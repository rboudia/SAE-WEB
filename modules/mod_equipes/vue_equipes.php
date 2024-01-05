<?php 
require_once 'vue_generique.php';

class VueEquipes extends VueGenerique{

	
	function affiche_liste($tab) {
		?>
		Voici la liste des équipes <br>
		<ul> 
		<?php
			foreach($tab as $element){
				?>
				<li><?= $element['id'] . ' ' . $element['nom'] . ' ' . $element['annee_creation'] ?> <a href="index.php?module=equipe&action=details&id=<?= $element['id'] ?>"> détails</a></li>
            <?php
		}
		?> </ul> <?php
	}

	function affiche_detail($detailEquipe){
		if (isset($detailEquipe['description'])) {
			?>
			<table>
				<tr>
					<td>Id</td> <td> <?= $detailEquipe['id'] ?></td>
				</tr>
				<tr>
					<td>Nom</td> <td> <?= $detailEquipe['nom'] ?></td>
				</tr>
				<tr>
					<td>Année creation</td> <td> <?= $detailEquipe['annee_creation'] ?></td>
				</tr>
				<tr>
					<td>Description</td> <td> <?= $detailEquipe['description'] ?></td>
				</tr>
				<tr>
					<td>Pays</td> <td> <?= $detailEquipe['pays'] ?></td>
				</tr>
				<tr>
					<td>Logo</td> <td> <?= $detailEquipe['logo'] ?></td>
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
        <li><a href="index.php?module=equipe&action=bienvenue">bienvenue</a></li>
        <li><a href="index.php?module=equipe&action=liste">liste</a></li>
		<li><a href="index.php?module=equipe&action=ajout">ajouter</a></li>
        </ul>
		<?php

	}

	function form_ajout(){
		?>
		<h1>Formulaire</h1>
		<?php
		if(isset($_SESSION['erreur'])){
            ?>
            <div style="color:red"><?=$_SESSION['erreur']?></div><br>
            <?php
            unset($_SESSION['erreur']);
        }
		?>
		<form action="index.php?module=equipe&action=ajout" method="POST">
    		<input type="text" name="nom" placeholder="Nom">
    		<input type="text" name="annee_creation" placeholder="Année creation">
			<input type="text" name="description" placeholder="Description">
    		<input type="text" name="pays" placeholder="Pays">
    		<input type="text" name="logo" placeholder="Logo">
    		<input type="submit" value="ajouter">
		</form>
		<?php if(isset($_SESSION['ajout'])){
            ?>
            <div style="color:red"><?=$_SESSION['ajout']?></div><br>
            <?php
            unset($_SESSION['ajout']);
        }
	}

	public function bienvenue() {
        ?>
		Bienvenue sur le site <br>
		<?php
    }
}

?>