<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>   
</head>
<body class="min-h-screen flex items-center justify-center p-4 transition-all duration-1000 bg-gray-300">
    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-sm">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Login</h1>
        <form action="{{ route('login') }}" method="POST" onsubmit="handleFormSubmit(event)" class="space-y-5">
            @csrf
            <div>
                <input type="email" name="email" placeholder="Email" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition" />
            </div>
            <div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold p-3 rounded-lg transition">Login</button>
            </div>
        </form>
        <p class="text-center text-gray-600 text-sm mt-4">Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
        </p>
    </div>
</body>
</html>
