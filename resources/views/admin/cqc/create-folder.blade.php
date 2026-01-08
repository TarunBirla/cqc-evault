@extends('layouts.admin')

@section('content')

<h3 class="mb-4">Create Folder / Subfolder</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
<div class="card-body">

<form method="POST" action="{{ url('cqc-vault/folder/create') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Folder Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter folder name" required>
    </div>

    <div class="mb-3">
        <label for="parent_id" class="form-label">Parent Folder (optional)</label>
        <select name="parent_id" id="parent_id" class="form-select">
            <option value="">-- None (Top Level) --</option>
            @foreach($folders as $folder)
            <option value="{{ $folder->id }}">{{ $folder->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="year" class="form-label">Year (optional)</label>
        <input type="number" name="year" id="year" class="form-control" placeholder="2026">
    </div>

    <button type="submit" class="btn btn-success w-100">Create Folder</button>
</form>

</div>
</div>

<a href="{{ url('cqc-vault') }}" class="btn btn-secondary mt-3">
<i class="bi bi-arrow-left"></i> Back to Folders
</a>

@endsection
