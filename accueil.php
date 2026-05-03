<?php
require_once 'includes/session.inc.php';
require_once 'includes/fonction_db.php';
require_once 'includes/fonction.php';
$title = "Accueil";
$db = getPDO();
$candidatures = getToutCandidatures($db);
$candidatureAcceptee = getToutCandidatureAcceptee($db);
$canfidatureRefus = getToutCandidatureRefus($db);
$candidatureAttente = getToutCandidatureAttente($db);
$entreprises = getToutEntreprises($db);




?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Tableau de Bord</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/StyleEntrer.anima.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php include 'includes/header.inc.php'; ?>

    <main>
        <div class="content">
            <h2>Tableau de Bord</h2>
            <p>Information première sur les entreprises et les candidatures.</p>
        </div>
        <div class="container-cards">
            <div class="card">
                <img src="images/batiments.png" alt="LogoEntreprise" width="50" height="50">
                <div class="card-content">
                    <h3>Entreprises</h3>
                    <p class="content-num"><?php echo count($entreprises); ?></p>
                    <p>Entreprises répertoriées</p>
                </div>
            </div>
            <div class="card">
                <img src="images/direct.png" alt="LogoEntreprise" width="50" height="50">
                <div class="card-content">
                    <h3>Candidatures</h3>
                     <p class="content-num"><?php echo count($candidatures); ?></p>
                    <p>Candidatures envoyées</p>
                </div>
            </div>
            <div class="card">  
                <img src="images/ne-pas-aimer.png" alt="LogoEntreprise" width="50" height="50">
                <div class="card-content">
                     <h3>Refus</h3>
                      <p class="content-num"><?php echo count($canfidatureRefus); ?></p>
                      <p>Par entreprise</p>
                </div>
            </div>
            <div class="card">
                <img src="images/pro.png" alt="LogoEntreprise" width="50" height="50">
                <div class="card-content">
                    <h3>Acceptées</h3>
                    <p class="content-num"><?php echo count($candidatureAcceptee); ?></p>
                    <p>Par entreprise</p>
                </div>
            </div>
        </div>
        <div class="content-stats">
            <h2>Données statistiques concernant l'ensemble du classeur.</h2>
            <div class="content-stats-items">
                <div class="stats-item">
                    <h3>Candidatures en attente</h3>
                    <p class="content-num"><?php echo count($candidatureAttente); ?></p>
                    <p>Par entreprise</p>
                </div>
                <div class="stats-item">
                    <h3>Taux d'acceptation</h3>
                    <p class="content-num"><?php echo tauxAcceptation($candidatures, $candidatureAcceptee); ?></p>
                    <p><?php echo count($candidatureAcceptee); ?> sur <?php echo count($candidatures); ?> candidature</p>
                </div>
            </div>
        </div>
        <div class="content-actions">
            <a href="#" class="btn-principal">+ Nouvelle candidature</a>
            <a href="classeur.php?section=entreprises" class="btn-secondaire">Voir toutes les entreprises enregistrées</a>
        </div>

        <div class="content-description">
            <div class="content-cart-desc">
                <h2>Présentation du site</h2>
                <p>Ce projet est une application web conçue pour centraliser et organiser mes recherches de stage. L'objectif est de remplacer les tableurs Excel classiques par une interface dédiée, permettant un suivi plus fluide et structuré des candidatures.</p>
                <br>
                <p>Le site offre une vue d'ensemble de toutes les entreprises ciblées, des candidatures envoyées, ainsi que des réponses reçues. Il permet également de suivre l'avancement de chaque candidature, de stocker les informations pertinentes et de faciliter la gestion de mes recherches de stage.</p>
            </div>
            <div class="content-cart-desc">
                <h2>Pourquoi ce projet ?</h2>
                <lu class="content-list-desc">
                    <li>
                        <h3><i class="fa-solid fa-angle-right"></i> Centralisation</h3>
                        <p>Regrouper toutes les informations liées aux candidatures en un seul endroit.</p>
                    </li>
                    <li>
                        <h3><i class="fa-solid fa-angle-right"></i> Organisation</h3>
                        <p>Offrir une interface intuitive pour suivre l'avancement de chaque candidature.</p>
                    </li>
                    <li>
                        <h3><i class="fa-solid fa-angle-right"></i> Accessibilité</h3>
                        <p>Permettre un accès facile et rapide aux données depuis n'importe quel appareil.</p>
                    </li>
                </lu>
            </div>
        </div>
            
    </main>

    <?php include 'includes/footer.inc.php'; ?>

</body>
</html>