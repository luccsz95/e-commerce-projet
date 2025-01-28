<?php
// connexion.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start(); // Démarrer la session pour accéder aux variables de session

    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    include 'bdd.php';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                // Stocker le prénom dans la session
                $_SESSION['firstname'] = $user['firstname'];
                echo "<p style='color: green;'>Connexion réussie !</p>";
                header("Location: index.php");
                exit();
            } else {
                echo "<p style='color: red;'>Mot de passe incorrect.</p>";
            }
        } else {
            echo "<p style='color: red;'>Utilisateur non trouvé.</p>";
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
    <link rel="stylesheet" href="style/inscription.css">
    <title>Page de connexion</title>
</head>
<body>

<div class="">
    <div class="header">
        <a class="logo-link" href="index.php"><img src="images/Image_immeuble.jpg" alt="logo"></a>
    </div>
</div>

<div class="signup">
    <h2>Connexion</h2>
    <form action="connexion.php" method="POST">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" placeholder="Email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required>

        <input type="submit" value="Se connecter">
    </form>

    <p>Pas encore inscrit ? <a href="inscription.html">Inscrivez-vous ici</a></p>
    <p>Oubli de mot de passe ? <a href="reset_password_request.php">Cliquez ici</a></p>
</div>

</body>
</html>