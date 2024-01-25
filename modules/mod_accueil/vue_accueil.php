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
            <br>
            <p class = "desc">Bienvenue sur notre plateforme dédiée aux passionnés de notre Tower Defense ! 
                Plongez dans l'univers fascinant de Royal Elphia, 
                non seulement en explorant une multitude d'informations détaillées sur votre jeu préféré. 
                Notre site est votre portail vers l'univers du Tower Defense, offrant un espace centralisé où vous pouvez consulter les classements, 
                les joueurs, et un tas d'autres fonctionnalités. Notre objectif est de nourrir votre 
                passion pour ces jeux, en vous offrant une ressource complète pour enrichir votre expérience. Préparez-vous à plonger dans 
                une communauté dédiée aux amateurs de défense stratégique et à explorer le monde palpitant de Royal Elphia comme jamais auparavant !</p>
                <a href="index.php?module=classement">
                <button class="button1">Voir le classement</button>
                </a>
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