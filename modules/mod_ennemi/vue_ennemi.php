<?php
require_once 'vue_generique.php';

class VueEnnemi extends VueGenerique {

    function affiche_liste($tab) {
        foreach($tab as $element) {
            ?>
            <center><li><?= $element['type_ennemi'] ?> <a href="index.php?module=ennemi&action=details&id=<?= $element['id_ennemi'] ?>"> détails</a></li></center>
            <?php
        }
    }

	function affiche_liste_sans($tab) {
        foreach($tab as $element) {
            ?>
            <li><?= $element['type_ennemi'] ?></li>
            <?php
        }
    }

    function affiche_detail($detailEnnemi) {
        if (isset($detailEnnemi['butin'])) {
			?>
			<style>
    table {
            border-collapse: collapse;
            width: 80%;
            max-width: 600px;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        td:nth-child(even) {
            background-color: #ecf0f1;
        }

        td:nth-child(odd) {
            background-color: #fff;
        }
</style>
			<center>
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
		</center>
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