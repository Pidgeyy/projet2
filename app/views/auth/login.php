<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h1 class="h4 fw-bold mb-3">Connexion</h1>
        <form method="post" action="index.php?route=login" autocomplete="off">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-primary w-100">Se connecter</button>
          <p class="text-muted small mt-3 mb-0">Comptes test : student@campus.local / tech@campus.local / admin@campus.local (mot de passe : password)</p>
        </form>
      </div>
    </div>
  </div>
</div>
