<?php 
require_once '../includes/session.inc.php';
require_once '../includes/fonction_db.php';

if (!$isLoggedIn || empty($_POST['candidatures']) || empty($_GET['id'])) {
    header("Location: ../classeur.php?section=entreprises&error=donnees_manquantes");
    exit();
}

$db = getPDO();
$entrepriseId = $_GET['id']; // On le garde pour la redirection finale
$all_success = true;

$requete = $db->prepare("UPDATE candidatures 
                            SET date_envoi = :date_envoi,
                                mode_contact = :mode_contact,
                                statut = :statut,
                                resultat = :resultat
                            WHERE id = :id");

foreach ($_POST['candidatures'] as $idCandidature => $donnees) {
    
    $success = $requete->execute([
        'date_envoi'   => $donnees['date'],
        'mode_contact' => $donnees['mode'],
        'statut'       => $donnees['statut'],
        'resultat'     => $donnees['resultat'],
        'id'           => $idCandidature // Utilise l'ID de la candidature !
    ]);

    if (!$success) {
        $all_success = false;
    }
}

if ($all_success) {
    header("Location: ../information.php?id=" . $entrepriseId . "&log=success");
} else {
    header("Location: ../information.php?id=" . $entrepriseId . "&log=erreur");
}
exit();