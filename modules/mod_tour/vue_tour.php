<?php
require_once 'vue_generique.php';

class VueTour extends VueGenerique {

    function affiche_liste($tab) {
        foreach($tab as $element) {
            ?>
            <li><?= $element['type_defense'] ?> <a href="index.php?module=tour&action=details&id=<?= $element['id_defense'] ?>"> détails</a></li>
            <?php
        }
    }

    function affiche_detail($detailTour) {
        if (isset($detailTour['cout_achat'])) {
			?>
			<table>
				<tr>
					<td>Id</td> <td> <?= $detailTour['id_defense'] ?></td>
				</tr>
				<tr>
					<td>Type de tour</td> <td> <?= $detailTour['type_defense'] ?></td>
				</tr>
				<tr>
					<td>Cout d'achat</td> <td> <?= $detailTour['cout_achat'] ?></td>
				</tr>
				<tr>
					<td>Cout de vente</td> <td> <?= $detailTour['cout_vente'] ?></td>
				</tr>
				<tr>
					<td>Niveau d'amélioration</td> <td> <?= $detailTour['niveau_amelioration'] ?></td>
				</tr>
				<tr>
					<td>Niveau max d'amélioration</td> <td> <?= $detailTour['niveau_max_amelioration'] ?></td>
				</tr>
                <tr>
					<td>Strategie de défense</td> <td> <?= $detailTour['strategie_defense'] ?></td>
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
        <li><a href="index.php?module=tour&action=bienvenue">bienvenue</a></li>
        <li><a href="index.php?module=tour&action=liste">liste</a></li>
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