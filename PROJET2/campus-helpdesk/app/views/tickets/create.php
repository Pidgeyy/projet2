<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h1 class="h4 fw-bold mb-3">Créer un ticket</h1>
        <?php if ($error): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="index.php?route=ticket-create">
          <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Catégorie</label>
            <select name="categorie_id" class="form-select" required>
              <option value="">-- Sélectionner une catégorie --</option>
              <?php foreach ($categories as $cat): ?>
                <option value="<?php echo intval($cat['id']); ?>"><?php echo htmlspecialchars($cat['nom']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Priorité</label>
            <select name="priorite" class="form-select">
              <option value="FAIBLE">Faible</option>
              <option value="MOYENNE" selected>Moyenne</option>
              <option value="ELEVE">Élevée</option>
            </select>
          </div>
          <button class="btn btn-primary">Créer le ticket</button>
          <a href="index.php?route=tickets" class="btn btn-secondary ms-2">Annuler</a>
        </form>
      </div>
    </div>
  </div>
</div>