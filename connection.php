<?php
require_once 'includes/session.inc.php';
require_once 'includes/fonction_db.php';
require_once 'includes/fonction.php';
$title = "Connection";
$db = getPDO();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/StyleEntrer.anima.css">
    <link rel="stylesheet" href="style/styleFrom.css">
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php include 'includes/header.inc.php'; ?>

    <main>
        <div class="content">
            <h2>Connection</h2>
            <p>Se connecter pour modifier et ajouter des candidatures.</p>
        </div>
        <form action="traitement/connextion.taitement.php" method="POST" class="content-form-premiere">
            <div class="content-form">

                <div class="input-group">
                    <label for="username"><i class="fa-solid fa-user"></i> Username</label>
                    <input type="text" id="username" name="username" placeholder="@exemple" required>
                </div>

                <div class="input-group">
                    <label for="password"><i class="fa-solid fa-address-card"></i> Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
            </div>
            <div class="content-actions">
                <a href="accueil.php" class="btn-secondaire"><i class="fa-solid fa-arrow-left"></i> Retourner à l'accueil</a>
                <button type="submit" class="btn-principal">Se connecter</button>
            </div>
        </form>
    </main>

    <?php include 'includes/footer.inc.php'; ?>

</body>
</html>