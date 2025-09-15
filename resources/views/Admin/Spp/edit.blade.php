<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit SPP</title>
</head>

<body>
    <section class="edit bg-gradient-to-br from-teal-100 to-gray-100 flex items-center justify-center min-h-screen p-4">
        <div
            class="container bg-white p-8 rounded-2xl shadow-lg w-full max-w-2xl transition-all duration-300 hover:shadow-xl">

            <!-- Heading -->
            <h1 class="text-3xl font-bold text-gray-800 mb-3 text-center">Edit SPP</h1>
            <div class="line w-20 h-1 bg-teal-500 mx-auto mb-6 rounded-full"></div>

            <!-- Form -->
            <form action="{{ route('spp.update', $spp) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Tahun -->
                <div>
                    <label for="year" class="block text-sm font-semibold text-gray-700 mb-1">Tahun *</label>
                    <input type="number" id="year" name="year" required min="2020" max="2030"
                        value="{{ old('year', $spp->year) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200">
                    @error('year')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bulan -->
                <div>
                    <label for="month" class="block text-sm font-semibold text-gray-700 mb-1">Bulan *</label>
                    <select id="month" name="month" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200">
                        <option value="">Pilih Bulan</option>
                        @php
                            $months = [
                                'January' => 'Januari',
                                'February' => 'Februari',
                                'March' => 'Maret',
                                'April' => 'April',
                                'May' => 'Mei',
                                'June' => 'Juni',
                                'July' => 'Juli',
                                'August' => 'Agustus',
                                'September' => 'September',
                                'October' => 'Oktober',
                                'November' => 'November',
                                'December' => 'Desember',
                            ];
                        @endphp
                        @foreach ($months as $value => $label)
                            <option value="{{ $value }}"
                                {{ old('month', $spp->month) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('month')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pilih Siswa -->
                <div>
                    <label for="student" class="block text-sm font-semibold text-gray-700 mb-1">Pilih Siswa *</label>
                    <select id="student" name="student" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200">
                        <option value="" disabled>-- Pilih Siswa --</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->student_id }}"
                                {{ old('student', $spp->student_id) == $student->student_id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nominal -->
                <div>
                    <label for="nominal" class="block text-sm font-semibold text-gray-700 mb-1">Nominal (Rp) *</label>
                    <input type="number" id="nominal" name="nominal" required min="0" step="1000"
                        placeholder="Contoh: 150000" value="{{ old('nominal', $spp->nominal) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200">
                    @error('nominal')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status : </label>
                    <select name="status" id="status" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200">
                        <option value="Paid">Paid</option>
                        <option value="Pending">Pending</option>
                        <option value="Unpaid">Unpaid</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-center space-x-4 pt-6">
                    <a href="{{ route('admin.spp.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-8 py-3 rounded-lg transition duration-200 transform hover:scale-105">
                        Kembali
                    </a>
                    <button type="submit"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-200 transform hover:scale-105">
                        Update SPP
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>
