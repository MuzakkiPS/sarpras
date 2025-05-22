<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-center">
    <div class="bg-white p-6 rounded-xl shadow w-full max-w-md">
        <h2 class="text-2xl font-bold mb-5 text-center">Edit Barang</h2>

        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="block mb-2 font-bold">Kategori:</label>
            <select name="kategori_barang_id" class="w-full p-2 border rounded mb-4">
                @foreach ($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ $barang->kategori_barang_id == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <label class="block mb-2 font-bold">Nama Barang:</label>
            <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" class="w-full p-2 border rounded mb-4">

            <label class="block mb-2 font-bold">Deskripsi:</label>
            <textarea name="deskripsi" class="w-full p-2 border rounded mb-4">{{ $barang->deskripsi }}</textarea>

            <label class="block mb-2 font-bold">Stok:</label>
            <input type="number" name="stok" value="{{ $barang->stok }}" class="w-full p-2 border rounded mb-4">

            <label class="block mb-2 font-bold">Foto (opsional):</label>
            <input type="file" name="foto" class="mb-4">

            @if($barang->foto)
                <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto Barang" class="w-32 mb-4">
            @endif

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-500">Simpan Perubahan</button>
        </form>

        <a href="{{ route('index') }}" class="block text-center mt-4 text-blue-600 hover:underline">Kembali</a>
    </div>
</body>
</html>
