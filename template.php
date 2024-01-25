<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Elphia</title>
    <link rel="stylesheet" href="Css_template.css">
    <link rel="icon" href="LogoCouronne.png" type="image/x-icon">
    
</head>
<body>
<header>
    <div class="header-container">
        <img src="images/Logo.png" alt="Logo" style="width: 175px; height: auto;">
        <nav>
            <button class="menu-btn">&#9776; Menu</button>
            <ul class="nav-list">
                <?php
                $menuComponent->affiche();
                ?>
            </ul>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuBtn = document.querySelector('.menu-btn');
        const navList = document.querySelector('.nav-list');

        menuBtn.addEventListener('click', function () {
            navList.classList.toggle('show');
        });
    });
</script>

    </main>

<footer>
    <p>Site du groupe BOUKEBECHE BOUDIA BOUDJEMAI - Fait en 2023 - 2024</p>
</footer>

</body>
</html>