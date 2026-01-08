<div class="row">
<div class="col-md-8">
<h5>Files</h5>
<ul class="list-group">
@foreach($folder->documents as $doc)
<li class="list-group-item d-flex justify-content-between">
  {{ $doc->title }}
  <span>
    <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank">
      <i class="bi bi-eye"></i>
    </a>
    <i class="bi bi-clock-history text-info history-btn"
       data-id="{{ $doc->id }}"></i>
  </span>
</li>
@endforeach
</ul>
</div>

<div class="col-md-4">
<h5>Upload</h5>
<form method="POST" enctype="multipart/form-data" action="/admin/cqc-vault/upload">
@csrf
<input type="hidden" name="folder_id" value="{{ $folder->id }}">
<input type="text" name="title" class="form-control mb-2" placeholder="Title">
<input type="file" name="file" class="form-control mb-2">
<button class="btn btn-success">Upload</button>
</form>
</div>
</div>
