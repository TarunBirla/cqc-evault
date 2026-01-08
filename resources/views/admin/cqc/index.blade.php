@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-shield-lock-fill text-primary me-2"></i>
            CQC E-Vault
        </h4>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row g-4">

        <!-- LEFT SIDE : CREATE FOLDER -->
        <div class="col-lg-4 col-md-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-folder-plus me-2"></i>
                        Create New Folder
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ url('cqc-vault/folder/create') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-tag-fill text-muted me-1"></i>
                                Folder Name
                            </label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control form-control-lg"
                                   placeholder="e.g., Staff Documents"
                                   required
                                   autofocus>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
                            <i class="bi bi-plus-circle me-2"></i>
                            Create Folder
                        </button>
                    </form>

                    <div class="mt-4 p-3 bg-light rounded">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Organize your CQC documents by creating folders for different categories.
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE : FOLDER LIST -->
        <div class="col-lg-8 col-md-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold text-dark">
                        <i class="bi bi-folder2-open me-2 text-warning"></i>
                        Your Folders
                        <span class="badge bg-secondary ms-2">{{ count($folders) }}</span>
                    </h5>
                </div>

                <div class="card-body p-4">
                    @forelse($folders as $folder)
                    <div class="folder-item mb-3">
                        <div class="card border hover-shadow transition-all" 
                             style="transition: all 0.3s ease;">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between">

                                    <!-- LEFT : ICON + NAME -->
                                    <div class="d-flex align-items-center gap-3 flex-grow-1" style="min-width: 0;">
                                        <div class="folder-icon">
                                            <i class="bi bi-folder-fill text-warning" style="font-size: 2rem;"></i>
                                        </div>

                                        <div class="flex-grow-1" style="min-width: 0;">
                                            <h6 class="mb-0 fw-semibold text-truncate" 
                                                title="{{ $folder->name }}">
                                                {{ $folder->name }}
                                            </h6>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                Created {{ $folder->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>

                                    <!-- RIGHT : ACTIONS -->
                                    <div class="d-flex gap-2 flex-shrink-0">
                                        <a href="{{ url('cqc-vault/folder/'.$folder->id) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Open Folder">
                                            <i class="bi bi-box-arrow-in-right"></i>
                                            <span class="d-none d-sm-inline ms-1">Open</span>
                                        </a>

                                        <form method="POST"
                                              action="{{ url('cqc-vault/folder/'.$folder->id) }}"
                                              onsubmit="return confirm('Are you sure you want to delete this folder? All files inside will be removed.');"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Delete Folder">
                                                <i class="bi bi-trash"></i>
                                                <span class="d-none d-sm-inline ms-1">Delete</span>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-folder-x" style="font-size: 4rem; color: #dee2e6;"></i>
                        </div>
                        <h5 class="text-muted mb-2">No Folders Yet</h5>
                        <p class="text-muted mb-0">
                            Create your first folder to start organizing documents.
                        </p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>

<style>
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    transform: translateY(-2px);
}

.transition-all {
    transition: all 0.3s ease;
}

.folder-item .card {
    border-left: 4px solid transparent;
}

.folder-item .card:hover {
    border-left-color: #667eea;
    background-color: #f8f9fa;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5568d3 0%, #65408b 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

@media (max-width: 768px) {
    .d-none.d-sm-inline {
        display: none !important;
    }
}
</style>

@endsection