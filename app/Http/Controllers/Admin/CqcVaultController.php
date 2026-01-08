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

// Show page to create folder/subfolder
public function createFolderPage()
{
    $folders = Folder::whereNull('parent_id')->get(); // top-level folders
    return view('admin.cqc.create-folder', compact('folders'));
}

// Create folder/subfolder
public function createFolder(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Folder::create([
        'name'      => $request->name,
        'parent_id' => $request->parent_id ?: null, // null if top-level
        'year'      => $request->year ?: null
    ]);

    return back()->with('success','Folder created successfully');
}



}



