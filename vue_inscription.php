<?php
session_start();

$captcha = random_int(10000, 99999);
$_SESSION['captcha'] = $captcha;

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'incription</title>
    <link rel="stylesheet" href="style/inscription.css">
</head>
<body>

<div class="">
    <div class="header">
        <a class="logo-link" href="index.php"><img src="image/logo_chat.png" alt="logo" style="height: 100px; width:100px;"></a>
    </div>
</div>

<div class="signup">
    <h2>Inscription</h2>
    <form action="inscription.php" method="POST" onsubmit="return validateform()">
        <label for="lastname">Nom de famille</label>
        <input type="text" name="lastname" id="lastname" placeholder="Nom de famille" required>

        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" placeholder="Prénom" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>

        <label for="phonenumber">Numéro de téléphone</label>
        <input type="text" name="phonenumber" id="phonenumber" placeholder="Numéro de téléphone" maxlength="10" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required>

        <label for="confirm-password">Confirmer le mot de passe</label>
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirmer le mot de passe" required>

        <label for="captcha">Recopier le code</label>
        <div class="captcha"><?php echo $_SESSION['captcha']; ?></div>
        <input type="text" name="captcha" id="captcha" placeholder="Recopier le code" required>

        <input type="submit" value="S'inscrire">
        <p>Déjà un compte ? <a href="connexion.php">Connectez-vous ici</a></p>

    </form>

    <p id="error-msg"></p>
</div>

<script>
    function validateform() {
        var lastname = document.getElementById('lastname').value;
        var firstname = document.getElementById('firstname').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirm_password = document.getElementById('confirm-password').value;
        var phonenumber = document.getElementById('phonenumber').value;

        if (lastname == "" || firstname == "" || email == "" || password == "" || confirm_password == "" || phonenumber == "") {
            document.getElementById('error-msg').innerHTML = "Tous les champs sont obligatoires";
            return false;
        }

        if (password != confirm_password) {
            document.getElementById('error-msg').innerHTML = "Les mots de passe ne correspondent pas";
            errorMSG.style.color = "red";
            return false;
        }

        return true;
    }
</script>
</body>
</html>
