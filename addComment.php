<?php

date_default_timezone_set('Europe/Paris');

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nameAnimals = $_POST['nameAnimals'];
    $firstname = $_POST['firstname'];
    $comment = $_POST['comment'];
    $note = intval($_POST['note']);

    if($note < 1 || $note > 5) {
        echo "La note doit être comprise entre 1 et 5";
        exit;
    }

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $comment = $_POST['comment'];
    $id = $_POST['id'];

    $stmt = $conn->prepare("INSERT INTO comments (nameAnimals, firstname, comment, note) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nameAnimals, $firstname, $comment, $note]);

    header("Location: index.php?");
    exit;
}
?>