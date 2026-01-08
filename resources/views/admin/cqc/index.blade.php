@extends('layouts.admin')

@section('content')

<h4>CQC E-Vault</h4>

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
<a href="{{ url('cqc-vault/folder/'.$folder->id) }}" class="btn btn-primary btn-sm">
View
</a>
</div>
</div>
</div>
@endforeach
</div>

@endsection
