<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder; 
use App\Models\Document;
use App\Models\DocumentHistory;

class CqcVaultController extends Controller
{
    public function index()
    {
        $folders = Folder::whereNull('parent_id')->get();
        return view('admin.cqc.index', compact('folders'));
    }

   public function viewFolder($id)
{
    $folder = Folder::with(['children','documents'])->findOrFail($id);
    return view('admin.cqc.folder',compact('folder'));
}


public function upload(Request $request)
{
    $request->validate([
        'title' => 'required',
        'file'  => 'required|file|max:10240'
    ]);

    $file = $request->file('file');

    // Create a unique filename
    $filename = time().'_'.$file->getClientOriginalName();

    // Define the public folder path
    $destinationPath = public_path('cqc'); // public/cqc

    // Make folder if it doesn't exist
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }

    // Move the file to public/cqc
    $file->move($destinationPath, $filename);

    // Save in DB (file_path relative to public/)
    $doc = Document::create([
        'folder_id'   => $request->folder_id,
        'title'       => $request->title,
        'file_path'   => 'cqc/'.$filename, // directly under public/cqc
        'uploaded_by' => 1
    ]);

    DocumentHistory::create([
        'document_id' => $doc->id,
        'action'      => 'uploaded',
        'file_path'   => 'cqc/'.$filename,
        'created_at'  => now()
    ]);

    return back()->with('success','Document Uploaded');
}




    public function history($id)
    {
        $history = DocumentHistory::where('document_id',$id)->get();
        return response()->json($history);
    }

 public function createFolder(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Folder::create([
        'name'      => $request->name,
        'parent_id' => $request->parent_id ?: null,
        'year'      => $request->year ?: null
    ]);

    return back()->with('success','Folder created successfully');
}
// Add multiple subfolders under current folder
public function addSubfolders(Request $request, $folderId)
{
    $parentFolder = Folder::findOrFail($folderId);

    // ❌ Agar ye already subfolder hai to allow mat karo
    if ($parentFolder->parent_id !== null) {
        return back()->with('error', 'Subfolder ke andar aur subfolder create nahi ho sakta');
    }

    $request->validate([
        'names' => 'required|array',
        'names.*' => 'required|string|max:255',
    ]);

    foreach ($request->names as $name) {
        Folder::create([
            'name' => $name,
            'parent_id' => $folderId,
        ]);
    }

    return back()->with('success', 'Subfolder(s) created successfully');
}


// Delete a folder (and optionally its subfolders and documents)
public function dFolder($id)
{
    $folder = Folder::findOrFail($id);

    // Optional: delete subfolders recursively
    foreach($folder->children as $child) {
        $child->delete();
    }

    // Optional: delete documents inside
    foreach($folder->documents as $doc) {
        if(file_exists(public_path($doc->file_path))) {
            unlink(public_path($doc->file_path));
        }
        $doc->delete();
    }

    $folder->delete();

    return back()->with('success', 'Folder deleted successfully');
}


// Delete a subfolder
public function deleteFolder($id)
{
    $folder = Folder::findOrFail($id);
    $folder->delete(); // optionally delete documents inside if needed

    return back()->with('success', 'Folder deleted successfully');
}
public function deleteDocument($id)
{
    $doc = Document::findOrFail($id);

    // File delete from public folder
    if ($doc->file_path && file_exists(public_path($doc->file_path))) {
        unlink(public_path($doc->file_path));
    }

    // Optional: delete document history
    DocumentHistory::where('document_id', $doc->id)->delete();

    // Delete document record
    $doc->delete();

    return back()->with('success', 'Document deleted successfully');
}


}



