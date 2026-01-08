<!DOCTYPE html>
<html>
<head>
<title>CQC E-Vault</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body{ background:#f4f6f9; }
        .sidebar{
            width:240px;
            height:100vh;
            position:fixed;
            background:#1f2937;
            color:white;
        }
        .sidebar a{
            color:white;
            text-decoration:none;
            padding:12px;
            display:block;
        }
        .sidebar a:hover{ background:#374151; }
        .content{
            margin-left:240px;
            padding:20px;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
<h5 class="p-3 border-bottom">Admin Panel</h5>

<a href="{{ url('cqc-vault') }}">
    <i class="bi bi-folder2-open me-2"></i>CQC E-Vault
</a>
<a href="{{ url('cqc-vault/audit-logs') }}">
    <i class="bi bi-journal-text me-2"></i>Audit Logs
</a>

</div>

<!-- CONTENT -->
<div class="content">
@yield('content')
</div>

</body>
</html>
