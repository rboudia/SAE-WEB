<?php
require_once 'vue_generique.php';

class VueTournoi extends VueGenerique {
    
    function affiche_liste($tab) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="modules/mod_tournoi/Css-Tournoi.css">
        </head>
        <h2>Tournoi</h2>
        <br>        <br>
        <?php
        if(isset($_SESSION['erreur'])){
            ?>
            <div style="color:red"><?=$_SESSION['erreur']?></div><br>
            <?php
            unset($_SESSION['erreur']);
        }
        ?>
        <div class="centered-container">
        <?php
        foreach($tab as $tournoi) {
            ?>
            <div class="tournoi-container">
                <h3><?= $tournoi['nom'] ?></h3>
                <div class="tournoi-details">
                    <p>Date: <?= $tournoi['date'] ?></p>
                    <form action="index.php?module=tournoi&action=traiterReponse" method="post">
                        <input type="hidden" name="tournoiId" value="<?= $tournoi['id_tournoi'] ?>">
                        <button type="submit" name="envoyerReponse">Rejoindre le tournoi</button>
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
        <?php
    }
    

    function mauvaiseReponse($reponse) {
        $reponse = 2 - $reponse 
        ?>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel="stylesheet" type="text/css" href="modules/mod_tournoi/Css-Tournoi.css">
            </head>
            <body>
                <div class='messErr2'>Faux ! La réponse est incorrecte. Il vous reste <?= $reponse ?> essai(s) </div>
            </body>
            </html>
        <?php
    }

    function mauvaiseDerniereReponse() {
        ?>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel="stylesheet" type="text/css" href="modules/mod_tournoi/Css-Tournoi.css">
            </head>
            <body>
                <div class='messErr2'>Faux ! La réponse est incorrecte. Vous n'avez plus d'essais... </div>
            </body>
            </html>
        <?php
    }

    function dejaReponduCorrectement() {
        ?>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel="stylesheet" type="text/css" href="modules/mod_tournoi/Css-Tournoi.css">
            </head>
            <body>
                <div class='messErr2'>Vous avez déjà répondu correctement à cette question.</div>
            </body>
            </html>
        <?php
    }

    function bonneReponse() {
        ?>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel="stylesheet" type="text/css" href="modules/mod_tournoi/Css-Tournoi.css">
            </head>
            <body>
                <div class='messBrep'>Bravo, +2 jetons !</div>
            </body>
            </html>
        <?php
    }
}
    ?>
