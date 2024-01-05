<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de tout le Monde </title>
    <link rel="stylesheet" href="Css_template.css">
    
</head>
<body>
<header>
    <div class="header-container">
        <img src="images/Logo.png" alt="Logo" style="width: 175px; height: auto;">
        <nav>
            <?php
            $menuComponent->affiche();
            ?>
        </nav>
    </div>
</header>
        <main>
        <?php
        if (isset($_SESSION['msg'])) {
            echo "<div style=\"color:green\">" . $_SESSION['msg'] . "</div><br>";
            unset($_SESSION['msg']);
        }
    echo $tampon;
?>
    </main>

<footer>
    <p>Mentions légales site</p>
</footer>

</body>
</html>