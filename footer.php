<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Appliquer un style de base pour le corps */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        /* Le contenu principal doit prendre tout l'espace disponible avant le footer */
        .content {
            flex: 1;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        /* Style du footer */
        .footer {
            background-color: #2c7b2f;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-family: Arial, sans-serif;
            width: 100%; / S'assurer que le footer prend toute la largeur /
            position: relative; / Position relative pour le footer /
            bottom: 0; / Positionner en bas /
        }

        /* Style des liens dans le footer */
        .footer a {
            color: white;
            text-decoration: none;
            padding: 0 10px;
        }

        /* Changement de couleur au survol des liens */
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Contenu principal -->
<div class="content">
    <h1></h1>
    <p></p>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Lucas. Tous droits réservés.</p>
    <p class="footer-links">
        <a href="privacy.php">Politique de confidentialité</a> |
        <a href="terms.php">Conditions d'utilisation</a>
    </p>
</div>

</body>
</html>