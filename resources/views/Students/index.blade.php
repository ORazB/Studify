@php
    $student = $students->first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>Studify | Student</title>
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg flex flex-col">
            <!-- Logo/Brand -->
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-800">Studify</h1>
                <p class="text-sm text-gray-500">Student Portal</p>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('students.index') }}"
                            class="flex items-center px-4 py-3 text-white bg-gray-800 rounded-lg font-medium transition-colors">
                            <i class='bx bx-home text-xl mr-3'></i>
                            Dashboard
                        </a>
                    </li>

                    <!-- Profile -->
                    <li>
                        <a href="{{ $student ? route('students.edit', $student->student_id) : '#' }}"
                            class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition-colors">
                            <i class='bx bx-user text-xl mr-3'></i>
                            Profile
                        </a>
                    </li>

                    <!-- Pembayaran -->
                    <li>
                        <a href="#"
                            class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition-colors">
                            <i class='bx bx-credit-card text-xl mr-3'></i>
                            Pembayaran
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-gray-200">
                <a href="./logout"
                    class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg font-medium transition-colors">
                    <i class='bx bx-log-out text-xl mr-3'></i>
                    Keluar
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            @if ($student)
                <div class="p-6 max-w-7xl mx-auto">

                    {{-- <!-- Top Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <!-- Saldo SPP -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                            <div class="text-sm text-gray-600 mb-2">Saldo SPP</div>
                            <div class="text-2xl font-bold text-green-500 mb-1">Rp 0</div>
                            <div class="text-xs text-gray-400">Tidak Ada Tunggakan</div>
                        </div>

                        <!-- Bulan ini -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                            <div class="text-sm text-gray-600 mb-2">Bulan ini</div>
                            <div class="text-2xl font-bold text-green-500 mb-1">Sudah Bayar</div>
                            <div class="text-xs text-gray-400">{{ now()->format('F Y') }}</div>
                        </div>

                        <!-- Pembayaran -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                            <div class="text-sm text-gray-600 mb-2">Pembayaran</div>
                            <div class="text-2xl font-bold text-gray-800 mb-1">5/6</div>
                            <div class="text-xs text-gray-400">Bulan Terbayar</div>
                        </div>

                        <!-- Jatuh Tempo -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                            <div class="text-sm text-gray-600 mb-2">Jatuh Tempo</div>
                            <div class="text-2xl font-bold text-red-500 mb-1">0 Hari</div>
                            <div class="text-xs text-gray-400">10 September 2025</div>
                        </div>
                    </div> --}}

                    <!-- Main Content Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Profile Section -->
                        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                            <div class="flex items-center mb-6">
                                <i class='bx bx-user text-xl mr-2'></i>
                                <span class="font-semibold text-gray-800">Profil Siswa</span>
                            </div>

                            <div class="flex items-start space-x-6">
                                <!-- Profile Image -->
                                <div class="flex-shrink-0">
                                    <img src="{{ $student->foto ? asset('storage/' . $student->foto) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face&auto=format' }}"
                                        alt="Profile"
                                        class="w-20 h-20 rounded-full object-cover border-4 border-gray-100">
                                </div>

                                <!-- Profile Info -->
                                <div class="flex-1">
                                    <h2 class="text-xl font-bold text-gray-800 mb-2">Selamat Datang, {{ $student->name }}
                                        </h2>
                                            <p class="text-gray-500 text-sm mb-4">Kelola pembayaran SPP Anda dengan
                                                mudah</p>

                                            <!-- Info Grid -->
                                            <div class="grid grid-cols-2 gap-3">
                                                <div class="flex items-center space-x-2">
                                                    <i class='bx bx-calendar text-gray-400'></i>
                                                    <div>
                                                        <div class="text-xs text-gray-400">Umur</div>
                                                        <div class="text-sm font-medium">{{ $student->age }} Tahun</div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center space-x-2">
                                                    <i class='bx bx-id-card text-gray-400'></i>
                                                    <div>
                                                        <div class="text-xs text-gray-400">NIS</div>
                                                        <div class="text-sm font-medium">{{ $student->nis }}</div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center space-x-2">
                                                    <i class='bx bx-phone text-gray-400'></i>
                                                    <div>
                                                        <div class="text-xs text-gray-400">No. HP</div>
                                                        <div class="text-sm font-medium">
                                                            {{ $student->phone_number ?? 'Tidak ada' }}</div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center space-x-2">
                                                    <i class='bx bx-map text-gray-400'></i>
                                                    <div>
                                                        <div class="text-xs text-gray-400">Alamat</div>
                                                        <div class="text-sm font-medium">
                                                            {{ Str::limit($student->address ?? 'Tidak ada', 20) }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Status Section -->
                        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <i class='bx bx-credit-card text-xl mr-2'></i>
                                    <span class="font-semibold text-gray-800">Status Pembayaran SPP</span>
                                </div>
                            </div>

                            @if (isset($spp) && $spps && $spp->count() > 0)
                                @foreach ($spps as $spp)
                                    <!-- Current Payment Card -->
                                    <div class="bg-[#7AE2CF] rounded-2xl p-6 text-black mb-6 relative overflow-hidden">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-2">
                                                <i class='bx bx-time-five'></i>
                                                <span class="text-sm">{{ $spp->month }} {{ $spp->year }}</span>
                                            </div>
                                            <div class="bg-white/20 px-3 py-1 rounded-full text-xs font-medium">
                                                @if ($spp->status == 'paid')
                                                    Sudah Bayar
                                                @elseif($spp->status == 'pending')
                                                    Menunggu Konfirmasi
                                                @else
                                                    Belum Bayar
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="text-sm mb-1">Jumlah SPP</div>
                                            <div class="text-2xl font-bold">Rp
                                                {{ number_format($spp->amount, 0, ',', '.') }}</div>
                                        </div>

                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm">Jatuh Tempo</div>
                                                <div class="font-semibold">{{ $spp->due_date->format('d F Y') }}</div>
                                            </div>

                                            @if ($spp->status == 'paid')
                                                <div class="bg-green-600 text-white px-4 py-2 rounded-lg font-medium">
                                                    <i class='bx bx-check mr-1'></i>
                                                    Lunas
                                                </div>
                                            @elseif($spp->status == 'pending')
                                                <div class="bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium">
                                                    <i class='bx bx-time mr-1'></i>
                                                    Pending
                                                </div>
                                            @else
                                                <form action="{{ route('spp.pay', $spp->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    <input type="hidden" name="spp_id" value="{{ $spp->id }}">
                                                    <input type="hidden" name="student_id"
                                                        value="{{ $student->id }}">
                                                    <input type="hidden" name="amount" value="{{ $spp->amount }}">
                                                    <button type="submit"
                                                        class="bg-gray-900 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-800 transition-colors">
                                                        Bayar Sekarang
                                                    </button>
                                                </form>
                                            @endif
                                        </div>

                                        <!-- Decorative circles -->
                                        <div class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full"></div>
                                        <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-white/5 rounded-full">
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Next Payment Info -->
                                @if ($nextSpp)
                                    <div class="flex items-center space-x-2 text-gray-600">
                                        <i class='bx bx-info-circle text-sm'></i>
                                        <div class="text-sm">
                                            <span class="font-medium">SPP Berikutnya:</span>
                                            <span class="text-gray-800 font-semibold ml-1">Rp
                                                {{ number_format($nextSpp->amount, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <!-- No SPP Data -->
                                <div class="bg-gray-100 rounded-2xl p-8 text-center">
                                    <i class='bx bx-file-blank text-4xl text-gray-400 mb-4'></i>
                                    <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Data SPP</h3>
                                    <p class="text-gray-500 text-sm">Data SPP belum tersedia. Silakan hubungi admin
                                        sekolah.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="min-h-screen flex items-center justify-center bg-gray-50">
                    <div class="text-center bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                        <i class='bx bx-user-plus text-6xl text-gray-300 mb-4'></i>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Profile Belum Lengkap</h2>
                        <p class="text-gray-500 mb-6">Silakan lengkapi profil siswa terlebih dahulu</p>
                        <a href="{{ route('students.create') }}"
                            class="inline-flex items-center bg-teal-500 text-white px-6 py-3 rounded-lg font-medium hover:bg-teal-600 transition-colors">
                            <i class='bx bx-plus mr-2'></i>
                            Buat Profil
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>

</html>
