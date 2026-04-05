<?php 
// Ambil nama file yang sedang dibuka
$current_page = basename($_SERVER['PHP_SELF']);

// Helper function untuk check active menu
function isActive($page) {
    global $current_page;
    return $current_page == $page ? 'bg-blue-primary border-l-4 border-white' : 'hover:bg-blue-primary';
}

// Menu items configuration
$menu_items = [
    ['file' => 'dashboard_admin.php', 'icon' => 'dashboard.png', 'label' => 'Dashboard'],
    ['file' => 'daftar_transaksi.php', 'icon' => 'book.png', 'label' => 'Peminjaman'],
    ['file' => 'daftar_buku.php', 'icon' => 'open-book.png', 'label' => 'Daftar Buku'],
    ['file' => 'daftar_anggota.php', 'icon' => 'group-users.png', 'label' => 'Daftar Anggota'],
    ['file' => 'riwayat_peminjaman.php', 'icon' => 'history.png', 'label' => 'Riwayat'],
];
?>

<!-- Top Navigation -->
<nav class="fixed top-0 left-0 right-0 lg:left-64 h-16 lg:h-20 bg-white shadow flex items-center px-4 lg:px-5 z-40 transition-all">
    <button id="sidebar-toggle" class="lg:hidden p-2 mr-2 text-blue-secondary hover:bg-gray-100 rounded">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <div class="flex-1">
        <h1 class="text-lg lg:text-xl font-bold text-gray-700">Dashboard Admin</h1>
        <p class="text-xs lg:text-sm text-gray-500">Digiperpus | Sistem Peminjaman Buku</p>
    </div>

    <div class="flex items-center gap-2 lg:gap-4">
        <div class="hidden sm:block text-right">
            <p class="text-xs lg:text-sm font-semibold text-gray-700"><?= $_SESSION['nama'] ?? 'Admin'; ?></p>
            <p class="text-xs text-gray-500">Admin</p>
        </div>
        <a href="profil_admin.php">
            <img src="../assets/img/profil.webp" alt="User Icon" class="w-8 lg:w-10 h-8 lg:h-10 rounded-full object-cover">
        </a>
    </div>
</nav>

<!-- Sidebar -->
<aside id="top-bar-sidebar" class="fixed top-0 left-0 w-64 h-full bg-blue-secondary text-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform z-30">
    <div class="p-6">
        <a href="dashboard_admin.php" class="flex items-center gap-3 mb-10">
            <img src="../assets/img/logo_title.png" alt="Logo" class="w-8 h-8">
            <span class="text-xl font-bold">Digiperpus</span>
        </a>    
        <!-- Menu Items -->
        <ul class="space-y-2 font-medium mt-10 ml-2">
            <?php foreach($menu_items as $item): ?>
            <li>
                <a href="<?= $item['file']; ?>" class="flex items-center p-2 text-white rounded-lg <?= isActive($item['file']); ?> transition-all">
                    <img src="../assets/img/<?= $item['icon']; ?>" alt="<?= $item['label']; ?>" class="w-5 h-5 mr-3">
                    <span><?= $item['label']; ?></span>
                </a>
            </li>
            <?php endforeach; ?>

            <hr class="my-4 border-blue-primary">

            <li>
                <a href="../auth/logout.php" onclick="confirmLogout(event)" class="flex items-center p-2 text-white rounded-lg hover:bg-blue-primary transition-all">
                    <img src="../assets/img/logout.png" alt="Logout" class="w-5 h-5 mr-3">
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- Overlay Mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden" onclick="toggleSidebar()"></div>

<script>
    function confirmLogout(event) {
        event.preventDefault();
        if (confirm('Yakin ingin keluar?')) {
            window.location.href = '../auth/logout.php';
        }
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('top-bar-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    document.getElementById('sidebar-toggle').addEventListener('click', toggleSidebar);
</script>
