<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin.html");
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si les paramètres sont définis
    if (isset($_GET['table']) && isset($_GET['primaryKey']) && isset($_GET['id'])) {
        $table = $_GET['table'];
        $primaryKey = $_GET['primaryKey'];
        $id = $_GET['id'];

        // Récupérer les données de l'enregistrement à modifier
        $stmt = $conn->prepare("SELECT * FROM $table WHERE $primaryKey = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$record) {
            echo "Erreur : Enregistrement non trouvé.";
            exit();
        }

        // Mettre à jour l'enregistrement si le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $columns = array_keys($record);
            $updateFields = [];
            foreach ($columns as $column) {
                if (isset($_POST[$column])) {
                    $updateFields[] = "$column = :$column";
                }
            }
            $updateQuery = "UPDATE $table SET " . implode(', ', $updateFields) . " WHERE $primaryKey = :id";
            $stmt = $conn->prepare($updateQuery);
            foreach ($columns as $column) {
                if (isset($_POST[$column])) {
                    $stmt->bindParam(":$column", $_POST[$column]);
                }
            }
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            echo "Enregistrement mis à jour avec succès.";
            exit();
        }
    } else {
        echo "Erreur : Paramètres manquants.";
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'enregistrement</title>
</head>
<body>

<h2>Modifier l'enregistrement</h2>

<form method="post">
    <?php foreach ($record as $column => $value): ?>
        <label for="<?php echo $column; ?>"><?php echo $column; ?>:</label>
        <input type="text" name="<?php echo $column; ?>" id="<?php echo $column; ?>" value="<?php echo htmlspecialchars($value); ?>">
        <br>
    <?php endforeach; ?>
    <button type="submit">Mettre à jour</button>
</form>

</body>
</html>