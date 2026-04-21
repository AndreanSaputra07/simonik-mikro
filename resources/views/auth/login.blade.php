<!DOCTYPE html>
<html>
<head>
    <title>Login SIMONIK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background: url('/assets/login.jpg') no-repeat center center;
    background-size: 100% 100%;
    height:100vh;
    font-family:'Segoe UI', sans-serif;
}

/* overlay supaya tulisan tetap jelas */
.overlay{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.3);
}

/* card login */
.login-card{
    width:420px;
    border-radius:20px;
    border:none;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
    background:white;
}

/* icon input */
.input-group-text{
    background:white;
}

.form-control{
    padding:10px;
}

/* tombol login */
.login-btn{
    background:#FFC72C;
    font-weight:bold;
    border-radius:10px;
    padding:10px;
    transition:0.3s;
}

.login-btn:hover{
    background:#ffb700;
}

/* logo */
.logo{
    width:120px;
    margin-bottom:10px;
}

</style>

</head>

<body>

<div class="overlay"></div>

<div class="container vh-100 d-flex justify-content-center align-items-center position-relative">

    <div class="card login-card p-4">

        <div class="text-center">

            <img src="/assets/mandiri.png" class="logo">

            <h4 class="fw-bold text-primary mb-4">LOGIN SIMONIK-MIKRO</h4>

        </div>

        <form method="POST" action="/login">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label>Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope-fill"></i>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email">
                </div>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label>Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password">
                </div>
            </div>

            <button class="btn login-btn w-100">
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>