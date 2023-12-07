<?php
require_once 'vue_generique.php';

class VueConnexion extends VueGenerique {
  public function form_inscription() {
        ?>
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
        <?php
    }

    public function form_connexion() {
        if (isset($_SESSION['user'])) {
            $utilisateur = $_SESSION['user'];
            ?>
            <li>Vous êtes déjà connecté sous l'identifiant <?= $utilisateur['login'] ?> !</li>
            <li><a href="index.php?module=connexion&action=deconnexion">Déconnexion</a></li>
             <?php
            } else {
        ?>
        <h2>Connexion</h2>
        <?php if(isset($_SESSION['erreur'])){
            ?>
            <div style="color:red"><?=$_SESSION['erreur']?></div><br>
            <?php
            unset($_SESSION['erreur']);
        }
        ?>
        <form method="post" action="index.php?module=connexion&action=connexion">
        Nom d\'utilisateur : <input type="text" name="login" required><br>
        Mot de passe : <input type="password" name="mdp" required><br>
        <input type="submit" value="Se connecter">
        </form>
        <?php
        }
    }
}

?>


 
