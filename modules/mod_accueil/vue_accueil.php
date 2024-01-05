<?php
require_once 'vue_generique.php';

class VueAccueil extends VueGenerique {

    public function bienvenue() {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_accueil/Css-Accueil.css"> 
            <title>Accueil</title>
        </head>
        <body>

        <div class="flex-container">
            <div class="rectangle rectangle1">
			<div class="text-container">
            <p class="styled-text">Le meilleur Tower-Defense de l'année !</p>
        </div>

            </div>

            <div class="rectangle rectangle2">

            </div>
        </div>

        </body>
        </html>
        <?php
    }
}
?>