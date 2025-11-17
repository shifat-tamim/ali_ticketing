<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="login-page">

    <div class="logo">
        <img src="/images/logo.png" alt="Logo">
    </div>

    <div class="login-wrapper">
        <div class="login-box">

            <h2>Login</h2>

            @if(session('error'))
                <p class="error">{{ session('error') }}</p>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <label>Username</label>
                <input type="text" name="username">

                <label>Password</label>
                <input type="password" name="password">

                <button type="submit">Login</button>
            </form>

        </div>
    </div>

</div>
</body>
</html>
