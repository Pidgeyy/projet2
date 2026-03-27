<?php $u = $user; ?>
<div class="container-fluid mt-4">
  <div class="row mb-4">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h1 class="h5 fw-bold mb-2">Dashboard Technicien</h1>
          <div class="text-muted">Bienvenue <strong><?php echo htmlspecialchars($u['nom']); ?></strong></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h6 class="card-title text-muted">Tickets Ouverts</h6>
          <p class="h3 fw-bold text-primary">
            <?php echo isset($statsOpen) ? $statsOpen : '...'; ?>
          </p>
          <a href="index.php?route=tickets&statut=OPEN" class="btn btn-sm btn-outline-primary">Voir</a>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h6 class="card-title text-muted">En Cours</h6>
          <p class="h3 fw-bold text-info">
            <?php echo isset($statsProgress) ? $statsProgress : '...'; ?>
          </p>
          <a href="index.php?route=tickets&statut=IN_PROGRESS" class="btn btn-sm btn-outline-info">Voir</a>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h6 class="card-title text-muted">Résolus</h6>
          <p class="h3 fw-bold text-success">
            <?php echo isset($statsResolved) ? $statsResolved : '...'; ?>
          </p>
          <a href="index.php?route=tickets&statut=RESOLVED" class="btn btn-sm btn-outline-success">Voir</a>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h6 class="card-title text-muted">Priorité Élevée</h6>
          <p class="h3 fw-bold text-danger">
            <?php echo isset($statsHighPriority) ? $statsHighPriority : '...'; ?>
          </p>
          <a href="index.php?route=tickets&priorite=ELEVE" class="btn btn-sm btn-outline-danger">Voir</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Actions Rapides</h5>
        </div>
        <div class="card-body">
          <a href="index.php?route=tickets" class="btn btn-primary me-2">Voir tous les tickets</a>
          <a href="index.php?route=tickets&statut=OPEN" class="btn btn-outline-primary me-2">Tickets à traiter</a>
          <a href="index.php?route=logout" class="btn btn-outline-danger">Se déconnecter</a>
        </div>
      </div>
    </div>
  </div>
</div>
