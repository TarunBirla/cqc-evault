@extends('layouts.admin')

@section('content')

<h4 class="mb-4 fw-bold">CQC E-Vault</h4>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">

    <!-- LEFT SIDE : CREATE FOLDER -->
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold">
                <i class="bi bi-folder-plus me-1"></i> Create New Folder
            </div>

            <div class="card-body">
                <form method="POST" action="{{ url('cqc-vault/folder/create') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Folder Name</label>
                        <input type="text" name="name" class="form-control"
                               placeholder="Enter folder name" required>
                    </div>

                    <button class="btn btn-success w-100">
                        <i class="bi bi-plus-circle me-1"></i> Create Folder
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE : FOLDER LIST -->
    <div class="col-md-6">
        <div class="row">

            @forelse($folders as $folder)
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm h-100 folder-card">
                    <div class="card-body text-center">

                        <i class="bi bi-folder-fill text-warning fs-1"></i>

                        <h6 class="mt-2 fw-bold text-truncate">
                            {{ $folder->name }}
                        </h6>

                        <div class="d-flex justify-content-center gap-2 mt-3">

                            <!-- VIEW -->
                            <a href="{{ url('cqc-vault/folder/'.$folder->id) }}"
                               class="btn btn-sm btn-outline-primary"
                               title="View Folder">
                                <i class="bi bi-eye"></i>
                            </a>

                            <!-- DELETE -->
                            <form method="POST"
                                  action="{{ url('cqc-vault/folder/'.$folder->id) }}"
                                  onsubmit="return confirm('Delete this folder?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Delete Folder">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                No folders created yet.
            </div>
            @endforelse

        </div>
    </div>

</div>
@endsection
