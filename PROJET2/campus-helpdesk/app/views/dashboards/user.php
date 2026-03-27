<?php $u = $user; ?>
<div class="card">
  <div class="card-body">
    <h1 class="h5 fw-bold mb-1">Dashboard Étudiant</h1>
    <div class="text-muted">Bonjour <strong><?php echo htmlspecialchars($u['nom']); ?></strong></div>
    <div class="mt-3">
      <a href="index.php?route=tickets" class="btn btn-primary me-2">Voir mes tickets</a>
      <a href="index.php?route=ticket-create" class="btn btn-success">Créer un ticket</a>
    </div>
  </div>
</div>
