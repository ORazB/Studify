<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

    <title>Studify | Login</title>
</head>

<body>

    <section class="login bg-gradient-to-b from-teal-200 to-[#E7F1FF]">
        <div class="container w-[80%] max-w-4xl mx-auto min-h-screen flex items-center justify-center">

            <div class="bg grid grid-cols-[40%_60%] rounded-2xl">

                <div class="bg-white rounded-bl-3xl rounded-tl-3xl">
                    <img class="w-full h-full object-cover rounded-3xl"
                        src="/images/login.jpg" alt="">
                </div>

                <div class="bg-white rounded-tr-2xl rounded-br-2xl forms flex flex-col justify-center px-11 py-10">
                    <h1 class="text-3xl font-semibold tracking-wide mb-6">Login</h1>

                    <div class="button_cta flex gap-3">
                        <button type="button"
                            class="w-full mb-3 bg-[#7be3cf] text-white font-medium rounded-full py-2 shadow-xl cursor-pointer"></box-icon>
                            <box-icon class="align-middle" size="sm" color="#fff" type="logo" name="google"></box-icon> Login with Google
                        </button>
                        <button type="button" class="w-full mb-3 bg-[#ccece6] font-medium rounded-full py-2 shadow-xl cursor-pointer">
                            <box-icon class="align-middle" size="sm" color="#000" type="logo" name="github"></box-icon> Login with Github
                        </button>
                    </div>

                    {{-- Form starts here --}}
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="forms_input my-2">
                            <h3 class="p-2 font-semibold">Username</h3>
                            <input type="text" name="username" value="{{ old('username') }}" placeholder="..."
                                class="w-full rounded-full px-4 py-3 bg-[#ccece6] shadow-lg" />
                            @error('username')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="forms_input mb-2">
                          <h3 class="p-2 font-semibold">Password</h3>
                            <input type="password" name="password" placeholder="..."
                                class="w-full rounded-full px-4 py-3 bg-[#ccece6] shadow-lg" />
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="flex items-center my-4">
                            <input type="checkbox" name="terms" class="mr-2 align-middle">
                            <span class="text-sm font-medium">I Agree to all terms and Privacy Policy</span>
                        </div>

                        <button type="submit"
                            class="w-full bg-black text-white rounded-full py-2 shadow cursor-pointer">Login</button>
                    </form>

                    <p class="mt-4 text-sm text-gray-600 font-medium text-shadow">
                        Belum Punya Akun?
                        <a href="{{ route('register') }}" class="text-[#7ae2cf]">Register</a>
                    </p>
                </div>

            </div>

        </div>
    </section>
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
</body>

</html>
