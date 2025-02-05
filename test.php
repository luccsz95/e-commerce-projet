<?php
session_start();
$captcha = random_int(10000,99999);
$_SESSION['captcha'] = $captcha;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>

<body>

<style>
    .signup-container{
        display: flex;
        justify-content: space-around;
        flex-direction: row;
        align-items: center;
        height: 100vh;
    }

    body{
        background: linear-gradient(rgba(247, 244, 244, 0.733), rgba(242, 241, 241, 0.696)), no-repeat, fixed
        url(img/DALL·E\ 2024-11-29\ 13.29.03\ -\ A\ vibrant\ and\ colorful\ image\ showcasing\ various\ video\ games\ integrated\ into\ a\ single\ scene.\ The\ image\ includes\ a\ retro\ arcade\ machine\ with\ a\ glowing\ s.webp);
    }

    .titre-signup{
        text-align: center;
        margin-bottom: 20px;
        color: #333;
        width: 37vw;
    }

    label {
        margin-top: 5px;
        color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        display: flex;
        justify-content: center;
        width: 50%;
        padding: 3px;
        margin: 0 auto;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 12px;
    }

    input[type="submit"] {
        width: 50%;
        padding: 10px;
        background-color: #5cb85c;
        color: white;
        border: none;
        border-radius: 5px;
        margin-top: 20px;
        cursor: pointer;
    }

    .captcha{
        font-family: 'Impact', sans-serif;
        font-size: 30px;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 2px;
        background-color: #f3f3f3;
        padding: 5px;
        border-radius: 5px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        width: 200px;
        /*changement de css*/
        margin: 0 auto; /* Centre horizontalement */
        display: flex;
        justify-content: center;
    }

</style>

<div class="signup-container">
    <div class="fond-img">
        <img src="img/signup.avif" alt="login">
    </div>
    <div class="titre-signup">
        <h2 style="color: rgb(181, 3, 3); margin-bottom: 60px; font-size: 50px"> <i class='bx bx-user'></i> &nbsp;Inscription <i class='bx bx-user'></i></h2>

        <form action="signup.php" method="POST" onsubmit="return validateForm()">
            <label for="nom">Nom d'utilisateur :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirmer le mot de passe :</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
            <label  for="capchat">Veuillez remplir le Captcha:</label>
            <div class="captcha">
                <?php echo $_SESSION ['captcha']?>
            </div>
            <label for="captcha">
                <input type="text" id="captcha" name="captcha" required>
                <input type="submit" value="S'inscrire">
        </form>
    </div>
    <p id="error-msg"></p>
</div>

<script>
    function validateForm() {
        var mdp = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm-password").value;
        var errorMsg = document.getElementById("error-msg");

        if (mdp !== confirmPassword) {
            errorMsg.textContent = "Les mots de passe ne correspondent pas.";
            errorMsg.style.color = "red";
            return false;
        }
        return true;
    }
</script>
<!-- <?php
include 'footer.php'
?> -->

</html>
</body>

</html>