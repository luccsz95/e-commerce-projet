<?php
session_start();

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idUsers = $_SESSION['idUser'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $fullAddress = $address . ', ' . $city . ', ' . $zip;

        $stmt = $conn->prepare("INSERT INTO adresse (idUsers, adresseUsers) VALUES (:idUsers, :adresseUsers);");
        $stmt->bindParam(':idUsers', $idUsers);
        $stmt->bindParam(':adresseUsers', $fullAddress);
        $stmt->execute();

        header("Location: checkout.php");
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entrer votre adresse</title>
</head>
<body>

<style>
    /* ✅ Style général */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        text-align: center;
    }

    /* ✅ Conteneur du formulaire */
    .add-adresses-form {
        background: white;
        max-width: 400px;
        margin: 30px auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* ✅ Style des labels */
    label {
        display: block;
        font-weight: bold;
        margin: 10px 0 5px;
        font-size: 14px;
    }

    /* ✅ Champs de saisie */
    input[type="text"] {
        width: 70%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    /* ✅ Bouton Valider */
    input[type="submit"] {
        background-color: #2e7d32;
        color: white;
        padding: 10px 15px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
        margin-top: 15px;
    }

    /* ✅ Effet hover */
    input[type="submit"]:hover {
        background-color: #1b5e20;
        transform: scale(1.05);
    }

    /* ✅ Responsive */
    @media (max-width: 600px) {
        form {
            width: 90%;
            padding: 15px;
        }

        input[type="text"] {
            font-size: 12px;
        }

        input[type="submit"] {
            font-size: 14px;
        }
    }

</style>

<?php include'navbar.php'?>
<br><br><br><br><br><br><br>
    <h1>Entrer votre adresse</h1>
    <form class="add-adresses-form" action="adresseUsers.php" method="post">
        <input type="hidden" name="idUsers" value="<?php echo $_SESSION['idUser']; ?>">

        <label for="address">Adresse</label>
        <input type="text" name="address" id="address" required>

        <label for="city">Ville</label>
        <input type="text" name="city" id="city" required>

        <label for="zip">Code postal</label>
        <input type="text" name="zip" id="zip" required>

        <input type="submit" value="Valider">
    </form>
<?php include'footer.php'?>
</body>
</html>
