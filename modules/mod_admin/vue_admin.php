<?php
require_once 'vue_generique.php';

class VueAdmin extends VueGenerique {

    public function form_inscription($token) {
        ?>
        <div>
            <link rel="stylesheet" type="text/css" href="modules/mod_admin/Css-Admin.css">
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
                <input type="hidden" name="csrf_token" value="<?= $token ?>">
                <input type="submit" value="S'inscrire">
            </form>
        </div>
        <?php
    }

    public function affiche_joueurs($joueurs) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_admin/Css-Admin2.css">
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                var messageContainer = document.getElementById("message-container");
                messageContainer.scrollTop = 0;  
            });
            </script>
        </head>
        <div id="message-container">
            <div id="ami-container">
                <h1>Joueurs</h1>
                <?php
                if(isset($_SESSION['message'])){
                    ?>
                    <div style="color:red; text-align: center;"><?=$_SESSION['message']?></div><br>
                    <?php
                    unset($_SESSION['message']);
                } else {
                    ?>
                    <ul> 
                        <?php
                        foreach ($joueurs as $joueur) {
                            ?>
                            <li><?= $joueur['pseudo'] ?><a href="index.php?module=admin&action=supprimer&id=<?= $joueur['id_joueur'] ?>"> Supprimer</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
        
        <?php
    }

    public function affiche_admin($admin) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_admin/Css-Admin2.css">
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                var messageContainer = document.getElementById("message-container");
                messageContainer.scrollTop = 0;  
            });
            </script>
        </head>

        <div id="message-container">
            <div id="ami-container">
                <h1>Admin</h1>
                <?php
                if(isset($_SESSION['message'])){
                    ?>
                    <div style="color:red; text-align: center;"><?=$_SESSION['message']?></div><br>
                    <?php
                    unset($_SESSION['message']);
                } else {
                    ?>
                    <ul> 
                        <?php
                        foreach ($admin as $admin) {
                            ?>
                            <li><?= $admin['pseudo'] ?><a href="index.php?module=admin&action=supprimer&id=<?= $admin['id_joueur'] ?>"> Supprimer</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
        
        <?php
    }
    
}
    ?>
