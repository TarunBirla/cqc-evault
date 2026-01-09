<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#f5f7fb;}
.card{border-radius:15px;box-shadow:0 10px 30px rgba(0,0,0,.1);}
</style>
</head>
<body>

<div class="container">
 <div class="row justify-content-center mt-5">
  <div class="col-md-5">
   <div class="card p-4">
    <h4 class="text-center mb-4">Create Account</h4>

    <form method="POST" action="/register">
     @csrf

     <input class="form-control mb-3" name="name" placeholder="Full Name" required>
     <input class="form-control mb-3" name="email" placeholder="Email" required>
     <input class="form-control mb-3" name="phone" placeholder="Phone" required>
     <input type="password" class="form-control mb-3" name="password" placeholder="Password" required>
     <input type="password" class="form-control mb-3" name="password_confirmation" placeholder="Confirm Password" required>

     <button class="btn btn-primary w-100">Register</button>
     <p class="text-center mt-3">
      Already have account? <a href="/login">Login</a>
     </p>
    </form>

   </div>
  </div>
 </div>
</div>

</body>
</html>
