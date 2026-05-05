<?php
require_once __DIR__ . '/load_env.php';

function getPDO() {
    // On garde la connexion en mémoire pour ne pas la recréer
    static $pdo = null;

    if ($pdo === null) {
        $host = getenv('DB_HOST');
        $db   = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        // Petite vérification de sécurité
        if (!$host || !$db) {
            die("Erreur : Configuration de la base de données manquante.");
        }

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

        try {
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false, // Désactive l'émulation pour plus de sécurité
            ]);
        } catch (PDOException $e) {
            // On enregistre l'erreur dans un fichier log au lieu de l'afficher au public
            error_log($e->getMessage()); 
            die("Une erreur technique est survenue. Veuillez réessayer plus tard.");
        }
    }

    return $pdo;
}

function getToutEntreprises($db) {
    try {
        $requete = $db->query("SELECT id, nom, email, site_web, localisation, description FROM entreprises ORDER BY nom ASC;");
        return $requete->fetchAll();
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return [];
    }
}
function getToutCandidatures($db) {
    try {
        $requete = $db->query("SELECT entreprise_id, date_envoi, mode_contact, statut, resultat FROM candidatures ORDER BY date_envoi DESC ;");
        return $requete->fetchAll();
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return [];
    }
}
function getToutCandidatureRefus($db) {
    try {
        $requete = $db->query("SELECT entreprise_id, date_envoi, mode_contact, statut, resultat FROM candidatures WHERE statut = 'Refus';");
        return $requete->fetchAll();
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return [];
    }
}
function getToutCandidatureAcceptee($db) {
    try {
        $requete = $db->query("SELECT entreprise_id, date_envoi, mode_contact, statut, resultat FROM candidatures WHERE statut = 'Acceptée';");
        return $requete->fetchAll();
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return [];
    }
}
function getToutCandidatureAttente($db) {
    try {
        $requete = $db->query("SELECT entreprise_id, date_envoi, mode_contact, statut, resultat FROM candidatures WHERE statut = 'En attente';");
        return $requete->fetchAll();
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return [];
    }
}
