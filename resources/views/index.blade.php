<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex flex-col min-h-screen">
        <!-- Navbar -->
        <nav class="bg-blue-900 shadow-lg px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl md:text-3xl font-bold text-white">SARPRAS</h1>
            <ul class="flex space-x-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-red-400 hover:text-red-300">Logout</button>
                </form>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex flex-1 flex-col md:flex-row">
            <!-- Sidebar -->
            <aside class="bg-blue-800 w-full md:w-64 shadow-lg">
                <nav class="mt-6">
                    <ul>
                        <li class="px-6 py-2 hover:bg-blue-700">
                            <a href="{{ route('dashboard') }}"
                                class="text-white font-medium text-lg flex justify-center">Dashboard</a>
                        </li>
                        <li class="px-6 py-2 bg-blue-700">
                            <a href="{{ route('index') }}"
                                class="text-white font-bold text-lg flex justify-center">Pendataan</a>
                        </li>
                        <li class="px-6 py-2 hover:bg-blue-700">
                            <a href="{{ route('user') }}"
                                class="text-white font-medium text-lg flex justify-center">Pengguna</a>
                        </li>
                        <li class="px-6 py-2 hover:bg-blue-700">
                            <a href="{{ route('peminjaman') }}"
                                class="text-white font-medium text-lg flex justify-center">Peminjaman</a>
                        </li>
                        <li class="px-6 py-2 hover:bg-blue-700">
                            <a href="{{ route('pengembalian.index') }}"
                                class="text-white font-medium text-lg flex justify-center">Pengembalian</a>
                        </li>

                    </ul>
                </nav>
            </aside>

            <!-- Content -->
            <main class="flex-1 px-6 py-8">
                <h1 class="text-3xl font-bold text-blue-800 mb-6 ">Dashboard Data</h1>

                <!-- Kategori -->
                <div class="mb-10">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold text-gray-700">Data Kategori</h2>
                        <a href="{{ route('kategori.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Tambah Kategori</a>
                    </div>

                    <div class="overflow-x-auto bg-white rounded shadow">
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="bg-blue-900 text-left">
                                    <th class="px-4 py-2 text-white">No</th>
                                    <th class="px-4 py-2 text-white">Nama Kategori</th>
                                    <th class="px-4 py-2 text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategori as $index => $data)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2">{{ $data->nama_kategori }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('kategori.edit', $data->id) }}"
                                                class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('kategori.destroy', $data->id) }}" method="POST"
                                                class="inline-block ml-2"
                                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-gray-500">Tidak ada data
                                            kategori.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Barang -->
                <div class="mb-10">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold text-gray-700">Data Barang</h2>
                        <a href="{{ route('barang.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Tambah Barang</a>
                    </div>

                    <div class="overflow-x-auto bg-white rounded shadow">
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="bg-blue-900 text-left">
                                    <th class="px-4 py-2 text-white">No</th>
                                    <th class="px-4 py-2 text-white">Nama Barang</th>
                                    <th class="px-4 py-2 text-white">Kategori</th>
                                    <th class="px-4 py-2 text-white">Stok</th>
                                    <th class="px-4 py-2 text-white">Foto</th>
                                    <th class="px-4 py-2 text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barang as $index => $item)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2">{{ $item->nama_barang }}</td>
                                        <td class="px-4 py-2">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $item->stok }}</td>
                                        <td class="px-4 py-2">
                                            @if ($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto"
                                                    class="w-16">
                                            @else
                                                Tidak ada
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('barang.edit', $item->id) }}"
                                                class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                                class="inline-block ml-2"
                                                onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada data barang.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>
</body>

</html>
