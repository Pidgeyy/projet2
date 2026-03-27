<?php
// app/controllers/AuthController.php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
  public function login() {
    Auth::start();
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      if (!$email) {
        $email = '';
      }
      $password = isset($_POST['password']) ? (string)$_POST['password'] : '';

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email invalide.';
      } elseif ($password === '') {
        $error = 'Mot de passe requis.';
      } else {
        $user = (new UserModel())->findByEmail(trim($email));
        if (!$user || (int)$user['actif'] !== 1) {
          $error = 'Identifiants incorrects.';
        } else {
          $dbHash = $user['mdp_hash'];
          $ok = false;

          if (strpos($dbHash, '$') === 0) {
            // Nouveau format bcrypt/argon2
            $ok = password_verify($password, $dbHash);
          } else {
            // Ancien format MD5
            $ok = (md5($password) === $dbHash);
          }

          if (!$ok) {
            $error = 'Identifiants incorrects.';
          } else {
            session_regenerate_id(true);
            $_SESSION['user'] = [
              'id' => (int)$user['id'],
              'nom' => $user['nom'],
              'email' => $user['email'],
              'role' => $user['role'],
            ];
            header('Location: index.php?route=dashboard');
            exit;
          }
        }
      }
    }

    View::render('auth/login', ['title' => 'Connexion', 'error' => $error]);
  }

  public function logout() {
    Auth::start();
    Auth::logout();
    header('Location: index.php?route=login');
    exit;
  }
}
