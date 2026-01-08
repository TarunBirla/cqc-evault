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

    dd($request->all(), $request->file('file'));
    $request->validate([
        'title' => 'required',
        'file'  => 'required|file|max:10240'
    ]);

    $path = $request->file('file')->store('cqc', 'public');

    $doc = Document::create([
        'folder_id'   => $request->folder_id,
        'title'       => $request->title,
        'file_path'   => $path,
        'uploaded_by' => 1 // TEMP if auth not ready
    ]);

    DocumentHistory::create([
        'document_id' => $doc->id,
        'action'      => 'uploaded',
        'file_path'   => $path,
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


}



