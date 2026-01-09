<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#eef2f7;}
.card{border-radius:15px;box-shadow:0 10px 30px rgba(0,0,0,.1);}
</style>
</head>
<body>

<div class="container">
 <div class="row justify-content-center mt-5">
  <div class="col-md-4">
   <div class="card p-4">

    <h4 class="text-center mb-4">Login</h4>

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="/login">
     @csrf

     <input class="form-control mb-3" name="email" placeholder="Email" required>
     <input type="password" class="form-control mb-3" name="password" placeholder="Password" required>

     <button class="btn btn-primary w-100">Login</button>
    </form>

   </div>
  </div>
 </div>
</div>

</body>
</html>
