<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Pengguna</title>
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
                        <li class="px-6 py-2 bg-blue-700">
                            <a href="{{ route('user') }}"
                                class="text-white font-bold text-lg flex justify-center">Pengguna</a>
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

            <!-- Main Content Area -->
            <main class="flex-1 px-6 py-8">
                <h1 class="text-3xl font-bold text-blue-700 mb-6">Daftar Akun Terdaftar</h1>

                <div class="flex justify-end mb-4">
                    <a href="{{ route('register.user') }}"
                        class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded">Tambah Pengguna</a>
                </div>

                <div class="overflow-x-auto bg-white shadow rounded p-4">
                    <table class="w-full text-sm">
                        <thead class="bg-blue-900 text-left font-semibold">
                            <tr>
                                <th class="p-2 text-white">No</th>
                                <th class="p-2 text-white">Nama</th>
                                <th class="p-2 text-white">Email</th>
                                <th class="p-2 text-white">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $i => $user)
                                <tr class="border-t">
                                    <td class="p-2">{{ $i + 1 }}</td>
                                    <td class="p-2">{{ $user->name }}</td>
                                    <td class="p-2">{{ $user->email }}</td>
                                    <td class="p-2 capitalize">{{ $user->role }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
