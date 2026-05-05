<?php
require_once 'includes/session.inc.php';
require_once 'includes/fonction_db.php';
require_once 'includes/fonction.php';
$title = "Contact";
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
            <h2>Cantact</h2>
            <p>N'hésitez pas à me contacter pour obtenir davantage d'informations ou pour d'autres demandes.</p>
        </div>

        <?php if (isset($_GET['log']) && $_GET['log'] == 'Reussi'):?>
                <div class="content-message-valide">
                    <h2><i class="fa-solid fa-envelope-circle-check"></i> Envoier</h2>
                    <p>Votre message a été traité avec succès.</p>
                </div>
            <?php endif; ?>
        
        <?php if (isset($_GET['log']) && $_GET['log'] == 'ChampsVides'):?>
            <div class="content-message-erreur">
                <h2><i class="fa-solid fa-circle-exclamation"></i> Invalide</h2>
                <p>Il est requis de compléter l'ensemble des champs marqués comme obligatoires.</p>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['log']) && $_GET['log'] == 'PasReussi'):?>
            <div class="content-message-erreur">
                <h2><i class="fa-solid fa-triangle-exclamation"></i> Problème</h2>
                <p>L'envoi du message a échoué. </p>
            </div>
        <?php endif; ?>

        <form action="traitement/contact.traitement.php" method="POST" class="content-form-seconde">
                <div class="content-form">

                    <div class="input-group">
                        <label for="firstname"><i class="fa-solid fa-user"></i> Votre prénom *</label>
                        <input type="text" id="firstname" name="firstname" placeholder="Prénom" required>
                    </div>

                    <div class="input-group">
                        <label for="email"><i class="fa-solid fa-envelope"></i> Votre adresse e-mail *</label>
                        <input type="email" id="email" name="email" placeholder="exemple@domain.com" required>
                    </div>

                    <div class="input-group">
                        <label title="phone"><i class="fa-solid fa-phone"></i> Votre téléphone</label>
                        <input type="tel" id="phone" name="phone" placeholder="+33 1 23 45 67 89" >
                    </div>

                    <div class="input-group">
                        <label for="message"><i class="fa-solid fa-message"></i> Message *</label>
                        <textarea id="message" name="message" rows="5" placeholder="Votre message ici..." required></textarea>
                    </div>
                </div>

                <div class="content-actions">
                    <a href="accueil.php" class="btn-secondaire"><i class="fa-solid fa-arrow-left"></i> Retour</a>
                    <button type="submit" class="btn-principal"><i class="fa-solid fa-paper-plane"></i> Envoyer</button>
                </div>
        </form>
    </main>

    <?php include 'includes/footer.inc.php'; ?>

</body>
</html>