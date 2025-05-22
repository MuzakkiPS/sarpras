<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Register User</h2>
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('register.user') }}" method="POST" class="mb-3">
            @csrf
            <input type="hidden" name="role" value="user">
            <input type="text" name="name" placeholder="Nama" required class="w-full p-2 border rounded mb-3">
            <input type="email" name="email" placeholder="Email" required class="w-full p-2 border rounded mb-3">
            <input type="password" name="password" placeholder="Password" required class="w-full p-2 border rounded mb-3">
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required class="w-full p-2 border rounded mb-3">
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-400">Register User</button>
        </form>
        <a href="{{route('user')}}" class="flex justify-center text-blue-600">Back</a>
    </div>
</body>
</html>
