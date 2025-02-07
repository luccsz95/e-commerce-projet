<?php
session_start(); // Démarrer la session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $hash = hash('sha256', $password);

    // Connexion à la base de données

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



            // Vérifier le mot de passe
            if (strcmp($hash, $admin['password']) == 0) {
                // Si le mot de passe est correct, connecter l'utilisateur en tant qu'admin
                $_SESSION['admin'] = $admin['firstname']; // Stocker l'utilisateur dans la session
                echo "<p style='color: green;'>Connexion réussie !</p>";
                //echo $_SESSION['admin'];
                // Rediriger vers le tableau de bord admin
                header("Location: index.php");
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

    // Fermer la connexion
    $conn = null;
}
?>
