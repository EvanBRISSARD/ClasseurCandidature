<?php
require_once '../includes/session.inc.php';
require_once '../includes/fonction_db.php'; // Ton fichier pour getPDO()

// 1. Vérification que les données ont bien été envoyées
if (empty($_POST['username']) || empty($_POST['password'])) {
    header("Location: ../connection.php?log=ChampsVides");
    exit();
}

$user_saisi = $_POST['username'];
$pass_saisi = $_POST['password'];

try {
    $db = getPDO();

    // 2. On récupère l'utilisateur par son username uniquement
    $requete = $db->prepare("SELECT * FROM utilisateurs WHERE username = :username");
    $requete->execute(['username' => $user_saisi]);
    $user = $requete->fetch();

    // 3. On vérifie si l'utilisateur existe ET si le mot de passe correspond
    if ($user && password_verify($pass_saisi, $user['pass'])) {
        
        // SUCCÈS : On enregistre les infos en session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['est_connecte'] = true;

        header("Location: ../accueil.php?log=ConnectionIN");
        exit();
    } else {
        // ÉCHEC : Mauvais identifiants
        header("Location: ../connection.php?log=Erreur");
        exit();
    }

} catch (PDOException $e) {
    error_log("Erreur SQL : " . $e->getMessage());
    header("Location: ../connection.php?log=ErreurTechnique");
    exit();
}