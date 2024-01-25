<?php

class ModeleConnexion extends Connexion {
    
	public function verifierLoginExistant($login) {
	    try {
		$query = self::$bdd->prepare("SELECT id_joueur, login, pseudo, mdp, photo_profil, jeton, tournoi FROM joueur WHERE login = :login");
		$query->bindParam(':login', $login, PDO::PARAM_STR);
		$query->execute();
		$resultat =  $query->fetch(PDO::FETCH_ASSOC);
		return ($resultat)?$resultat:null;
	    } catch (PDOException $e) {
		die('Erreur lors de la vérification du login : ' . $e->getMessage());
	    }
	}

	public function verifierPseudoExistant($pseudo){
	    try {
		$query = self::$bdd->prepare("SELECT id_joueur, pseudo, mdp FROM joueur WHERE pseudo = :pseudo");
		$query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
		$query->execute();
		$resultat =  $query->fetch(PDO::FETCH_ASSOC);
		return ($resultat)?$resultat:null;
	    } catch (PDOException $e) {
		die('Erreur lors de la vérification du pseudo : ' . $e->getMessage());
	    }
	}

	public function ajouterUtilisateur($pseudo, $login, $mdp, $logo) {
		try {
			$jeton = 0;
			$stmt = self::$bdd->prepare("INSERT INTO joueur (pseudo, login, mdp, photo_profil, jeton) VALUES (:pseudo, :login, md5(:mdp), :logo, :jeton)");
			$stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
			$stmt->bindParam(':login', $login, PDO::PARAM_STR);
			$stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
			$stmt->bindParam(':logo', $logo, PDO::PARAM_STR);
			$stmt->bindParam(':jeton', $jeton, PDO::PARAM_INT);
			return $stmt->execute(); 
		} catch (PDOException $e) {
			die('Erreur lors de l\'ajout du joueur : ' . $e->getMessage());
		}
	}

public function verifierMotDePasse($login, $mdp) {
	try {
		$query = self::$bdd->prepare("SELECT id_joueur, login, pseudo FROM joueur WHERE login = :login AND mdp = md5(:mdp)");
		$query->bindParam(':login', $login, PDO::PARAM_STR);
		$query->bindParam(':mdp', $mdp, PDO::PARAM_STR);
		$query->execute();
		$resultat = $query->fetch(PDO::FETCH_ASSOC);
		return ($resultat)?$resultat:null;
	} catch (PDOException $e) {
		die('Erreur lors de la vérification du mot de passe : ' . $e->getMessage());
	}
}

}
?>
