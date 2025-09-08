<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create Data</title>
</head>

<body>

    <section class="create bg-gray-200 flex items-center justify-center h-screen">

        <div class="container bg-white p-8 rounded-2xl shadow-md w-[400px]">
            <h1 class="text-2xl font-bold mb-2">Add User</h1>
            <div class="line w-16 h-1 bg-teal-400 mb-6"></div>

            <form class="space-y-4">
                <div>
                    <label for="username" class="font-semibold">Username</label>
                    <input type="text" id="username" name="username"
                        class="w-full border border-teal-400 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>

                <div>
                    <label for="password" class="font-semibold">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full border border-teal-400 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                </div>

                <div>
                    <label for="role" class="font-semibold">Role</label>
                    <select name="role"
                        class="w-full rounded-md px-3 py-2 appearance-none focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <option value="">--Choose Your Role--</option>
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                    </select>
                </div>

                <div class="flex justify-center space-x-4 pt-4">
                    <button type="submit"
                        class="bg-teal-700 hover:bg-teal-800 text-white font-semibold px-8 py-2 rounded-lg">Add</button>
                    <button type="button"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold px-8 py-2 rounded-lg">Back</button>
                </div>
            </form>

        </div>
    </section>

</body>

</html>
