<?php
// app/core/Auth.php
// declare(strict_types=1);

class Auth {
  public static function start() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }
  }

  public static function user() {
    self::start();
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
  }

  public static function requireLogin() {
    self::start();
    if (!self::user()) {
      header('Location: index.php?route=login');
      exit;
    }
  }

  public static function requireRole($roles) {
    self::start();
    $user = self::user();
    $role = isset($user['role']) ? $user['role'] : null;

    if (!$role || !in_array($role, (array)$roles, true)) {
      http_response_code(403);
      echo '<h1>403 Interdit</h1><p>Accès refusé.</p>';
      exit;
    }
  }

  public static function logout() {
    self::start();
    $_SESSION = array();
    if (ini_get('session.use_cookies')) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
      );
    }
    session_unset();
    session_destroy();
  }
}
