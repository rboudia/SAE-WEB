<?php
    require_once 'vue_generique.php';

    class VueMap extends VueGenerique {
        function affiche_liste($tab) {
            foreach($tab as $element) {
                ?>
                <li> Map<?= $element['id_map'] ?> <a href="index.php?module=map&action=details&id=<?= $element['id_map'] ?>"> détails</a></li>
                <?php
            }
        }
    
        function affiche_liste_sans($tab) {
            foreach($tab as $element) {
                ?>
                <li> Map<?= $element['id_map'] ?></li>
                <?php
            }
        }

        function affiche_detail($detailMap) {
            ?>
            <center><img src=<?= $detailMap['image_map']?> width="500" height="500"/></center>
            <?php
        }

        function menu(){
            if(isset($_SESSION['erreur'])){
                ?>
                <div style="color:red"><?=$_SESSION['erreur']?></div><br>
                <?php
                unset($_SESSION['erreur']);
            }
            ?>
            <ul>
                <li><a href="index.php?module=info">Retour aux informations du jeu</a></li>
                <?php if($_GET['action']=='details') {
                    ?>
                <li><a href="index.php?module=map&action=liste">Retour à la liste des maps</a></li>
                <?php } ?>
            </ul>
            <?php
        }
     }
?>