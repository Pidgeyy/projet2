<h1 class="mb-4">Tickets</h1>
<form class="row g-2 mb-3" method="get" action="index.php">
  <input type="hidden" name="route" value="tickets">
  <div class="col-auto">
    <select name="categorie_id" class="form-select">
      <option value="">Toutes catégories</option>
      <?php foreach ($categories as $cat): ?>
        <option value="<?php echo intval($cat['id']); ?>" <?php echo (isset($_GET['categorie_id']) && intval($_GET['categorie_id']) === (int)$cat['id']) ? 'selected' : ''; ?>>
          <?php echo htmlspecialchars($cat['nom']); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-auto">
    <select name="statut" class="form-select">
      <option value="">Tous statuts</option>
      <option value="OPEN" <?php echo (isset($_GET['statut']) && $_GET['statut'] === 'OPEN') ? 'selected' : ''; ?>>OPEN</option>
      <option value="IN_PROGRESS" <?php echo (isset($_GET['statut']) && $_GET['statut'] === 'IN_PROGRESS') ? 'selected' : ''; ?>>IN_PROGRESS</option>
      <option value="RESOLVED" <?php echo (isset($_GET['statut']) && $_GET['statut'] === 'RESOLVED') ? 'selected' : ''; ?>>RESOLVED</option>
      <option value="CLOSED" <?php echo (isset($_GET['statut']) && $_GET['statut'] === 'CLOSED') ? 'selected' : ''; ?>>CLOSED</option>
    </select>
  </div>
  <div class="col-auto">
    <select name="priorite" class="form-select">
      <option value="">Toutes priorités</option>
      <option value="FAIBLE" <?php echo (isset($_GET['priorite']) && $_GET['priorite'] === 'FAIBLE') ? 'selected' : ''; ?>>FAIBLE</option>
      <option value="MOYENNE" <?php echo (isset($_GET['priorite']) && $_GET['priorite'] === 'MOYENNE') ? 'selected' : ''; ?>>MOYENNE</option>
      <option value="ELEVE" <?php echo (isset($_GET['priorite']) && $_GET['priorite'] === 'ELEVE') ? 'selected' : ''; ?>>ELEVE</option>
    </select>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary">Filtrer</button>
  </div>
</form>

<div class="table-responsive">
  <table class="table table-hover">
    <thead class="table-light">
      <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Catégorie</th>
        <th>Priorité</th>
        <th>Statut</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($tickets)): ?>
        <tr>
          <td colspan="6" class="text-center text-muted">Aucun ticket.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($tickets as $ticket): ?>
          <tr>
            <td><strong>#<?php echo intval($ticket['id']); ?></strong></td>
            <td><?php echo htmlspecialchars($ticket['titre']); ?></td>
            <td>
              <span class="badge bg-info"><?php echo htmlspecialchars($ticket['categorie_nom'] ?? 'N/A'); ?></span>
            </td>
            <td>
              <?php 
                $priorityBg = $ticket['priorite'] === 'ELEVE' ? 'danger' : ($ticket['priorite'] === 'MOYENNE' ? 'warning' : 'success');
              ?>
              <span class="badge bg-<?php echo $priorityBg; ?>"><?php echo htmlspecialchars($ticket['priorite']); ?></span>
            </td>
            <td>
              <span class="badge bg-secondary"><?php echo htmlspecialchars($ticket['statut']); ?></span>
            </td>
            <td>
              <a href="index.php?route=ticket&id=<?php echo intval($ticket['id']); ?>" class="btn btn-sm btn-outline-primary">Voir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

