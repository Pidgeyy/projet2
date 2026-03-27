<?php if ($ticket): ?>
  <div class="card mb-4">
    <div class="card-body">
      <h1 class="h4 fw-bold">Ticket #<?php echo intval($ticket['id']); ?></h1>
      <p><strong>Titre :</strong> <?php echo htmlspecialchars($ticket['titre']); ?></p>
      <p><strong>Statut :</strong> <span class="badge bg-secondary"><?php echo htmlspecialchars($ticket['statut']); ?></span></p>
      <p><strong>Priorité :</strong> <?php echo htmlspecialchars($ticket['priorite']); ?></p>
      <p><strong>Catégorie :</strong> 
        <span class="badge bg-info"><?php echo htmlspecialchars($ticket['categorie_nom'] ?? 'N/A'); ?></span>
      </p>
      <p><strong>Description :</strong><br><?php echo nl2br(htmlspecialchars($ticket['description'])); ?></p>
      <p class="text-muted small">Créé le <?php echo htmlspecialchars($ticket['created_at']); ?></p>
    </div>
  </div>

  <?php if (isset($user) && ($user['role'] === 'TECH' || $user['role'] === 'ADMIN')): ?>
  <div class="card mb-4">
    <div class="card-body">
      <h5>Changer le statut</h5>
      <form method="post" action="index.php?route=ticket&id=<?php echo intval($ticket['id']); ?>">
        <div class="input-group">
          <select name="change_statut" class="form-select">
            <option value="OPEN" <?php echo ($ticket['statut'] === 'OPEN') ? 'selected' : ''; ?>>OPEN</option>
            <option value="IN_PROGRESS" <?php echo ($ticket['statut'] === 'IN_PROGRESS') ? 'selected' : ''; ?>>IN_PROGRESS</option>
            <option value="RESOLVED" <?php echo ($ticket['statut'] === 'RESOLVED') ? 'selected' : ''; ?>>RESOLVED</option>
            <option value="CLOSED" <?php echo ($ticket['statut'] === 'CLOSED') ? 'selected' : ''; ?>>CLOSED</option>
          </select>
          <button class="btn btn-secondary" type="submit">Mettre à jour</button>
        </div>
      </form>
    </div>
  </div>
  <?php endif; ?>

  <div class="card mb-4">
    <div class="card-header">
      <h5 class="mb-0">Messages</h5>
    </div>
    <div class="card-body">
      <?php if (empty($messages)): ?>
        <p class="text-muted">Aucun message pour le moment.</p>
      <?php else: ?>
        <?php foreach ($messages as $message): ?>
          <div class="border-bottom pb-3 mb-3">
            <p><?php echo nl2br(htmlspecialchars($message['contenu'])); ?></p>
            <small class="text-muted">Par <?php echo htmlspecialchars($message['auteur_nom']); ?> le <?php echo htmlspecialchars($message['created_at']); ?></small>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">Ajouter un message</h5>
    </div>
    <div class="card-body">
      <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>
      <form method="post" action="index.php?route=ticket&id=<?php echo intval($ticket['id']); ?>">
        <div class="mb-3">
          <label class="form-label">Message</label>
          <textarea name="contenu" class="form-control" rows="3" required></textarea>
        </div>
        <button class="btn btn-primary">Ajouter le message</button>
      </form>
    </div>
  </div>
<?php else: ?>
  <div class="alert alert-warning">
    <h1>Ticket introuvable</h1>
    <p>Aucun ticket trouvé pour cet ID ou vous n'avez pas accès à ce ticket.</p>
    <a href="index.php?route=tickets" class="btn btn-primary">Retour à la liste</a>
  </div>
<?php endif; ?>

