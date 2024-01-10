<?php 
require_once 'vue_generique.php';

class VueClassement extends VueGenerique{


	public function affiche_liste($elements) {
        ?> 
		Voici la liste de joueur <br>
		<ul> 
			<?php
        foreach ($elements as $element) { 
            ?>
            <li> <?= $element['id'] ?> <a href="index.php?module=classement&action=details&id=<?= $element['id'] ?> "> <?=$element['nom']?></a></li> 
            <?php }
        ?> </ul> <?php
    }

	function affiche_details($detailJoueur){
		if (isset($detailJoueur['description'])) {
			?>
			<table>
				<tr>
					<td>Id</td> <td> <?= $detailJoueur['id'] ?></td>
				</tr>
				<tr>
					<td>Nom</td> <td> <?= $detailJoueur['nom'] ?></td>
				</tr>
				<tr>
					<td>Description</td> <td> <?= $detailJoueur['description'] ?></td>
				</tr>
			</table>
			<?php
		} else {
			?>
			 <div>Aucune description n'a été trouvée pour ce joueur.</div>
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
        <li><a href="index.php?module=classement&action=bienvenue">bienvenue</a></li>
        <li><a href="index.php?module=classement&action=liste">liste</a></li>
        <li><a href="index.php?module=classement&action=ajout">ajouter</a></li>
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
		<form action="index.php?module=profil&action=ajout" method="POST">
    		<input type="text" name="nom" placeholder="Nom">
    		<input type="text" name="description" placeholder="Description">
    		<input type="submit" value="ajouter">
		</form>
		<?php if(isset($_SESSION['ajout'])){
            ?>
            <div style="color:red"><?=$_SESSION['ajout']?></div><br>
            <?php
            unset($_SESSION['ajout']);
        }
	}

	public function classement($tab) {
		$num = 1;
        ?>
		<section>
			<h2>Classement</h2>
			<table>
				<thead>
					<tr>
						<th>Classement</th>
						<th>Pseudo</th>
						<th>Status</th>
						<th>Vague atteinte</th>
						<th>Ennemis tués</th>
						<th>Pv de la base</th>
						<th>Argent restant</th>
					</tr>
				</thead>
				<tbody>
				<?php
        foreach($tab as $defi) {
            ?>
            <tr>
				<td><?= $num ?></td>
				<td><?= $defi['pseudo'] ?></td>
				<td><?= $defi['status'] ?></td>
				<td><?= $defi['vague_atteinte'] ?></td>
				<td><?= $defi['nb_ennemis_tues'] ?></td>
				<td><?= $defi['pv_base'] ?></td>
				<td><?= $defi['argent_restant'] ?></td>
			</tr>
            </form>
            <?php
			$num = $num + 1;
        }
        ?> 

				</tbody>
			</table>
		</section>		
		<?php
    }
}

?>