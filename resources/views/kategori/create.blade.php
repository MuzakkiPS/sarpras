<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 min-h-screen flex justify-center items-center">
    <div class="bg-white p-6 rounded-xl shadow w-full max-w-sm">
        <h2 class="flex justify-center font-bold text-2xl mb-5">Tambah Kategori Barang</h2>
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <label for="nama_kategori" class="font-bold">Nama Kategori:</label>
            <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}" required
                class="w-full p-2 border border-black rounded my-2">
            @error('nama_kategori')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            <button type="submit"
                class="p-2 bg-blue-600 rounded-lg mb-3 text-white hover:bg-blue-400 w-full">Simpan</button>
        </form>
        <a href="{{ route('index') }}" class="block text-center text-blue-600 hover:text-blue-400">Back</a>
    </div>
</body>
</html>
