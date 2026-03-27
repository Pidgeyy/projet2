<?php
// app/controllers/AdminController.php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';

class AdminController {
  
  // ===== USERS =====
  public function users() {
    Auth::start();
    Auth::requireLogin();
    Auth::requireRole('ADMIN');
    
    $users = [];
    try {
      $users = (new UserModel())->all();
    } catch (Exception $e) {
      $users = [];
    }
    
    View::render('admin/users', ['title' => 'Gestion des Comptes', 'users' => $users]);
  }

  public function userCreate() {
    Auth::start();
    Auth::requireLogin();
    Auth::requireRole('ADMIN');
    
    $error = null;
    $success = null;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nom = trim(isset($_POST['nom']) ? $_POST['nom'] : '');
      $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
      $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
      $role = isset($_POST['role']) ? $_POST['role'] : 'ETUDIANT';
      
      if (empty($nom) || empty($email) || empty($mdp)) {
        $error = 'Tous les champs sont requis.';
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email invalide.';
      } elseif ((new UserModel())->findByEmail($email)) {
        $error = 'Cet email existe déjà.';
      } else {
        $userId = (new UserModel())->create($nom, $email, $mdp, $role, 1);
        if ($userId) {
          header('Location: index.php?route=admin-users');
          exit;
        } else {
          $error = 'Erreur lors de la création du compte.';
        }
      }
    }
    
    View::render('admin/user-create', ['title' => 'Créer un Compte', 'error' => $error]);
  }

  public function userEdit() {
    Auth::start();
    Auth::requireLogin();
    Auth::requireRole('ADMIN');
    
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $user = (new UserModel())->findById($id);
    $error = null;
    $success = null;
    
    if (!$user) {
      header('Location: index.php?route=admin-users');
      exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nom = trim(isset($_POST['nom']) ? $_POST['nom'] : '');
      $email = trim(isset($_POST['email']) ? $_POST['email'] : '');
      $role = isset($_POST['role']) ? $_POST['role'] : 'ETUDIANT';
      
      if (empty($nom) || empty($email)) {
        $error = 'Tous les champs sont requis.';
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email invalide.';
      } else {
        $existing = (new UserModel())->findByEmail($email);
        if ($existing && $existing['id'] != $id) {
          $error = 'Cet email existe déjà.';
        } else {
          if ((new UserModel())->update($id, $nom, $email, $role)) {
            $success = 'Compte mis à jour avec succès.';
            $user = (new UserModel())->findById($id);
          } else {
            $error = 'Erreur lors de la mise à jour.';
          }
        }
      }
    }
    
    View::render('admin/user-edit', ['title' => 'Modifier le Compte', 'user' => $user, 'error' => $error, 'success' => $success]);
  }

  public function userToggle() {
    Auth::start();
    Auth::requireLogin();
    Auth::requireRole('ADMIN');
    
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $user = (new UserModel())->findById($id);
    
    if ($user && $user['id'] != Auth::user()['id']) {
      $newStatus = $user['actif'] ? 0 : 1;
      (new UserModel())->toggleActive($id, $newStatus);
    }
    
    header('Location: index.php?route=admin-users');
    exit;
  }

  // ===== CATEGORIES =====
  public function categories() {
    Auth::start();
    Auth::requireLogin();
    Auth::requireRole('ADMIN');
    
    $categories = [];
    try {
      $categories = (new CategoryModel())->all();
    } catch (Exception $e) {
      $categories = [];
    }
    
    View::render('admin/categories', ['title' => 'Gestion des Catégories', 'categories' => $categories]);
  }

  public function categoryCreate() {
    Auth::start();
    Auth::requireLogin();
    Auth::requireRole('ADMIN');
    
    $error = null;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nom = trim(isset($_POST['nom']) ? $_POST['nom'] : '');
      $description = trim(isset($_POST['description']) ? $_POST['description'] : '');
      
      if (empty($nom)) {
        $error = 'Le nom est requis.';
      } elseif ((new CategoryModel())->findByName($nom)) {
        $error = 'Cette catégorie existe déjà.';
      } else {
        $catId = (new CategoryModel())->create($nom, empty($description) ? null : $description);
        if ($catId) {
          header('Location: index.php?route=admin-categories');
          exit;
        } else {
          $error = 'Erreur lors de la création de la catégorie.';
        }
      }
    }
    
    View::render('admin/category-create', ['title' => 'Créer une Catégorie', 'error' => $error]);
  }

  public function categoryEdit() {
    Auth::start();
    Auth::requireLogin();
    Auth::requireRole('ADMIN');
    
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $category = (new CategoryModel())->findById($id);
    $error = null;
    $success = null;
    
    if (!$category) {
      header('Location: index.php?route=admin-categories');
      exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nom = trim(isset($_POST['nom']) ? $_POST['nom'] : '');
      $description = trim(isset($_POST['description']) ? $_POST['description'] : '');
      
      if (empty($nom)) {
        $error = 'Le nom est requis.';
      } else {
        $existing = (new CategoryModel())->findByName($nom);
        if ($existing && $existing['id'] != $id) {
          $error = 'Cette catégorie existe déjà.';
        } else {
          if ((new CategoryModel())->update($id, $nom, empty($description) ? null : $description)) {
            $success = 'Catégorie mise à jour avec succès.';
            $category = (new CategoryModel())->findById($id);
          } else {
            $error = 'Erreur lors de la mise à jour.';
          }
        }
      }
    }
    
    View::render('admin/category-edit', ['title' => 'Modifier la Catégorie', 'category' => $category, 'error' => $error, 'success' => $success]);
  }

  public function categoryDelete() {
    Auth::start();
    Auth::requireLogin();
    Auth::requireRole('ADMIN');
    
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id > 0) {
      (new CategoryModel())->delete($id);
    }
    
    header('Location: index.php?route=admin-categories');
    exit;
  }
}
