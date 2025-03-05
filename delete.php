<?php
    session_start();

    if (!isset($_SESSION['admin'])) {
        header("Location: admin.html");
        exit();
    }

    if (isset($_GET['table']) && isset($_GET['id'])) {
        $table = htmlspecialchars($_GET['table']);
        $id = intval($_GET['id']);

        $servername = "localhost";
        $dbname = "e_commerce_project";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Suppression de l'enregistrement
            $idColumn = 'id' . ucfirst(rtrim($table, 's')); // Générer le nom de la colonne ID
            $stmt = $conn->prepare("DELETE FROM $table WHERE $idColumn = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo "<p style='color: green;'>Enregistrement supprimé avec succès.</p>
            <a href='admin_dashboard.php'>Retour au tableau de bord</a>";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        $conn = null;
    } else {
        echo "<p style='color: red;'>Table ou ID non fourni.</p>";
    }
    ?>