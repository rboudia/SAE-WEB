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
					<td>Mot de passe</td> <td><?= str_repeat('*', strlen($detailJoueur['mdp'])) ?> 	<a href="index.php?module=profil&action=changermdp">Changer votre mot de passe</a>
</td>
				</tr>
				<tr>
					<td>Photo de profil</td> <td> <?= $detailJoueur['photo_profil'] ?></td>
				</tr>
				<tr>
					<td>Jeton</td> <td> <?= $detailJoueur['jeton'] ?></td>
				</tr>
			</table>
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
            <h2 class="inscription">Inscription</h2>
            <?php if(isset($_SESSION['erreur'])){
                ?>
                <div style="color:red; text-align: center;"><?=$_SESSION['erreur']?></div><br>
                <?php
                unset($_SESSION['erreur']);
            }
            ?>
            <form method="post" action="index.php?module=connexion&action=changermdp">
                Pseudo: <input type="text" name="pseudo" required><br>
                Login: <input type="text" name="login" required><br>
                Mot de passe: <input type="password" name="mdp" required><br>
                <input type="submit" value="S'inscrire">
            </form>
        </div>
        <?php
    }
}

?>