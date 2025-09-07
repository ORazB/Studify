<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

  <title>Studify | Login</title>
</head>
<body>

    <section class="login min-h-screen flex items-center justify-center">
        <div class="container mx-auto bg-white rounded-xl grid grid-cols-2 overflow-hidden max-w-5xl">
          
          <div class="images_placeholder">
            <img src="https://i.pinimg.com/1200x/0f/64/6c/0f646c760cc87a0b880e1fe64092f850.jpg" 
                 alt="img_login" 
                 class="w-full h-screen object-cover" />
          </div>  
          
          <div class="forms flex flex-col justify-center px-11 py-10">
            <h1 class="text-3xl font-bold mb-6">Login</h1>
            
            <div class="button_cta flex gap-3">
                <button class="w-full mb-3 bg-[#7be3cf] text-white rounded-full py-3 shadow">
                <i class='bxl bx-google'></i> Login with Google
                </button>
                <button class="w-full mb-3 bg-[#ccece6] rounded-full py-2 shadow">
                <i class='bxl  bx-github'  style='color:#000000'></i> Login with Github
                </button>
            </div>
            
            <div class="forms_input my-4">
              <p>Username</p>
              <input type="text" class="w-full rounded-full px-4 py-3 bg-[#ccece6]"/>
            </div>
            <p>Password</p>
            <div class="forms_input mb-4">
              <input type="text" class="w-full rounded-full px-4 py-3 bg-[#ccece6]"/>
            </div>
            <div class="forms_input mb-4 w-full rounded-full px-4 py-3 bg-[#ccece6]">
                <select id="role" class="w-full rounded-full bg-[#ccece6] focus:outline-none focus:ring-2 focus:ring-[#ccece6]">
                  <option value="">Silahkan pilih role anda</option>
                  <option value="admin">Admin</option>
                  <option value="student">Student</option>
                </select>
              </div>
              
            
            <div class="flex items-center mb-4">
              <input type="checkbox" class="mr-2">
              <span class="text-sm">I Agree to all terms and Privacy Policy</span>
            </div>
            
            <button class="w-full bg-black text-white rounded-full py-2 shadow">Login</button>
            
            <p class="mt-4 text-sm text-gray-600">
             Belum Punya Akun? 
              <a href="#" class="text-green-600">Register</a>
            </p>
          </div>
          
        </div>
      </section>
      

</body>