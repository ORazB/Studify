<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

    <title>Studify | Register</title>
</head>

<body>

    <section class="register bg-[#7be3cf]">
        <div class="container w-[80%] max-w-4xl mx-auto min-h-screen flex items-center justify-center">

            <div class="bg grid grid-cols-[40%_60%] rounded-2xl">

                <div class="bg-white rounded-bl-3xl rounded-tl-3xl">
                    <img class="w-full h-full object-cover rounded-3xl"
                        src="/images/login.jpg" alt="">
                </div>

                <div class="bg-white rounded-tr-2xl rounded-br-2xl forms flex flex-col justify-center px-11 py-10">
                    <h1 class="text-3xl font-semibold tracking-wide mb-6">Create Account</h1>

                    <div class="button_cta flex gap-3">
                        <button type="button"
                            class="w-full mb-3 bg-[#7be3cf] text-white font-medium rounded-full py-2 shadow-xs"></box-icon>
                            <box-icon class="align-middle" size="sm" color="#fff" type="logo" name="google"></box-icon> Sign up with Google
                        </button>
                        <button type="button" class="w-full mb-3 bg-[#ccece6] font-medium rounded-full py-2 shadow">
                            <box-icon class="align-middle" size="sm" color="#000" type="logo" name="github"></box-icon> Sign up with Github
                        </button>
                    </div>

                    {{-- Form starts here --}}
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="forms_input my-2">
                            <h3 class="p-2 font-semibold">Username</h3>
                            <input type="text" name="username" value="{{ old('username') }}" placeholder="..."
                                class="w-full rounded-full px-4 py-3 bg-[#ccece6]" />
                            @error('username')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="forms_input mb-2">
                          <h3 class="p-2 font-semibold">Password</h3>
                            <input type="password" name="password" placeholder="..."
                                class="w-full rounded-full px-4 py-3 bg-[#ccece6]" />
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="forms_input mb-4">
                          <h3 class="p-2 font-semibold">Role</h3>
                            <select name="role"
                                class="w-full rounded-full px-4 py-3 bg-[#ccece6] appearance-none focus:outline-none focus:ring-2 focus:ring-[#ccece6]">
                                <option value="">--Choose Your Role--</option>
                                <option value="admin">Admin</option>
                                <option value="student">Student</option>
                            </select>
                            @error('role')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center mb-4">
                            <input type="checkbox" name="terms" class="mr-2">
                            <span class="text-sm">I Agree to all terms and Privacy Policy</span>
                        </div>

                        <button type="submit"
                            class="w-full bg-black text-white rounded-full py-2 shadow">Register</button>
                    </form>

                    <p class="mt-4 text-sm text-gray-600 font-medium text-shadow">
                        Sudah Punya Akun?
                        <a href="{{ route('login') }}" class="text-[#7ae2cf]">Login</a>
                    </p>
                </div>

            </div>

        </div>
    </section>
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
</body>

</html>
