<?php
require_once 'includes/session.inc.php';
require_once 'includes/fonction_db.php';
require_once 'includes/fonction.php';
$title = "Information";
$db = getPDO();
$entreprises = getToutEntreprises($db);

if (isset($_GET['id'])) {
    // On cherche l'entreprise dans le tableau récupéré
    $entreprise = getEntrepriseParId($_GET['id'], $entreprises);

    // Si l'entreprise n'existe pas (id invalide)
    if (!$entreprise) {
        header("Location: classeur.php?section=entreprises");
        exit(); // Toujours mettre un exit après une redirection
    }
} else {
    // Si l'id n'est même pas précisé dans l'URL
    header("Location: classeur.php?section=entreprises");
    exit();
}

$candidatures = getToutCandidatures($db);
$candidaturesEntreprise = getCandidaturesParEntrepriseId($entreprise['id'], $candidatures);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - <?php echo $entreprise['nom']; ?></title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/styleDetails.css">
    <link rel="stylesheet" href="style/styleTag.css">
    <link rel="stylesheet" href="style/tab_style.css">
    <link rel="stylesheet" href="style/StyleEntrer.anima.css">
    <link rel="stylesheet" href="style/StyleTable.anima.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php include 'includes/header.inc.php'; ?>

    <main>
        <div class="content">
            <h2>Détails de l'entreprise</h2>
            <p>Information supplémentaire sur l'entreprise.</p>
        </div>
        <div>
            <div class="content-actions-secondaire">
                <button type="button" onclick="history.back()" class="btn-secondaire">
                    <i class="fa-solid fa-arrow-left"></i> Retour
                </button>
                <?php if ($isLoggedIn):?>
                    <a href="classeur.php?section=entreprises" class="btn-principal">+ Nouvelle candidature</a>
                    <a href="classeur.php?section=entreprises" class="btn-principal"><i class="fa-solid fa-pen"></i> Modifier</a>
                <?php endif; ?>
            </div>

            <div class="content-detail">
                <div class="content-detail-Entreprise">

                    <div class="content-detail-Entreprise-ligne">
                        <strong><i class="fa-solid fa-city"></i> Nom</strong>
                        <span> <?php echo $entreprise['nom'] ? $entreprise['nom'] : "-"; ?></span>
                    </div>
                    
                    <div class="content-detail-Entreprise-ligne">
                        <strong>Email</strong>
                        <div class="tag-Email">
                            <?php if ($entreprise['email']): ?>
                                <a href="mailto:<?php echo $entreprise['email']; ?>"><i class="fa-solid fa-envelope"></i> <?php echo $entreprise['email']; ?></a>
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="content-detail-Entreprise-ligne">
                        <strong>Site Web</strong>
                        <div class="tag-Site-web">
                            <?php if ($entreprise['site_web']): ?>
                                <a href="<?php echo $entreprise['site_web']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-globe"></i> <?php echo $entreprise['site_web']; ?></a>
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="content-detail-Entreprise-ligne">
                        <strong>Localisation</strong>
                        <span> <?php echo $entreprise['localisation'] ? $entreprise['localisation'] : "-"; ?></span>
                    </div>

                    <div class="content-detail-Entreprise-ligne">
                        <strong><i class="fa-regular fa-chart-bar"></i> Description</strong>
                        <span> <?php echo $entreprise['description'] ? $entreprise['description'] : "-"; ?></span>
                    </div>

                </div>
                <div class="content-detail-Candidatures">
                    <table class="tableau">
                        <thead class="tableau-header">

                            <tr class="content-tab-header">
                                <th><i class="fa-regular fa-calendar-days"></i> Date d'envoi</th>
                                <th><i class="fa-solid fa-address-book"></i> Mode de contact</th>
                                <th><i class="fa-solid fa-circle-info"></i> Statut</th>
                                <th><i class="fa-solid fa-book-open"></i> Resultat</th>
                            </tr>

                        </thead>
                        <tbody class="tableau-boby" >
                            <?php foreach ($candidaturesEntreprise as $candidature): ?>
                                <tr class="content-tab-body">
                                    <td class="tag-DateEnvoi"><p><i class="fa-regular fa-calendar-days"></i> <?php echo formaterDateFr($candidature['date_envoi']); ?></p></td>
                                    
                                    <td class="tag-modeContact">
                                        <?php if ($candidature['mode_contact']): ?>
                                            <p><?php echo $candidature['mode_contact']; ?></p>
                                        <?php else: ?>
                                            <span class="no-info"><i class="fa-regular fa-window-minimize"></i></span>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <td class="tag-Statut">
                                        <?php if ($candidature['statut'] === 'En attente'): ?>
                                            <p class="tag-statut-Attante"><?php echo $candidature['statut']; ?></p>
                                        <?php elseif ($candidature['statut'] === 'Acceptée'): ?>
                                            <p class="tag-statut-Acceptee"><?php echo $candidature['statut']; ?></p>
                                        <?php elseif ($candidature['statut'] === 'Refus'): ?>
                                            <p class="tag-statut-Refus"><?php echo $candidature['statut']; ?></p>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <td class="tag-Resultat">
                                        <?php if ($candidature['resultat'] == "") : ?>
                                            <span class="tag-Resultat-vide">-</span>
                                        <?php else: ?>
                                            <p><?php echo $candidature['resultat']; ?></p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.inc.php'; ?>

</body>
</html>