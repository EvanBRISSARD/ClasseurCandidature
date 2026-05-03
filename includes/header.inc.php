<header class="header-container"> 
    <div class="logo-container">
        <img src="images/logo.png" alt="LogoSite" width="40" height="40">
        <h1 class="head-h1"><?php echo $title; ?></h1>
    </div>

    <nav class="container-nav">
        <ul>
            <li><a href="accueil.php">Accueil</a></li>
            <li><a href="classeur.php?section=candidatures">Classeur</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    
        <div class="container-connecter">
            <?php if ($isLoggedIn): ?>
                <div class="container-connecter-info">
                    <i class="fa-solid fa-user"></i>
                    <span><?php echo $_SESSION['nom']; ?> <?php echo $_SESSION['prenom']; ?></span>
                </div>
            <?php endif; ?>
        </div>  
</header>