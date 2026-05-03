<?php
require_once 'includes/fonction_db.php';
require_once 'includes/fonction.php';
$title = "Inscrition";
$db = getPDO();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Tableau de Bord</title>
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
            <h2>Inscription</h2>
            <p>Inscription pour modifier et ajouter des candidature.</p>
        </div>
        <form action="#" method="POST" class="content-form-premiere">
            <div class="content-form">
                
                <div class="input-group">
                    <label for="username"><i class="fa-solid fa-user"></i> Nom</label>
                    <input type="text" id="username" name="username" placeholder="Paul" required>
                </div>

                <div class="input-group">
                    <label for="username"><i class="fa-solid fa-user"></i> Prénom</label>
                    <input type="text" id="username" name="username" placeholder="Mirabel" required>
                </div>

                <div class="input-group">
                    <label for="username"><i class="fa-solid fa-paper-plane"></i> Mail</label>
                    <input type="email" name="email" id="email" placeholder="exemple@domaine.com" required>
                </div>

                <div class="input-group">
                    <label for="password"><i class="fa-solid fa-address-card"></i> Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
            </div>
            <div class="content-actions">
                <a href="accueil.php" class="btn-secondaire"><i class="fa-solid fa-arrow-left"></i> Retourner à l'accueil</a>
                <button type="submit" class="btn-principal">S'inscrire</button>
            </div>
        </form>
    </main>

    <?php include 'includes/footer.inc.php'; ?>

</body>
</html>