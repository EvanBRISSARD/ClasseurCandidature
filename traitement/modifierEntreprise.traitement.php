<?php 
require_once '../includes/session.inc.php';
require_once '../includes/fonction_db.php';

if (!$isLoggedIn || empty($_POST['nom']) || empty($_GET['id'])) {
    header("Location: ../classeur.php?section=entreprises&error=donnees_manquantes");
    exit();
}

$db = getPDO();

$id = $_GET['id']; 
$nom = $_POST['nom'];
$email = $_POST['email'];
$site_web = $_POST['site_web'];
$localisation = $_POST['localisation'];
$description = $_POST['description'];
$requete = $db->prepare("UPDATE entreprises
                            SET nom = :nom,
                                email = :mail,
                                site_web = :site_web,
                                localisation = :localisation,
                                description = :description
                            WHERE id = :id");

$success = $requete->execute([
    'nom'          => $nom,
    'mail'         => $email,
    'site_web'     => $site_web,
    'localisation' => $localisation,
    'description'  => $description,
    'id'           => $id
]);

if ($success) {
    header("Location: ../information.php?id=" . $id . "&log=success");
} else {
    header("Location: ../information.php?id=" . $id . "&log=erreur");
}
exit();