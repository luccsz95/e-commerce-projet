<?php
// connexion.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start(); // Démarrer la session pour accéder aux variables de session
    session_regenerate_id(true); // Régénérer l'ID de session pour éviter les attaques de fixation de session

    if (isset($_SESSION['user_id'])) {
        $idUsers = $_SESSION['user_id'];
    } else {
        echo "l'opération à échoué";
    }

    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $servername = "localhost";
    $dbname = "e_commerce_project";
    $dbusername = "root";
    $dbpassword = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user['etat_du_token'] == 0) {
                echo "<p style='color: red;'>Votre compte n'est pas activé. Veuillez vérifier vos emails pour l'activer.</p>";
                exit;
            }

            // Debugging lines
            /*echo "<p>Mot de passe saisi : $password</p>";
            echo "<p>Mot de passe haché : " . $user['password'] . "</p>";*/

            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT password FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $hashed_password = $stmt->fetchColumn();

            if ($hashed_password && password_verify($password, $hashed_password)) {
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['email'] = $email;
                $_SESSION['idUser'] = $user['idUser'];

                echo "<p style='color: green;'>Connexion réussie !</p>";

                /*var_dump($_SESSION); // Debugging
                die();*/
                header("Location: index.php");
                exit();
            } else {
                echo "<p style='color: red;'>Mot de passe incorrect</p>";
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
            <a class="logo-link" href="index.php"><img src="image/logo_chat.png" alt="logo" style="height: 100px; width:100px;"></a>
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

        <p>Pas encore inscrit ? <a href="vue_inscription.php">Inscrivez-vous ici</a></p>
        <p>Mot de passe oublié ? <a href="reset_password.html">Cliquez ici</a></p>
    </div>

</body>

</html>