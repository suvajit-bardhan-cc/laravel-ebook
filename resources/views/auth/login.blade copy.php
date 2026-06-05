<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>eBook Stack - Login</title>
  <link rel="shortcut icon" href="images/1731092903.jpg" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/login_style.css?v=3">
  <link rel="stylesheet" href="css/style.css?v=3">
</head>

<body>
  <main class="login_wrapper">
    <section class="login_left">
      <div class="brand"><img src="images/logo.png" alt=""></div>

      <div>
        <h1>Holla,<br>Welcome Back</h1>
        <p class="subtitle">Hey, welcome back to your special place</p>

        <form method="POST" action="/login" class="space-y-5">

    <div>
        <label for="email" class="block mb-2 text-sm font-medium">
            Email address
        </label>
        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
            autofocus
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
        @error('email')
            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password" class="block mb-2 text-sm font-medium">
            Password
        </label>
        <input
            id="password"
            type="password"
            name="password"
            required
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
        @error('password')
            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex items-center justify-between">
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="remember">
            <span>Remember me</span>
        </label>

        <a href="#" class="text-sm text-red-600 hover:underline">
            Forgot password?
        </a>
    </div>

    <button
        type="submit"
        class="w-full py-3 rounded-lg bg-black text-white font-medium hover:bg-gray-800 transition">
        Sign In
    </button>

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