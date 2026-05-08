<?php
require_once 'includes/session.inc.php';
require_once 'includes/fonction_db.php';
require_once 'includes/fonction.php';
$title = "Modifier";
$db = getPDO();

if ($isLoggedIn) {
    $entreprises = getToutEntreprises($db);
    if (isset($_GET['id'])){

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
} else {
    header("Location: classeur.php?section=entreprises");
    exit();
}

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
    <link rel="stylesheet" href="style/styleFrom.css">
    <link rel="icon" type="image/png" href="images/logoV2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php include 'includes/header.inc.php'; ?>

    <main>
        <div class="content">
            <h2>Modifier - <?php echo $entreprise['nom']; ?></h2>
            <p>Modifier les information de entreprise.</p>
        </div>

        <div>
            <div class="content-detail">
                <form action="traitement/modifierEntreprise.traitement.php?id=<?php echo $entreprise['id']?>" method="POST" class="content-form-premiere">
                    <input type="hidden" name="id" value="<?php echo $entreprise['id']; ?>">

                    <div class="content-form">

                        <div class="input-group">
                            <label for="nom"><i class="fa-solid fa-user"></i> Nom</label>
                            <input type="text" id="nom" name="nom" placeholder="-" value="<?php echo htmlspecialchars($entreprise['nom']); ?>" required>
                        </div>

                        <div class="input-group">
                            <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                            <input type="text" id="email" name="email" placeholder="-" value="<?php echo htmlspecialchars($entreprise['email']); ?>">
                        </div>

                        <div class="input-group">
                            <label for="site_web"><i class="fa-solid fa-globe"></i> Site Web</label>
                            <input type="text" id="site_web" name="site_web" placeholder="-" value="<?php echo htmlspecialchars($entreprise['site_web']); ?>">
                        </div>

                        <div class="input-group">
                            <label for="localisation"><i class="fa-solid fa-location-dot"></i> Localisation</label>
                            <input type="text" id="localisation" name="localisation" placeholder="-" value="<?php echo htmlspecialchars($entreprise['localisation']); ?>">
                        </div>

                        <div class="input-group">
                            <label for="message"><i class="fa-solid fa-align-left"></i> Description</label>
                            <textarea id="message" name="description" rows="5" placeholder="Description ici..." required><?php echo htmlspecialchars($entreprise['description']); ?></textarea>
                        </div>

                    </div>

                    <div class="content-actions">
                        <button type="button" onclick="history.back()" class="btn-secondaire">
                            <i class="fa-solid fa-arrow-left"></i> Retour
                        </button>
                        <button type="submit" class="btn-principal"><i class="fa-solid fa-file-arrow-up"></i> Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.inc.php'; ?>

</body>
</html>