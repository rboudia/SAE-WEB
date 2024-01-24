<?php
require_once 'vue_generique.php';

class VueDefense extends VueGenerique {

    function affiche_liste($tab,$i) {
        foreach($tab as $element) {
            
            if($element['t_defense']==$i) {
            ?>
            <center><li><?= $element['type_defense'] ?> <a href="index.php?module=defense&action=details&id=<?= $element['id_defense'] ?>"> détails</a></li></center>
            <?php
            }
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
			</center>
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
			<?php if($_GET['action']=='details' || isset($_GET['i'])) {
				?>
        	<li><a href="index.php?module=defense&action=liste">Retour à la liste des défenses</a></li>
			<?php } ?>
        </ul>
		<?php

	}

    public function menu_spe() {
        ?>
        <li><a href="index.php?module=info">Retour aux informations du jeu</a></li>
        <li> <a href="index.php?module=defense&action=liste_spe&i=1">Liste des tours</a></li>
        <li> <a href="index.php?module=defense&action=liste_spe&i=2">Liste des obstacles</a></li>
        <?php
    }
}
?>