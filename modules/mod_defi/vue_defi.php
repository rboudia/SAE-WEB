<?php
require_once 'vue_generique.php';

class VueDefi extends VueGenerique {

    public function bienvenue() {
        $titre = "Votre Titre";
        $cssPath = "modules/mod_defi/Css-Defi.css";

        $content = isset($_SESSION['user'])
            ? '<div class="welcome-message">Bienvenue ' . $_SESSION['user']['pseudo'] . '!</div>'
            : '<div class="error-message">Pour accéder aux défis, veuillez vous connecter SVP !</div>';

        echo "
            <!DOCTYPE html>
            <html lang='fr'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>$titre</title>
                <link rel='stylesheet' type='text/css' href='$cssPath'>
            </head>
            <body>
                $content
            </body>
            </html>";
    }

    function affiche_liste($tab) {
        echo '<ul>';
        foreach($tab as $element) {
            echo '<li>'.$element['defi'].'</li>';
        }
        echo '</ul>';
    }
}
?>
