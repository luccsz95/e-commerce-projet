<?php
session_start(); // Démarrer la session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $servername = "localhost";
    $dbname = "e_commerce_project";
    $dbusername = "root";
    $dbpassword = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si l'utilisateur existe et s'il est admin (id = 0)
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Si l'utilisateur existe et est un admin
        if ($stmt->rowCount() > 0) {
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin'] = $admin['firstname'];
                echo "<p style='color: green;'>Connexion réussie !</p>";
                header("Location: admin_dashboard.php");
                exit();
            } else {
                echo "<p style='color: red;'>Mot de passe incorrect.</p>";
            }

        } else {
            echo "<p style='color: red;'>Utilisateur non trouvé ou identifiant incorrect.</p>";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
}
?>
