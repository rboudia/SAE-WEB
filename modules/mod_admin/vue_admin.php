<?php
require_once 'vue_generique.php';

class VueAdmin extends VueGenerique {

    public function form_inscription() {
        ?>
        <div>
            <link rel="stylesheet" type="text/css" href="modules/mod_connexion/Css.css">
            <h2 class="inscription">Ajouter un admin</h2>
            <?php if(isset($_SESSION['erreur'])){
                ?>
                <div style="color:red; text-align: center;"><?=$_SESSION['erreur']?></div><br>
                <?php
                unset($_SESSION['erreur']);
            }
            ?>

            <form method="post" action="index.php?module=admin&action=inscription" class="animationFormulaireIns">
                Login: <input type="text" name="login" required><br>
                Mot de passe: <input type="password" name="mdp" required><br>
                <input type="submit" value="S'inscrire">
            </form>
        </div>
        <?php
    }
}
    ?>
