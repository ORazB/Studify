<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>

    <title>Dashboard | Siswa</title>

    <style>
        .title {
            border-bottom: 1px solid black;
        }
    </style>
</head>
<body>
    
    <section>

        <div class="container mx-auto">
            <div class="grid grid-cols-[20%_80%] mx-auto">
                <div class="  bg-lime bg-blue-600">
                    <h1>Studify</h1>
        
                    <div class="left-text">
                        <h1>TABEL</h1>
                        <p>siswa</p>
                    </div>
                </div>
        
                <div class="main-dashboard bg-red-500 mx-auto w-full">
                    <div class="main-title p-2">
                        <h1>Tabel</h1>
                        <h1>Selamat Datang "Siswa"</h1>
                    </div>

                    <div class="dashboard-table ">
                        <div class="title">
                            <div class="text flex gap-3 font-bold p-3">
                                <h3>NIS</h3>
                                <h3>Nama</h3>
                                <h3>Nomor Hp</h3>
                                <h3>Umur</h3>
                                <h3>Alamat</h3>
                                <h3>Foto Profile</h3>
                                <h3>Aksi</h3>
                            </div>
                        </div>

                        <div class="line"></div>

                        <div class="data">
                            <div class="input-data flex gap-4">
                                <h3>1</h3>
                                <h3>Andra</h3>
                                <h3>0854123568</h3>
                                <h3>13</h3>
                                <h3>Jimbaran</h3>
                                <h3><img src="#" alt="#"></h3>
                                <a href="#" class="btn bg-primary rounded-full"><box-icon type="regular" name="edit"></box-icon></a>
                                <a href="#" class="btn bg-red rounded-fulll"><box-icon type="regular" name="trash"></box-icon></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

</body>
</html>