<?php
session_start();

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Désactivation du cache pour éviter les résultats périmés
if (isset($_GET['search_term'])) {
    $searchTerm = '%' . $_GET['search_term'] . '%';

    // Utilisation de COLLATE pour ignorer les accents
    $sql = "SELECT typeAnimals 
            FROM animals 
            WHERE typeAnimals LIKE :search_term COLLATE utf8mb4_general_ci 
            LIMIT 10";

    $stmt = $conn->prepare($sql);
    $stmt->execute(['search_term' => $searchTerm]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        foreach ($results as $product) {
            // Nettoyage du nom du produit pour éviter les guillemets indésirables
            $cleanedProductName = str_replace('"', '', $product['nameAnimals']);
            $cleanedProductName = htmlspecialchars($cleanedProductName, ENT_QUOTES, 'UTF-8');

            // Génération des options
            echo '<option value="' . $cleanedProductName . '" data-id="' . htmlspecialchars($product['idAnimals'], ENT_QUOTES, 'UTF-8') . '">' . $cleanedProductName . '</option>';
        }
    } else {
        echo '<option value="">Aucun produit trouvé.</option>';
    }
} else {
    echo '<option value="">Termes de recherche manquants.</option>';
}