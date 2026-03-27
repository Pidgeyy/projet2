<?php
// app/controllers/TicketController.php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../models/TicketModel.php';
require_once __DIR__ . '/../models/MessageModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';

class TicketController {
  public function index() {
    Auth::start();
    Auth::requireLogin();

    $u = Auth::user();
    $statut = isset($_GET['statut']) ? $_GET['statut'] : null;
    $priorite = isset($_GET['priorite']) ? $_GET['priorite'] : null;
    $categorieId = isset($_GET['categorie_id']) ? intval($_GET['categorie_id']) : null;

    $tickets = [];
    $categories = [];
    
    try {
      $categories = (new CategoryModel())->all();
      if ($u['role'] === 'ETUDIANT') {
        $tickets = (new TicketModel())->findByUser($u['id'], $statut, $priorite, $categorieId);
      } else {
        $tickets = (new TicketModel())->all($statut, $priorite, $categorieId);
      }
    } catch (Exception $e) {
      $tickets = [];
      $categories = [];
    }

    View::render('tickets/index', ['title' => 'Tickets', 'tickets' => $tickets, 'categories' => $categories]);
  }

  public function create() {
    Auth::start();
    Auth::requireLogin();

    $u = Auth::user();
    if ($u['role'] !== 'ETUDIANT') {
      header('Location: index.php?route=dashboard');
      exit;
    }

    $error = null;
    $categories = [];
    
    try {
      $categories = (new CategoryModel())->all();
    } catch (Exception $e) {
      $categories = [];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $titre = trim(isset($_POST['titre']) ? $_POST['titre'] : '');
      $description = trim(isset($_POST['description']) ? $_POST['description'] : '');
      $priorite = isset($_POST['priorite']) ? $_POST['priorite'] : 'MOYENNE';
      $categorieId = isset($_POST['categorie_id']) ? intval($_POST['categorie_id']) : 0;

      if (empty($titre) || empty($description) || $categorieId <= 0) {
        $error = 'Tous les champs sont requis.';
      } elseif (!in_array($priorite, ['FAIBLE', 'MOYENNE', 'ELEVE'])) {
        $error = 'Priorité invalide.';
      } else {
        try {
          $ticketId = (new TicketModel())->create($titre, $description, $categorieId, $priorite, $u['id']);
          if ($ticketId) {
            header('Location: index.php?route=ticket&id=' . $ticketId);
            exit;
          } else {
            $error = 'Impossible de créer le ticket (ID invalide).';
          }
        } catch (Exception $e) {
          $error = 'Erreur lors de la création du ticket : ' . $e->getMessage();
        }
      }
    }

    View::render('tickets/create', ['title' => 'Créer un ticket', 'error' => $error, 'categories' => $categories]);
  }
  public function show() {
    Auth::start();
    Auth::requireLogin();

    $u = Auth::user();
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $ticket = null;
    $messages = [];
    $error = null;

    try {
      $ticket = (new TicketModel())->find($id);
      if ($ticket) {
        // Check if user can view this ticket
        if ($u['role'] === 'ETUDIANT' && $ticket['auteur_id'] != $u['id']) {
          $ticket = null;
        } else {
          $messages = MessageModel::findByTicketId($id);
        }
      }
    } catch (Exception $e) {
      $ticket = null;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $ticket) {
      if (isset($_POST['change_statut']) && $u['role'] !== 'ETUDIANT') {
        $newStatut = $_POST['change_statut'];
        if (in_array($newStatut, array('OPEN','IN_PROGRESS','RESOLVED','CLOSED'))) {
          (new TicketModel())->updateStatus($id, $newStatut);
          header('Location: index.php?route=ticket&id=' . $id);
          exit;
        }
      }

      $contenu = trim(isset($_POST['contenu']) ? $_POST['contenu'] : '');
      if (!empty($contenu)) {
        try {
          MessageModel::create($id, $u['id'], $contenu);
          header('Location: index.php?route=ticket&id=' . $id);
          exit;
        } catch (Exception $e) {
          $error = 'Erreur lors de l\'ajout du message : ' . $e->getMessage();
        }
      }
    }

    View::render('tickets/show', ['title' => 'Ticket ' . $id, 'ticket' => $ticket, 'messages' => $messages, 'error' => $error, 'user' => $u]);
  }
}
