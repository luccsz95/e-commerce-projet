<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: connexion.php");
    exit;
}

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$email = $_SESSION["email"];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT idUser, firstname, lastname, email, phonenumber FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['idUser'];

        $stmt = $conn->prepare("SELECT adresseUsers FROM adresse WHERE idUsers = :idUsers");
        $stmt->bindParam(':idUsers', $user['idUser']);
        $stmt->execute();
        $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Utilisateur introuvable";
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
</head>

<body>
    <style>
        /* Style global */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Conteneur principal */
        .container {
            flex: 1;
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Titre */
        h1 {
            color: #2c7b2f;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Informations utilisateur */
        .container p {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }

        /* Lien de modification */
        .information {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #2c7b2f;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            transition: background 0.3s;
        }

        a:hover {
            background-color: #1f5a21;
        }

        /* 🟢 RESPONSIVE DESIGN 🟢 */
        @media screen and (max-width: 768px) {
            .container {
                max-width: 90%;
                margin: 20px auto;
                padding: 15px;
            }

            h1 {
                font-size: 22px;
            }

            p {
                font-size: 16px;
            }

            .information {
                font-size: 14px;
                padding: 8px 12px;
            }
        }

        @media screen and (max-width: 480px) {
            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }

            .information {
                font-size: 12px;
                padding: 6px 10px;
            }
        }

    </style>

    <?php include "navbar.php" ?>
    <br><br><br><br><br><br><br>

    <div class="container">
        <h1>Mon Profil</h1>
        <p><strong>Nom :</strong> <?php echo htmlspecialchars($user['lastname']); ?></p>
        <p><strong>Prénom :</strong> <?php echo htmlspecialchars($user['firstname']); ?></p>
        <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Numéro de téléphone :</strong> <?php echo htmlspecialchars($user['phonenumber']); ?></p>
        <p><strong>Adresses :</strong></p>
        <ul>
            <?php foreach ($addresses as $address): ?>
                <li><?php echo htmlspecialchars($address['adresseUsers']); ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="account.php" class="information">Modifier mes informations</a>
    </div>

    <?php include "footer.php" ?>

</body>

</html>