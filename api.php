<?php
include 'bdd.php';

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);

$getTableDB = $pdo->query('show tables;')->fetchAll(PDO::FETCH_COLUMN);

foreach ($getTableDB as $table) {
    $sqlQuery = $pdo->query('select * from ' . $table);
    $sqlStock = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
    $data[$table] = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($sqlStock);
}
?>