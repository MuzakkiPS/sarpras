<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex flex-col min-h-screen">
        <!-- Navbar -->
        <nav class="bg-blue-900 shadow-lg px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white">SARPRAS</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-red-400 hover:text-red-300">Logout</button>
            </form>
        </nav>

        <div class="flex flex-1">
            <!-- Sidebar -->
             <aside class="bg-blue-800 w-full md:w-64 shadow-lg">
                <nav class="mt-6">
                    <ul>
                        <li class="px-6 py-2 bg-blue-700">
                            <a href="{{ route('dashboard') }}"
                                class="text-white font-bold text-lg flex justify-center">Dashboard</a>
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
                        <li class="px-6 py-2 hover:bg-blue-700">
                            <a href="{{ route('pengembalian.index') }}"
                                class="text-white font-medium text-lg flex justify-center">Pengembalian</a>
                        </li>

                    </ul>
                </nav>
            </aside>

            <!-- Main -->
            <main class="flex-1 p-8">
                <h2 class="text-3xl font-bold text-blue-800 mb-6">Selamat Datang, {{ auth()->user()->name }}</h2>

                <!-- Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white shadow rounded p-4 text-center">
                        <h3 class="text-lg font-semibold text-gray-600">Total Barang</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $jumlahBarang }}</p>
                    </div>
                    <div class="bg-white shadow rounded p-4 text-center">
                        <h3 class="text-lg font-semibold text-gray-600">Total User</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $jumlahUser }}</p>
                    </div>
                    <div class="bg-white shadow rounded p-4 text-center">
                        <h3 class="text-lg font-semibold text-gray-600">Total Peminjaman</h3>
                        <p class="text-3xl font-bold text-yellow-600">{{ $jumlahPeminjaman }}</p>
                    </div>
                    <div class="bg-white shadow rounded p-4 text-center">
                        <h3 class="text-lg font-semibold text-gray-600">Belum Dikembalikan</h3>
                        <p class="text-3xl font-bold text-red-600">{{ $jumlahBelumKembali }}</p>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
