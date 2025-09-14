<!DOCTYPE html>
<html lang="en">

@if (!session('role') == 'admin')
    <script>
        window.location.href = '/login';
        alert('Access denied. Admins only.');
    </script>
@endif

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>

    <title>Studify | Admin Panel</title>

    <style>
        .title {
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>

    <x-header />

    <section class="flex min-h-screen">

        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg flex flex-col">
            <!-- Logo/Brand -->
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-800">Admin Portal</h1>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('students.index') }}"
                            class="flex items-center px-4 py-3 text-white bg-gray-800 rounded-lg font-medium transition-colors">
                            <i class='bx bx-home text-xl mr-3'></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.edit', session('user_id')) }}"
                            class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg font-medium transition-colors">
                            <i class='bx bx-user text-xl mr-3'></i>
                            Profile
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

        <div class="main-dashboard bg-[#f5f5f5] mx-auto w-full">
            <div class="p-8">
                <div class="bg-white w-fit px-4 pt-3 gap-6 rounded-xl shadow flex">
                    <a href={{ route('users.index') }}
                        class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Users</a>
                    <a href={{ route('admin.students.index') }}
                        class="border-b-2 font-medium cursor-pointer px-2 pb-3 border-[#7AE2CF]">Students</a>
                    <a href={{ route('admin.spp.index') }}
                        class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Spp</a>
                    <a href={{ route('admin.payments.index') }}
                        class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Payments</a>
                </div>

            </div>
            <div class="ml-8 my-4 gap-8 flex w-fit justify-center items-center">
                <h1 class="text-2xl font-semibold">Students</h1>
                <a href={{ route('admin.students.create') }}
                    class="bg-teal-700 cursor-pointer py-2 px-4 text-white font-medium rounded-lg">Add
                    new</a>
            </div>
            <div class="ml-8 mb-6 flex gap-3">
                <a href="{{ route('admin.students.index', ['class_id' => 'all']) }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium {{ request('class_id') == 'all' || !request('class_id') ? 'bg-teal-700 text-white' : 'bg-gray-200 text-gray-700' }}">
                    All
                </a>

                @foreach ($classes as $id => $name)
                    <a href="{{ route('admin.students.index', ['class_id' => $id]) }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium {{ request('class_id') == $id ? 'bg-teal-700 text-white' : 'bg-gray-200 text-gray-700' }}">
                        {{ $name }}
                    </a>
                @endforeach
            </div>

            <div class="w-[85%] ml-8 rounded-xl p-8 pt-2 bg-[#fff] shadow">
                <div class="grid grid-cols-8">
                    <div class="grid gap-3">
                        <h1 class="font-semibold">Foto</h1>

                        <div class="grid gap-2">
                            @foreach ($students as $student)
                                <img src="{{ $student->foto ? asset('storage/' . $student->foto) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face&auto=format' }}" class="text-gray-500 w-[50px] h-[50px] object-cover"></img>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid gap-3">
                        <h1 class="font-semibold">Name</h1>

                        <div class="grid gap-2">
                            @foreach ($students as $student)
                                <p class="text-gray-500">{{ $student->name }}</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid gap-3">
                        <h1 class="font-semibold">NIS</h1>

                        <div class="grid gap-2">
                            @foreach ($students as $student)
                                <p class="text-gray-500">{{ $student->nis }}</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid gap-3">
                        <h1 class="font-semibold">Age</h1>

                        <div class="grid gap-2">
                            @foreach ($students as $student)
                                <p class="text-gray-500">{{ $student->age }}</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid gap-3">
                        <h1 class="font-semibold">Phone</h1>

                        <div class="grid gap-2">
                            @foreach ($students as $student)
                                <p class="text-gray-500">{{ $student->phone_number }}</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid gap-3">
                        <h1 class="font-semibold">Jurusan</h1>

                        <div class="grid gap-2">
                            @foreach ($students as $student)
                                <p class="text-gray-500">{{ $classes[$student->class_id] ?? 'Unknown' }}</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid gap-3">
                        <h1 class="font-semibold">Operation</h1>

                        <div class="grid gap-2">
                            @foreach ($students as $student)
                                <div class="flex gap-2">
                                    {{-- Edit --}}
                                    <a href="{{ route('admin.students.edit', $student) }}" class="cursor-pointer">
                                        <box-icon type="regular" color="#077A7D" name="edit"></box-icon>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('students.destroy', $student) }}" method="POST"
                                        onsubmit="return confirm('Delete this student?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cursor-pointer">
                                            <box-icon type="regular" color="#077A7D" name="trash"></box-icon>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
        </div>

    </section>

</body>

</html>
