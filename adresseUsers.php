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

<?php include'navbar.php'?>

    <h1>Entrer votre adresse</h1>
    <form action="adresseUsers.php" method="post">
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
