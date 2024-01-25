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
                <h3><?= $tournoi['nom_tournoi'] ?></h3>
                <div class="tournoi-details">
                    <p>Nombre de joueur: <?= $tournoi['nombre_de_joueurs'] ?>/<?= $tournoi['nombre_max_participant'] ?></p>
                    <p>Date: <?= $tournoi['date_tournoi'] ?></p>
                    <form action="index.php?module=tournoi&action=traiterReponse&id=<?= $tournoi['id_tournoi'] ?>" method="post">
                        <button type="submit" name="envoyerReponse">Rejoindre le tournoi</button>
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
        <?php
       if ($_SESSION['user']['tournoi'] !== null) {
        ?>
        <h2>Tournoi rejoin</h2>
        <div class="container">
        <?php
        foreach ($tab as $tournoi) {
            if ($_SESSION['user']['tournoi'] === $tournoi['id_tournoi']) {
                ?>
                <h3><?= $tournoi['nom_tournoi'] ?></h3>
                <?php
            }
        }
        ?>
        
        <form action="index.php?module=tournoi&action=supprimerTournoi" method="post">
            <button type="submit" name="envoyerReponse">Quitter le Tournoi</button>
        </form>
        </div>
        <?php
    }
    
    }
}
    ?>
