<?php
// On inclut les fichiers qu'on vient de télécharger
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../includes/load_env.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message'])) {
    header("Location: ../contact.php?log=ChampsVides");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. On récupère tes champs du formulaire
    $prenom = htmlspecialchars($_POST['firstname']);
    $email  = htmlspecialchars($_POST['email']);
    $phone  = htmlspecialchars($_POST['phone']);
    $msg    = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // 2. CONFIGURATION DU SERVEUR (La Poste)
        $mail->isSMTP();
        $mail->Host       = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth   = true;
        $mail->Username   = getenv('MAILER_USER');       // ✅ ton vrai username
        $mail->Password   = getenv('MAILER_PASS'); // ← remplace les **** par ton vrai password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ✅ important !
        $mail->Port       = 2525;              // Le port donné par Mailtrap

        // 3. QUI ENVOIE / QUI REÇOIT
        $mail->setFrom('contact@classeurcandidature.com', 'Mon Formulaire');
        $mail->addAddress('evanbrissard@icloud.com'); // C'est ICI que tu recevras le mail

        // 4. LE CONTENU
        $mail->isHTML(true);
        $mail->Subject = "Nouveau message de $prenom";
        $mail->Body    = "
            <h1>Nouveau message de contact</h1>
            <p><b>Nom :</b> $prenom</p>
            <p><b>Email :</b> $email</p>
            <p><b>Message :</b><br>$msg</p>
        ";

        $mail->send();
        header("Location: ../contact.php?log=Reussi");
        exit();
    } catch (Exception $e) {
        header("Location: ../contact.php?log=PasReussi");
    }
}