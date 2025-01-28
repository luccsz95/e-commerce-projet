<?php

require 'vendor/autoload.php';

/*require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
}

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.mail.yahoo.com';
$mail->SMTPAuth = true;
$mail->Username = 'kouicicontact@yahoo.com';
$mail->Password = 'ndvmyqlrsnmeecxw';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->setFrom('kouicicontact@yahoo.com', 'E-commerce');
$mail->addAddress($email);

$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Subject = 'Réinitialisation de mot de passe';
$mail->Body = "Bonjour Avez vous bien demandé la réinitialisation de votre mot de passe ?";
//$mail->Body = "Bonjour " . htmlspecialchars($firstname) ." Avez vous bien demandé la réinitialisation de votre mot de passe ? Si oui, cliquez sur le lien suivant pour le réinitialiser: <a href='http://localhost/ecom/reset_password.php?email=$email'>Réinitialiser le mot de passe</a>";


if($mail->send()){
    error_log("E-mail de vérification envoyé avec succès à $email.");
} else {
    $_SESSION['message'] = "L'envoi de l'e-mail a échoué.";
    error_log("Erreur lors de l'envoi de l'e-mail: {$mail->ErrorInfo}");
}


