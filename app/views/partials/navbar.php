<?php
// app/views/partials/navbar.php
require_once __DIR__ . '/../../core/Auth.php';
Auth::start();
$u = Auth::user();
?>
<nav class="navbar navbar-expand-lg bg-white border-bottom">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Campus HelpDesk</a>
    <div class="ms-auto d-flex align-items-center gap-2">
      <span class="text-muted small">
        <?php if ($u): ?>
          <?php echo htmlspecialchars($u['nom']); ?> • <?php echo htmlspecialchars($u['role']); ?>
        <?php else: ?>
          Non connecté
        <?php endif; ?>
      </span>
      <?php if ($u): ?>
        <a class="btn btn-sm btn-outline-danger" href="index.php?route=logout">Déconnexion</a>
      <?php else: ?>
        <a class="btn btn-sm btn-primary" href="index.php?route=login">Connexion</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
