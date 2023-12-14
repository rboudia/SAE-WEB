<?php
require_once 'vue_generique.php';

class VueEnnemi extends VueGenerique {

    function affiche_liste($tab) {
        foreach($tab as $element) {
            ?>
            <li><?= $element['type_ennemi'] ?> <a href="index.php?module=ennemi&action=details&id=<?= $element['id_ennemi'] ?>"> détails</a></li>
            <?php
        }
    }

    function affiche_detail($detailEnnemi) {
        if (isset($detailEnnemi['butin'])) {
			?>
			<table>
				<tr>
					<td>Id</td> <td> <?= $detailEnnemi['id_ennemi'] ?></td>
				</tr>
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
					<td>Imunnite</td> <td> <?= $detailEnnemi['immunite'] ?></td>
				</tr>
                <tr>
					<td>Capacite obstacle</td> <td> <?= $detailEnnemi['capacite_obstacle'] ?></td>
				</tr>
                <tr>
					<td>Strategie attaque</td> <td> <?= $detailEnnemi['strategie_attaque'] ?></td>
				</tr>
                <tr>
					<td>Strategie déplacement</td> <td> <?= $detailEnnemi['strategie_deplacement'] ?></td>
				</tr>
                <tr>
					<td><img src=<?= $detailEnnemi['image']?> width="50" height="50"/></td>
				</tr>
			</table>
			<?php
        } else {
            ?>
			<div>Aucune description n'a été trouvée pour cette equipe.</div>
			<?php
        }
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

    public function bienvenue() {
        ?>
		Bienvenue sur le site <br>
		<?php
    }
}
?>