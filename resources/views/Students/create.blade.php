<!DOCTYPE html>
<html lang="en">

@if (!session('role') == 'student')
    <script>
        window.location.href = '/login';
        alert('You do not have access to this page.');
    </script>
@endif

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register Student</title>
</head>

<body>

    <section
        class="create bg-gradient-to-br from-teal-100 to-gray-100 flex items-center justify-center min-h-screen p-4">
        <div
            class="container bg-white p-8 rounded-2xl shadow-lg w-full max-w-2xl transition-all duration-300 hover:shadow-xl">
            <h1 class="text-3xl font-bold text-gray-800 mb-3 text-center">Register New Student</h1>
            <div class="line w-20 h-1 bg-teal-500 mx-auto mb-6 rounded-full"></div>

            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Personal Information Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Personal Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Full Name
                                *</label>
                            <input type="text" id="name" name="name" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="age" class="block text-sm font-semibold text-gray-700 mb-1">Age *</label>
                            <input type="number" id="age" name="age" required min="1" max="100"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200"
                                value="{{ old('age') }}">
                            @error('age')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="nis" class="block text-sm font-semibold text-gray-700 mb-1">NIS (Student ID
                                Number) *</label>
                            <input type="text" id="nis" name="nis" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200"
                                value="{{ old('nis') }}">
                            @error('nis')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone_number" class="block text-sm font-semibold text-gray-700 mb-1">Phone
                                Number</label>
                            <input type="tel" id="phone_number" name="phone_number"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200"
                                value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Address</label>
                        <textarea id="address" name="address" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="foto" class="block text-sm font-semibold text-gray-700 mb-1">Photo</label>
                        <input type="file" id="foto" name="foto" accept="image/*"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200">
                        <p class="text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG, GIF. Max size: 2MB</p>
                        @error('foto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Academic Information Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Academic Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="class" class="block text-sm font-semibold text-gray-700 mb-1">Class *</label>
                            <select name="class_id" required>
                                <option value="">-- Select Class --</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->class_id }}">{{ $class->major }}</option>
                                @endforeach
                            </select>


                            @error('class_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Hidden field for role -->
                <input type="hidden" name="role" value="student">

                <div class="flex justify-center space-x-4 pt-6">
                    <button type="submit"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-200 transform hover:scale-105">
                        Register Student
                    </button>
                    <a href="{{ url()->previous() }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-8 py-3 rounded-lg transition duration-200 transform hover:scale-105">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </section>

</body>

</html>
