<?php $u = currentUser();
$flash = getFlash(); ?>
<header class="app-topbar">
  <div class="page-title">
    <h1><?= e($pageTitle ?? 'Perpustakaan Digital') ?></h1>
    <p><?= e($pageSubtitle ?? '') ?></p>
  </div>
  <div class="topbar-user"><span class="avatar"><?= e(strtoupper(substr($u['name'] ?? 'U', 0, 2))) ?></span>
    <div><?= e($u['name'] ?? 'Tamu') ?><br><span class="badge badge-member"
        style="margin-top:2px;"><?= e(ucfirst($u['role'] ?? 'guest')) ?></span></div>
  </div>
</header>
<?php if ($flash): ?>
  <div class="app-content">
    <div class="form-card" style="margin-bottom:16px;<?= $flash['type'] === 'error' ? 'border-color:#ef4444;' : '' ?>">
      <?= e($flash['message']) ?></div>
  </div><?php endif; ?>