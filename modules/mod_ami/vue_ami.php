<?php 
require_once 'vue_generique.php';

class VueAmi extends VueGenerique{

    public function affiche_ami($amis) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_ami/Css-Ami.css">
        </head>
        <div id="ami-barre-container">
        <div id="ami-container">
            <h1>Ami</h1>
            <?php
            if(isset($_SESSION['message'])){
                ?>
                <div style="color:red; text-align: center;"><?=$_SESSION['message']?></div><br>
                <?php
                unset($_SESSION['message']);
            }else {
                foreach ($amis as $ami) {
                    ?>
                    <li><?= $ami['pseudo'] ?><a href="index.php?module=ami&action=supprimer&id=<?= $ami['id_joueur'] ?>"> Supprimer</a></li>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }

    public function affiche_barre(){
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_ami/Css-Ami.css">
        </head>
        <div id="barre-container">
            <h2>Faites vous des amis en recherchant le pseudo d'un joueur :</h2>
            <form action="index.php?module=ami&action=liste" method="post">
                <label for="pseudo">Entrez un pseudo :</label><br>
                <input type="text" id="pseudo" name="pseudo"><br>
                <input type="submit" value="Rechercher">
            </form>
            <br>
            <br>
            <?php 
            if(isset($_SESSION['erreur'])){
                ?>
                <div style="color:red; text-align: center;"><?=$_SESSION['erreur']?></div><br>
                <?php
                unset($_SESSION['erreur']);
            }
            ?>
        </div>
        </div>

        <?php
    }

    function affiche_liste($tab) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_ami/Css-Ami.css">
        </head>
        <div id="liste-container">
            <?= $tab[0]['pseudo'] ?><a href="index.php?module=ami&action=ajouter&id=<?= $tab[0]['id_joueur'] ?>&date=<?= date('Y-m-d H:i:s') ?>"> Ajouter</a>
            <br>
            <br>
        </div>
        <?php
    }

    public function affiche_demande($demandes) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_ami/Css-Ami.css">
        </head>
        <div id="demande-container">
            <br>
            <h2>Demande d'amis:</h2>
            <br>
            <?php
             if(isset($_SESSION['message_erreur'])){
                ?>
                <div style="color:red; text-align: center;"><?=$_SESSION['message_erreur']?></div><br>
                <?php
                unset($_SESSION['message_erreur']);
            }else {
                foreach ($demandes as $demande) {
                    ?>
                    <li><?= $demande['id_joueur'] ?> <?= $demande['pseudo'] ?><a href="index.php?module=ami&action=accepter&id=<?= $demande['id_joueur'] ?>"> Accepter</a> <a href="index.php?module=ami&action=refuser&id=<?= $demande['id_joueur'] ?>"> Refuser</a></li>
                    <?php 
                }
            }
            ?>
        </div>
        <?php
    }
}
?>
