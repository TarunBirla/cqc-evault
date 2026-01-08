<div class="container mt-4">
<h4>CQC E-Vault</h4>

<div class="row">
@foreach($folders as $folder)
<div class="col-md-3">
  <div class="card text-center">
    <div class="card-body">
      <i class="bi bi-folder-fill fs-1 text-warning"></i>
      <h6>{{ $folder->name }}</h6>
      <a href="/admin/cqc-vault/folder/{{ $folder->id }}" class="btn btn-sm btn-primary">
        View
      </a>
    </div>
  </div>
</div>
@endforeach
</div>
</div>
