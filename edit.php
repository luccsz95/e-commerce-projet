<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin.html");
    exit();
}

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$table = isset($_GET['table']) ? htmlspecialchars($_GET['table']) : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Déterminer la clé primaire de la table
$primaryKey = ''; // Valeur par défaut
switch ($table) {
    case 'animals':
        $primaryKey = 'idAnimals';
        break;
    case 'users':
        $primaryKey = 'idUser';
        break;
    case 'adresse':
        $primaryKey = 'idAdresse';
        break;
    // Ajouter d'autres tables ici si nécessaire
    default:
        $primaryKey = 'id'; // Assure-toi que cela est cohérent avec ta base de données
        break;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Construire la requête de mise à jour
        $updateQuery = "UPDATE $table SET ";
        $params = [];
        foreach ($_POST as $column => $value) {
            if ($column != $primaryKey && $column != 'token' && $column != 'token_status') {
                $updateQuery .= "$column = :$column, ";
                $params[":$column"] = htmlspecialchars(trim($value));
            }
        }
        $updateQuery = rtrim($updateQuery, ', ') . " WHERE $primaryKey = :id";
        $params[':id'] = $id;

        $stmt = $conn->prepare($updateQuery);
        $stmt->execute($params);

        echo "<p style='color: green;'>Enregistrement mis à jour avec succès !</p>";
        header("Location: admin_dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Récupérer les données de l'enregistrement à modifier
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM $table WHERE $primaryKey = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$record) {
        echo "<p style='color: red;'>Enregistrement non trouvé.</p>";
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
    <script>
        function confirmUpdate() {
            return confirm("Êtes-vous sûr de vouloir modifier cet enregistrement ?");
        }
    </script>
</head>
<body>
<h1>Modifier l'enregistrement</h1>

<form method="POST" onsubmit="return confirmUpdate();">
    <?php if (isset($record)): ?>
        <?php foreach ($record as $column => $value): ?>
            <?php if ($column != 'token' && $column != 'token_status'): ?>
                <label for="<?php echo htmlspecialchars($column); ?>"><?php echo htmlspecialchars($column); ?>:</label>
                <input type="text" name="<?php echo htmlspecialchars($column); ?>"
                       id="<?php echo htmlspecialchars($column); ?>"
                       value="<?php echo htmlspecialchars($value); ?>" <?php echo $column == $primaryKey ? 'readonly' : ''; ?>>
                <br>
            <?php endif; ?>
        <?php endforeach; ?>
        <button type="submit">Mettre à jour</button>
    <?php else: ?>
        <p style="color: red;">Erreur : Enregistrement non trouvé.</p>
    <?php endif; ?>
</form>

</body>
</html>
