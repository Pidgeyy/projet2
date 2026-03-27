<?php
// app/models/CategoryModel.php

require_once __DIR__ . '/../core/Database.php';

class CategoryModel {
  public function all() {
    $stmt = Database::pdo()->prepare(
      'SELECT id, nom, description, created_at FROM categories ORDER BY nom ASC'
    );
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function findById($id) {
    $stmt = Database::pdo()->prepare(
      'SELECT id, nom, description FROM categories WHERE id = :id LIMIT 1'
    );
    $stmt->execute(array('id' => $id));
    return $stmt->fetch();
  }

  public function findByName($nom) {
    $stmt = Database::pdo()->prepare(
      'SELECT id, nom, description FROM categories WHERE nom = :nom LIMIT 1'
    );
    $stmt->execute(array('nom' => $nom));
    return $stmt->fetch();
  }

  public function create($nom, $description = null) {
    try {
      $stmt = Database::pdo()->prepare(
        'INSERT INTO categories (nom, description) VALUES (:nom, :description)'
      );
      $result = $stmt->execute(array(
        'nom' => $nom,
        'description' => $description
      ));
      if ($result) {
        return (int)Database::pdo()->lastInsertId();
      }
      return null;
    } catch (Exception $e) {
      return null;
    }
  }

  public function update($id, $nom, $description = null) {
    $stmt = Database::pdo()->prepare(
      'UPDATE categories SET nom = :nom, description = :description WHERE id = :id'
    );
    return $stmt->execute(array(
      'id' => $id,
      'nom' => $nom,
      'description' => $description
    ));
  }

  public function delete($id) {
    $stmt = Database::pdo()->prepare('DELETE FROM categories WHERE id = :id');
    return $stmt->execute(array('id' => $id));
  }

  public function count() {
    $stmt = Database::pdo()->prepare('SELECT COUNT(*) as count FROM categories');
    $stmt->execute();
    $result = $stmt->fetch();
    return $result ? (int)$result['count'] : 0;
  }
}
