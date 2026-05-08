<?php 
require_once '../includes/session.inc.php';
require_once '../includes/fonction_db.php';

// 1. Vérification de la session et des données
// Note : Si ton formulaire est en POST, l'ID devrait aussi être en POST (via le champ hidden)
if (!$isLoggedIn || empty($_POST['nom']) || empty($_GET['id'])) {
    header("Location: ../classeur.php?section=entreprises&error=donnees_manquantes");
    exit();
}

$db = getPDO();

// 2. Récupération des données proprement
$id = $_GET['id']; 
$nom = $_POST['nom'];
$email = $_POST['email'];
$site_web = $_POST['site_web'];
$localisation = $_POST['localisation'];
$description = $_POST['description'];

// 3. Préparation de la requête avec le paramètre :id
$requete = $db->prepare("UPDATE entreprises
                            SET nom = :nom,
                                email = :mail,
                                site_web = :site_web,
                                localisation = :localisation,
                                description = :description
                            WHERE id = :id");

// 4. Exécution avec UN SEUL tableau regroupant toutes les clés
$success = $requete->execute([
    'nom'          => $nom,
    'mail'         => $email,
    'site_web'     => $site_web,
    'localisation' => $localisation,
    'description'  => $description,
    'id'           => $id
]);

// 5. Redirection après succès
if ($success) {
    // On utilise le point (.) pour coller la variable à la chaîne de texte
    header("Location: ../information.php?id=" . $id . "&log=success");
} else {
    header("Location: ../information.php?id=" . $id . "&log=erreur");
}
exit();