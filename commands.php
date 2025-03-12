<?php
session_start();
session_regenerate_id(true); // Regenerate session ID to prevent session fixation attacks

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$idUser = $_SESSION['user_id'];
$cart = $_SESSION['cart'];
$amount = $_SESSION['total_price'];
$idAdresse = $_SESSION['idAdresse'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $conn->prepare("INSERT INTO command (idUsers, amount) VALUES (:idUsers, :amount)");
    $sql->execute([
        'idUsers' => $idUser,
        'amount' => $amount
    ]);

    $idCommand = $conn->lastInsertId();

    $sqlDetails = $conn->prepare("INSERT INTO command_details (idCommand, idAnimals, idAdresse, quantity) VALUES (:idCommand, :idAnimals, :idAdresse, :quantity)");

    foreach ($cart as $item) {
        $sqlDetails->execute([
            'idCommand' => $idCommand,
            'idAnimals' => $item['product_id'],
            'idAdresse' => $idAdresse,
            'quantity' => $item['quantity']
        ]);
    }

    // Clear the cart after inserting the order details
    $_SESSION['cart'] = [];
    $_SESSION['total_price'] = 0;

    // Send confirmation email
    $stmt = $conn->prepare("SELECT email FROM users WHERE idUser = :idUser");
    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $email = $user['email'];
        $mail = new PHPMailer(true);

        try {
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
            $mail->Subject = 'Confirmation de commande';
            $mail->Body = "Bonjour,<br>Votre commande a été validée avec succès. Merci pour votre achat.<br>Montant total : $amount €";

            $mail->send();
            error_log("E-mail de confirmation envoyé avec succès à $email.");
        } catch (Exception $e) {
            error_log("Erreur lors de l'envoi de l'e-mail: {$mail->ErrorInfo}");
        }
    }

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php include "navbar.php"?>
    <h1>Commande validée avec succès !</h1>
    <p>Merci pour votre achat. Vous recevrez un email de confirmation sous peu.</p>
</body>
</html>