<?php
require_once 'vue_generique.php';

class VueConnexion extends VueGenerique {
    public function form_inscription() {
        ?>
        <div>
            <link rel="stylesheet" type="text/css" href="modules/mod_connexion/Css.css">
            <h2 class="inscription">Inscription</h2>
            <?php if(isset($_SESSION['erreur'])){
                ?>
                <div style="color:red; text-align: center;"><?=$_SESSION['erreur']?></div><br>
                <?php
                unset($_SESSION['erreur']);
            }
            ?>
            <form method="post" action="index.php?module=connexion&action=inscription" class="animationFormulaireIns">
                Nom d'utilisateur: <input type="text" name="login" required><br>
                Mot de passe: <input type="password" name="mdp" required><br>
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
                <link rel="stylesheet" type="text/css" href="modules/mod_connexion/Css.css">
                <h2 class="connexion">Connexion</h2>
                <?php if(isset($_SESSION['erreur'])){
                    ?>
                    <div style="color:red; text-align: center;"><?=$_SESSION['erreur']?></div><br>
                    <?php
                    unset($_SESSION['erreur']);
                }
                ?>
                <form class="animationFormulaireConn" method="post" action="index.php?module=connexion&action=connexion">
                    Nom d'utilisateur: <input type="text" name="login" required><br>
                    Mot de passe: <input type="password" name="mdp" required><br>
                    <input type="submit" value="Se connecter">
                </form>
            </div>
            <?php
        }
    }
}
?>
