<?php
include 'bdd.php';

date_default_timezone_set('Europe/Paris');

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM password_resets WHERE expires_at  < NOW() - INTERVAL 1 MINUTE"); 
        $stmt->execute();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email"); 
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            //génération du token
            $token = bin2hex(random_bytes(32));
            //expiration du token de 15 minutes
            $expires_at = date('Y-m-d H:i:s', strtotime('+15 minutes'));
            //enregistrer le token dans la base de données
            $conn->prepare("INSERT INTO password_resets (email, token, expires_at, created_at) VALUES (:email, :token, :expires_at, NOW())")
            ->execute([':email' => $email, ':token' => $token, ':expires_at' => $expires_at]);
                $resetLink = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . "/oldReset_password.php?token=$token";

                $subject = "=?UTF-8?B?" . base64_encode("Réinitialisation du mot de passe") . "?=";

                $message = "
                    <html>
                        <head>
                            <title>Réinitialisation du mot de passe</title>
                        </head>
                        <body>
                            <p>Vous avez demandé une réinitialisation de votre mot de passe.</p>
                            <p>Cliquez sur le lien suivant pour réinitialiser votre mot de passe :</p>
                            <p><a href='$resetLink'>Cliquez ici</a></p> 
                            <p>Le lien expirera dans 15 minutes.</p>
                            <p>Si vous n'avez pas demandé de réinitialisation de mot de passe, veuillez ignorer cet email.</p>
                        </body>
                    </html> 
                ";

                $headers = "From: no-replay@" . $_SERVER['HTTP_HOST'] . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $headers .= "Content-Transfer-Encoding: 8bit\r\n";

                if (mail($email, $subject, $message, $headers)) {
                    echo "<p style='color: green;'>Un email de réinitialisation de mot de passe vous a été envoyé.</p>";
                }
                else {
                    echo "<p style='color: red;'>Aucun utilisateur trouvé avec cet email.</p>";
                } 
            }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réinitialisation du mot de passe</title>
</head>
<body>
<div class="signup">
    <h2>Mot de passe oublié</h2>
    <form action="reset_password_request.php" method="POST">
        <label for="email">Entrer votre mail :</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="submit" value="Envoyer">
    </form>
</div>

<p>Retour à la <a href="connexion.php">page de connexion</a></p>
</body>
</html>