<?php
// app/models/UserModel.php

require_once __DIR__ . '/../core/Database.php';

class UserModel {
  public function findById($id) {
    $stmt = Database::pdo()->prepare(
      'SELECT id, nom, email, role, actif FROM utilisateurs WHERE id = :id LIMIT 1'
    );
    $stmt->execute(array('id' => $id));
    $u = $stmt->fetch();
    return $u ? $u : null;
  }

  public function findByEmail($email) {
    $stmt = Database::pdo()->prepare(
      'SELECT id, nom, email, mdp_hash, role, actif FROM utilisateurs WHERE email = :email LIMIT 1'
    );
    $stmt->execute(array('email' => $email));
    $u = $stmt->fetch();
    return $u ? $u : null;
  }

  public function all() {
    $stmt = Database::pdo()->prepare(
      'SELECT id, nom, email, role, actif, created_at FROM utilisateurs ORDER BY created_at DESC'
    );
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function create($nom, $email, $mdp, $role = 'ETUDIANT', $actif = 1) {
    try {
      $mdpHash = md5($mdp);
      $stmt = Database::pdo()->prepare(
        'INSERT INTO utilisateurs (nom, email, mdp_hash, role, actif) VALUES (:nom, :email, :mdp_hash, :role, :actif)'
      );
      $result = $stmt->execute(array(
        'nom' => $nom,
        'email' => $email,
        'mdp_hash' => $mdpHash,
        'role' => $role,
        'actif' => $actif
      ));
      if ($result) {
        return (int)Database::pdo()->lastInsertId();
      }
      return null;
    } catch (Exception $e) {
      return null;
    }
  }

  public function update($id, $nom, $email, $role) {
    $stmt = Database::pdo()->prepare(
      'UPDATE utilisateurs SET nom = :nom, email = :email, role = :role WHERE id = :id'
    );
    return $stmt->execute(array(
      'id' => $id,
      'nom' => $nom,
      'email' => $email,
      'role' => $role
    ));
  }

  public function toggleActive($id, $actif) {
    $stmt = Database::pdo()->prepare(
      'UPDATE utilisateurs SET actif = :actif WHERE id = :id'
    );
    return $stmt->execute(array(
      'id' => $id,
      'actif' => $actif ? 1 : 0
    ));
  }

  public function changePassword($id, $newPassword) {
    $mdpHash = md5($newPassword);
    $stmt = Database::pdo()->prepare(
      'UPDATE utilisateurs SET mdp_hash = :mdp_hash WHERE id = :id'
    );
    return $stmt->execute(array(
      'id' => $id,
      'mdp_hash' => $mdpHash
    ));
  }

  public function delete($id) {
    $stmt = Database::pdo()->prepare('DELETE FROM utilisateurs WHERE id = :id');
    return $stmt->execute(array('id' => $id));
  }
}