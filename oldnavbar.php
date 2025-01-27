<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Navbar</title>
</head>
<body>
<nav class="navbar">

    <a class="logo-link" href="index.php"><img src="image/Image_immeuble.jpg" class="logo-img" alt="logo"></a>

   <?php
/*    if (isset($tab_firstname)) {
        echo "<h2 class=\"greatings\">Bonjour " . $tab_firstname[0]["firstname"] . "</h2>";
    } elseif (isset($firstname)) {
        echo "<h2 class=\"greatings\">Bonjour " . $firstname . "</h2>";
    }
    */?>

    <form class="search-form" role="search">
        <input class="nav-search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn-search" type="submit">Search</button>
    </form>

    <form action="Vue/login.html">
        <button class="btn-login"type="submit">Log in</button>
    </form>

</nav>
</body>
</html>