<!DOCTYPE html>
<html lang="en">

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
                        <a href="{{route('users.edit', session('user_id')) }}"
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
                            <a href={{route('users.index')}} class="border-b-2 font-medium cursor-pointer px-2 pb-3 border-[#7AE2CF]">Users</a>
                            <a href={{route('admin.students.index')}} class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Students</a>
                            <a href={{route('admin.spp.index')}} class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Spp</a>
                            <a href={{route('admin.payments.index')}} class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Payments</a>
                        </div>

                    </div>
                    <div class="ml-8 my-4 gap-8 flex w-fit justify-center items-center">
                        <h1 class="text-2xl font-semibold">Users</h1>
                        <a href="./create" class="bg-teal-700 cursor-pointer py-2 px-4 text-white font-medium rounded-lg">Add
                            new</a>
                    </div>
                    <div class="w-[85%] ml-8 rounded-xl p-8 pt-2 bg-[#fff] shadow">
                        <div class="grid grid-cols-3">
                            <div class="grid gap-3">
                                <h1 class="font-semibold">Username</h1>

                                <div class="grid gap-2">
                                    @foreach ($users as $user)
                                        <p class="text-gray-500">{{ $user->username }}</p>
                                    @endforeach
                                </div>
                            </div>

                            <div class="grid gap-3">
                                <h1 class="font-semibold">Role</h1>

                                <div class="grid gap-2">
                                    @foreach ($users as $user)
                                        <p class="text-gray-500">{{ $user->role }}</p>
                                    @endforeach
                                </div>
                            </div>

                            <div class="grid gap-3">
                                <h1 class="font-semibold">Operation</h1>

                                <div class="grid gap-2">
                                    @foreach ($users as $user)
                                        <div class="flex gap-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('users.edit', $user) }}" class="cursor-pointer">
                                                <box-icon type="regular" color="#077A7D" name="edit"></box-icon>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('Delete this user?')">
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
