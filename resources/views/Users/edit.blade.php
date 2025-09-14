<!DOCTYPE html>
<html lang="en">

@if (!session('role') == 'admin')
    <script>
        window.location.href = '/login';
    </script>
@endif

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create Data</title>
</head>

<body>

<section class="create bg-gradient-to-br from-teal-100 to-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="container bg-white p-8 rounded-2xl shadow-lg w-full max-w-md transition-all duration-300 hover:shadow-xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-3 text-center">Edit User: {{$user->username}}</h1>
        <div class="line w-20 h-1 bg-teal-500 mx-auto mb-6 rounded-full"></div>

        <form action="{{ route('users.update', $user->user_id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                <input type="text" id="username" name="username"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200">
                @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">Role</label>
                <select name="role"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent transition duration-200 appearance-none">
                    <option value="">-- Choose Your Role --</option>
                    <option value="admin">Admin</option>
                    <option value="student">Student</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center space-x-4 pt-6">
                <button type="submit"
                    class="bg-teal-600 text-white font-semibold px-6 py-3 rounded-lg">Edit User</button>
                <a href="{{url()->previous()}}" type="button"
                    class="bg-gray-500 text-white font-semibold px-6 py-3 rounded-lg">Back</a>
            </div>
        </form>
    </div>
</section>

</body>

</html>
