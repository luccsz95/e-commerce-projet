<?php

session_start();

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirm-password']);
    $phonenumber = htmlspecialchars($_POST['phonenumber']);

    if ($_POST['captcha'] != $_SESSION['captcha']) {
        $_SESSION['errorMessage'] = "<p style='color: red;'>Le code de vérification est incorrect</p>";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if ($password != $confirmPassword) {
        echo "<p style='color: red;'>Les mots de passe ne correspondent pas</p>";
        exit;
    }

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $token = bin2hex(random_bytes(16));

        $test = $token;

        if ($stmt->rowCount() > 0) {
            echo "<p style='color: red;'>Cet email est déjà utilisé</p>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (lastname, firstname, email, password, phonenumber, token) VALUES (:lastname, :firstname, :email, :password, :phonenumber, :token)");
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':phonenumber', $phonenumber);
            $stmt->bindParam(':token', $token);

            $mail = new PHPMailer(true);

        }
        if ($stmt->execute()) {
            $mail->isSMTP();
            $mail->Host = 'smtp.mail.yahoo.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kouicicontact@yahoo.com';
            $mail->Password = 'ndvmyqlrsnmeecxw';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('kouicicontact@yahoo.com', 'E-commerce');
            $mail->addAddress($email, htmlspecialchars("$firstname $lastname"));
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Inscription réussie';

            $mail->Body = "Bonjour " . htmlspecialchars($firstname) .". Vous êtes maintenant inscrit.
                <br><a href='http://localhost/BTS-project/newE-project/email_verif.php?token=" . urlencode($token) . "'>
                Vérifier votre email</a>";

            if($mail->send()){
                error_log("E-mail de vérification envoyé avec succès à $email.");
            } else {
                $_SESSION['message'] = "L'envoi de l'e-mail a échoué.";
                error_log("Erreur lors de l'envoi de l'e-mail: {$mail->ErrorInfo}");
            }

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;

            header("Location: connexion.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    $conn = null;
}
?>
