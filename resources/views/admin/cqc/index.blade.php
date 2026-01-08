<div class="container mt-4">
<h4>CQC E-Vault</h4>


<div class="container mt-4">

<h4>CQC E-Vault</h4>

<!-- CREATE FOLDER FORM -->
<form method="POST" action="{{ url('cqc-vault/folder/create') }}" class="mb-4">
@csrf
<div class="row">
    <div class="col-md-9">
        <input type="text" name="name" class="form-control"
               placeholder="Enter Folder Name" required>
    </div>
    <div class="col-md-3">
        <button class="btn btn-success w-100">Create Folder</button>
    </div>
</div>
</form>


<div class="row">
@foreach($folders as $folder)
<div class="col-md-3">
  <div class="card text-center">
    <div class="card-body">
      <i class="bi bi-folder-fill fs-1 text-warning"></i>
      <h6>{{ $folder->name }}</h6>
      <a href="{{ url('cqc-vault/folder/'.$folder->id) }}"
   class="btn btn-sm btn-primary">
   View
</a>
    </div>
  </div>
</div>
@endforeach
</div>
</div>
