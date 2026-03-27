-- db/seed.sql
USE campus_helpdesk;

INSERT INTO utilisateurs (nom, email, mdp_hash, role, actif) VALUES
('Etudiant Test', 'student@campus.local', '5f4dcc3b5aa765d61d8327deb882cf99', 'ETUDIANT', 1),
('Tech Test', 'tech@campus.local', '5f4dcc3b5aa765d61d8327deb882cf99', 'TECH', 1),
('Admin Test', 'admin@campus.local', '5f4dcc3b5aa765d61d8327deb882cf99', 'ADMIN', 1);

INSERT INTO categories (nom, description) VALUES
('Réseau', 'Problèmes de connexion réseau et WiFi'),
('Compte', 'Problèmes d\'authentification et gestion de compte'),
('Matériel', 'Problèmes avec les équipements informatiques'),
('Logiciel', 'Problèmes d\'installation ou utilisation de logiciels'),
('Autre', 'Autres demandes');

INSERT INTO tickets (titre, description, categorie_id, priorite, statut, auteur_id, created_at, updated_at) VALUES
('Problème WiFi', 'Je n\'arrive pas à me connecter au WiFi du campus', 1, 'MOYENNE', 'OPEN', 1, NOW(), NOW()),
('Compte bloqué', 'Mon compte utilisateur est bloqué depuis ce matin', 2, 'ELEVE', 'IN_PROGRESS', 1, NOW(), NOW()),
('Imprimante défaillante', 'L\'imprimante du bâtiment A ne fonctionne plus', 3, 'FAIBLE', 'OPEN', 2, NOW(), NOW());
