<?php
// app/models/TicketModel.php

require_once __DIR__ . '/../core/Database.php';

class TicketModel {
  public function all($statut = null, $priorite = null, $categorieId = null) {
    $sql = 'SELECT t.*, c.nom as categorie_nom FROM tickets t LEFT JOIN categories c ON t.categorie_id = c.id';
    $params = array();
    $clauses = array();

    if ($statut) {
      $clauses[] = 't.statut = :statut';
      $params['statut'] = $statut;
    }
    if ($priorite) {
      $clauses[] = 't.priorite = :priorite';
      $params['priorite'] = $priorite;
    }
    if ($categorieId) {
      $clauses[] = 't.categorie_id = :categorie_id';
      $params['categorie_id'] = $categorieId;
    }

    if (!empty($clauses)) {
      $sql .= ' WHERE ' . implode(' AND ', $clauses);
    }

    $sql .= ' ORDER BY t.created_at DESC';
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
  }

  public function findByUser($userId, $statut = null, $priorite = null, $categorieId = null) {
    $sql = 'SELECT t.*, c.nom as categorie_nom FROM tickets t LEFT JOIN categories c ON t.categorie_id = c.id WHERE t.auteur_id = :auteur_id';
    $params = array('auteur_id' => $userId);

    if ($statut) {
      $sql .= ' AND t.statut = :statut';
      $params['statut'] = $statut;
    }
    if ($priorite) {
      $sql .= ' AND t.priorite = :priorite';
      $params['priorite'] = $priorite;
    }
    if ($categorieId) {
      $sql .= ' AND t.categorie_id = :categorie_id';
      $params['categorie_id'] = $categorieId;
    }

    $sql .= ' ORDER BY t.created_at DESC';
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
  }

  public function find($id) {
    $stmt = Database::pdo()->prepare('SELECT t.*, c.nom as categorie_nom FROM tickets t LEFT JOIN categories c ON t.categorie_id = c.id WHERE t.id = :id');
    $stmt->execute(array('id' => $id));
    $t = $stmt->fetch();
    return $t ? $t : null;
  }

  public function create($titre, $description, $categorieId, $priorite, $auteurId) {
    $stmt = Database::pdo()->prepare('INSERT INTO tickets (titre, description, categorie_id, priorite, auteur_id, statut) VALUES (:titre, :description, :categorie_id, :priorite, :auteur_id, :statut)');
    $result = $stmt->execute(array(
      'titre' => $titre,
      'description' => $description,
      'categorie_id' => $categorieId,
      'priorite' => $priorite,
      'auteur_id' => $auteurId,
      'statut' => 'OPEN'
    ));
    if ($result) {
      $id = Database::pdo()->lastInsertId();
      return $id ? (int)$id : null;
    }
    return null;
  }

  public function updateStatus($id, $statut) {
    $stmt = Database::pdo()->prepare('UPDATE tickets SET statut = :statut, updated_at = NOW() WHERE id = :id');
    return $stmt->execute(array('id' => $id, 'statut' => $statut));
  }

  public function countByStatus($statut = null) {
    if ($statut) {
      $stmt = Database::pdo()->prepare('SELECT COUNT(*) as count FROM tickets WHERE statut = :statut');
      $stmt->execute(array('statut' => $statut));
    } else {
      $stmt = Database::pdo()->prepare('SELECT COUNT(*) as count FROM tickets');
      $stmt->execute(array());
    }
    $result = $stmt->fetch();
    return $result ? (int)$result['count'] : 0;
  }
}