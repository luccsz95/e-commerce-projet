<?php

include 'bdd.php';
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
/*$mail->Body = "Bonjour Avez vous bien demandé la réinitialisation de votre mot de passe ?";*/

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();

$token = bin2hex(random_bytes(16));

$mail->Body = "Bonjour, <br>Vous avez demandé une réinitialisation de votre mot de passe sur E-Commerce. 
Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe : 
<br><a href='http://localhost/BTS-project/newE-project/reset_password.php?token=" . urlencode($token) . "'>Réinitialiser mon mot de passe</a>";

if ($stmt->rowCount() == 0) {
    echo "<p style='color: red;'>Cet email n'existe pas dans nos bases.</p>";
    exit;
}

if($mail->send()){
    error_log("E-mail de vérification envoyé avec succès à $email.");
} else {
    $_SESSION['message'] = "L'envoi de l'e-mail a échoué.";
    error_log("Erreur lors de l'envoi de l'e-mail: {$mail->ErrorInfo}");
}


