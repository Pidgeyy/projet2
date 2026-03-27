<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-body">
        <h1 class="h4 fw-bold mb-4">Modifier le Compte</h1>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
          <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="post" action="index.php?route=admin-user-edit&id=<?php echo intval($user['id']); ?>">
          <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Rôle</label>
            <select name="role" class="form-select" required>
              <option value="ETUDIANT" <?php echo $user['role'] === 'ETUDIANT' ? 'selected' : ''; ?>>Étudiant</option>
              <option value="TECH" <?php echo $user['role'] === 'TECH' ? 'selected' : ''; ?>>Technicien</option>
              <option value="ADMIN" <?php echo $user['role'] === 'ADMIN' ? 'selected' : ''; ?>>Admin</option>
            </select>
          </div>

          <p class="text-muted small">
            <strong>Note:</strong> Pour changer le mot de passe, contactez l'utilisateur ou utilisez une fonction réinitialisation.
          </p>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="index.php?route=admin-users" class="btn btn-outline-secondary">Retour</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
