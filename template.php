<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de tout le Monde </title>
    <link rel="stylesheet" href="Css_Acceuil.css">
    
</head>
<body>
<header>
    <div class="header-container">
        <img src="Logo.png" alt="Logo" style="width: 175px; height: auto;">
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
<div class="main-acc">
            <div class="section1">
                <p class="texte_classement">Le meilleur Tower-Defense de l'année</p>
                
                <p class="details">ebhgrhvbgelzgbelzrbvlezgrblezbgzlebvrgblezgerbrfyuvbrlub</p>
            </div>
            <div class="section2">
                <img src = "paysage.jpg" class = "imageAcc"></img>
            </div>
        </div>
    </main>

<footer>
    <p>Mentions légales site</p>
</footer>

</body>
</html>