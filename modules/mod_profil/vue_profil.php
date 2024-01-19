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
			<link rel="stylesheet" type="text/css" href="modules\mod_profil\Css-profil.css">
			<div class="contenuProfil">
				<div class="headerProfil">
					<h2>Profil de <?= $detailJoueur['pseudo'] ?></h2>
				</div>
				<div class="contProf">
					<div class="profile-details">
						<div class="details">
							<span class="detail-label">Id</span>
							<span class="detail-val"><?= $detailJoueur['id_joueur'] ?></span>
						</div>
						<div class="details">
							<span class="detail-label">Pseudo</span>
							<span class="detail-val"><?= $detailJoueur['pseudo'] ?></span>
						</div>
						<div class="details">
							<span class="detail-label">Login</span>
							<span class="detail-val"><?= $detailJoueur['login'] ?></span>
						</div>
						<div class="details">
							<span class="detail-label">Mot de passe</span>
							<span class="detail-val">
								<?= str_repeat('*', strlen($detailJoueur['mdp'])) ?>
								<a class="modifMdp" href="index.php?module=profil&action=afficher">Changer votre mot de passe</a>
							</span>
						</div>
						<div class="details">
							<span class="detail-label">Photo de profil</span>
							<span class="detail-val"><img src="<?php echo htmlspecialchars($detailJoueur['photo_profil']); ?>" alt="Logo de <?php echo htmlspecialchars($detailJoueur['pseudo']); ?>" style="max-width: 100px; height: auto;"></span>
						</div>
						<div class="details">
							<span class="detail-label">Jeton</span>
							<span class="detail-val"><?= $detailJoueur['jeton'] ?></span>
						</div>
					</div>
					<div class="actionProfil">
						<a href="index.php?module=profil&action=modifier" class="mdp">Modifier le profil</a>
					</div>
				</div>
			</div>
			<?php
		} else {
			?>
			<div>Aucune description n'a été trouvée.</div>
			<?php
		}
	}
	

	public function form_changer() {
		?>
		<link rel="stylesheet" type="text/css" href="modules\mod_profil\Css-profil.css">
		<div class="changementDeMdp">
			<h2>Changer votre mot de passe</h2>
			<?php if(isset($_SESSION['erreur'])) { ?>
				<div class="MessErreur"><?=$_SESSION['erreur']?></div>
			<?php unset($_SESSION['erreur']); } ?>
	
			<form method="post" action="index.php?module=profil&action=changermdp" class="formulaireChangmnt">
				<div class="formMdp">
					<label for="ancienmdp">Ancien mot de passe:</label>
					<input type="password" name="ancienmdp" id="ancienmdp" required>
				</div>
	
				<div class="formMdp">
					<label for="nouveaumdp">Nouveau mot de passe:</label>
					<input type="password" name="nouveaumdp" id="nouveaumdp" required>
				</div>
	
				<div class="formMdp">
					<label for="confirmermdp">Confirmer mot de passe:</label>
					<input type="password" name="confirmermdp" id="confirmermdp" required>
				</div>
	
				<input type="submit" value="Confirmer" class="boutonConfirmation">
			</form>
		</div>
		<?php
	}
	

	function formulaireModification($detailJoueur) {
		if (isset($_SESSION['user'])) {
			?>
			<link rel="stylesheet" type="text/css" href="modules\mod_profil\Css-profil.css">
			<div class="formModif">
				<?php if(isset($_SESSION['erreur'])) { ?>
					<div class="MessErreur"><?=$_SESSION['erreur']?></div>
				<?php unset($_SESSION['erreur']); } ?>
	
				<form action="index.php?module=profil&action=modifier" method="post" class="modification-form" enctype="multipart/form-data">
					<div class="formMod">
						<label for="pseudo">Pseudo:</label>
						<input type="text" id="pseudo" name="pseudo" value="<?= $detailJoueur['pseudo'] ?>" required>
					</div>
	
					<div class="formMod">
						<label for="login">Login:</label>
						<input type="text" id="login" name="login" value="<?= $detailJoueur['login'] ?>" required>
					</div>
	
					<div class="formMod">
						<label for="mdp">Mot de passe:</label>
						<span class="mdpCache"><?= str_repeat('*', strlen($detailJoueur['mdp'])) ?></span>
						<a class="chgmntMdp" href="index.php?module=profil&action=afficher">Changer le mot de passe</a>
					</div>
	
					<div class="formMod">
						<label for="photo_profil">URL de la Photo de profil:</label><br>
						<img src="<?php echo htmlspecialchars($detailJoueur['photo_profil']); ?>" alt="Logo de <?php echo htmlspecialchars($detailJoueur['pseudo']); ?>" style="max-width: 100px; height: auto;">
						<input type="file" name="logo" accept="image/*"><br> 

					</div>
	
					<div class="formMod">
						<label for="jeton">Jeton:</label>
						<span class="jetonJoueur"><?= $detailJoueur['jeton'] ?></span>
					</div>
	
					<input type="submit" value="Modifier" class="boutonConfirmation">
				</form>
			</div>
			<?php
		} else {
			?>
			<div>Aucun utilisateur connecté.</div>
			<?php
		}
	}
	
	
}

?>