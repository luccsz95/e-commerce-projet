<?php
session_start();

/*$captcha = random_int(10000, 99999);
$_SESSION['captcha'] = $captcha;*/

function createCaptcha($lenght = 5)
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ?!$%&*@#";
    $captchaCode = substr(str_shuffle($characters), 0, $lenght);
    return $captchaCode;
}

$getCaptchaCode = createCaptcha();
$_SESSION['captcha'] = $getCaptchaCode;

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
        <form action="inscription.php" method="POST" onsubmit="return validateform()" id="validate_form">
            <label for="lastname">Nom de famille</label>
            <input type="text" name="lastname" id="lastname" placeholder="Nom de famille">

            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" placeholder="Prénom">

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email">

            <label for="phonenumber">Numéro de téléphone</label>
            <input type="text" name="phonenumber" id="phonenumber" placeholder="Numéro de téléphone" maxlength="10">

            <label for="password">Mot de passe</label>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Mot de passe">
                <button type="button" id="togglePassword">
                    <img src="image/afficher_mdp.png" alt="Afficher" id="togglePasswordIcon">
                </button>
            </div>

            <div class="force_password" id="force_password"></div>

            <div id="password-requirements">
                <ul class="list-unstyled">
                    <li id="caracteres" class="invalid">Au moins 8 caractères</li>
                    <li id="maj" class="invalid">Une majuscule</li>
                    <li id="chiffre" class="invalid">Un chiffre</li>
                    <li id="special" class="invalid">Un caractère spécial</li>
                </ul>
            </div>

            <label for="confirm-password">Confirmer le mot de passe</label>
            <div class="password-container">
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirmer le mot de passe">
                <button type="button" id="toggleConfirmPassword">
                    <img src="image/afficher_mdp.png" alt="Afficher" id="toggleConfirmPasswordIcon">
                </button>
            </div>

            <div class="password_confirm"></div>

            <label for="captcha">Recopier le code</label>
            <div class="captcha">
                <?php
                $captcha_move = str_split($_SESSION['captcha']);
                foreach ($captcha_move as $char) {
                    echo "<span>" . $char . "</span>";
                }
                ?>
            </div>

            <input type="text" name="captcha" id="captcha" placeholder="Recopier le code">
            <input type="submit" name="button" class="insc-btn" value="S'inscrire">
            <p>Déjà un compte ? <a href="connexion.php">Connectez-vous ici</a></p>

        </form>

        <p id="error-msg"></p>
    </div>

    <script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const passwordIcon = document.getElementById('togglePasswordIcon');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        passwordIcon.src = type === 'password' ? 'image/afficher_mdp.png' : 'image/cacher_mdp.png';
        passwordIcon.alt = type === 'password' ? 'Afficher' : 'Cacher';
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        const confirmPasswordField = document.getElementById('confirm-password');
        const confirmPasswordIcon = document.getElementById('toggleConfirmPasswordIcon');
        const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordField.setAttribute('type', type);
        confirmPasswordIcon.src = type === 'password' ? 'image/afficher_mdp.png' : 'image/cacher_mdp.png';
        confirmPasswordIcon.alt = type === 'password' ? 'Afficher' : 'Cacher';
    });
    </script>
    <script src="validateForm.js"></script>
    <script src="inscription.js"></script>
</body>

</html>