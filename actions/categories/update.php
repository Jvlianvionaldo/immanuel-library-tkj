<?php require_once '../../config/bootstrap.php';
requireLogin('../../pages/auth/login.php');
$id = (int) ($_POST['id'] ?? 0);
$d = db();
foreach ($d['categories'] as &$c)
    if ((int) $c['id'] === $id) {
        $c['name'] = trim($_POST['name'] ?? '');
        $c['description'] = trim($_POST['description'] ?? '');
    }
unset($c);
saveDb($d);
flash('Kategori berhasil diperbarui.');
redirect('../../pages/categories/index.php');
