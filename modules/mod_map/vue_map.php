
<?php
    require_once 'vue_generique.php';

    class VueMap extends VueGenerique {
        function affiche_liste($tab) {
            foreach($tab as $element) {
                ?>
                <li class=item> Map <?= $element['id_map'] ?> <a class="details-link" href="index.php?module=map&action=details&id=<?= $element['id_map'] ?>"> détails</a></li>
                <?php
            }
        }
    

        function affiche_detail($detailMap) {
            ?>
            <div class="container">
            <img src=<?= $detailMap['image_map']?> width="500" height="500"/>
        </div>
            <?php
        }

        function menu(){
            ?>
            <ul class="menu-list">
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