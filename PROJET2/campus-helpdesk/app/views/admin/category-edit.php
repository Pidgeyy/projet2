<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-body">
        <h1 class="h4 fw-bold mb-4">Modifier la Catégorie</h1>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
          <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="post" action="index.php?route=admin-category-edit&id=<?php echo intval($category['id']); ?>">
          <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($category['nom']); ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($category['description'] ?? ''); ?></textarea>
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="index.php?route=admin-categories" class="btn btn-outline-secondary">Retour</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
