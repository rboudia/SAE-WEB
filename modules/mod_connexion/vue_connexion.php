<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titre de votre page</title>
    <link rel="stylesheet" type="text/css" href="Css.css">
</head>
<body>

<?php
require_once 'vue_generique.php';

class VueConnexion extends VueGenerique {
    public function form_inscription() {
        ?>
        <div>
            <h2>Inscription</h2>
            <?php if(isset($_SESSION['erreur'])){
                ?>
                <div style="color:red"><?=$_SESSION['erreur']?></div><br>
                <?php
                unset($_SESSION['erreur']);
            }
            ?>
            <form method="post" action="index.php?module=connexion&action=inscription">
                Nom d'utilisateur : <input type="text" name="login" required><br>
                Mot de passe : <input type="password" name="mdp" required><br>
                <input type="submit" value="S'inscrire">
            </form>
        </div>
        <?php
    }

    public function form_connexion() {
        if (isset($_SESSION['user'])) {
            $utilisateur = $_SESSION['user'];
            ?>
            <div>
                <li>Vous êtes déjà connecté sous l'identifiant <?= $utilisateur['login'] ?> !</li>
                <li><a href="index.php?module=connexion&action=deconnexion">Déconnexion</a></li>
            </div>
            <?php
        } else {
            ?>
            <div>

                <h2 class="connexion">Connexion</h2>
                <?php if(isset($_SESSION['erreur'])){
                    ?>
                    <div style="color:red"><?=$_SESSION['erreur']?></div><br>
                    <?php
                    unset($_SESSION['erreur']);
                }
                ?>
                <form method="post" action="index.php?module=connexion&action=connexion">
                    Nom d'utilisateur : <input type="text" name="login" required><br>
                    Mot de passe : <input type="password" name="mdp" required><br>
                    <input type="submit" value="Se connecter">
                </form>
            </div>
            <?php
        }
    }
}
?>
</body>
</html>
