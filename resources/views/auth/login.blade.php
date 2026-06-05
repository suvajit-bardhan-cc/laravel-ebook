<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>eBook Stack - Login</title>
    <link rel="shortcut icon" href="images/1731092903.jpg" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <main class="login_wrapper">
        <section class="login_left">
            <div class="brand"><img src="images/logo.png" alt=""></div>

            <div>
                <h1>Holla,<br>Welcome Back</h1>
                <p class="subtitle">Hey, welcome back to your special place</p>

                <form action="/login" method="POST">@csrf
                    <input class="input" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>

                    @error('email')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror

                    <input class="input" id="password" name="password" type="password" value="{{ old('password') }}" required>

                    @error('password')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror

                    <button class="btn" type="submit">Sign In</button>
                </form>
            </div>
        </section>

        <section class="login-right">
            <div class="visual-card">
                <!-- Replace this image with your right-side illustration -->
                <div class="login_bg"></div>
            </div>
        </section>
    </main>
</body>

</html>