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
            <input type="password" name="password" id="password" placeholder="Mot de passe">
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
            <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirmer le mot de passe">
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

            <?php
/*            if (isset($_SESSION['errorMessage'])) {
                echo $_SESSION['errorMessage'];
                unset($_SESSION['errorMessage']);
            }
            */?>
            <input type="text" name="captcha" id="captcha" placeholder="Recopier le code">
            <input type="submit" name="button" value="S'inscrire">
            <p>Déjà un compte ? <a href="connexion.php">Connectez-vous ici</a></p>

        </form>

        <p id="error-msg"></p>
    </div>

    <script src="validateForm.js"></script>
    <script src="inscription.js"></script>
</body>

<?php include "footer.php"?>

</html>