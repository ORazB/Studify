<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>Studify | Edit Profile</title>
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen">
        <!-- Main Content -->
        <div class="p-6 w-full">
            @if ($student)
                <div class="w-[50%] mx-auto gap-8">
                    <!-- Profile Form -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center mb-6">
                            <i class='bx bx-user text-xl mr-2'></i>
                            <span class="font-semibold text-gray-800">Edit Profil Siswa</span>
                        </div>

                        @if (session('success'))
                            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->hasBag('student'))
                            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                                <ul>
                                    @foreach ($errors->getBag('student')->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('students.update', $student->student_id) }}" method="POST"
                            enctype="multipart/form-data" name="student">
                            @csrf
                            @method('PUT')

                            <!-- Profile Image -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $student->foto ? asset('storage/' . $student->foto) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face&auto=format' }}"
                                        alt="Profile" class="w-20 h-20 rounded-full object-cover border-4 border-gray-100">
                                    <input type="file" name="foto" accept="image/*"
                                        class="block w-full text-sm text-gray-500
                                               file:mr-4 file:py-2 file:px-4
                                               file:rounded-lg file:border-0
                                               file:text-sm file:font-semibold
                                               file:bg-teal-50 file:text-teal-700
                                               hover:file:bg-teal-100">
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="mb-6">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('student.name', $student->name) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                    required>
                            </div>

                            <!-- Age -->
                            <div class="mb-6">
                                <label for="age" class="block text-sm font-medium text-gray-700">Umur</label>
                                <input type="number" name="age" id="age"
                                    value="{{ old('student.age', $student->age) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                    required>
                            </div>

                            <!-- NIS -->
                            <div class="mb-6">
                                <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                                <input type="text" name="nis" id="nis"
                                    value="{{ old('student.nis', $student->nis) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                    required>
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-6">
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">No. HP</label>
                                <input type="text" name="phone_number" id="phone_number"
                                    value="{{ old('student.phone_number', $student->phone_number ?? '') }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                    placeholder="Masukkan nomor telepon">
                            </div>

                            <!-- Address -->
                            <div class="mb-6">
                                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                                <textarea name="address" id="address" rows="4"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                    placeholder="Masukkan alamat">{{ old('student.address', $student->address ?? '') }}</textarea>
                            </div>

                            <!-- Class -->
                            <div class="mb-6">
                                <label for="class_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                                <select name="class_id" id="class_id"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                    required>
                                    <option value="">-- Select Class --</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->class_id }}"
                                            {{ old('student.class_id', $student->class_id) == $class->class_id ? 'selected' : '' }}>
                                            {{ $class->major ?? 'Unnamed Class' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit and Cancel Buttons -->
                            <div class="flex justify-end space-x-4">
                                <a href="{{ url()->previous() }}"
                                    class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors">
                                    Simpan Perubahan Profil
                                </button>
                            </div>
                        </form>
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