<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-center">
    <div class="bg-white p-6 rounded-xl shadow w-full max-w-md">
        <h2 class="text-2xl font-bold mb-5 text-center">Tambah Barang</h2>

        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="block mb-2 font-bold">Kategori:</label>
            <select name="kategori_barang_id" class="w-full p-2 border rounded mb-4">
                @foreach ($kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                @endforeach
            </select>

            <label class="block mb-2 font-bold">Nama Barang:</label>
            <input type="text" name="nama_barang" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2 font-bold">Deskripsi:</label>
            <textarea name="deskripsi" class="w-full p-2 border rounded mb-4"></textarea>

            <label class="block mb-2 font-bold">Stok:</label>
            <input type="number" name="stok" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2 font-bold">Foto (opsional):</label>
            <input type="file" name="foto" class="mb-4">

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-500">Simpan Barang</button>
        </form>

        <a href="{{ route('index') }}" class="block text-center mt-4 text-blue-600 hover:underline">Back</a>
    </div>
</body>
</html>
