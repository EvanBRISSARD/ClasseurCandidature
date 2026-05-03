<?php
require_once 'includes/fonction_db.php';
require_once 'includes/fonction.php';
$delai = 0.1;
$db = getPDO();

if (isset($_GET['section']) && $_GET['section'] === 'candidatures') {
    $candidatures = getToutCandidatures($db);
}
$entreprises = getToutEntreprises($db);
$title = "Classeur";
$titlePage = "Classeur - " . ucfirst($_GET['section']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titlePage; ?></title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/tab_style.css">
    <link rel="stylesheet" href="style/StyleTable.anima.css">
    <link rel="icon" type="image/png" href="images/logo-favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php include 'includes/header.inc.php'; ?>

    <main>
        <div class="content">
            <?php if ($_GET['section'] === 'candidatures') : ?>
                <h2>Candidatures</h2>
                <p>Liste des candidatures ( <?php echo count($candidatures); ?> répertoriées.)</p>
            <?php elseif ($_GET['section'] === 'entreprises') : ?>
                <h2>Entreprises</h2>
                <p>Liste des entreprises ( <?php echo count($entreprises); ?> répertoriées.)</p>
            <?php endif; ?>
        </div>
        <div class="content-actions">
            <a href="classeur.php?section=entreprises" class="<?php echo ($_GET['section'] === 'entreprises') ? 'btn-principal' : 'btn-secondaire'; ?>">Entreprise</a>
            <a href="classeur.php?section=candidatures" class="<?php echo ($_GET['section'] === 'candidatures') ? 'btn-principal' : 'btn-secondaire'; ?>">Candidature</a>
         </div>
         <?php if ($_GET['section'] === 'candidatures') : ?>
            <div>
                <table class="tableau">
                    <thead class="tableau-header">

                        <tr class="content-tab-header">
                            <th><i class="fa-regular fa-calendar-days"></i> Date d'envoi</th>
                            <th><i class="fa-solid fa-city"></i> Entreprise visée</th>
                            <th><i class="fa-solid fa-address-book"></i> Mode de contact</th>
                            <th><i class="fa-solid fa-circle-info"></i> Statut</th>
                        </tr>

                    </thead>
                    <tbody class="tableau-boby">
                        <?php foreach ($candidatures as $candidature) : ?>
                        <?php $entreprise = getEntrepriseParId($candidature['entreprise_id'], $entreprises); ?>
                        <tr class="content-tab-body" style="animation-delay: <?= $delai ?>s;" onclick="window.location.href='information.php?id=<?php echo $entreprise['id']; ?>'">
                                <td class="tag-DateEnvoi"><p><i class="fa-regular fa-calendar-days"></i> <?php echo $candidature['date_envoi']; ?></p></td>
                                
                                <td class="tag-Entreprise">
                                    <?php if ($entreprise): ?>
                                        <p><?php echo $entreprise['nom']; ?></p>
                                    <?php else: ?>
                                        <span class="no-info"><i class="fa-regular fa-window-minimize"></i></span>
                                    <?php endif; ?>
                                </td>

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
                        </tr>
                        <?php $delai += 0.1; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php elseif ($_GET['section'] === 'entreprises') : ?>
            <div>
                <table class="tableau">
                    <thead class="tableau-header">
                        <tr class="content-tab-header">
                            <th><i class="fa-solid fa-city"></i> Entreprise</th>
                            <th><i class="fa-solid fa-envelope"></i> Email</th>
                            <th><i class="fa-solid fa-globe"></i> Site web</th>
                            <th><i class="fa-solid fa-map-marker-alt"></i> Localisation</th>
                        </tr>
                    </thead>
                    <tbody class="tableau-boby">
                        <?php foreach ($entreprises as $entreprise) : ?>
                        <tr class="content-tab-body" style="animation-delay: <?= $delai ?>s;" onclick="window.location.href='information.php?id=<?php echo $entreprise['id']; ?>'">
                            <td class="tag-Entreprise"><p><?php echo $entreprise['nom']; ?></p></td>
                            <td class="tag-Email">
                                <?php if ($entreprise['email']): ?>
                                    <a href="mailto:<?php echo $entreprise['email']; ?>"><i class="fa-solid fa-envelope"></i> <?php echo $entreprise['email']; ?></a>
                                <?php else: ?>
                                    <span class="no-info"><i class="fa-regular fa-window-minimize"></i></span>
                                <?php endif; ?>
                            </td>
                            <td class="tag-Site-web">
                                <?php if ($entreprise['site_web']): ?>
                                    <a href="<?php echo $entreprise['site_web']; ?>" target="_blank"><i class="fa-solid fa-globe"></i> <?php echo $entreprise['site_web']; ?></a>
                                <?php else: ?>
                                    <span class="no-info"><i class="fa-regular fa-window-minimize"></i></span>
                                <?php endif; ?>
                            </td>
                            <td class="tag-Localisation"><p><i class="fa-solid fa-map-marker-alt"></i> <?php echo $entreprise['localisation']; ?></p></td>
                        </tr>
                        <?php $delai += 0.1; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        
    </main>

    <?php include 'includes/footer.inc.php'; ?>

</body>
</html>