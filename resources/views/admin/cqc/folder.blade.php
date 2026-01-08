<div class="container mt-4">

<a href="{{ url('cqc-vault') }}" class="btn btn-secondary mb-3">
← Back to Folders
</a>

<div class="row">
<!-- LEFT: FILE LIST -->
<div class="col-md-8">
<h5>Files in {{ $folder->name }}</h5>

<ul class="list-group">
@forelse($folder->documents as $doc)
<li class="list-group-item d-flex justify-content-between align-items-center">
  {{ $doc->title }}

  <span>
    <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank"
       class="me-2">
      <i class="bi bi-eye"></i>
    </a>

    <button class="btn btn-link p-0 history-btn"
            data-id="{{ $doc->id }}">
      <i class="bi bi-clock-history text-info"></i>
    </button>
  </span>
</li>
@empty
<li class="list-group-item text-muted">
No documents found.
</li>
@endforelse
</ul>
</div>

<!-- RIGHT: UPLOAD -->
<div class="col-md-4">
<h5>Upload Document</h5>

<form method="POST" enctype="multipart/form-data"
      action="{{ url('cqc-vault/upload') }}">
@csrf

<input type="hidden" name="folder_id" value="{{ $folder->id }}">

<input type="text" name="title" class="form-control mb-2"
       placeholder="Document Title" required>

<input type="file" name="file" class="form-control mb-2" required>

<button class="btn btn-success w-100">
Upload
</button>
</form>
</div>
</div>
</div>
