<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        </div>
    </div>
</body>

</html>
