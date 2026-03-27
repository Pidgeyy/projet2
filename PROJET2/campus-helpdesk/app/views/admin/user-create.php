<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-body">
        <h1 class="h4 fw-bold mb-4">Créer un Compte</h1>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="post" action="index.php?route=admin-user-create">
          <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="mdp" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Rôle</label>
            <select name="role" class="form-select" required>
              <option value="ETUDIANT">Étudiant</option>
              <option value="TECH">Technicien</option>
              <option value="ADMIN">Admin</option>
            </select>
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="index.php?route=admin-users" class="btn btn-outline-secondary">Annuler</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
