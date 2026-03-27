<h1 class="mb-4">Gestion des Comptes</h1>

<div class="mb-3">
  <a href="index.php?route=admin-user-create" class="btn btn-primary">+ Créer un compte</a>
</div>

<div class="table-responsive">
  <table class="table table-hover">
    <thead class="table-light">
      <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Statut</th>
        <th>Créé le</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($users)): ?>
        <tr>
          <td colspan="6" class="text-center text-muted">Aucun compte trouvé.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?php echo htmlspecialchars($user['nom']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td>
              <span class="badge bg-info"><?php echo htmlspecialchars($user['role']); ?></span>
            </td>
            <td>
              <?php if ($user['actif']): ?>
                <span class="badge bg-success">Actif</span>
              <?php else: ?>
                <span class="badge bg-danger">Inactif</span>
              <?php endif; ?>
            </td>
            <td>
              <small><?php echo htmlspecialchars($user['created_at']); ?></small>
            </td>
            <td>
              <a href="index.php?route=admin-user-edit&id=<?php echo intval($user['id']); ?>" class="btn btn-sm btn-warning">Éditer</a>
              <a href="index.php?route=admin-user-toggle&id=<?php echo intval($user['id']); ?>" class="btn btn-sm btn-secondary">
                <?php echo $user['actif'] ? 'Désactiver' : 'Activer'; ?>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<hr>
<a href="index.php?route=dashboard" class="btn btn-outline-secondary">Retour au Dashboard</a>
