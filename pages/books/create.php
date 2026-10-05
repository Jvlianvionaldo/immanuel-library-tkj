<?php require_once '../../config/bootstrap.php';
requireLogin('../auth/login.php');
$d = db();
$base = '../../';
$pageTitle = 'Tambah Buku';
$pageSubtitle = 'Lengkapi data buku, kategori, dan penulis'; ?><!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../../styles/books/create.css">
</head>

<body>
    <div class="app-shell"><?php require '../../components/admin/sidebar.php'; ?>
        <main class="app-main"><?php require '../../components/admin/topbar.php'; ?>
            <div class="app-content">
                <form method="POST" action="../../actions/books/store.php">
                    <div class="form-card">
                        <div class="form-section-title">Data Buku</div>
                        <div class="form-group"><label>Judul Buku</label><input required name="title"
                                value="<?= old('title') ?>"></div>
                        <div class="form-row">
                            <div class="form-group"><label>ISBN</label><input name="isbn" value="<?= old('isbn') ?>">
                            </div>
                            <div class="form-group"><label>Tahun Terbit</label><input required type="number" name="year"
                                    value="<?= old('year') ?>"></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group"><label>Stok</label><input required min="0" type="number"
                                    name="stock" value="<?= old('stock', '0') ?>"></div>
                            <div class="form-group"><label>Kategori</label><select required
                                    name="category_id"><?php foreach ($d['categories'] as $c): ?>
                                        <option value="<?= $c['id'] ?>"><?= e($c['name']) ?></option><?php endforeach; ?>
                                </select></div>
                        </div>
                        <div class="form-group"><label>Deskripsi</label><textarea name="description"
                                rows="4"><?= old('description') ?></textarea></div>
                    </div>
                    <div class="form-card" style="margin-top:20px">
                        <div class="form-section-title">Penulis Buku</div><?php foreach ($d['authors'] as $a): ?><label
                                style="display:block;margin:8px 0"><input type="checkbox" name="author_ids[]"
                                    value="<?= $a['id'] ?>"> <?= e($a['name']) ?></label><?php endforeach; ?>
                        <div class="form-actions"><a href="index.php" class="btn btn-outline">Batal</a><button
                                class="btn btn-primary">Simpan Buku</button></div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>