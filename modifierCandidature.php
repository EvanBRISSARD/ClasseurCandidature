<?php
require_once 'includes/session.inc.php';
require_once 'includes/fonction_db.php';
require_once 'includes/fonction.php';
$title = "Modifier";
$db = getPDO();

if ($isLoggedIn) {
    $candidatures = getToutCandidatures($db);
    if (isset($_GET['id'])){

    // On cherche l'entreprise dans le tableau récupéré
    $candidaturesEntreprise = getCandidaturesParEntrepriseId($_GET['id'], $candidatures);

    // Si l'entreprise n'existe pas (id invalide)
    if (!$candidaturesEntreprise) {
            header("Location: classeur.php?section=entreprises"); 
            exit(); // Toujours mettre un exit après une redirection
    }
    } else {
        // Si l'id n'est même pas précisé dans l'URL
        header("Location: classeur.php?section=entreprises");
        exit();
    }
} else {
    header("Location: classeur.php?section=entreprises");
    exit();
}

$entreprises = getToutEntreprises($db);
$entreprise = getEntrepriseParId($_GET['id'], $entreprises);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> candidature</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/tab_style.css">
    <link rel="stylesheet" href="style/styleFrom.css">
    <link rel="stylesheet" href="style/styleDetails.css">
    <link rel="stylesheet" href="style/StyleTable.anima.css">
    <link rel="icon" type="image/png" href="images/logoV2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php include 'includes/header.inc.php'; ?>

    <main>
        <div class="content">
            <h2>Modifier - <?php echo htmlspecialchars($entreprise['nom']); ?></h2>
            <p>Modifier les candidatures de l'entreprise.</p>
        </div>

        <div class="content-detail-Candidatures">

            <form action="traitement/modifier_plusieurs_candidatures.php" method="POST">
                <table class="tableau">
                    <thead class="tableau-header">
                        <tr class="content-tab-header">
                            <th><i class="fa-regular fa-calendar-days"></i> Date d'envoi</th>
                            <th><i class="fa-solid fa-address-book"></i> Mode de contact</th>
                            <th><i class="fa-solid fa-circle-info"></i> Statut</th>
                            <th><i class="fa-solid fa-book-open"></i> Resultat</th>
                        </tr>
                    </thead>
                    <tbody class="tableau-body">
                        <?php foreach ($candidaturesEntreprise as $candidature): ?>
                            <tr class="content-tab-body">
                                <!-- Input caché pour l'ID de chaque candidature -->
                                <input type="hidden" name="candidatures[<?php echo $candidature['id']; ?>][id]" value="<?php echo $candidature['id']; ?>">

                                <td>
                                    <div class="input-group">
                                        <input type="date" name="candidatures[<?php echo $candidature['id']; ?>][date]" value="<?php echo $candidature['date_envoi']; ?>">
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="candidatures[<?php echo $candidature['id']; ?>][mode]" value="<?php echo htmlspecialchars($candidature['mode_contact']); ?>">
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="input-group">
                                        <select name="candidatures[<?php echo $candidature['id']; ?>][statut]">
                                            <option value="En attente" <?php echo ($candidature['statut'] == 'En attente') ? 'selected' : ''; ?>>En attente</option>
                                            <option value="Acceptée" <?php echo ($candidature['statut'] == 'Acceptée') ? 'selected' : ''; ?>>Acceptée</option>
                                            <option value="Refus" <?php echo ($candidature['statut'] == 'Refus') ? 'selected' : ''; ?>>Refus</option>
                                        </select>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="candidatures[<?php echo $candidature['id']; ?>][resultat]" placeholder="-" value="<?php echo $candidature['resultat']; ?>">
                                    </div>
                                </td>
            
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="content-actions">
                    <button type="button" onclick="history.back()" class="btn-secondaire">
                        <i class="fa-solid fa-arrow-left"></i> Retour
                    </button>
                    <button type="submit" class="btn-principal">
                        <i class="fa-solid fa-file-arrow-up"></i> Sauvegarder tout
                    </button>
                </div>
            </form>
        </div>
    </main>

    <?php include 'includes/footer.inc.php'; ?>

</body>
</html>