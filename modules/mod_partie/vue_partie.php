<?php 
require_once 'vue_generique.php';

class VuePartie extends VueGenerique{

	public function affiche_barre(){
		?>
		<h1>Partie</h1>
		<h2>Trouvez les statistiques des parties :</h2>
    	<form action="index.php?module=partie&action=partie" method="post">
      	<label for="pseudo">Entrez un pseudo :</label><br>
      	<input type="text" id="pseudo" name="pseudo"><br>
      	<input type="submit" value="Afficher les statistiques">
    	</form>
		<br>
		<br>
		<?php 
	}

	function affiche_liste($tab) {
        foreach($tab as $element) {
            ?>
            <li><?php if(isset($_SESSION['user'])) : ?><a href="index.php?module=partie&action=details&id=<?= $element['id_partie'] ?>"> Partie <?= $element['id_partie'] ?></a> <?php else : ?> Partie <?= $element['id_partie'] ?><?php endif; ?> <?= $element['status'] ?></li>
            <?php
			}
			if(!isset($_SESSION['user'])){
				?>
				<div>Pour accéder aux défis, veuillez vous <a href="index.php?module=connexion&action=connexion"> connecter</a> SVP !</div>
	            <?php
        }
    }

	public function classement($elements){
		$num = 1;
        ?>
		<section>
			<h2>Les 3 meilleurs !</h2>
			<table>
				<thead>
					<tr>
						<th>Classement</th>
						<th>Pseudo</th>
					</tr>
				</thead>
				<tbody>
				<?php
        foreach($elements as $defi) {
            ?>
            <tr>
				<td><?= $num ?></td>
				<td><a href="index.php?module=classement"><?= $defi['pseudo'] ?></a></td>
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

	function menu(){
		if(isset($_SESSION['erreur'])){
            ?>
            <div style="color:red"><?=$_SESSION['erreur']?></div><br>
            <?php
            unset($_SESSION['erreur']);
        }
		?>
		<ul>
        <?php if(isset($_GET['action']) && $_GET['action'] == 'details') {
				?>
			<li><a href="index.php?module=partie">Retour aux parties</a></li>
			<?php } ?>
        </ul>
		<?php
	}



	function affiche_detail($detailEnnemi) {
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
					<td>Id</td> <td> <?= $detailEnnemi['id_partie'] ?></td>
				</tr>
				<tr>
					<td>Nombre d'ennemis tués</td> <td> <?= $detailEnnemi['nb_ennemis_tues'] ?></td>
				</tr>
				<tr>
					<td>Argent restant</td> <td> <?= $detailEnnemi['argent_restant'] ?></td>
				</tr>
				<tr>
					<td>Vague atteinte</td> <td> <?= $detailEnnemi['vague_atteinte'] ?></td>
				</tr>
				<tr>
					<td>Pv base</td> <td> <?= $detailEnnemi['pv_base'] ?></td>
				</tr>
				<tr>
					<td>Status</td> <td> <?= $detailEnnemi['status'] ?></td>
				</tr>
                <tr>
			</table>
		</center>
			<?php
        
    }
}

?>