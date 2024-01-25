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

            <form method="post" action="index.php?module=connexion&action=inscription" class="animationFormulaireIns" enctype="multipart/form-data">
                Pseudo: <input type="text" name="pseudo" required><br>
                Login: <input type="text" name="login" required><br>
                Mot de passe: <input type="password" name="mdp" required><br>
                Photo de profil: <input type="file" name="logo" accept="image/*" ><br>
                <input type="hidden" name="csrf_token" value="valeur_du_token_generé">
                <input type="submit" value="S'inscrire">
            </form>
        </div>
        <?php
    }

    public function form_connexion() {
        if (isset($_SESSION['user'])) {
            $utilisateur = $_SESSION['user'];
            ?>
        
            <link rel="stylesheet" type="text/css" href="modules/mod_connexion/Css.css">
            <div id="connexion-info">
                Vous êtes connecté sous le pseudo <?= $utilisateur['pseudo'] ?> ! <br>
                <a href="index.php?module=connexion&action=deconnexion">Déconnexion</a>
            </div>
            <?php
        } else {
            ?>
            <div>
                <h2 class="connexion">Connexion</h2>
                <?php if(isset($_SESSION['erreur'])){
                    ?>
                    <div style="color:red; text-align: center;"><?=$_SESSION['erreur']?></div><br>
                    <?php
                    unset($_SESSION['erreur']);
                }
                ?>
                <link rel="stylesheet" type="text/css" href="modules/mod_connexion/Css.css">

                <form class="animationFormulaireConn" method="post" action="index.php?module=connexion&action=connexion">
                    Login: <input type="text" name="login" required><br>
                    Mot de passe: <input type="password" name="mdp" required><br>
                    <input type="submit" value="Se connecter">
                </form>
            </div>
            <?php
        }
    }
}
?>
