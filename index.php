<?php require_once 'config/bootstrap.php';
$d = db();
$u = currentUser(); ?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Beranda - Perpustakaan Digital</title>
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>
    <header>
        <nav class="navbar"><a href="index.php" class="brand"><span class="logo-badge">PD</span> Perpustakaan
                Digital</a>
            <div class="nav-links"><a href="index.php" class="active">Beranda</a><a href="pages/books/index.php">Katalog
                    Buku</a><a href="pages/authors/index.php">Penulis</a></div>
            <div class="nav-actions"><?php if ($u): ?><a href="pages/books/index.php"
                        class="btn btn-primary btn-sm">Dashboard</a><?php else: ?><a href="pages/auth/login.php"
                        class="btn btn-outline btn-sm">Masuk</a><a href="pages/auth/register.php"
                        class="btn btn-primary btn-sm">Daftar</a><?php endif; ?></div>
        </nav>
    </header>
    <section class="hero">
        <div class="hero-text"><span class="hero-badge">SISTEM MANAJEMEN PERPUSTAKAAN</span>
            <h1>Kelola Koleksi Buku Sekolah <span>Lebih Rapi &amp; Modern</span></h1>
            <p>Kelola buku, penulis, kategori, dan pengguna secara terpusat dengan penyimpanan persisten.</p>
            <div class="hero-cta"><a href="pages/books/index.php" class="btn btn-primary">Lihat Katalog Buku</a><a
                    href="<?= $u ? 'pages/profile/edit.php' : 'pages/auth/login.php' ?>"
                    class="btn btn-outline"><?= $u ? 'Profil Saya' : 'Masuk ke Akun' ?></a></div>
        </div>
    </section>
    <section class="section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?= count($d['books']) ?></div>
                <div class="stat-label">Total Judul Buku</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($d['categories']) ?></div>
                <div class="stat-label">Kategori Buku</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($d['authors']) ?></div>
                <div class="stat-label">Penulis Terdaftar</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($d['users']) ?></div>
                <div class="stat-label">Pengguna</div>
            </div>
        </div>
    </section>
    <footer class="site-footer"><span>&copy; 2026 Perpustakaan Digital - SMK Kristen Immanuel Pontianak</span><span>PHP
            &amp; JSON storage</span></footer>
</body>

</html>