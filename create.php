<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin.html");
    exit();
}

if (isset($_GET['table'])) {
    $table = htmlspecialchars($_GET['table']);

    $servername = "localhost";
    $dbname = "e_commerce_project";
    $dbusername = "root";
    $dbpassword = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les colonnes de la table
        $stmt = $conn->query("DESCRIBE $table");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [];
            foreach ($columns as $column) {
                if ($column != 'id' . ucfirst(rtrim($table, 's'))) { // Ignorer la colonne ID
                    $data[$column] = htmlspecialchars($_POST[$column]);
                }
            }

            // Construire la requête d'insertion
            $columnsString = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
            $sql = "INSERT INTO $table ($columnsString) VALUES ($placeholders)";
            $stmt = $conn->prepare($sql);

            foreach ($data as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }

            $stmt->execute();
            echo "<p style='color: green;'>Enregistrement ajouté avec succès.</p>
            <a href='admin_dashboard.php'>Retour au tableau de bord</a>";
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
} else {
    echo "<p style='color: red;'>Table non spécifiée.</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un enregistrement</title>
</head>
<body>
    <h2>Ajouter un enregistrement dans la table "<?php echo $table; ?>"</h2>
    <form action="" method="post">
        <?php if (isset($columns)): ?>
            <?php foreach ($columns as $column): ?>
                <?php if ($column != 'id' . ucfirst(rtrim($table, 's'))): // Ignorer la colonne ID ?>
                    <label for="<?php echo $column; ?>"><?php echo ucfirst($column); ?>:</label>
                    <input type="text" name="<?php echo $column; ?>" id="<?php echo $column; ?>" required>
                    <br>
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit">Ajouter</button>
        <?php endif; ?>
    </form>
</body>
</html>