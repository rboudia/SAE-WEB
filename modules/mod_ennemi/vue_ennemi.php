<?php
require_once 'vue_generique.php';

class VueEnnemi extends VueGenerique {

    function affiche_liste($tab) {
        foreach($tab as $element) {
            echo "<li>$element[type_ennemi]";
        }
    }

    public function bienvenue() {
        ?>
		Bienvenue sur le site <br>
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
		<li>Retourner à la première page<a href="index.php?module=debut">ici</a></li>
        <li><a href="index.php?module=ennemi&action=bienvenue">bienvenue</a></li>
        <li><a href="index.php?module=ennemi&action=liste">liste</a></li>
        </ul>
		<?php

	}
}
?>