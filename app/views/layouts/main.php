<?php
// app/views/layouts/main.php
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars(isset($title) ? $title : 'Campus HelpDesk'); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
  <?php require __DIR__ . '/../partials/navbar.php'; ?>
  <main class="container py-4">
    <?php require __DIR__ . '/../partials/alerts.php'; ?>
    <?php require __DIR__ . '/../' . $view . '.php'; ?>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/campus-helpdesk/public/assets/js/app.js"></script>
</body>
</html>
