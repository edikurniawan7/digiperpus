<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi | Digiperpus</title>
    <link rel="icon" href="../assets/img/logo_title.png" type="image/png">
    <link href="../src/output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-t from-cyan-100 to-teal-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-sm">
        <!-- Logo -->
        <div class="text-center mb-4">
            <img 
                src="../assets/img/logo_digiperpus1.png" 
                alt="Logo DigiPerpus" 
                class="h-18 w-auto rounded-3xl object-cover mx-auto"
            >
            <p class="text-sm text-gray-600">Buat akun peminjaman buku</p>
        </div>

        <!-- Form Registration -->
        <div class="bg-white p-12 rounded-2xl shadow-lg">
            <form method="post" action="../aksi/aksi_registrasi.php" id="registrasiForm" class="space-y-6">
                
                <!-- Full Name Field -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-3">
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <img 
                            src="../assets/img/user.png" 
                            alt="" 
                            class="absolute left-3 top-3.5 w-5 h-5 pointer-events-none"
                        >
                        <input 
                            type="text" 
                            id="nama"
                            name="nama"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-200 focus:outline-none transition"
                            placeholder="Masukkan nama lengkap"
                            required
                        >
                    </div>
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-3">
                        Username
                    </label>
                    <div class="relative">
                        <img 
                            src="../assets/img/user.png" 
                            alt="" 
                            class="absolute left-3 top-3.5 w-5 h-5 pointer-events-none"
                        >
                        <input 
                            type="text" 
                            id="username"
                            name="username"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-200 focus:outline-none transition"
                            placeholder="Masukkan username"
                            required
                        >
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <img 
                            src="../assets/img/padlock.png" 
                            alt="" 
                            class="absolute left-3 top-3.5 w-5 h-5 pointer-events-none"
                        >
                        <input 
                            type="password"
                            id="password"  
                            name="password"
                            class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:border-teal-500 focus:ring-2 focus:ring-teal-200 focus:outline-none transition"
                            placeholder="Masukkan password"
                            required
                        >
                        <button 
                            type="button" 
                            id="togglePassword"
                            class="absolute right-3 top-3 text-gray-400 hover:text-teal-500 transition"
                        >
                            <img id="eyeIcon" class="w-5 h-5" src="../assets/img/hidden.png" alt="Tampilkan">
                            <img id="eyeOffIcon" class="w-5 h-5 hidden" src="../assets/img/eye.png" alt="Sembunyikan">
                        </button>
                    </div>
                </div>

                <!-- Tombol Daftar -->
                <button
                    type="submit"
                    class="w-full bg-teal-primary hover:bg-teal-secondary text-white text-sm font-semibold py-2.5 px-4 rounded-lg transition transform hover:scale-105 shadow-md"
                >
                    Daftar
                </button>

            </form>
        </div>

        <!-- Tombol Login -->
        <div class="text-center mt-6 text-sm text-gray-600">
            Sudah punya akun?
            <a href="../auth/login.php" class="text-teal-primary font-semibold hover:underline">
                Masuk sekarang
            </a>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center mt-4">
            <a href="../index.php" class="text-gray-500 hover:text-teal-primary text-sm transition">
                ← Kembali ke beranda
            </a>
        </div>
    </div>

    <script src="../assets/js/login.js"></script>
</body>
</html>
