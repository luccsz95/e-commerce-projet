<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin.html");
    exit();
}

// Récupération du nom d'utilisateur
$username = isset($_SESSION['admin']) ? $_SESSION['admin'] : 'Utilisateur';

echo "<h1>Bienvenue, $username !</h1>";

// Connexion à la base de données
include "bdd.php";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer toutes les tables de la base de données
    $stmt = $conn->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_NUM);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>


<h2>Liste des tables dans la base de données "<?php echo $dbname; ?>"</h2>

<?php
if ($tables) {
    foreach ($tables as $table) {
        $tableName = $table[0];
        echo "<h3>Table : $tableName</h3>";

        // Récupérer les colonnes et les enregistrements de chaque table
        $stmt = $conn->query("SELECT * FROM $tableName");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($rows) {
            // Afficher les en-têtes de colonne
            echo "<table>";
            echo "<tr>";
            foreach (array_keys($rows[0]) as $column) {
                echo "<th>$column</th>";
            }
            echo "<th>Actions</th>"; // Ajouter la colonne "Actions" pour modifier/supprimer
            echo "</tr>";

            // Afficher les données de la table
            foreach ($rows as $row) {
                echo "<tr>";
                foreach ($row as $data) {
                    echo "<td>$data</td>";
                }

                // Ajouter des boutons pour modifier et supprimer
                echo "<td>";
                $idColumn = array_keys($rows[0])[0]; // Prendre la première colonne qui est généralement l'ID
                echo "<a href='edit.php?table=$tableName&id={$row[$idColumn]}'>Modifier</a> | ";
                echo "<a href='delete.php?table=$tableName&id={$row[$idColumn]}' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet enregistrement ?\");'>Supprimer</a>";
                echo "</td>";

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucune donnée disponible dans la table $tableName.</p>";
        }

        // Ajouter un lien pour ajouter un nouvel enregistrement
        echo "<p><a href='create.php?table=$tableName'>Ajouter un nouvel enregistrement</a></p>";
    }
} else {
    echo "<p>Aucune table trouvée dans la base de données.</p>";
}

// Fermer la connexion
$conn = null;
?>
</body>
</html>