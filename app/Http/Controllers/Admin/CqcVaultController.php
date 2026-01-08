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
        $folder = Folder::with('documents')->findOrFail($id);
        return view('admin.cqc.folder', compact('folder'));
    }

    public function upload(Request $request)
    {
        $path = $request->file('file')->store('cqc', 'public');

        $doc = Document::create([
            'folder_id' => $request->folder_id,
            'title' => $request->title,
            'file_path' => $path,
            'uploaded_by' => auth()->id()
        ]);

        DocumentHistory::create([
            'document_id' => $doc->id,
            'action' => 'uploaded',
            'file_path' => $path,
            'created_at' => now()
        ]);

        return back()->with('success','Document Uploaded');
    }

    public function history($id)
    {
        $history = DocumentHistory::where('document_id',$id)->get();
        return response()->json($history);
    }
}

