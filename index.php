<?php
    session_start(); // Démarrer la session pour accéder aux variables de session

    $servername = "localhost";
    $dbname = "e_commerce_project";
    $dbusername = "root";
    $dbpassword = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch the top 3 rated animals based on average rating from comments
        $query = "
            SELECT a.*, AVG(c.note) as avg_note
            FROM animals a
            LEFT JOIN comments c ON a.nameAnimals = c.nameAnimals
            GROUP BY a.nameAnimals
            ORDER BY avg_note DESC
            LIMIT 3
        ";
        $result = $conn->query($query);
        $topAnimals = $result->fetchAll(PDO::FETCH_ASSOC);

        // If there are less than 3 rated animals, fetch random animals to fill the carousel
        if (count($topAnimals) < 3) {
            $needed = 3 - count($topAnimals);
            $query = "
                SELECT a.*
                FROM animals a
                WHERE a.nameAnimals NOT IN (
                    SELECT nameAnimals
                    FROM comments
                    GROUP BY nameAnimals
                    ORDER BY AVG(note) DESC
                    LIMIT 3
                )
                ORDER BY RAND()
                LIMIT $needed
            ";
            $result = $conn->query($query);
            $randomAnimals = $result->fetchAll(PDO::FETCH_ASSOC);
            $topAnimals = array_merge($topAnimals, $randomAnimals);
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        exit;
    }
    ?>
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style/index.css">
        <title>Accueil</title>
    </head>
    <body>

    <?php include 'navbar.php';?>
    <br><br><br><br><br><br><br>

    <?php
    if (isset($_SESSION['firstname'])) {
        echo "<h1 class='title'>Bienvenue " . htmlspecialchars($_SESSION['firstname']) . " !</h1>";
    }
    else {
        echo "<h1 class='title'>Bienvenue sur notre site !</h1>";
    }
    ?>

    <h2 class="subtitle">Découvrez nos peluche favorites !</h2>

    <div class="carousel">
        <?php foreach ($topAnimals as $animal): ?>
            <div class="carousel-item">
                <a href="fiche_produit.php?idAnimals=<?php echo htmlspecialchars($animal['idAnimals']); ?>">
                    <h2><?php echo htmlspecialchars($animal['nameAnimals']); ?></h2>
                    <img class="imageAnimals" src="<?php echo htmlspecialchars($animal['imageAnimals']); ?>" alt="<?php echo htmlspecialchars($animal['nameAnimals']); ?>">
                </a>
                <p>
                    <?php
                    if ($animal['avg_note'] === null) {
                        echo "Aucun avis pour ce produit.";
                    } else {
                        echo "Note moyenne: " . htmlspecialchars(number_format($animal['avg_note'], 1));
                    }
                    ?>
                </p>
            </div>
        <?php endforeach; ?>
        <a class="prev" onclick="change(-1)">&#10094;</a>
        <a class="next" onclick="change(1)">&#10095;</a>
    </div>

    <?php include "footer.php"?>
    
    </body>
    <script src="carousel.js"></script>
    </html>