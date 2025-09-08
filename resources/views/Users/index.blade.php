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

    <section>

        <div class="w-full mx-auto">
            <div class="grid grid-cols-[15%_85%] mx-auto">
                <div class="h-screen bg-teal-700 p-4 text-white w-64">
                    <div class="flex flex-col gap-2 mt-2">
                        <h2
                            class="flex items-center font-medium text-lg p-2 rounded cursor-pointer hover:bg-white/10 transition-colors">
                            <box-icon type="regular" name="user" color="#fff" size="24"
                                class="mr-3"></box-icon>
                            Profile
                        </h2>
                        <h2
                            class="flex items-center font-medium text-lg p-2 rounded cursor-pointer hover:bg-white/10 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24" class="mr-3">
                                <path
                                    d="M12 2C7.66 2 4 3.83 4 6v12c0 2.17 3.66 4 8 4s8-1.83 8-4V6c0-2.17-3.66-4-8-4m0 2c3.68 0 5.91 1.49 6 2-.09.51-2.32 2-6 2S6.07 6.49 6 6.01C6.07 5.51 8.31 4 12 4M6 8.61C7.48 9.46 9.64 10 12 10s4.52-.55 6-1.39V10c-.07.5-2.31 2-6 2s-5.93-1.51-6-2zm0 4c1.48.85 3.64 1.39 6 1.39s4.52-.55 6-1.39V14c-.07.5-2.31 2-6 2s-5.93-1.51-6-2zM12 20c-3.69 0-5.93-1.51-6-2v-1.39c1.48.85 3.64 1.39 6 1.39s4.52-.55 6-1.39V18c-.07.5-2.31 2-6 2">
                                </path>
                            </svg>
                            Users
                        </h2>
                    </div>
                </div>

                <div class="main-dashboard bg-[#f5f5f5] mx-auto w-full">
                    <div class="p-8">
                        <div class="bg-white w-fit px-4 pt-3 gap-6 rounded-xl shadow flex">
                            <h1 class="border-b-2 font-medium cursor-pointer px-2 pb-3 border-[#7AE2CF]">Users</h1>
                            <h1 class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Students</h1>
                            <h1 class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Spp</h1>
                            <h1 class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Payments</h1>
                            <h1 class="font-normal text-gray-700 cursor-pointer px-2 pb-3">Classes</h1>
                        </div>

                    </div>
                    <div class="ml-8 my-4 gap-8 flex w-fit justify-center items-center">
                        <h1 class="text-2xl font-semibold">Users</h1>
                        <button class="bg-teal-700 cursor-pointer py-2 px-4 text-white font-medium rounded-lg">Add
                            new</button>
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
