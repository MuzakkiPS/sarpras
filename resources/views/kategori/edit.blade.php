<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 min-h-screen flex justify-center items-center">
    <div class="bg-white p-6 rounded-xl shadow w-full max-w-sm">
        <h2 class="font-bold text-2xl text-center mb-5">Edit Kategori</h2>

        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nama_kategori" class="font-bold">Nama Kategori:</label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required class="w-full p-2 border rounded my-2">

            @error('nama_kategori')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <button type="submit" class="w-full p-2 bg-blue-600 text-white rounded hover:bg-blue-400">Update</button>
        </form>

       
        <a href="{{ route('index') }}" class="block mt-3 text-center text-blue-600 hover:text-blue-400">Back</a>
    </div>
</body>
</html>
