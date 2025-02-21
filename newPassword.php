<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    //var_dump($token);
} else {
    // Rediriger ou afficher un message d'erreur si le token est absent
    die('Token manquant.');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
</head>
<body>

<style>
    /* Reset global */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        color: #343a40;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    /* Conteneur principal */
    form {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    /* Titre */
    h2 {
        color: #343a40;
        margin-bottom: 15px;
        font-size: 22px;
    }

    /* Labels */
    label {
        font-size: 16px;
        display: block;
        margin-bottom: 8px;
        text-align: left;
    }

    /* Champs de saisie */
    input[type="password"] {
        width: 90%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        font-size: 14px;
        outline: none;
        text-align: center; /* Centre le texte et le placeholder */
    }

    /* Placeholder stylisé */
    input[type="password"]::placeholder {
        color: #adb5bd;
    }

    /* Bouton */
    input[type="submit"] {
        background-color: #2E7D32;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    input[type="submit"]:hover {
        background-color: #255d27;
        transform: scale(1.05);
    }

    label {
        display: flex;
        justify-content: center;
    }

    /* Responsive */
    @media (max-width: 480px) {
        form {
            max-width: 90%;
        }
    }

</style>

<?php echo '<form action="new_password.php?token=' . urlencode($token) . '" method="POST">';?>
    <h2>Entrez votre nouveau mot de passe</h2>
    <label for="password">Entrez votre nouveau mot de passe :</label>
    <input type="password" id="newPassword" name="newPassword" required placeholder="Votre nouveau mot de passe">
    <br><br>
    <label for="password_confirm">Confirmez votre nouveau mot de passe :</label>
    <input type="password" id="password_confirm" name="password_confirm" required placeholder="Confirmez votre nouveau mot de passe">
    <br><br>
    <input type="submit" value="Réinitialiser votre mot de passe">
</body>
</html>