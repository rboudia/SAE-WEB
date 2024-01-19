<?php 
require_once 'vue_generique.php';

class VueAmi extends VueGenerique{

	public function bienvenue() {
        ?>
		Bienvenue sur le site <br>
		<?php
    }

    public function affiche_barre(){
		?>
		<h1>Ami</h1>
		<h2>Faites vous des amis en recherchant le pseudo d'un joueur :</h2>
    	<form action="index.php?module=ami&action=liste" method="post">
      	<label for="pseudo">Entrez un pseudo :</label><br>
      	<input type="text" id="pseudo" name="pseudo"><br>
      	<input type="submit" value="Rechercher">
    	</form>
		<br>
		<br>
		<?php 
	}

    function affiche_liste($tab) {
        ?>
        <?= $tab[0]['pseudo'] ?> <a href="index.php?module=ami&action=ajouter&id=<?= $tab[0]['id_joueur'] ?>&date=<?= date('Y-m-d H:i:s') ?>"> Ajouter</a>
        <?php
    }

	public function afficherMessages($messages) {
        ?>
        <h2>Messages:</h2>
        <?php

        foreach ($messages as $message) {
            ?>

            <?php 
        }
    }
}

?>