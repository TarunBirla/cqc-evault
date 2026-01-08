@extends('layouts.admin')

@section('content')

<h4>Create Folder / Subfolder</h4>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- CREATE FOLDER FORM -->
<form method="POST" action="{{ url('cqc-vault/folder/create') }}" class="mb-4">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-2">
            <input type="text" name="name" class="form-control" placeholder="Folder Name" required>
        </div>
        <div class="col-md-6 mb-2">
            <select name="parent_id" class="form-select">
                <option value="">-- Select Parent Folder (for Subfolder) --</option>
                @foreach($folders as $folder)
                <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <button class="btn btn-success w-100">Create Folder</button>
        </div>
    </div>
</form>

<!-- EXISTING FOLDERS -->
<h5>Top-Level Folders</h5>
<div class="row">
    @foreach($folders as $folder)
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <i class="bi bi-folder-fill fs-1 text-warning"></i>
                <h6 class="mt-2">{{ $folder->name }}</h6>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
