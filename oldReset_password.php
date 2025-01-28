<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    include 'bdd.php';

    $token = htmlspecialchars(trim($_POST['token']));//token unique pour réinitialiser le mot de passe
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);   

    // Validation des entrées
    if ($new_password !== $confirm_password){
        echo "<p style='color: red;'>Les mots de passe ne correspondent pas</p>";
        exit;
    }
    if (strlen($new_password) < 8){
        echo "<p style='color: red;'>Le mot de passe doit contenir au moins 8 caractères</p>";
        exit;
    }

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier le token avec la date d'expiration
        $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = :token AND expires_at > NOW()");
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        if ($stmt->rowCount() > 0){
            $email = $stmt->fetchColumn();

            // Mettre à jour le mot de passe
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $conn->prepare("UPDATE users SET password = :password WHERE email = :email")
                ->execute(['password' => $hashed_password, 'email' => $email]);

            // Supprimer le token utilisé
            $conn->prepare("DELETE FROM password_resets WHERE token = :token")
                ->execute(['token' => $token]);

            // Redirection après succès
            header('Location: connexion.php');
            exit;
        } else {
            echo "<p style='color: red;'>Le lien est invalide ou a expiré</p>";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else if (isset($_GET['token'])){
    $token = htmlspecialchars($_GET['token']);
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="login-container">
    <div class="form-container">
        <h2>Réinitialiser votre mot de passe</h2>
        <form action="oldReset_password.php" method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token); ?>">
            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" id="new_password" name="new_password" placeholder="Nouveau mot de passe" required>
            <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmer le nouveau mot de passe" required>
            <button type="submit">Réinitialiser</button>
        </form>
    </div>
</div>

<p>Retour à la <a href="connexion.php">page de connexion</a></p>
</body>
</html>