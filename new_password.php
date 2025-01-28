<?php
$token = htmlspecialchars(trim($_GET['token']));
var_dump($token);
// if($_SERVER['REQUEST_METHOD'] == 'POST') {


$new_password = trim($_POST['newPassword']);
$confirm_password = trim($_POST['password_confirm']);

echo "Le token est : " . htmlspecialchars($token);

if($new_password !== $confirm_password){
    echo"<p style='color: red;'>Le mot de passe ne correspond pas.</p>";
    exit;
}

if(strlen($new_password) < 8 ){
    echo"<p style='color: red;'>Le mot de passe  doit contenir au moins 8 caractères.</p>";
    exit;
}

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = :token AND expires_at > NOW()");
$stmt ->bindParam(':token', $token);
$stmt->execute();


if($stmt->rowCount() > 0){
    $email = $stmt->fetchColumn();
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $conn->prepare("UPDATE users SET password = :password WHERE email = :email")->execute(['password' => $hashed_password, 'email' => $email]);
    $conn->prepare("DELETE FROM password_resets WHERE token = :token ")
        ->execute(['token' => $token]);
}
if ($stmt->execute()) {
    echo "<p style='color: green;'>Votre mot de passe a été réinitialisé avec succès !</p>";
} else {
    echo "<p style='color: red;'>Une erreur est survenue lors de la réinitialisation de votre mot de passe. Veuillez réessayer.</p>";

}
