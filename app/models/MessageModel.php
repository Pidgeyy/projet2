<?php
// app/models/MessageModel.php

require_once __DIR__ . '/../core/Database.php';

class MessageModel
{
    public static function findByTicketId($ticketId)
    {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare('SELECT m.*, u.nom as auteur_nom FROM messages m JOIN utilisateurs u ON m.auteur_id = u.id WHERE m.ticket_id = :ticket_id ORDER BY m.created_at ASC');
        $stmt->execute(['ticket_id' => $ticketId]);
        return $stmt->fetchAll();
    }

    public static function create($ticketId, $auteurId, $contenu)
    {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare('INSERT INTO messages (ticket_id, auteur_id, contenu, created_at) VALUES (:ticket_id, :auteur_id, :contenu, NOW())');
        return $stmt->execute(['ticket_id' => $ticketId, 'auteur_id' => $auteurId, 'contenu' => $contenu]);
    }
}
