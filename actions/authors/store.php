<?php require_once '../../config/bootstrap.php';
requireLogin('../../pages/auth/login.php');
$d = db();
$name = trim($_POST['name'] ?? '');
$bio = trim($_POST['bio'] ?? '');
if ($name === '') {
    flash('Nama penulis wajib diisi.', 'error');
    redirect('../../pages/authors/create.php');
}
$d['authors'][] = ['id' => nextId($d['authors']), 'name' => $name, 'bio' => $bio];
saveDb($d);
flash('Penulis berhasil ditambahkan.');
redirect('../../pages/authors/index.php');
