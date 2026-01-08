@extends('layouts.admin')

@section('content')

<h4>CQC E-Vault</h4>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- CREATE FOLDER -->
<form method="POST" action="{{ url('cqc-vault/folder/create') }}" class="mb-4">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <input name="name" class="form-control" placeholder="New Folder Name" required>
        </div>
        <div class="col-md-3">
            <button class="btn btn-success w-100">Create Folder</button>
        </div>
    </div>
</form>

<!-- FOLDERS -->
<div class="row">
@foreach($folders as $folder)
<div class="col-md-3 mb-3">
    <div class="card text-center shadow-sm">
        <div class="card-body">
            <i class="bi bi-folder-fill fs-1 text-warning"></i>
            <h6 class="mt-2">{{ $folder->name }}</h6>
            <a href="{{ url('cqc-vault/folder/'.$folder->id) }}" class="btn btn-primary btn-sm mb-1">View</a>

            <!-- DELETE FORM -->
            <form method="POST" action="{{ url('cqc-vault/folder/'.$folder->id) }}" onsubmit="return confirm('Are you sure you want to delete this folder?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    </div>
</div>
@endforeach
</div>

@endsection
