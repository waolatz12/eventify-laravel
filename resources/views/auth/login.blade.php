<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Event Ticketing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Optional: Tailwind CDN for quick styling -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md text-center">
        <h1 class="text-2xl font-bold mb-6">Login</h1>

        <p class="mb-6 text-gray-600">
            Sign in to your account
        </p>

        <a href="{{ route('auth.google.redirect') }}"
           class="flex items-center justify-center gap-3 bg-red-600 text-white px-4 py-3 rounded-lg hover:bg-red-700 transition">

            <!-- Google icon -->
            <svg class="w-5 h-5" viewBox="0 0 48 48">
                <path fill="#FFC107" d="M43.6 20.4H42V20H24v8h11.3C33.7 32.7 29.2 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.2 6.1 29.4 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.7-.4-3.6z"/>
                <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.7 16 19 12 24 12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.2 6.1 29.4 4 24 4 16.3 4 9.7 8.3 6.3 14.7z"/>
                <path fill="#4CAF50" d="M24 44c5.1 0 9.8-2 13.3-5.3l-6.1-5.2C29.1 35.1 26.7 36 24 36c-5.2 0-9.6-3.3-11.3-8l-6.5 5C9.6 39.6 16.3 44 24 44z"/>
                <path fill="#1976D2" d="M43.6 20.4H42V20H24v8h11.3c-1.1 3-3.4 5.4-6.3 6.9l.1.1 6.1 5.2C34.8 39.8 40 36 42.4 30c1-2.6 1.6-5.4 1.6-8 0-1.3-.1-2.7-.4-3.6z"/>
            </svg>

            Continue with Google
        </a>

    </div>

</body>
</html>
