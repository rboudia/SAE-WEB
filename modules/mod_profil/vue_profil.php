<?php
require_once 'vue_generique.php';

class VueProfil extends VueGenerique{

	public function bienvenue() {
        ?>
		Bienvenue sur la page Profil <br>
		<?php
    }

	function affiche_detail($detailJoueur) {
        if (isset($_SESSION['user'])) {
			?>
			<table>
				<tr>
					<td>Id</td> <td> <?= $detailJoueur['id_joueur'] ?></td>
				</tr>
				<tr>
					<td>Pseudo</td> <td> <?= $detailJoueur['pseudo'] ?></td>
				</tr>
				<tr>
					<td>Login</td> <td> <?= $detailJoueur['login'] ?></td>
				</tr>
				<tr>
					<td>Mot de passe</td> <td><?= str_repeat('*', strlen($detailJoueur['mdp'])) ?> 	<a href="index.php?module=profil&action=afficher">Changer votre mot de passe</a>
</td>
				</tr>
				<tr>
					<td>Photo de profil</td> <td> <?= $detailJoueur['photo_profil'] ?></td>
				</tr>
				<tr>
					<td>Jeton</td> <td> <?= $detailJoueur['jeton'] ?></td>
				</tr>
			</table>
			<ul>
			<li><a href="index.php?module=profil&action=modifier">Modifier</a></li>
			</ul>
			<?php
        } else {
            ?>
			<div>Aucune description n'a été trouvée.</div>
			<?php
        }
    }

	public function form_changer() {
        ?>
        <div>
            <h2>Changer votre mot de passe</h2>
            <?php if(isset($_SESSION['erreur'])){
                ?>
                <div style="color:red; text-align: center;"><?=$_SESSION['erreur']?></div><br>
                <?php
                unset($_SESSION['erreur']);
            }
            ?>
            <form method="post" action="index.php?module=profil&action=changermdp">
                Ancien mot de passe: <input type="password" name="ancienmdp" required><br>
                Nouveau mot de passe: <input type="password" name="nouveaumdp" required><br>
                Confirmer mot de passe: <input type="password" name="confirmermdp" required><br>
                <input type="submit" value="Confirmer">
            </form>
        </div>
        <?php
    }

	function formulaireModification($detailJoueur) {
		if (isset($_SESSION['user'])) {
			if(isset($_SESSION['erreur'])){
                ?>
                <div style="color:red; text-align: center;"><?=$_SESSION['erreur']?></div><br>
                <?php
                unset($_SESSION['erreur']);
            }
            ?>
			
			<form action="index.php?module=profil&action=modifier" method="post">
				<label for="pseudo">Pseudo:</label>
				<input type="text" id="pseudo" name="pseudo" value="<?= $detailJoueur['pseudo'] ?>" required><br>
	
				<label for="login">Login:</label>
				<input type="text" id="login" name="login" value="<?= $detailJoueur['login'] ?>" required><br>
	
				<label for="mdp">Mot de passe:</label>
				<label for="mdp"><?= str_repeat('*', strlen($detailJoueur['mdp'])) ?></label><br>
	
				<label for="photo_profil">URL de la Photo de profil:</label>
				<input type="text" id="photo_profil" name="photo_profil" value="<?= $detailJoueur['photo_profil'] ?>"><br>
	
				<label for="jeton">Jeton:</label>
				<label for="jeton"><?= $detailJoueur['jeton'] ?></label><br>
	
				<input type="submit" value="Modifier">
			</form>
			<?php
		} else {
			?>
			<div>Aucun utilisateur connecté.</div>
			<?php
		}
	}
	
}

?>