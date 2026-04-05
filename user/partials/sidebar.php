<?php 
$current_page = basename($_SERVER['PHP_SELF']);
$menu_items = [
    ['file' => 'dashboard.php', 'label' => 'Dashboard', 'icon' => 'dashboard.png'],
    ['file' => 'daftar_peminjaman.php', 'label' => 'Peminjaman', 'icon' => 'book.png'],
    ['file' => 'riwayat_peminjaman.php', 'label' => 'Riwayat', 'icon' => 'history.png'],
];
?>

<!-- Top Navigation Bar -->
<nav class="fixed top-0 left-0 sm:left-64 right-0 h-16 sm:h-20 bg-white shadow flex items-center px-4 sm:px-5 z-40 transition-all">
    <div class="flex-1">
        <h1 class="text-lg sm:text-xl font-bold text-gray-700">Dashboard Anggota</h1>
        <p class="text-xs sm:text-sm text-gray-500">Digiperpus | Sistem Peminjaman Buku</p>
    </div>

    <div class="flex items-center gap-2 sm:gap-4">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-semibold text-gray-700"><?php echo $_SESSION['username']; ?></p>
            <p class="text-xs text-gray-500">Anggota</p>
        </div>
        <a href="profil.php">
            <img src="../assets/img/profil.webp" alt="User Icon" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full object-cover">
        </a>
    </div>
</nav>

<!-- Sidebar -->
<aside id="top-bar-sidebar" class="fixed top-0 left-0 z-40 w-64 h-full bg-blue-secondary transition-transform -translate-x-full sm:translate-x-0 shadow-lg border-r border-blue-primary pt-20 sm:pt-0">
    <div class="h-full px-3 py-4 overflow-y-auto bg-neutral-primary-soft border-e border-default">
        <!-- Logo -->
        <div class="flex items-center justify-center border-b-2 border-white pb-1 mb-10">
            <img src="../assets/img/logo_digiperpus1.png" alt="Logo DigiPerpus" class="h-14 w-40 rounded-3xl object-cover">
        </div>

        <!-- Menu List -->
        <ul class="space-y-2 font-medium ml-2">
            <?php foreach ($menu_items as $item): ?>
                <li>
                    <a href="<?php echo $item['file']; ?>" 
                       class="flex items-center gap-3 px-3 py-2 text-white rounded-lg transition-all <?php echo $current_page == $item['file'] ? 'bg-blue-primary border-l-4 border-white' : 'hover:bg-blue-primary'; ?>">
                        <img src="../assets/img/<?php echo $item['icon']; ?>" alt="<?php echo $item['label']; ?>" class="w-5 h-5">
                        <span><?php echo $item['label']; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>

            <hr class="my-4 border-blue-primary">

            <li>
                <a href="../auth/logout.php" onclick="confirmLogout(event)" 
                   class="flex items-center gap-3 px-3 py-2 text-white rounded-lg hover:bg-blue-primary transition-all">
                    <img src="../assets/img/logout.png" alt="Logout" class="w-5 h-5">
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<script>
function confirmLogout(event) {
    event.preventDefault();
    if (confirm('Yakin ingin keluar?')) {
        window.location.href = '../auth/logout.php';
    }
}
</script>
