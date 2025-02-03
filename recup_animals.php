<?php
$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $stmt = $conn->prepare("SELECT typeAnimals FROM animals WHERE typeAnimals LIKE :search");
    $search = '%' . $search . '%';
    $stmt->bindParam(':search', $search, PDO::PARAM_STR); // Ajout du ":" manquant
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($results); // Placer ici pour envoyer une réponse correcte en JSON

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
