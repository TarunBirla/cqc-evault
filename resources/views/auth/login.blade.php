<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
body{
    background:#eaf1f8;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:'Poppins', sans-serif;
}

.login-wrapper{
    width:900px;
    height:520px;
    background:#fff;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 15px 40px rgba(0,0,0,.1);
    display:flex;
}

/* LEFT PANEL */
.login-left{
    width:50%;
    background:linear-gradient(135deg,#2f80ed,#56ccf2);
    color:#fff;
    padding:50px;
    position:relative;
}

.login-left::after{
    content:'';
    position:absolute;
    inset:0;
    background-image:
      radial-gradient(circle at 20% 30%,rgba(255,255,255,.2) 2px,transparent 3px),
      radial-gradient(circle at 70% 60%,rgba(255,255,255,.2) 2px,transparent 3px),
      radial-gradient(circle at 40% 80%,rgba(255,255,255,.2) 2px,transparent 3px);
    background-size:150px 150px;
}

.login-left h1{
    font-size:34px;
    font-weight:700;
}

.login-left p{
    opacity:.9;
    margin-top:20px;
    line-height:1.7;
}

/* RIGHT PANEL */
.login-right{
    width:50%;
    padding:60px 50px;
}

.login-right h4{
    font-weight:700;
    color:#2f80ed;
}

.form-control{
    height:48px;
    border-radius:10px;
    background:#f4f7fb;
    border:none;
}

.form-control:focus{
    box-shadow:none;
    border:2px solid #2f80ed;
    background:#fff;
}

.login-btn{
    background:#2f80ed;
    border:none;
    padding:14px;
    width:100%;
    color:#fff;
    border-radius:30px;
    font-weight:600;
    margin-top:10px;
}

.login-btn:hover{
    background:#1c6ed5;
}

.small-link{
    color:#2f80ed;
    text-decoration:none;
    font-weight:500;
}

.checkbox-label{
    font-size:14px;
    color:#777;
}
</style>
</head>

<body>

<div class="login-wrapper">

    <!-- LEFT -->
    <div class="login-left text-center ">
        <small>CQC EVault</small>
        <h1 class="mt-4">WELCOME BACK</h1>
        <p>Nice to see you again!  
        Enter your credentials to access your account and continue your journey with us.</p>
    </div>

    <!-- RIGHT -->
    <div class="login-right">
        <h4>Login Account</h4>
        <p class="text-muted mb-4">Enter your email and password to login</p>

        <form method="POST" action="/login">
            @csrf

            <input type="email" name="email" class="form-control mb-3" placeholder="Email ID" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

            

            <button class="login-btn">Login</button>
        </form>
    </div>

</div>

</body>
</html>
