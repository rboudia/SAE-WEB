<?php
require_once 'vue_generique.php';

class VueDefense extends VueGenerique {

    function affiche_liste($tab) {
        foreach($tab as $element) {
            ?>
            <li><?= $element['type_defense'] ?> <a href="index.php?module=defense&action=details&id=<?= $element['id_defense'] ?>"> détails</a></li>
            <?php
        }
    }

	function affiche_liste_sans($tab) {
        foreach($tab as $element) {
            ?>
            <li><?= $element['type_defense'] ?></li>
            <?php
        }
    }

    function affiche_detail($detailDefense) {
        if (isset($detailDefense['cout_achat'])) {
			?>
			<table>
				<tr>
					<td>Id</td> <td> <?= $detailDefense['id_defense'] ?></td>
				</tr>
				<tr>
					<td>Type de defense</td> <td> <?= $detailDefense['type_defense'] ?></td>
				</tr>
				<tr>
					<td>Cout d'achat</td> <td> <?= $detailDefense['cout_achat'] ?></td>
				</tr>
				<tr>
					<td>Cout de vente</td> <td> <?= $detailDefense['cout_vente'] ?></td>
				</tr>
				<tr>
					<td>Niveau d'amélioration</td> <td> <?= $detailDefense['niveau_amelioration'] ?></td>
				</tr>
				<tr>
					<td>Niveau max d'amélioration</td> <td> <?= $detailDefense['niveau_max_amelioration'] ?></td>
				</tr>
                <tr>
					<td>Strategie de défense</td>
					<?php
						if($detailDefense['strategie_defense']=='null') {
					?>
					<td> Pas de stratégie</td>
					<?php
						} else { 
					?>
					 <td> <?= $detailDefense['strategie_defense'] ?></td>
					<?php
						}
					?>
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
		<li><a href="index.php?module=info">Retour aux informations du jeu</a></li>
			<?php if($_GET['action']=='details') {
				?>
        	<li><a href="index.php?module=ennemi&action=liste">Retour à la liste des défenses</a></li>
			<?php } ?>
        </ul>
		<?php

	}
}
?>