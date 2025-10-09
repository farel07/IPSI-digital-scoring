<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Superadmin - Kelola Pertandingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-lg border-b-4 border-blue-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-600 p-3 rounded-lg">
                        <i class="fas fa-trophy text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard Superadmin</h1>
                        <p class="text-gray-600">Sistem Manajemen Pertandingan Pencak Silat</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Selamat datang,</p>
                        <p class="font-semibold text-gray-900">Admin Utama</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Navigation Breadcrumb -->
        <nav class="mb-6">
            <div class="flex items-center space-x-2 text-sm">
                <button onclick="showMainDashboard()" class="text-blue-600 hover:text-blue-800 font-medium">
                    <i class="fas fa-home mr-1"></i>Dashboard
                </button>
                <span id="breadcrumb-separator" class="text-gray-400 hidden">></span>
                <span id="breadcrumb-current" class="text-gray-600 hidden"></span>
            </div>
        </nav>

        <!-- Main Dashboard -->
        <div id="main-dashboard">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Total Event</p>
                            <p class="text-2xl font-bold text-gray-900">12</p>
                        </div>
                        <i class="fas fa-calendar-alt text-blue-500 text-2xl"></i>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Total Pesilat</p>
                            <p class="text-2xl font-bold text-gray-900">248</p>
                        </div>
                        <i class="fas fa-users text-green-500 text-2xl"></i>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Total Juri</p>
                            <p class="text-2xl font-bold text-gray-900">36</p>
                        </div>
                        <i class="fas fa-gavel text-purple-500 text-2xl"></i>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-orange-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Total Dewan</p>
                            <p class="text-2xl font-bold text-gray-900">18</p>
                        </div>
                        <i class="fas fa-user-tie text-orange-500 text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Main Action Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Kelola Event Card -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="text-center">
                        <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-trophy text-blue-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Kelola Peserta</h3>
                        <p class="text-gray-600 mb-6">Atur dan kelola semua event pertandingan pencak silat, termasuk data pesilat dalam kategori Pemasalan dan Prestasi dengan sistem arena</p>
                        <button onclick="showEventManagement()" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors duration-200 w-full">
                            <i class="fas fa-arrow-right mr-2"></i>Masuk ke Kelola Peserta
                        </button>
                    </div>
                </div>

                <!-- Kelola Panitia Card -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="text-center">
                        <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-plus text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Kelola Panitia</h3>
                        <p class="text-gray-600 mb-6">Tambah dan atur panitia dengan role Juri dan Dewan untuk setiap event pertandingan</p>
                        <button onclick="showPanitiaManagement()" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors duration-200 w-full">
                            <i class="fas fa-arrow-right mr-2"></i>Masuk ke Kelola Panitia
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Management Section -->
        <div id="event-management" class="hidden">
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-trophy text-blue-600 mr-2"></i>Kelola Peserta
                    </h2>
                    {{-- <button onclick="showAddEvent()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-plus mr-2"></i>Tambah Event
                    </button> --}}
                </div>

                <!-- Event List -->
                <div class="space-y-4">
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                        <div class="flex justify-between items-center">
                            <div class="flex-1 cursor-pointer" onclick="showEventDetail('Kejuaraan Nasional 2024')">
                                <h3 class="font-semibold text-gray-900">Kejuaraan Nasional 2024</h3>
                                <p class="text-gray-600 text-sm">15-20 Januari 2024 • Jakarta</p>
                                <p class="text-blue-600 text-xs mt-1">
                                    <i class="fas fa-square mr-1"></i>Arena: Pemasalan (3), Prestasi (3)
                                </p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button onclick="showArenaConfig('Kejuaraan Nasional 2024')" class="text-blue-600 hover:text-blue-800 text-sm px-3 py-1 border border-blue-300 rounded-lg">
                                    <i class="fas fa-cog mr-1"></i>Atur Arena
                                </button>
                                <i class="fas fa-chevron-right text-gray-400 cursor-pointer" onclick="showEventDetail('Kejuaraan Nasional 2024')"></i>
                            </div>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                        <div class="flex justify-between items-center">
                            <div class="flex-1 cursor-pointer" onclick="showEventDetail('Piala Gubernur 2024')">
                                <h3 class="font-semibold text-gray-900">Piala Gubernur 2024</h3>
                                <p class="text-gray-600 text-sm">5-10 Februari 2024 • Bandung</p>
                                <p class="text-blue-600 text-xs mt-1">
                                    <i class="fas fa-square mr-1"></i>Arena: Pemasalan (2), Prestasi (2)
                                </p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button onclick="showArenaConfig('Piala Gubernur 2024')" class="text-blue-600 hover:text-blue-800 text-sm px-3 py-1 border border-blue-300 rounded-lg">
                                    <i class="fas fa-cog mr-1"></i>Atur Arena
                                </button>
                                <i class="fas fa-chevron-right text-gray-400 cursor-pointer" onclick="showEventDetail('Piala Gubernur 2024')"></i>
                            </div>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                        <div class="flex justify-between items-center">
                            <div class="flex-1 cursor-pointer" onclick="showEventDetail('Turnamen Regional 2024')">
                                <h3 class="font-semibold text-gray-900">Turnamen Regional 2024</h3>
                                <p class="text-gray-600 text-sm">20-25 Februari 2024 • Surabaya</p>
                                <p class="text-blue-600 text-xs mt-1">
                                    <i class="fas fa-square mr-1"></i>Arena: Pemasalan (4), Prestasi (2)
                                </p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button onclick="showArenaConfig('Turnamen Regional 2024')" class="text-blue-600 hover:text-blue-800 text-sm px-3 py-1 border border-blue-300 rounded-lg">
                                    <i class="fas fa-cog mr-1"></i>Atur Arena
                                </button>
                                <i class="fas fa-chevron-right text-gray-400 cursor-pointer" onclick="showEventDetail('Turnamen Regional 2024')"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Detail Section -->
        <div id="event-detail" class="hidden">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-trophy text-blue-600 mr-2"></i>
                        <span id="event-title">Kejuaraan Nasional 2024</span>
                    </h2>
                    <button onclick="showAddAthlete()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-user-plus mr-2"></i>Tambah Pesilat
                    </button>
                </div>

                <!-- Category Tabs -->
                <div class="flex space-x-4 mb-6 border-b">
                    <button onclick="showCategory('pemasalan')" id="tab-pemasalan" class="px-4 py-2 font-semibold text-blue-600 border-b-2 border-blue-600">
                        <i class="fas fa-medal mr-2"></i>Pemasalan
                    </button>
                    <button onclick="showCategory('prestasi')" id="tab-prestasi" class="px-4 py-2 font-semibold text-gray-600 hover:text-blue-600">
                        <i class="fas fa-star mr-2"></i>Prestasi
                    </button>
                </div>

                <!-- Pemasalan Section -->
                <div id="pemasalan-section">
                    <!-- Arena Tabs for Pemasalan -->
                    <div class="flex space-x-2 mb-4 bg-gray-100 p-1 rounded-lg">
                        <button onclick="showArena('pemasalan', 1)" id="pemasalan-arena-1" class="flex-1 px-3 py-2 text-sm font-medium rounded-md bg-white text-blue-600 shadow-sm">
                            <i class="fas fa-square mr-1"></i>Arena 1
                        </button>
                        <button onclick="showArena('pemasalan', 2)" id="pemasalan-arena-2" class="flex-1 px-3 py-2 text-sm font-medium rounded-md text-gray-600 hover:text-blue-600">
                            <i class="fas fa-square mr-1"></i>Arena 2
                        </button>
                        <button onclick="showArena('pemasalan', 3)" id="pemasalan-arena-3" class="flex-1 px-3 py-2 text-sm font-medium rounded-md text-gray-600 hover:text-blue-600">
                            <i class="fas fa-square mr-1"></i>Arena 3
                        </button>
                    </div>

                    <!-- Pemasalan Arena 1 Table -->
                    <div id="pemasalan-arena-1-table">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-semibold text-gray-900">Arena 1 - Kategori Pemasalan</h4>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">2 Pertandingan Aktif</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PARTAI</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tim Merah</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tim Biru</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas Tanding</th>
                                        {{-- <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Babak</th> --}}
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        {{-- <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th> --}}
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">PARTAI 1</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-red-700">
                                            <i class="fas fa-square text-red-500 mr-1"></i>Ahmad Fajar Sidiq<br>
                                            <span class="text-xs text-gray-600">DKI Jakarta</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-blue-700">
                                            <i class="fas fa-square text-blue-500 mr-1"></i>Muhammad Rizki Pratama<br>
                                            <span class="text-xs text-gray-600">Jawa Timur</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                            <div class="font-medium">Putra Dewasa Kelas A</div>
                                            <div class="text-gray-600">(45-50 kg)</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Semifinal</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Berlangsung</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">10:30 - 10:45</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="editMatch(1, 'Ahmad Fajar Sidiq', 'DKI Jakarta', 'Muhammad Rizki Pratama', 'Jawa Timur', 'Berlangsung', '10:30 - 10:45', 'pemasalan', 1)" class="text-green-600 hover:text-green-900 mr-2">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button onclick="deleteMatch(1, 'Ahmad Fajar Sidiq', 'Muhammad Rizki Pratama', 'pemasalan', 1)" class="text-red-600 hover:text-red-900 mr-2">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                            <button onclick="showMoveModal('Ahmad Fajar Sidiq', 'Muhammad Rizki Pratama', 'pemasalan', 1)" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-exchange-alt mr-1"></i>Pindah
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">PARTAI 2</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-red-700">
                                            <i class="fas fa-square text-red-500 mr-1"></i>Sari Dewi Maharani<br>
                                            <span class="text-xs text-gray-600">Jawa Barat</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-blue-700">
                                            <i class="fas fa-square text-blue-500 mr-1"></i>Maya Putri Salsabila<br>
                                            <span class="text-xs text-gray-600">DI Yogyakarta</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                            <div class="font-medium">Putri Dewasa Kelas B</div>
                                            <div class="text-gray-600">(50-55 kg)</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Final</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Menunggu</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">11:00 - 11:15</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="editMatch(2, 'Sari Dewi Maharani', 'Jawa Barat', 'Maya Putri Salsabila', 'DI Yogyakarta', 'Menunggu', '11:00 - 11:15', 'pemasalan', 1)" class="text-green-600 hover:text-green-900 mr-2">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button onclick="deleteMatch(2, 'Sari Dewi Maharani', 'Maya Putri Salsabila', 'pemasalan', 1)" class="text-red-600 hover:text-red-900 mr-2">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                            <button onclick="showMoveModal('Sari Dewi Maharani', 'Maya Putri Salsabila', 'pemasalan', 1)" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-exchange-alt mr-1"></i>Pindah
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pemasalan Arena 2 Table -->
                    <div id="pemasalan-arena-2-table" class="hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-semibold text-gray-900">Arena 2 - Kategori Pemasalan</h4>
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">Kosong</span>
                        </div>
                        <div class="text-center py-12 text-gray-500">
                            <i class="fas fa-square text-4xl mb-4"></i>
                            <p class="text-lg">Arena 2 sedang kosong</p>
                            <p class="text-sm">Pesilat dapat dipindahkan ke arena ini</p>
                        </div>
                    </div>

                    <!-- Pemasalan Arena 3 Table -->
                    <div id="pemasalan-arena-3-table" class="hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-semibold text-gray-900">Arena 3 - Kategori Pemasalan</h4>
                            <span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-medium rounded-full">1 Pertandingan Aktif</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PARTAI</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tim Merah</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tim Biru</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas Tanding</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Babak</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">PARTAI 1</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-red-700">
                                            <i class="fas fa-square text-red-500 mr-1"></i>Andi Wijaya Kusuma<br>
                                            <span class="text-xs text-gray-600">Sulawesi Selatan</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-blue-700">
                                            <i class="fas fa-square text-blue-500 mr-1"></i>Rudi Hartono Saputra<br>
                                            <span class="text-xs text-gray-600">Sumatera Utara</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                            <div class="font-medium">Putra Dewasa Kelas D</div>
                                            <div class="text-gray-600">(60-65 kg)</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Babak 16 Besar</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">09:30 - 09:45</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-gray-400 cursor-not-allowed">
                                                <i class="fas fa-check mr-1"></i>Selesai
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Prestasi Section -->
                <div id="prestasi-section" class="hidden">
                    <!-- Arena Tabs for Prestasi -->
                    <div class="flex space-x-2 mb-4 bg-gray-100 p-1 rounded-lg">
                        <button onclick="showArena('prestasi', 1)" id="prestasi-arena-1" class="flex-1 px-3 py-2 text-sm font-medium rounded-md bg-white text-blue-600 shadow-sm">
                            <i class="fas fa-square mr-1"></i>Arena 1
                        </button>
                        <button onclick="showArena('prestasi', 2)" id="prestasi-arena-2" class="flex-1 px-3 py-2 text-sm font-medium rounded-md text-gray-600 hover:text-blue-600">
                            <i class="fas fa-square mr-1"></i>Arena 2
                        </button>
                        <button onclick="showArena('prestasi', 3)" id="prestasi-arena-3" class="flex-1 px-3 py-2 text-sm font-medium rounded-md text-gray-600 hover:text-blue-600">
                            <i class="fas fa-square mr-1"></i>Arena 3
                        </button>
                    </div>

                    <!-- Prestasi Arena 1 Table -->
                    <div id="prestasi-arena-1-table">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-semibold text-gray-900">Arena 1 - Kategori Prestasi</h4>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">1 Pertandingan Aktif</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PARTAI</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tim Merah</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tim Biru</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas Tanding</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Babak</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">PARTAI 1</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-red-700">
                                            <i class="fas fa-square text-red-500 mr-1"></i>Dedi Kurniawan<br>
                                            <span class="text-xs text-gray-600">Sumatera Selatan</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-blue-700">
                                            <i class="fas fa-square text-blue-500 mr-1"></i>Fajar Nugraha Putra<br>
                                            <span class="text-xs text-gray-600">Jawa Tengah</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                            <div class="font-medium">Putra Dewasa Kelas E</div>
                                            <div class="text-gray-600">(65-70 kg)</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Final</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Berlangsung</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">14:00 - 14:15</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="editMatch(4, 'Dedi Kurniawan', 'Sumatera Selatan', 'Fajar Nugraha Putra', 'Jawa Tengah', 'Berlangsung', '14:00 - 14:15', 'prestasi', 1)" class="text-green-600 hover:text-green-900 mr-2">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button onclick="deleteMatch(4, 'Dedi Kurniawan', 'Fajar Nugraha Putra', 'prestasi', 1)" class="text-red-600 hover:text-red-900 mr-2">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                            <button onclick="showMoveModal('Dedi Kurniawan', 'Fajar Nugraha Putra', 'prestasi', 1)" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-exchange-alt mr-1"></i>Pindah
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Prestasi Arena 2 Table -->
                    <div id="prestasi-arena-2-table" class="hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-semibold text-gray-900">Arena 2 - Kategori Prestasi</h4>
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">Kosong</span>
                        </div>
                        <div class="text-center py-12 text-gray-500">
                            <i class="fas fa-square text-4xl mb-4"></i>
                            <p class="text-lg">Arena 2 sedang kosong</p>
                            <p class="text-sm">Pesilat dapat dipindahkan ke arena ini</p>
                        </div>
                    </div>

                    <!-- Prestasi Arena 3 Table -->
                    <div id="prestasi-arena-3-table" class="hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-semibold text-gray-900">Arena 3 - Kategori Prestasi</h4>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">1 Pertandingan Menunggu</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PARTAI</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tim Merah</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tim Biru</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas Tanding</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Babak</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">PARTAI 1</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-red-700">
                                            <i class="fas fa-square text-red-500 mr-1"></i>Hendra Saputra Jaya<br>
                                            <span class="text-xs text-gray-600">Bali</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-blue-700">
                                            <i class="fas fa-square text-blue-500 mr-1"></i>Indra Gunawan Maulana<br>
                                            <span class="text-xs text-gray-600">Kalimantan Timur</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                            <div class="font-medium">Putra Dewasa Kelas F</div>
                                            <div class="text-gray-600">(70-75 kg)</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Semifinal</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Menunggu</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">15:00 - 15:15</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="editMatch(5, 'Hendra Saputra Jaya', 'Bali', 'Indra Gunawan Maulana', 'Kalimantan Timur', 'Menunggu', '15:00 - 15:15', 'prestasi', 3)" class="text-green-600 hover:text-green-900 mr-2">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </button>
                                            <button onclick="deleteMatch(5, 'Hendra Saputra Jaya', 'Indra Gunawan Maulana', 'prestasi', 3)" class="text-red-600 hover:text-red-900 mr-2">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                            <button onclick="showMoveModal('Hendra Saputra Jaya', 'Indra Gunawan Maulana', 'prestasi', 3)" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-exchange-alt mr-1"></i>Pindah
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panitia Management Section -->
        <div id="panitia-management" class="hidden">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-user-plus text-green-600 mr-2"></i>Kelola Panitia
                    </h2>
                    <button onclick="showAddPanitia()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-plus mr-2"></i>Tambah Panitia
                    </button>
                </div>

                <!-- Panitia Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arena</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Dr. Andi Wijaya</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">andi.wijaya@email.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Juri</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Kejuaraan Nasional 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Tanding</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Arena 1</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editPanitia(1, 'Dr. Andi Wijaya', 'andi.wijaya@email.com', 'juri', 'kejuaraan-nasional', 'tanding', '1')" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <button onclick="deletePanitia(1, 'Dr. Andi Wijaya')" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Prof. Siti Nurhaliza</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">siti.nurhaliza@email.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Dewan</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Kejuaraan Nasional 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Seni</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Arena 2</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editPanitia(2, 'Prof. Siti Nurhaliza', 'siti.nurhaliza@email.com', 'dewan', 'kejuaraan-nasional', 'seni', '2')" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <button onclick="deletePanitia(2, 'Prof. Siti Nurhaliza')" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Drs. Bambang Sutrisno</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">bambang.sutrisno@email.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Juri</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Kejuaraan Nasional 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Jurus Baku</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Arena 3</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editPanitia(3, 'Drs. Bambang Sutrisno', 'bambang.sutrisno@email.com', 'juri', 'kejuaraan-nasional', 'jurus-baku', '3')" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <button onclick="deletePanitia(3, 'Drs. Bambang Sutrisno')" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">4</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Dr. Maya Sari</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">maya.sari@email.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Dewan</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Piala Gubernur 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Tanding</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Arena 1</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editPanitia(4, 'Dr. Maya Sari', 'maya.sari@email.com', 'dewan', 'piala-gubernur', 'tanding', '1')" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </button>
                                    <button onclick="deletePanitia(4, 'Dr. Maya Sari')" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Panitia -->
    <div id="modal-add-panitia" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-lg mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900">Tambah Panitia Baru</h3>
                <button onclick="closeModal('modal-add-panitia')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form class="space-y-4" onsubmit="handleAddPanitia(event)">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="panitia-name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan nama lengkap" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="panitia-email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan email" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select id="panitia-role" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" onchange="updateRoleInfo()" required>
                        <option value="">Pilih Role</option>
                        <option value="juri">Juri</option>
                        <option value="dewan">Dewan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Assignment</label>
                    <select id="panitia-event" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih Event</option>
                        <option value="kejuaraan-nasional">Kejuaraan Nasional 2024</option>
                        <option value="piala-gubernur">Piala Gubernur 2024</option>
                        <option value="turnamen-regional">Turnamen Regional 2024</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Pertandingan</label>
                    <select id="panitia-category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" onchange="updateArenaOptions()" required>
                        <option value="">Pilih Kategori</option>
                        <option value="tanding">Tanding</option>
                        <option value="seni">Seni</option>
                        <option value="jurus-baku">Jurus Baku</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Arena</label>
                    <select id="panitia-arena" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" onchange="checkArenaCapacity()" required>
                        <option value="">Pilih Arena</option>
                        <option value="1">Arena 1</option>
                        <option value="2">Arena 2</option>
                        <option value="3">Arena 3</option>
                    </select>
                </div>
                
                <!-- Role Info Display -->
                <div id="role-info" class="hidden bg-blue-50 p-3 rounded-lg">
                    <div class="text-sm">
                        <div class="font-medium text-blue-900 mb-1">Informasi Role:</div>
                        <div id="role-description" class="text-blue-700"></div>
                    </div>
                </div>

                <!-- Arena Capacity Warning -->
                <div id="arena-warning" class="hidden bg-yellow-50 border border-yellow-200 p-3 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5 mr-2"></i>
                        <div class="text-sm text-yellow-800">
                            <div class="font-medium">Peringatan Kapasitas Arena</div>
                            <div id="arena-warning-text"></div>
                        </div>
                    </div>
                </div>

                <!-- Arena Status Display -->
                <div id="arena-status" class="hidden bg-gray-50 p-3 rounded-lg">
                    <div class="text-sm">
                        <div class="font-medium text-gray-900 mb-2">Status Arena Saat Ini:</div>
                        <div id="arena-status-content"></div>
                    </div>
                </div>

                <div class="flex space-x-3 pt-4">
                    <button type="button" onclick="closeModal('modal-add-panitia')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" id="submit-btn" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Add Athlete -->
    <div id="modal-add-athlete" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-lg mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900">Tambah Pesilat Baru</h3>
                <button onclick="closeModal('modal-add-athlete')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form class="space-y-4" onsubmit="handleAddAthlete(event)">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-red-700 mb-1">
                            <i class="fas fa-square text-red-500 mr-1"></i>Tim Merah
                        </label>
                        <input type="text" id="athlete-name-1" class="w-full px-3 py-2 border border-red-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Nama pesilat tim merah" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-red-700 mb-1">Asal Daerah</label>
                        <input type="text" id="athlete-origin-1" class="w-full px-3 py-2 border border-red-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Asal daerah tim merah" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-700 mb-1">
                            <i class="fas fa-square text-blue-500 mr-1"></i>Tim Biru
                        </label>
                        <input type="text" id="athlete-name-2" class="w-full px-3 py-2 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nama pesilat tim biru" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-700 mb-1">Asal Daerah</label>
                        <input type="text" id="athlete-origin-2" class="w-full px-3 py-2 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Asal daerah tim biru" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select id="athlete-category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Kategori</option>
                        <option value="pemasalan">Pemasalan</option>
                        <option value="prestasi">Prestasi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Arena</label>
                    <select id="athlete-arena" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Arena</option>
                        <option value="1">Arena 1</option>
                        <option value="2">Arena 2</option>
                        <option value="3">Arena 3</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kelas Tanding</label>
                    <select id="athlete-class" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Kelas Tanding</option>
                        <optgroup label="Putra Dewasa">
                            <option value="Putra Dewasa Kelas A (45-50 kg)">Kelas A (45-50 kg)</option>
                            <option value="Putra Dewasa Kelas B (50-55 kg)">Kelas B (50-55 kg)</option>
                            <option value="Putra Dewasa Kelas C (55-60 kg)">Kelas C (55-60 kg)</option>
                            <option value="Putra Dewasa Kelas D (60-65 kg)">Kelas D (60-65 kg)</option>
                            <option value="Putra Dewasa Kelas E (65-70 kg)">Kelas E (65-70 kg)</option>
                            <option value="Putra Dewasa Kelas F (70-75 kg)">Kelas F (70-75 kg)</option>
                            <option value="Putra Dewasa Kelas G (75-80 kg)">Kelas G (75-80 kg)</option>
                            <option value="Putra Dewasa Kelas H (80-85 kg)">Kelas H (80-85 kg)</option>
                            <option value="Putra Dewasa Kelas I (85-90 kg)">Kelas I (85-90 kg)</option>
                            <option value="Putra Dewasa Kelas J (90+ kg)">Kelas J (90+ kg)</option>
                        </optgroup>
                        <optgroup label="Putri Dewasa">
                            <option value="Putri Dewasa Kelas A (45-48 kg)">Kelas A (45-48 kg)</option>
                            <option value="Putri Dewasa Kelas B (48-52 kg)">Kelas B (48-52 kg)</option>
                            <option value="Putri Dewasa Kelas C (52-56 kg)">Kelas C (52-56 kg)</option>
                            <option value="Putri Dewasa Kelas D (56-60 kg)">Kelas D (56-60 kg)</option>
                            <option value="Putri Dewasa Kelas E (60-65 kg)">Kelas E (60-65 kg)</option>
                            <option value="Putri Dewasa Kelas F (65-70 kg)">Kelas F (65-70 kg)</option>
                            <option value="Putri Dewasa Kelas G (70+ kg)">Kelas G (70+ kg)</option>
                        </optgroup>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Babak Pertandingan</label>
                    <select id="athlete-round" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Babak</option>
                        <option value="Babak 32 Besar">Babak 32 Besar</option>
                        <option value="Babak 16 Besar">Babak 16 Besar</option>
                        <option value="Perempat Final">Perempat Final</option>
                        <option value="Semifinal">Semifinal</option>
                        <option value="Final">Final</option>
                        <option value="Perebutan Juara 3">Perebutan Juara 3</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Pertandingan</label>
                    <input type="text" id="athlete-time" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: 16:00 - 16:15" required>
                </div>
                <div class="flex space-x-3 pt-4">
                    <button type="button" onclick="closeModal('modal-add-athlete')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Tambah Pertandingan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Arena Configuration -->
    <div id="modal-arena-config" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-cog text-blue-600 mr-2"></i>Konfigurasi Arena Event
                </h3>
                <button onclick="closeModal('modal-arena-config')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="mb-4">
                <h4 class="text-lg font-semibold text-gray-900 mb-2" id="config-event-name">Kejuaraan Nasional 2024</h4>
                <p class="text-gray-600 text-sm mb-4">Atur jumlah arena untuk setiap kategori pertandingan</p>
            </div>

            <form onsubmit="handleArenaConfig(event)" class="space-y-6">
                <!-- Pemasalan Configuration -->
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-medal text-blue-600 mr-2"></i>
                        <h5 class="font-semibold text-gray-900">Kategori Pemasalan</h5>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Arena</label>
                            <select id="pemasalan-arena-count" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="updateArenaPreview('pemasalan')">
                                <option value="1">1 Arena</option>
                                <option value="2">2 Arena</option>
                                <option value="3" selected>3 Arena</option>
                                <option value="4">4 Arena</option>
                                <option value="5">5 Arena</option>
                                <option value="6">6 Arena</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <div class="flex items-center space-x-2 mt-2">
                                <input type="checkbox" id="pemasalan-enabled" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label for="pemasalan-enabled" class="text-sm text-gray-700">Aktifkan kategori ini</label>
                            </div>
                        </div>
                    </div>
                    <div id="pemasalan-preview" class="mt-3 text-sm text-gray-600">
                        Arena yang akan dibuat: Arena 1, Arena 2, Arena 3
                    </div>
                </div>

                <!-- Prestasi Configuration -->
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-star text-green-600 mr-2"></i>
                        <h5 class="font-semibold text-gray-900">Kategori Prestasi</h5>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Arena</label>
                            <select id="prestasi-arena-count" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" onchange="updateArenaPreview('prestasi')">
                                <option value="1">1 Arena</option>
                                <option value="2">2 Arena</option>
                                <option value="3" selected>3 Arena</option>
                                <option value="4">4 Arena</option>
                                <option value="5">5 Arena</option>
                                <option value="6">6 Arena</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <div class="flex items-center space-x-2 mt-2">
                                <input type="checkbox" id="prestasi-enabled" checked class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                                <label for="prestasi-enabled" class="text-sm text-gray-700">Aktifkan kategori ini</label>
                            </div>
                        </div>
                    </div>
                    <div id="prestasi-preview" class="mt-3 text-sm text-gray-600">
                        Arena yang akan dibuat: Arena 1, Arena 2, Arena 3
                    </div>
                </div>

                <!-- Warning for existing matches -->
                <div id="arena-change-warning" class="hidden bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5 mr-3"></i>
                        <div>
                            <div class="font-medium text-yellow-800 mb-1">Peringatan Perubahan Arena</div>
                            <div class="text-sm text-yellow-700">
                                Mengurangi jumlah arena akan memindahkan pertandingan yang ada ke arena yang tersisa. 
                                Pastikan arena yang tersisa memiliki kapasitas yang cukup.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h6 class="font-medium text-gray-900 mb-2">Ringkasan Konfigurasi:</h6>
                    <div id="config-summary" class="text-sm text-gray-700 space-y-1">
                        <div>• Total Arena Pemasalan: 3</div>
                        <div>• Total Arena Prestasi: 3</div>
                        <div>• Total Arena Keseluruhan: 6</div>
                    </div>
                </div>

                <div class="flex space-x-3 pt-4">
                    <button type="button" onclick="closeModal('modal-arena-config')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i>Simpan Konfigurasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Panitia -->
    <div id="modal-edit-panitia" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-lg mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900">Edit Data Panitia</h3>
                <button onclick="closeModal('modal-edit-panitia')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form class="space-y-4" onsubmit="handleEditPanitia(event)">
                <input type="hidden" id="edit-panitia-id">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="edit-panitia-name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="edit-panitia-email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select id="edit-panitia-role" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih Role</option>
                        <option value="juri">Juri</option>
                        <option value="dewan">Dewan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Assignment</label>
                    <select id="edit-panitia-event" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih Event</option>
                        <option value="kejuaraan-nasional">Kejuaraan Nasional 2024</option>
                        <option value="piala-gubernur">Piala Gubernur 2024</option>
                        <option value="turnamen-regional">Turnamen Regional 2024</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Pertandingan</label>
                    <select id="edit-panitia-category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih Kategori</option>
                        <option value="tanding">Tanding</option>
                        <option value="seni">Seni</option>
                        <option value="jurus-baku">Jurus Baku</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Arena</label>
                    <select id="edit-panitia-arena" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Pilih Arena</option>
                        <option value="1">Arena 1</option>
                        <option value="2">Arena 2</option>
                        <option value="3">Arena 3</option>
                    </select>
                </div>
                <div class="flex space-x-3 pt-4">
                    <button type="button" onclick="closeModal('modal-edit-panitia')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete Confirmation -->
    <div id="modal-delete-confirm" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-red-600">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Konfirmasi Hapus
                </h3>
                <button onclick="closeModal('modal-delete-confirm')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="mb-6">
                <p class="text-gray-700 mb-2">Apakah Anda yakin ingin menghapus data ini?</p>
                <div class="bg-red-50 p-3 rounded-lg">
                    <p class="text-sm text-red-800" id="delete-item-info">
                        <strong>Nama:</strong> <span id="delete-item-name"></span><br>
                        <strong>Type:</strong> <span id="delete-item-type"></span>
                    </p>
                </div>
                <p class="text-sm text-gray-600 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="flex space-x-3">
                <button type="button" onclick="closeModal('modal-delete-confirm')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="button" onclick="confirmDelete()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    <i class="fas fa-trash mr-2"></i>Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Match -->
    <div id="modal-edit-match" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-lg mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900">Edit Pertandingan</h3>
                <button onclick="closeModal('modal-edit-match')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form class="space-y-4" onsubmit="handleEditMatch(event)">
                <input type="hidden" id="edit-match-id">
                <input type="hidden" id="edit-match-category">
                <input type="hidden" id="edit-match-arena">
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-red-700 mb-1">
                            <i class="fas fa-square text-red-500 mr-1"></i>Tim Merah
                        </label>
                        <input type="text" id="edit-athlete-name-1" class="w-full px-3 py-2 border border-red-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-red-700 mb-1">Asal Daerah</label>
                        <input type="text" id="edit-athlete-origin-1" class="w-full px-3 py-2 border border-red-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-blue-700 mb-1">
                            <i class="fas fa-square text-blue-500 mr-1"></i>Tim Biru
                        </label>
                        <input type="text" id="edit-athlete-name-2" class="w-full px-3 py-2 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-700 mb-1">Asal Daerah</label>
                        <input type="text" id="edit-athlete-origin-2" class="w-full px-3 py-2 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Pertandingan</label>
                    <select id="edit-match-status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Berlangsung">Berlangsung</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Pertandingan</label>
                    <input type="text" id="edit-match-time" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: 16:00 - 16:15" required>
                </div>
                <div class="flex space-x-3 pt-4">
                    <button type="button" onclick="closeModal('modal-edit-match')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Move Arena -->
    <div id="modal-move-arena" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900">Pindah Arena</h3>
                <button onclick="closeModal('modal-move-arena')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="mb-4">
                <div class="bg-blue-50 p-4 rounded-lg mb-4">
                    <h4 class="font-semibold text-gray-900 mb-2">Pertandingan yang akan dipindah:</h4>
                    <p class="text-sm text-gray-700" id="move-match-info">
                        <span class="text-red-600"><i class="fas fa-square mr-1"></i>Tim Merah</span> vs 
                        <span class="text-blue-600"><i class="fas fa-square mr-1"></i>Tim Biru</span>
                    </p>
                    <p class="text-xs text-gray-500" id="move-current-arena">Arena saat ini: Arena 1 - Pemasalan</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Arena Tujuan:</label>
                    <div class="space-y-2" id="arena-options">
                        <!-- Arena options will be generated dynamically -->
                    </div>
                </div>
            </div>
            <div class="flex space-x-3">
                <button type="button" onclick="closeModal('modal-move-arena')" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button type="button" onclick="moveArena()" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-exchange-alt mr-2"></i>Pindah Arena
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentMoveData = {};
        let currentConfigEvent = '';
        
        // Event arena configuration
        const eventArenaConfig = {
            'Kejuaraan Nasional 2024': {
                pemasalan: { count: 3, enabled: true },
                prestasi: { count: 3, enabled: true }
            },
            'Piala Gubernur 2024': {
                pemasalan: { count: 2, enabled: true },
                prestasi: { count: 2, enabled: true }
            },
            'Turnamen Regional 2024': {
                pemasalan: { count: 4, enabled: true },
                prestasi: { count: 2, enabled: true }
            }
        };
        
        // Match data for each category and arena - Following IPSI Regulations
        const matchData = {
            'pemasalan': {
                '1': [
                    { 
                        id: 1, 
                        pesilat1: 'Ahmad Fajar Sidiq', asal1: 'DKI Jakarta', 
                        pesilat2: 'Muhammad Rizki Pratama', asal2: 'Jawa Timur', 
                        status: 'Berlangsung', 
                        waktu: '10:30 - 10:45',
                        kelas: 'Putra Dewasa Kelas A (45-50 kg)',
                        babak: 'Semifinal'
                    },
                    { 
                        id: 2, 
                        pesilat1: 'Sari Dewi Maharani', asal1: 'Jawa Barat', 
                        pesilat2: 'Maya Putri Salsabila', asal2: 'DI Yogyakarta', 
                        status: 'Menunggu', 
                        waktu: '11:00 - 11:15',
                        kelas: 'Putri Dewasa Kelas B (50-55 kg)',
                        babak: 'Final'
                    }
                ],
                '2': [
                    { 
                        id: 6, 
                        pesilat1: 'Bayu Aji Pangestu', asal1: 'Jawa Tengah', 
                        pesilat2: 'Dimas Arya Wijaya', asal2: 'Banten', 
                        status: 'Menunggu', 
                        waktu: '11:30 - 11:45',
                        kelas: 'Putra Dewasa Kelas C (55-60 kg)',
                        babak: 'Perempat Final'
                    }
                ],
                '3': [
                    { 
                        id: 3, 
                        pesilat1: 'Andi Wijaya Kusuma', asal1: 'Sulawesi Selatan', 
                        pesilat2: 'Rudi Hartono Saputra', asal2: 'Sumatera Utara', 
                        status: 'Selesai', 
                        waktu: '09:30 - 09:45',
                        kelas: 'Putra Dewasa Kelas D (60-65 kg)',
                        babak: 'Babak 16 Besar'
                    }
                ]
            },
            'prestasi': {
                '1': [
                    { 
                        id: 4, 
                        pesilat1: 'Dedi Kurniawan', asal1: 'Sumatera Selatan', 
                        pesilat2: 'Fajar Nugraha Putra', asal2: 'Jawa Tengah', 
                        status: 'Berlangsung', 
                        waktu: '14:00 - 14:15',
                        kelas: 'Putra Dewasa Kelas E (65-70 kg)',
                        babak: 'Final'
                    }
                ],
                '2': [
                    { 
                        id: 7, 
                        pesilat1: 'Lestari Wulandari', asal1: 'Kalimantan Timur', 
                        pesilat2: 'Fitri Handayani', asal2: 'Lampung', 
                        status: 'Menunggu', 
                        waktu: '14:30 - 14:45',
                        kelas: 'Putri Dewasa Kelas C (55-60 kg)',
                        babak: 'Semifinal'
                    }
                ],
                '3': [
                    { 
                        id: 5, 
                        pesilat1: 'Hendra Saputra Jaya', asal1: 'Bali', 
                        pesilat2: 'Indra Gunawan Maulana', asal2: 'Kalimantan Timur', 
                        status: 'Menunggu', 
                        waktu: '15:00 - 15:15',
                        kelas: 'Putra Dewasa Kelas F (70-75 kg)',
                        babak: 'Semifinal'
                    }
                ]
            }
        };
        
        // Arena capacity data (simulated database)
        const arenaCapacity = {
            'tanding': { juri: 3, dewan: 2 },
            'seni': { juri: 10, dewan: 2 },
            'jurus-baku': { juri: 10, dewan: 2 }
        };

        // Current arena assignments (simulated data)
        const currentAssignments = {
            'kejuaraan-nasional': {
                'tanding': {
                    '1': { juri: 2, dewan: 1 },
                    '2': { juri: 0, dewan: 0 },
                    '3': { juri: 3, dewan: 2 }
                },
                'seni': {
                    '1': { juri: 8, dewan: 1 },
                    '2': { juri: 6, dewan: 2 },
                    '3': { juri: 10, dewan: 2 }
                },
                'jurus-baku': {
                    '1': { juri: 7, dewan: 1 },
                    '2': { juri: 9, dewan: 2 },
                    '3': { juri: 5, dewan: 0 }
                }
            }
        };

        // Navigation functions
        function showMainDashboard() {
            document.getElementById('main-dashboard').classList.remove('hidden');
            document.getElementById('event-management').classList.add('hidden');
            document.getElementById('event-detail').classList.add('hidden');
            document.getElementById('panitia-management').classList.add('hidden');
            document.getElementById('breadcrumb-separator').classList.add('hidden');
            document.getElementById('breadcrumb-current').classList.add('hidden');
        }

        function showEventManagement() {
            document.getElementById('main-dashboard').classList.add('hidden');
            document.getElementById('event-management').classList.remove('hidden');
            document.getElementById('event-detail').classList.add('hidden');
            document.getElementById('panitia-management').classList.add('hidden');
            updateBreadcrumb('Kelola Peserta');
        }

        function showEventDetail(eventName) {
            document.getElementById('main-dashboard').classList.add('hidden');
            document.getElementById('event-management').classList.add('hidden');
            document.getElementById('event-detail').classList.remove('hidden');
            document.getElementById('panitia-management').classList.add('hidden');
            document.getElementById('event-title').textContent = eventName;
            updateBreadcrumb('Kelola Peserta > ' + eventName);
            
            // Show default category and arena
            showCategory('pemasalan');
            showArena('pemasalan', 1);
        }

        function showPanitiaManagement() {
            document.getElementById('main-dashboard').classList.add('hidden');
            document.getElementById('event-management').classList.add('hidden');
            document.getElementById('event-detail').classList.add('hidden');
            document.getElementById('panitia-management').classList.remove('hidden');
            updateBreadcrumb('Kelola Panitia');
        }

        function updateBreadcrumb(text) {
            document.getElementById('breadcrumb-separator').classList.remove('hidden');
            document.getElementById('breadcrumb-current').classList.remove('hidden');
            document.getElementById('breadcrumb-current').textContent = text;
        }

        // Category switching in event detail
        function showCategory(category) {
            const pemasalanTab = document.getElementById('tab-pemasalan');
            const prestasiTab = document.getElementById('tab-prestasi');
            const pemasalanSection = document.getElementById('pemasalan-section');
            const prestasiSection = document.getElementById('prestasi-section');

            if (category === 'pemasalan') {
                pemasalanTab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                pemasalanTab.classList.remove('text-gray-600');
                prestasiTab.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                prestasiTab.classList.add('text-gray-600');
                pemasalanSection.classList.remove('hidden');
                prestasiSection.classList.add('hidden');
                showArena('pemasalan', 1);
            } else {
                prestasiTab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                prestasiTab.classList.remove('text-gray-600');
                pemasalanTab.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                pemasalanTab.classList.add('text-gray-600');
                prestasiSection.classList.remove('hidden');
                pemasalanSection.classList.add('hidden');
                showArena('prestasi', 1);
            }
        }

        // Arena switching
        function showArena(category, arenaNumber) {
            const currentEvent = document.getElementById('event-title').textContent;
            const config = eventArenaConfig[currentEvent];
            const maxArenas = config ? config[category].count : 3;
            
            // Reset all arena tabs for the category
            for (let i = 1; i <= maxArenas; i++) {
                const tab = document.getElementById(`${category}-arena-${i}`);
                const table = document.getElementById(`${category}-arena-${i}-table`);
                
                if (tab && table) {
                    if (i === arenaNumber) {
                        tab.classList.add('bg-white', 'text-blue-600', 'shadow-sm');
                        tab.classList.remove('text-gray-600');
                        table.classList.remove('hidden');
                    } else {
                        tab.classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
                        tab.classList.add('text-gray-600');
                        table.classList.add('hidden');
                    }
                }
            }
        }

        // Arena configuration functions
        function showArenaConfig(eventName) {
            currentConfigEvent = eventName;
            document.getElementById('config-event-name').textContent = eventName;
            
            // Load current configuration
            const config = eventArenaConfig[eventName];
            if (config) {
                document.getElementById('pemasalan-arena-count').value = config.pemasalan.count;
                document.getElementById('pemasalan-enabled').checked = config.pemasalan.enabled;
                document.getElementById('prestasi-arena-count').value = config.prestasi.count;
                document.getElementById('prestasi-enabled').checked = config.prestasi.enabled;
                
                updateArenaPreview('pemasalan');
                updateArenaPreview('prestasi');
                updateConfigSummary();
            }
            
            document.getElementById('modal-arena-config').classList.remove('hidden');
        }

        function updateArenaPreview(category) {
            const count = parseInt(document.getElementById(`${category}-arena-count`).value);
            const enabled = document.getElementById(`${category}-enabled`).checked;
            const preview = document.getElementById(`${category}-preview`);
            
            if (!enabled) {
                preview.textContent = 'Kategori ini dinonaktifkan';
                preview.className = 'mt-3 text-sm text-gray-400 italic';
            } else {
                const arenas = [];
                for (let i = 1; i <= count; i++) {
                    arenas.push(`Arena ${i}`);
                }
                preview.textContent = `Arena yang akan dibuat: ${arenas.join(', ')}`;
                preview.className = 'mt-3 text-sm text-gray-600';
            }
            
            updateConfigSummary();
            checkArenaChanges();
        }

        function updateConfigSummary() {
            const pemasalanCount = document.getElementById('pemasalan-enabled').checked ? 
                parseInt(document.getElementById('pemasalan-arena-count').value) : 0;
            const prestasiCount = document.getElementById('prestasi-enabled').checked ? 
                parseInt(document.getElementById('prestasi-arena-count').value) : 0;
            
            const summary = document.getElementById('config-summary');
            summary.innerHTML = `
                <div>• Total Arena Pemasalan: ${pemasalanCount}</div>
                <div>• Total Arena Prestasi: ${prestasiCount}</div>
                <div>• Total Arena Keseluruhan: ${pemasalanCount + prestasiCount}</div>
            `;
        }

        function checkArenaChanges() {
            const currentConfig = eventArenaConfig[currentConfigEvent];
            const newPemasalanCount = parseInt(document.getElementById('pemasalan-arena-count').value);
            const newPrestasiCount = parseInt(document.getElementById('prestasi-arena-count').value);
            
            const warning = document.getElementById('arena-change-warning');
            
            if ((currentConfig.pemasalan.count > newPemasalanCount) || 
                (currentConfig.prestasi.count > newPrestasiCount)) {
                warning.classList.remove('hidden');
            } else {
                warning.classList.add('hidden');
            }
        }

        function handleArenaConfig(event) {
            event.preventDefault();
            
            const pemasalanCount = parseInt(document.getElementById('pemasalan-arena-count').value);
            const pemasalanEnabled = document.getElementById('pemasalan-enabled').checked;
            const prestasiCount = parseInt(document.getElementById('prestasi-arena-count').value);
            const prestasiEnabled = document.getElementById('prestasi-enabled').checked;
            
            // Update configuration
            eventArenaConfig[currentConfigEvent] = {
                pemasalan: { count: pemasalanCount, enabled: pemasalanEnabled },
                prestasi: { count: prestasiCount, enabled: prestasiEnabled }
            };
            
            // Regenerate arena tabs and tables for current event if it's being viewed
            const currentEventTitle = document.getElementById('event-title').textContent;
            if (currentEventTitle === currentConfigEvent) {
                regenerateArenaInterface();
            }
            
            alert(`Konfigurasi arena untuk ${currentConfigEvent} berhasil disimpan!\nPemasalan: ${pemasalanCount} arena, Prestasi: ${prestasiCount} arena`);
            closeModal('modal-arena-config');
        }

        function regenerateArenaInterface() {
            const currentEvent = document.getElementById('event-title').textContent;
            const config = eventArenaConfig[currentEvent];
            
            if (!config) return;
            
            // Regenerate Pemasalan arena tabs
            regenerateArenaTabs('pemasalan', config.pemasalan.count);
            regenerateArenaTables('pemasalan', config.pemasalan.count);
            
            // Regenerate Prestasi arena tabs
            regenerateArenaTabs('prestasi', config.prestasi.count);
            regenerateArenaTables('prestasi', config.prestasi.count);
            
            // Show first arena of current category
            const currentCategory = document.getElementById('pemasalan-section').classList.contains('hidden') ? 'prestasi' : 'pemasalan';
            showArena(currentCategory, 1);
        }

        function regenerateArenaTabs(category, count) {
            const tabContainer = document.querySelector(`#${category}-section .flex.space-x-2.mb-4`);
            if (!tabContainer) return;
            
            let tabsHTML = '';
            for (let i = 1; i <= count; i++) {
                const activeClass = i === 1 ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-blue-600';
                tabsHTML += `
                    <button onclick="showArena('${category}', ${i})" id="${category}-arena-${i}" class="flex-1 px-3 py-2 text-sm font-medium rounded-md ${activeClass}">
                        <i class="fas fa-square mr-1"></i>Arena ${i}
                    </button>
                `;
            }
            tabContainer.innerHTML = tabsHTML;
        }

        function regenerateArenaTables(category, count) {
            const sectionContainer = document.getElementById(`${category}-section`);
            
            // Remove existing arena tables
            const existingTables = sectionContainer.querySelectorAll('[id$="-table"]');
            existingTables.forEach(table => table.remove());
            
            // Create new arena tables
            for (let i = 1; i <= count; i++) {
                const tableDiv = document.createElement('div');
                tableDiv.id = `${category}-arena-${i}-table`;
                tableDiv.className = i === 1 ? '' : 'hidden';
                
                // Initialize with empty arena or existing data
                updateArenaTable(category, i);
                
                sectionContainer.appendChild(tableDiv);
            }
        }

        // Modal functions
        function showAddPanitia() {
            document.getElementById('modal-add-panitia').classList.remove('hidden');
        }

        function showMoveModal(pesilat1, pesilat2, category, currentArena) {
            currentMoveData = { pesilat1, pesilat2, category, currentArena };
            
            document.getElementById('move-match-info').innerHTML = `
                <span class="text-red-600"><i class="fas fa-square mr-1"></i>${pesilat1}</span> vs 
                <span class="text-blue-600"><i class="fas fa-square mr-1"></i>${pesilat2}</span>
            `;
            document.getElementById('move-current-arena').textContent = `Arena saat ini: Arena ${currentArena} - ${category.charAt(0).toUpperCase() + category.slice(1)}`;
            
            // Generate arena options dynamically
            const arenaOptionsContainer = document.getElementById('arena-options');
            let optionsHTML = '';
            
            for (let i = 1; i <= 3; i++) {
                if (i != currentArena) {
                    const matches = matchData[category][i] || [];
                    const matchCount = matches.length;
                    const statusText = matchCount === 0 ? 'Kosong - Tersedia' : `${matchCount} pertandingan`;
                    const statusColor = matchCount === 0 ? 'text-green-600' : 'text-blue-600';
                    
                    optionsHTML += `
                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <input type="radio" name="target-arena" value="${i}" class="mr-3">
                            <div class="flex-1">
                                <div class="font-medium">Arena ${i}</div>
                                <div class="text-sm ${statusColor}">${statusText}</div>
                            </div>
                        </label>
                    `;
                }
            }
            
            arenaOptionsContainer.innerHTML = optionsHTML;
            document.getElementById('modal-move-arena').classList.remove('hidden');
        }

        function moveArena() {
            const selectedArena = document.querySelector('input[name="target-arena"]:checked');
            if (selectedArena) {
                const targetArena = selectedArena.value;
                
                // Remove match from current arena
                const currentCategory = currentMoveData.category;
                const currentArenaNum = currentMoveData.currentArena;
                const matchIndex = matchData[currentCategory][currentArenaNum].findIndex(match => 
                    match.pesilat1 === currentMoveData.pesilat1 && match.pesilat2 === currentMoveData.pesilat2
                );
                
                if (matchIndex !== -1) {
                    // Move the match to target arena
                    const match = matchData[currentCategory][currentArenaNum].splice(matchIndex, 1)[0];
                    if (!matchData[currentCategory][targetArena]) {
                        matchData[currentCategory][targetArena] = [];
                    }
                    matchData[currentCategory][targetArena].push(match);
                    
                    // Refresh the display
                    refreshArenaDisplay();
                    
                    alert(`Pertandingan Tim Merah (${currentMoveData.pesilat1}) vs Tim Biru (${currentMoveData.pesilat2}) berhasil dipindah ke Arena ${targetArena}!`);
                    closeModal('modal-move-arena');
                }
            } else {
                alert('Silakan pilih arena tujuan terlebih dahulu!');
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function showAddEvent() {
            alert('Fitur tambah event akan segera tersedia!');
        }

        function refreshArenaDisplay() {
            const currentCategory = document.getElementById('pemasalan-section').classList.contains('hidden') ? 'prestasi' : 'pemasalan';
            
            // Refresh all arena tables for current category
            for (let arena = 1; arena <= 3; arena++) {
                const tableId = `${currentCategory}-arena-${arena}-table`;
                const tableElement = document.getElementById(tableId);
                if (tableElement) {
                    updateArenaTable(currentCategory, arena);
                }
            }
        }

        function updateArenaTable(category, arena) {
            const matches = matchData[category][arena] || [];
            const tableContainer = document.getElementById(`${category}-arena-${arena}-table`);
            
            if (matches.length === 0) {
                // Empty arena
                tableContainer.innerHTML = `
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold text-gray-900">Arena ${arena} - Kategori ${category.charAt(0).toUpperCase() + category.slice(1)}</h4>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">Kosong</span>
                    </div>
                    <div class="text-center py-12 text-gray-500">
                        <i class="fas fa-square text-4xl mb-4"></i>
                        <p class="text-lg">Arena ${arena} sedang kosong</p>
                        <p class="text-sm">Pesilat dapat dipindahkan ke arena ini</p>
                    </div>
                `;
            } else {
                // Arena with matches
                const activeMatches = matches.filter(m => m.status !== 'Selesai').length;
                const statusText = activeMatches > 0 ? `${activeMatches} Pertandingan Aktif` : 'Semua Selesai';
                const statusClass = activeMatches > 0 ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800';
                
                let tableHTML = `
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold text-gray-900">Arena ${arena} - Kategori ${category.charAt(0).toUpperCase() + category.slice(1)}</h4>
                        <span class="px-3 py-1 ${statusClass} text-sm font-medium rounded-full">${statusText}</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PARTAI</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tim Merah</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tim Biru</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas Tanding</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Babak</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                `;
                
                matches.forEach((match, index) => {
                    const statusColors = {
                        'Berlangsung': 'bg-yellow-100 text-yellow-800',
                        'Menunggu': 'bg-blue-100 text-blue-800',
                        'Selesai': 'bg-green-100 text-green-800'
                    };

                    const babakColors = {
                        'Final': 'bg-yellow-100 text-yellow-800',
                        'Semifinal': 'bg-orange-100 text-orange-800',
                        'Perempat Final': 'bg-purple-100 text-purple-800',
                        'Babak 16 Besar': 'bg-purple-100 text-purple-800',
                        'Babak 32 Besar': 'bg-gray-100 text-gray-800',
                        'Perebutan Juara 3': 'bg-blue-100 text-blue-800'
                    };
                    
                    const actionButton = match.status === 'Selesai' 
                        ? '<button class="text-gray-400 cursor-not-allowed"><i class="fas fa-check mr-1"></i>Selesai</button>'
                        : `<button onclick="editMatch(${match.id}, '${match.pesilat1}', '${match.asal1}', '${match.pesilat2}', '${match.asal2}', '${match.status}', '${match.waktu}', '${category}', ${arena})" class="text-green-600 hover:text-green-900 mr-2"><i class="fas fa-edit mr-1"></i>Edit</button>
                           <button onclick="deleteMatch(${match.id}, '${match.pesilat1}', '${match.pesilat2}', '${category}', ${arena})" class="text-red-600 hover:text-red-900 mr-2"><i class="fas fa-trash mr-1"></i>Hapus</button>
                           <button onclick="showMoveModal('${match.pesilat1}', '${match.pesilat2}', '${category}', ${arena})" class="text-blue-600 hover:text-blue-900"><i class="fas fa-exchange-alt mr-1"></i>Pindah</button>`;
                    
                    tableHTML += `
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">PARTAI ${index + 1}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-red-700">
                                <i class="fas fa-square text-red-500 mr-1"></i>${match.pesilat1}<br>
                                <span class="text-xs text-gray-600">${match.asal1}</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-blue-700">
                                <i class="fas fa-square text-blue-500 mr-1"></i>${match.pesilat2}<br>
                                <span class="text-xs text-gray-600">${match.asal2}</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-xs text-gray-900">
                                <div class="font-medium">${match.kelas ? match.kelas.split('(')[0].trim() : 'Kelas Belum Ditentukan'}</div>
                                <div class="text-gray-600">${match.kelas ? '(' + match.kelas.split('(')[1] : ''}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${babakColors[match.babak] || 'bg-gray-100 text-gray-800'}">${match.babak || 'Belum Ditentukan'}</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusColors[match.status]}">${match.status}</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">${match.waktu}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">${actionButton}</td>
                        </tr>
                    `;
                });
                
                tableHTML += `
                            </tbody>
                        </table>
                    </div>
                `;
                
                tableContainer.innerHTML = tableHTML;
            }
        }

        function showAddAthlete() {
            document.getElementById('modal-add-athlete').classList.remove('hidden');
        }

        // Panitia management functions
        function updateRoleInfo() {
            const role = document.getElementById('panitia-role').value;
            const roleInfo = document.getElementById('role-info');
            const roleDescription = document.getElementById('role-description');

            if (role) {
                roleInfo.classList.remove('hidden');
                if (role === 'juri') {
                    roleDescription.innerHTML = `
                        <div>• <strong>Tanding:</strong> Maksimal 3 juri per arena</div>
                        <div>• <strong>Seni & Jurus Baku:</strong> Maksimal 10 juri per arena</div>
                    `;
                } else if (role === 'dewan') {
                    roleDescription.innerHTML = `
                        <div>• <strong>Semua Kategori:</strong> Maksimal 2 dewan per arena</div>
                    `;
                }
            } else {
                roleInfo.classList.add('hidden');
            }
        }

        function updateArenaOptions() {
            const category = document.getElementById('panitia-category').value;
            const arenaSelect = document.getElementById('panitia-arena');
            
            // Reset arena selection
            arenaSelect.value = '';
            checkArenaCapacity();
        }

        function checkArenaCapacity() {
            const event = document.getElementById('panitia-event').value;
            const category = document.getElementById('panitia-category').value;
            const arena = document.getElementById('panitia-arena').value;
            const role = document.getElementById('panitia-role').value;

            const arenaWarning = document.getElementById('arena-warning');
            const arenaStatus = document.getElementById('arena-status');
            const submitBtn = document.getElementById('submit-btn');

            if (!event || !category || !arena || !role) {
                arenaWarning.classList.add('hidden');
                arenaStatus.classList.add('hidden');
                return;
            }

            // Get current assignments for this event/category/arena
            const current = currentAssignments[event]?.[category]?.[arena] || { juri: 0, dewan: 0 };
            const maxCapacity = arenaCapacity[category];

            // Show arena status
            arenaStatus.classList.remove('hidden');
            const statusContent = document.getElementById('arena-status-content');
            statusContent.innerHTML = `
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="font-medium">Juri:</div>
                        <div class="text-xs">${current.juri}/${maxCapacity.juri} terisi</div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: ${(current.juri/maxCapacity.juri)*100}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="font-medium">Dewan:</div>
                        <div class="text-xs">${current.dewan}/${maxCapacity.dewan} terisi</div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-orange-600 h-2 rounded-full" style="width: ${(current.dewan/maxCapacity.dewan)*100}%"></div>
                        </div>
                    </div>
                </div>
            `;

            // Check if adding this role would exceed capacity
            const wouldExceed = (role === 'juri' && current.juri >= maxCapacity.juri) || 
                               (role === 'dewan' && current.dewan >= maxCapacity.dewan);

            if (wouldExceed) {
                arenaWarning.classList.remove('hidden');
                const warningText = document.getElementById('arena-warning-text');
                warningText.textContent = `Arena ${arena} sudah penuh untuk role ${role} pada kategori ${category}. Silakan pilih arena lain.`;
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                arenaWarning.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        function handleAddAthlete(event) {
            event.preventDefault();
            
            const name1 = document.getElementById('athlete-name-1').value;
            const origin1 = document.getElementById('athlete-origin-1').value;
            const name2 = document.getElementById('athlete-name-2').value;
            const origin2 = document.getElementById('athlete-origin-2').value;
            const category = document.getElementById('athlete-category').value;
            const arena = document.getElementById('athlete-arena').value;
            const kelas = document.getElementById('athlete-class').value;
            const babak = document.getElementById('athlete-round').value;
            const time = document.getElementById('athlete-time').value;

            // Generate new match ID
            const newId = Math.max(...Object.values(matchData).flatMap(cat => 
                Object.values(cat).flatMap(arena => arena.map(match => match.id))
            )) + 1;

            // Create new match
            const newMatch = {
                id: newId,
                pesilat1: name1,
                asal1: origin1,
                pesilat2: name2,
                asal2: origin2,
                status: 'Menunggu',
                waktu: time,
                kelas: kelas,
                babak: babak
            };

            // Add to match data
            if (!matchData[category][arena]) {
                matchData[category][arena] = [];
            }
            matchData[category][arena].push(newMatch);

            alert(`Pertandingan ${kelas} - ${babak}\nTim Merah (${name1}) vs Tim Biru (${name2})\nberhasil ditambahkan ke Arena ${arena} kategori ${category}!`);
            
            // Reset form
            document.getElementById('athlete-name-1').value = '';
            document.getElementById('athlete-origin-1').value = '';
            document.getElementById('athlete-name-2').value = '';
            document.getElementById('athlete-origin-2').value = '';
            document.getElementById('athlete-category').value = '';
            document.getElementById('athlete-arena').value = '';
            document.getElementById('athlete-class').value = '';
            document.getElementById('athlete-round').value = '';
            document.getElementById('athlete-time').value = '';
            
            // Refresh display if we're currently viewing this category
            refreshArenaDisplay();
            
            closeModal('modal-add-athlete');
        }

        function handleAddPanitia(event) {
            event.preventDefault();
            
            const name = document.getElementById('panitia-name').value;
            const email = document.getElementById('panitia-email').value;
            const role = document.getElementById('panitia-role').value;
            const eventName = document.getElementById('panitia-event').value;
            const category = document.getElementById('panitia-category').value;
            const arena = document.getElementById('panitia-arena').value;

            // Update current assignments (simulate database update)
            if (!currentAssignments[eventName]) {
                currentAssignments[eventName] = {};
            }
            if (!currentAssignments[eventName][category]) {
                currentAssignments[eventName][category] = {};
            }
            if (!currentAssignments[eventName][category][arena]) {
                currentAssignments[eventName][category][arena] = { juri: 0, dewan: 0 };
            }

            currentAssignments[eventName][category][arena][role]++;

            alert(`Panitia ${name} berhasil ditambahkan sebagai ${role} untuk kategori ${category} di Arena ${arena}!`);
            
            // Reset form
            document.getElementById('panitia-name').value = '';
            document.getElementById('panitia-email').value = '';
            document.getElementById('panitia-role').value = '';
            document.getElementById('panitia-event').value = '';
            document.getElementById('panitia-category').value = '';
            document.getElementById('panitia-arena').value = '';
            
            // Hide info panels
            document.getElementById('role-info').classList.add('hidden');
            document.getElementById('arena-warning').classList.add('hidden');
            document.getElementById('arena-status').classList.add('hidden');
            
            closeModal('modal-add-panitia');
        }

        // Initialize arena display on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all arena tables with current data
            for (const category of ['pemasalan', 'prestasi']) {
                for (let arena = 1; arena <= 3; arena++) {
                    updateArenaTable(category, arena);
                }
            }
        });

        // Panitia data storage (simulated database)
        let panitiaData = [
            { id: 1, name: 'Dr. Andi Wijaya', email: 'andi.wijaya@email.com', role: 'juri', event: 'kejuaraan-nasional', category: 'tanding', arena: '1' },
            { id: 2, name: 'Prof. Siti Nurhaliza', email: 'siti.nurhaliza@email.com', role: 'dewan', event: 'kejuaraan-nasional', category: 'seni', arena: '2' },
            { id: 3, name: 'Drs. Bambang Sutrisno', email: 'bambang.sutrisno@email.com', role: 'juri', event: 'kejuaraan-nasional', category: 'jurus-baku', arena: '3' },
            { id: 4, name: 'Dr. Maya Sari', email: 'maya.sari@email.com', role: 'dewan', event: 'piala-gubernur', category: 'tanding', arena: '1' }
        ];

        let deleteTarget = null;

        // Edit Panitia Functions
        function editPanitia(id, name, email, role, event, category, arena) {
            document.getElementById('edit-panitia-id').value = id;
            document.getElementById('edit-panitia-name').value = name;
            document.getElementById('edit-panitia-email').value = email;
            document.getElementById('edit-panitia-role').value = role;
            document.getElementById('edit-panitia-event').value = event;
            document.getElementById('edit-panitia-category').value = category;
            document.getElementById('edit-panitia-arena').value = arena;
            
            document.getElementById('modal-edit-panitia').classList.remove('hidden');
        }

        function handleEditPanitia(event) {
            event.preventDefault();
            
            const id = parseInt(document.getElementById('edit-panitia-id').value);
            const name = document.getElementById('edit-panitia-name').value;
            const email = document.getElementById('edit-panitia-email').value;
            const role = document.getElementById('edit-panitia-role').value;
            const eventName = document.getElementById('edit-panitia-event').value;
            const category = document.getElementById('edit-panitia-category').value;
            const arena = document.getElementById('edit-panitia-arena').value;

            // Update panitia data
            const panitiaIndex = panitiaData.findIndex(p => p.id === id);
            if (panitiaIndex !== -1) {
                panitiaData[panitiaIndex] = { id, name, email, role, event: eventName, category, arena };
            }

            alert(`Data panitia ${name} berhasil diperbarui!`);
            closeModal('modal-edit-panitia');
            refreshPanitiaTable();
        }

        // Delete Panitia Functions
        function deletePanitia(id, name) {
            deleteTarget = { type: 'panitia', id, name };
            document.getElementById('delete-item-name').textContent = name;
            document.getElementById('delete-item-type').textContent = 'Panitia';
            document.getElementById('modal-delete-confirm').classList.remove('hidden');
        }

        // Edit Match Functions
        function editMatch(id, pesilat1, asal1, pesilat2, asal2, status, waktu, category, arena) {
            document.getElementById('edit-match-id').value = id;
            document.getElementById('edit-match-category').value = category;
            document.getElementById('edit-match-arena').value = arena;
            document.getElementById('edit-athlete-name-1').value = pesilat1;
            document.getElementById('edit-athlete-origin-1').value = asal1;
            document.getElementById('edit-athlete-name-2').value = pesilat2;
            document.getElementById('edit-athlete-origin-2').value = asal2;
            document.getElementById('edit-match-status').value = status;
            document.getElementById('edit-match-time').value = waktu;
            
            document.getElementById('modal-edit-match').classList.remove('hidden');
        }

        function handleEditMatch(event) {
            event.preventDefault();
            
            const id = parseInt(document.getElementById('edit-match-id').value);
            const category = document.getElementById('edit-match-category').value;
            const arena = document.getElementById('edit-match-arena').value;
            const pesilat1 = document.getElementById('edit-athlete-name-1').value;
            const asal1 = document.getElementById('edit-athlete-origin-1').value;
            const pesilat2 = document.getElementById('edit-athlete-name-2').value;
            const asal2 = document.getElementById('edit-athlete-origin-2').value;
            const status = document.getElementById('edit-match-status').value;
            const waktu = document.getElementById('edit-match-time').value;

            // Update match data
            const matchIndex = matchData[category][arena].findIndex(m => m.id === id);
            if (matchIndex !== -1) {
                matchData[category][arena][matchIndex] = {
                    id, pesilat1, asal1, pesilat2, asal2, status, waktu
                };
            }

            alert(`Pertandingan ${pesilat1} vs ${pesilat2} berhasil diperbarui!`);
            closeModal('modal-edit-match');
            refreshArenaDisplay();
        }

        // Delete Match Functions
        function deleteMatch(id, pesilat1, pesilat2, category, arena) {
            deleteTarget = { type: 'match', id, name: `${pesilat1} vs ${pesilat2}`, category, arena };
            document.getElementById('delete-item-name').textContent = `${pesilat1} vs ${pesilat2}`;
            document.getElementById('delete-item-type').textContent = 'Pertandingan';
            document.getElementById('modal-delete-confirm').classList.remove('hidden');
        }

        // Confirm Delete Function
        function confirmDelete() {
            if (!deleteTarget) return;

            if (deleteTarget.type === 'panitia') {
                // Remove from panitia data
                panitiaData = panitiaData.filter(p => p.id !== deleteTarget.id);
                alert(`Panitia ${deleteTarget.name} berhasil dihapus!`);
                refreshPanitiaTable();
            } else if (deleteTarget.type === 'match') {
                // Remove from match data
                const matchIndex = matchData[deleteTarget.category][deleteTarget.arena].findIndex(m => m.id === deleteTarget.id);
                if (matchIndex !== -1) {
                    matchData[deleteTarget.category][deleteTarget.arena].splice(matchIndex, 1);
                }
                alert(`Pertandingan ${deleteTarget.name} berhasil dihapus!`);
                refreshArenaDisplay();
            }

            deleteTarget = null;
            closeModal('modal-delete-confirm');
        }

        // Refresh Panitia Table
        function refreshPanitiaTable() {
            const tbody = document.querySelector('#panitia-management tbody');
            if (!tbody) return;

            const eventNames = {
                'kejuaraan-nasional': 'Kejuaraan Nasional 2024',
                'piala-gubernur': 'Piala Gubernur 2024',
                'turnamen-regional': 'Turnamen Regional 2024'
            };

            const categoryNames = {
                'tanding': 'Tanding',
                'seni': 'Seni',
                'jurus-baku': 'Jurus Baku'
            };

            const roleColors = {
                'juri': 'bg-purple-100 text-purple-800',
                'dewan': 'bg-orange-100 text-orange-800'
            };

            const categoryColors = {
                'tanding': 'bg-blue-100 text-blue-800',
                'seni': 'bg-green-100 text-green-800',
                'jurus-baku': 'bg-yellow-100 text-yellow-800'
            };

            let tableHTML = '';
            panitiaData.forEach((panitia, index) => {
                tableHTML += `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${index + 1}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${panitia.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${panitia.email}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${roleColors[panitia.role]}">${panitia.role.charAt(0).toUpperCase() + panitia.role.slice(1)}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${eventNames[panitia.event]}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${categoryColors[panitia.category]}">${categoryNames[panitia.category]}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Arena ${panitia.arena}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="editPanitia(${panitia.id}, '${panitia.name}', '${panitia.email}', '${panitia.role}', '${panitia.event}', '${panitia.category}', '${panitia.arena}')" class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                            <button onclick="deletePanitia(${panitia.id}, '${panitia.name}')" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </td>
                    </tr>
                `;
            });

            tbody.innerHTML = tableHTML;
        }

        // Close modal when clicking outside
        document.getElementById('modal-add-panitia').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal('modal-add-panitia');
            }
        });

        document.getElementById('modal-add-athlete').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal('modal-add-athlete');
            }
        });

        document.getElementById('modal-move-arena').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal('modal-move-arena');
            }
        });

        document.getElementById('modal-arena-config').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal('modal-arena-config');
            }
        });

        document.getElementById('modal-edit-panitia').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal('modal-edit-panitia');
            }
        });

        document.getElementById('modal-delete-confirm').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal('modal-delete-confirm');
            }
        });

        document.getElementById('modal-edit-match').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal('modal-edit-match');
            }
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'97a42c3005919ccb',t:'MTc1NzA1OTAxMy4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
