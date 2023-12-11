<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de tout le Monde </title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

header {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px 0;
}

h1 {
    font-size: 28px;
}

nav {
    background-color: #333;
    text-align: center;
}

nav a {
    text-decoration: none;
    color: #fff;
    padding: 10px 20px;
}

nav a:hover {
    background-color: #ff6600;
    padding: 5px 20px;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
}

main {
    flex: 1;
}
    </style>

    </style>
</head>
<body>
<header>
    <div style="text-align: center;"> 
        <h1>Site de tout le monde</h1></div>
        <nav> 
    <?php
        $menuComponent->affiche();
        ?>
        </nav>
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
    <p>Tout le monde / Informations légales</p>
</footer>

</body>
</html>