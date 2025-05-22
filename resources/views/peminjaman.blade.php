    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>Daftar Peminjaman</title>
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
                            <li class="px-6 py-2 hover:bg-blue-700">
                                <a href="{{ route('index') }}"
                                    class="text-white font-medium text-lg flex justify-center">Pendataan</a>
                            </li>
                            <li class="px-6 py-2 hover:bg-blue-700">
                                <a href="{{ route('user') }}"
                                    class="text-white font-medium text-lg flex justify-center">Pengguna</a>
                            </li>
                            <li class="px-6 py-2 bg-blue-700">
                                <a href="{{ route('peminjaman') }}"
                                    class="text-white font-bold text-lg flex justify-center">Peminjaman</a>
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
                    <h1 class="text-3xl font-bold text-blue-800 mb-6">Daftar Peminjaman</h1>

                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto bg-white shadow-md rounded p-4">
                        <table class="w-full table-auto">
                            <thead class="bg-blue-900">
                                <tr>
                                    <th class="px-4 py-2 text-left text-white">No</th>
                                    <th class="px-4 py-2 text-left text-white">Nama Peminjam</th>
                                    <th class="px-4 py-2 text-left text-white">Barang</th>
                                    <th class="px-4 py-2 text-left text-white">Tgl Pinjam</th>
                                    <th class="px-4 py-2 text-left text-white">Jumlah</th>
                                    <th class="px-4 py-2 text-left text-white">Status</th>
                                    <th class="px-4 py-2 text-left text-white">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($peminjamans as $index => $data)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2">{{ $data->user->name }}</td>
                                        <td class="px-4 py-2">{{ $data->barang->nama_barang }}</td>
                                        <td class="px-4 py-2">{{ $data->tanggal_pinjam }}</td>
                                        <td class="px-4 py-2">{{ $data->jumlah }}</td>
                                        <td class="px-4 py-2 capitalize">
                                            {{ $data->status }} <br>
                                            @if ($data->pengembalian)
                                                <span class="text-green-600 text-sm">Sudah dikembalikan</span>
                                            @elseif($data->status === 'disetujui')
                                                <span class="text-yellow-600 text-sm">Belum dikembalikan</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 space-x-2">
                                            @if ($data->status === 'menunggu')
                                                <form action="{{ route('peminjaman.approve', $data->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Setujui</button>
                                                </form>
                                                <form action="{{ route('peminjaman.reject', $data->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Tolak</button>
                                                </form>
                                            @else
                                                <span class="text-gray-600 italic">Tidak Ada Aksi</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada data
                                            peminjaman.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </body>

    </html>
