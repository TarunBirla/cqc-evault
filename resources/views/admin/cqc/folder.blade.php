@extends('layouts.admin')

@section('content')

<a href="{{ url('cqc-vault') }}" class="btn btn-secondary mb-3">
← Back
</a>

<div class="row">

<!-- LEFT SIDEBAR -->
<div class="col-md-3">
<div class="card shadow-sm">
<div class="card-header fw-bold">{{ $folder->name }}</div>
<ul class="list-group list-group-flush">
@foreach($folder->children as $child)
<li class="list-group-item d-flex justify-content-between">
<a href="{{ url('cqc-vault/folder/'.$child->id) }}">
{{ $child->name }}
</a>
<i class="bi bi-eye"></i>
</li>
@endforeach
</ul>
</div>
</div>

<!-- RIGHT CONTENT -->
<div class="col-md-9">

<h5>Files</h5>

<table class="table table-bordered bg-white shadow-sm">
<thead>
<tr>
<th>Title</th>
<th width="80">View</th>
<th width="80">History</th>
</tr>
</thead>

<tbody>
@forelse($folder->documents as $doc)
<tr>
<td>{{ $doc->title }}</td>
<td class="text-center">
<a href="{{ asset($doc->file_path) }}" target="_blank">
    <i class="bi bi-eye text-primary"></i>
</a>

</td>
<td class="text-center">
<button class="btn btn-sm btn-info history-btn"
data-id="{{ $doc->id }}">
<i class="bi bi-clock-history"></i>
</button>
</td>
</tr>
@empty
<tr>
<td colspan="3" class="text-center text-muted">
No documents uploaded.
</td>
</tr>
@endforelse
</tbody>
</table>

<hr>

<!-- UPLOAD -->
<h6>Upload Document</h6>

<form method="POST" enctype="multipart/form-data"
action="{{ url('cqc-vault/upload') }}">
@csrf
<input type="hidden" name="folder_id" value="{{ $folder->id }}">

<input class="form-control mb-2" name="title"
placeholder="Document Title" required>

<input class="form-control mb-2" type="file" name="file" required>

<button class="btn btn-success">
Upload
</button>
</form>

</div>
</div>

<!-- HISTORY MODAL -->
<div class="modal fade" id="historyModal">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5>Document History</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<ul id="historyList" class="list-group"></ul>
</div>

</div>
</div>
</div>

<script>
$('.history-btn').click(function(){
let id = $(this).data('id');

$.get('{{ url("cqc-vault/history") }}/'+id, function(res){
let html='';
res.forEach(r=>{
html+=`<li class="list-group-item">
${r.action} <br><small>${r.created_at}</small>
</li>`;
});
$('#historyList').html(html);
$('#historyModal').modal('show');
});
});
</script>

@endsection
