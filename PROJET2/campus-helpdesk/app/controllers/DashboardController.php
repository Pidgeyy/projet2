<?php
// app/controllers/DashboardController.php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../models/TicketModel.php';

class DashboardController {
  public function home() {
    Auth::start();
    if (Auth::user()) {
      header('Location: index.php?route=dashboard');
      exit;
    }
    header('Location: index.php?route=login');
    exit;
  }

  public function dashboard() {
    Auth::start();
    Auth::requireLogin();
    $u = Auth::user();
    $role = $u['role'];

    if ($role === 'ADMIN') {
      try {
        $stats = [
          'statsUsers' => $this->countUsers(),
          'statsTickets' => $this->countAllTickets(),
          'statsOpenTickets' => $this->countTicketsByStatus('OPEN') + $this->countTicketsByStatus('IN_PROGRESS'),
          'statsHighPriority' => $this->countTicketsByPriority('ELEVE'),
        ];
        View::render('dashboards/admin', array_merge(['title' => 'Dashboard Admin', 'user' => $u], $stats));
      } catch (Exception $e) {
        View::render('dashboards/admin', ['title' => 'Dashboard Admin', 'user' => $u, 'statsUsers' => 0, 'statsTickets' => 0, 'statsOpenTickets' => 0, 'statsHighPriority' => 0]);
      }
      return;
    }
    if ($role === 'TECH') {
      try {
        $ticketModel = new TicketModel();
        $stats = [
          'statsOpen' => $this->countTicketsByStatus('OPEN'),
          'statsProgress' => $this->countTicketsByStatus('IN_PROGRESS'),
          'statsResolved' => $this->countTicketsByStatus('RESOLVED'),
          'statsHighPriority' => $this->countTicketsByPriority('ELEVE'),
        ];
        View::render('dashboards/tech', array_merge(['title' => 'Dashboard Technicien', 'user' => $u], $stats));
      } catch (Exception $e) {
        View::render('dashboards/tech', ['title' => 'Dashboard Technicien', 'user' => $u, 'statsOpen' => 0, 'statsProgress' => 0, 'statsResolved' => 0, 'statsHighPriority' => 0]);
      }
      return;
    }

    View::render('dashboards/user', ['title' => 'Dashboard Étudiant', 'user' => $u]);
  }

  private function countTicketsByStatus($statut) {
    try {
      $model = new TicketModel();
      return $model->countByStatus($statut);
    } catch (Exception $e) {
      return 0;
    }
  }

  private function countTicketsByPriority($priorite) {
    try {
      $db = \Database::pdo();
      $stmt = $db->prepare('SELECT COUNT(*) as count FROM tickets WHERE priorite = :priorite');
      $stmt->execute(['priorite' => $priorite]);
      $result = $stmt->fetch();
      return $result ? (int)$result['count'] : 0;
    } catch (Exception $e) {
      return 0;
    }
  }

  private function countUsers() {
    try {
      $db = \Database::pdo();
      $stmt = $db->prepare('SELECT COUNT(*) as count FROM utilisateurs WHERE actif = 1');
      $stmt->execute();
      $result = $stmt->fetch();
      return $result ? (int)$result['count'] : 0;
    } catch (Exception $e) {
      return 0;
    }
  }

  private function countAllTickets() {
    try {
      $db = \Database::pdo();
      $stmt = $db->prepare('SELECT COUNT(*) as count FROM tickets');
      $stmt->execute();
      $result = $stmt->fetch();
      return $result ? (int)$result['count'] : 0;
    } catch (Exception $e) {
      return 0;
    }
  }
}
