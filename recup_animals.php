<?php
include 'bdd.php';

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

header('Content-Type: text/html; charset=UTF-8');

if (!isset($_GET['search_term']) || empty(trim($_GET['search_term']))) {
    http_response_code(400);
    echo '<option value="">Termes de recherche manquants.</option>';
    exit;
}

$searchTerm = '%' . trim($_GET['search_term']) . '%';

$sql = "SELECT nameAnimals FROM animals WHERE nameAnimals LIKE :search_term LIMIT 10";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare($sql);
$stmt->execute(['search_term' => $searchTerm]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
    foreach ($results as $product) {
        echo '<option value="' . htmlspecialchars($product['nameAnimals'], ENT_QUOTES, 'UTF-8') . '"></option>';
    }
} else {
    echo '<option value="">Aucun produit trouvé.</option>';
}
?>