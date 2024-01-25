<?php
require_once 'vue_generique.php';

class VueDefense extends VueGenerique {

    function affiche_liste($tab,$i) {
		?>
		<head>
		<link rel="stylesheet" href="modules/mod_defense/Css-Defense.css">
		</head>
		<?php
        foreach($tab as $element) {
            
            if($element['type_defense']==$i) {
            ?>
            <li class="item"><?= $element['nom_defense'] ?> <a class="lien_detail" href="index.php?module=defense&action=details&id=<?= $element['id_defense'] ?>"> détails</a></li>
            <?php
            }
        }
    }

    function affiche_detail($detailDefense) {
        
			?>
            <div class="tab_detail">
			<table class="table_detail">
				<tr>
					<td>Nom de la défense</td> <td> <?= $detailDefense['nom_defense'] ?></td>
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
			<div class="image_item">
            <img src=<?= $detailDefense['image']?> alt="Defense Image"/>
        	</div>
		</div>
			<?php     
    }  

    function menu(){
		?>
		<ul class="liste_menu">
		<li><a href="index.php?module=info">Retour aux informations du jeu</a></li>
			<?php if($_GET['action']=='details' || isset($_GET['i'])) {
				?>
        	<li><a href="index.php?module=defense&action=liste">Retour à la liste des défenses</a></li>
			<?php } ?>
        </ul>
		<?php

	}

    public function menu_spe() {
        ?>
		<ul class="liste_menu">
        <li><a href="index.php?module=info">Retour aux informations du jeu</a></li>
		</ul>
        <li class="item"><a class="lien_detail" href="index.php?module=defense&action=liste_spe&i=1">Liste des tours</a></li>
        <li class="item"><a class="lien_detail" href="index.php?module=defense&action=liste_spe&i=2">Liste des obstacles</a></li>
	
        <?php
    }
}
?>