<h1 class="mb-4">Gestion des Catégories</h1>

<div class="mb-3">
  <a href="index.php?route=admin-category-create" class="btn btn-primary">+ Créer une catégorie</a>
</div>

<div class="table-responsive">
  <table class="table table-hover">
    <thead class="table-light">
      <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Créée le</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($categories)): ?>
        <tr>
          <td colspan="4" class="text-center text-muted">Aucune catégorie trouvée.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($categories as $category): ?>
          <tr>
            <td><strong><?php echo htmlspecialchars($category['nom']); ?></strong></td>
            <td><?php echo htmlspecialchars($category['description'] ?? ''); ?></td>
            <td>
              <small><?php echo htmlspecialchars($category['created_at']); ?></small>
            </td>
            <td>
              <a href="index.php?route=admin-category-edit&id=<?php echo intval($category['id']); ?>" class="btn btn-sm btn-warning">Éditer</a>
              <a href="index.php?route=admin-category-delete&id=<?php echo intval($category['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?');">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<hr>
<a href="index.php?route=dashboard" class="btn btn-outline-secondary">Retour au Dashboard</a>
