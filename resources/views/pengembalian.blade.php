<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pengembalian</title>
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
                        <li class="px-6 py-2 hover:bg-blue-700">
                            <a href="{{ route('peminjaman') }}"
                                class="text-white font-medium text-lg flex justify-center">Peminjaman</a>
                        </li>
                        <li class="px-6 py-2 bg-blue-700">
                            <a href="{{ route('pengembalian.index') }}"
                                class="text-white font-bold text-lg flex justify-center">Pengembalian</a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <!-- Content -->
            <main class="flex-1 px-6 py-8">
                <h1 class="text-3xl font-bold text-blue-800 mb-6">Data Pengembalian</h1>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto bg-white shadow-md rounded p-4">
                    <table class="w-full table-auto">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left">No</th>
                                <th class="px-4 py-2 text-left">Nama Peminjam</th>
                                <th class="px-4 py-2 text-left">Barang</th>
                                <th class="px-4 py-2 text-left">Tanggal Kembali</th>
                                <th class="px-4 py-2 text-left">Keterangan</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Foto Pengembalian</th>
                                <th class="px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengembalians as $index => $data)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $data->peminjaman->user->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $data->peminjaman->barang->nama_barang ?? '-' }}</td>
                                    <td class="px-4 py-2">
                                        {{ $data->tanggal_pengembalian
                                            ? \Carbon\Carbon::parse($data->tanggal_pengembalian)->format('d-m-Y')
                                            : '-' }}
                                    </td>
                                    <td class="px-4 py-2">{{ $data->keterangan ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($data->status) ?? '-' }}</td>
                                 <td class="px-4 py-2">
    @if ($data->foto_pengembalian)
        <img src="{{ asset('storage/' . $data->foto_pengembalian) }}"
            alt="Foto Pengembalian" class="w-24 h-auto " />
    @else
        Tidak ada foto
    @endif
</td>

                                    <td class="px-4 py-2">
                                        <form action="{{ route('pengembalian.updateStatus', $data->id) }}" method="POST"
                                            class="flex gap-2">
                                            @csrf
                                            @method('PUT')

                                            @if (strtolower(trim($data->status)) === 'menunggu konfirmasi')
                                                <button name="status" value="disetujui"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-sm">
                                                    Setujui
                                                </button>
                                                <button name="status" value="ditolak"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-sm">
                                                    Tolak
                                                </button>
                                            @else
                                                <span class="text-gray-800 font-semibold">
                                                    {{ ucfirst($data->status) }}
                                                </span>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-gray-500 py-4">Tidak ada data pengembalian.</td>
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
