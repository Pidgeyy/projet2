<?php $u = $user; ?>
<div class="container-fluid mt-4">
  <div class="row mb-4">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h1 class="h5 fw-bold mb-2">Dashboard Admin</h1>
          <div class="text-muted">Bienvenue <strong><?php echo htmlspecialchars($u['nom']); ?></strong></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h6 class="card-title text-muted">Utilisateurs Actifs</h6>
          <p class="h3 fw-bold text-primary">
            <?php echo isset($statsUsers) ? $statsUsers : '...'; ?>
          </p>
          <a href="index.php?route=admin-users" class="btn btn-sm btn-outline-primary">Gérer</a>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h6 class="card-title text-muted">Tickets Tous Statuts</h6>
          <p class="h3 fw-bold text-info">
            <?php echo isset($statsTickets) ? $statsTickets : '...'; ?>
          </p>
          <a href="index.php?route=tickets" class="btn btn-sm btn-outline-info">Voir</a>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card text-center">
        <div class="card-body">
          <h6 class="card-title text-muted">Tickets Non Résolus</h6>
          <p class="h3 fw-bold text-warning">
            <?php echo isset($statsOpenTickets) ? $statsOpenTickets : '...'; ?>
          </p>
          <a href="index.php?route=tickets&statut=OPEN" class="btn btn-sm btn-outline-warning">Voir</a>
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
    <div class="col-md-6 mb-3">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Gestion du Système</h5>
        </div>
        <div class="card-body">
          <div class="list-group">
            <a href="index.php?route=tickets" class="list-group-item list-group-item-action">
              Tous les Tickets
            </a>
            <a href="index.php?route=admin-users" class="list-group-item list-group-item-action">
              Gérer les Comptes (S1)
            </a>
            <a href="index.php?route=admin-categories" class="list-group-item list-group-item-action">
              Gérer les Catégories (S1)
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Actions Rapides</h5>
        </div>
        <div class="card-body">
          <div class="d-grid gap-2">
            <a href="index.php?route=dashboard" class="btn btn-primary">Actualiser</a>
            <a href="index.php?route=logout" class="btn btn-outline-danger">Se déconnecter</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
