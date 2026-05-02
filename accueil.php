<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Tableau de Bord</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="image/png" href="images/logo-favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <header class="header-container"> 
        <div class="logo-container">
            <img src="images/logo-favicon.png" alt="LogoSite" width="40" height="40">
            <h1 class="head-h1">Accueil</h1>
        </div>

        <nav class="container-nav">
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="classeur.html">Classeur</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </header>

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
                    <p class="content-num">53</p>
                    <p>Entreprises répertoriées</p>
                </div>
            </div>
            <div class="card">
                <img src="images/direct.png" alt="LogoEntreprise" width="50" height="50">
                <div class="card-content">
                    <h3>Candidatures</h3>
                     <p class="content-num">41</p>
                    <p>Candidatures envoyées</p>
                </div>
            </div>
            <div class="card">
                <img src="images/ne-pas-aimer.png" alt="LogoEntreprise" width="50" height="50">
                <div class="card-content">
                     <h3>Refus</h3>
                      <p class="content-num">23</p>
                      <p>Par entreprise</p>
                </div>
            </div>
            <div class="card">
                <img src="images/pro.png" alt="LogoEntreprise" width="50" height="50">
                <div class="card-content">
                    <h3>Acceptées</h3>
                    <p class="content-num">0</p>
                    <p>Par entreprise</p>
                </div>
            </div>
        </div>
        <div class="content-stats">
            <h2>Données statistiques concernant l'ensemble du classeur.</h2>
            <div class="content-stats-items">
                <div class="stats-item">
                    <h3>Candidatures en attente</h3>
                    <p class="content-num">13</p>
                    <p>Par entreprise</p>
                </div>
                <div class="stats-item">
                    <h3>Taux d'acceptation</h3>
                    <p class="content-num">0%</p>
                    <p>0 sur 41 candidature</p>
                </div>
            </div>
        </div>
        <div class="content-actions">
            <a href="#" class="btn-principal">+ Nouvelle candidature</a>
            <a href="#" class="btn-secondaire">Voir toutes les entreprises</a>
        </div>
    </main>

    <footer>
        <div class="footer-logo">
            <img src="images/logo-favicon.png" alt="LogoSite" width="30" height="30">
            <span>Classeur Candidature</span>
        </div>
        <div class="contact-info-doit">
            <p>Copyright &copy; 2026 EvanBRISSARD</p>
            <p>Tous droits réservés | Licence MIT</p>
        </div>
        <div class="contact-info">
            <div class="social-icons">
                <i class="fa-solid fa-envelope"></i>
                <a href="mailto:evanbrissard@icloud.com">evanbrissard@icloud.com</a>
            </div>
             <div class="social-icons">
                <i class="fa-brands fa-github"></i>
                <a href="https://github.com/EvanBRISSARD/ClasseurCandidature">Mon github</a>
            </div>
        </div>
    </footer>

</body>
</html>