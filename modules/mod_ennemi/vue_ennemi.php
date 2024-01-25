<?php
require_once 'vue_generique.php';


class VueEnnemi extends VueGenerique {

    function affiche_liste($tab) {
		?>
		<head>
		<link rel="stylesheet" href="modules/mod_ennemi/Css-Ennemi.css">
		</head>
		<?php

		foreach ($tab as $element) {
		?>
			<li class="item"><?= $element['type_ennemi'] ?> <a class="lien_detail" href="index.php?module=ennemi&action=details&id=<?= $element['id_ennemi'] ?>"> détails</a></li>
		<?php
		}
    }

    function affiche_detail($detailEnnemi) {
			?>
            <div class="tab_detail">
			<table class="table_detail">
				<tr>
					<td>Type ennemi</td> <td> <?= $detailEnnemi['type_ennemi'] ?></td>
				</tr>
				<tr>
					<td>PV</td> <td> <?= $detailEnnemi['pv'] ?></td>
				</tr>
				<tr>
					<td>Point de défense</td> <td> <?= $detailEnnemi['point_defense'] ?></td>
				</tr>
				<tr>
					<td>Dégat base</td> <td> <?= $detailEnnemi['degat_base'] ?></td>
				</tr>
				<tr>
					<td>Butin</td> <td> <?= $detailEnnemi['butin'] ?></td>
				</tr>
                <tr>
					<td>Immunité</td> <td> <?= $detailEnnemi['immunite'] ?></td>
				</tr>
                <tr>
					<td>Capacitée obstacle</td> <td> <?= $detailEnnemi['capacite_obstacle'] ?></td>
				</tr>
                <tr>
					<td>Strategie attaque</td> <td> <?= $detailEnnemi['strategie_attaque'] ?></td>
				</tr>
                <tr>
					<td>Strategie déplacement</td> <td> <?= $detailEnnemi['strategie_deplacement'] ?></td>
				</tr>
			</table>
            <div class="image_item">
            <img src=<?= $detailEnnemi['image']?> alt="Ennemi Image"/>
        	</div>
		</div>
			<?php
        
    }

    

    function menu(){
		?>
		
		<ul class="liste_menu">
			<li><a href="index.php?module=info">Retour aux informations du jeu</a></li>
			<?php if($_GET['action']=='details') {
				?>
        	<li><a href="index.php?module=ennemi&action=liste">Retour à la liste des ennemis</a></li>
			<?php } ?>
        </ul>
		<?php
	}
}
?>