<?php
require_once 'vue_generique.php';

class VueTournoi extends VueGenerique {
    
    function affiche_liste($tab, $token) {
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
                    <?php
                    if (isset($_SESSION['admin'])) {
                        ?>
                    <form action="index.php?module=tournoi&action=supprimer&id=<?= $tournoi['id_tournoi'] ?>" method="post">
                        <input type="hidden" name="csrf_token" value="<?= $token ?>">
                        <button type="submit" name="supprimerTournoi">Supprimer le tournoi</button>
                    </form>
                    <?php
                    }
                    if (isset($_SESSION['user'])) {
                        ?>
                    <form action="index.php?module=tournoi&action=traiterReponse&id=<?= $tournoi['id_tournoi'] ?>" method="post">
                        <input type="hidden" name="csrf_token" value="<?= $token ?>">
                        <button type="submit" name="envoyerReponse">Rejoindre le tournoi</button>
                    </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
        <?php
        if (isset($_SESSION['admin'])) {
            ?>
            <div>
            <h2>Créer un tournoi :</h2>
            <form method="post" action="index.php?module=tournoi&action=creerTournoi" class="animationFormulaireIns">
                Nom: <input type="text" name="nom" required><br>
                Nombre de participant: <input type="text" name="nb_max" required><br>
                Date et heure: <input type="datetime-local" name="date" required><br>
                <input type="hidden" name="csrf_token" value="<?= $token ?>">
                <input type="submit" value="Ajouter">
            </form>
            <?php
        }
        if (isset($_SESSION['user']) && isset($_SESSION['user']['tournoi'])) {
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
                <input type="hidden" name="csrf_token" value="<?= $token ?>">
                <button type="submit" name="envoyerReponse">Quitter le Tournoi</button>
            </form>
            </div>
            <?php
            }
        }
    }
}
    ?>
