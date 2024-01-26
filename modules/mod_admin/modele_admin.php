<?php

require_once 'Connexion.php';

class ModeleAdmin extends Connexion {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

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

	public function ajouterUtilisateur($login, $mdp) {
		try {
			$jeton = 0;
			$stmt = self::$bdd->prepare("INSERT INTO joueur (pseudo, login, mdp, admin) VALUES (:pseudo, :login, md5(:mdp), 1)");
			$stmt->bindParam(':pseudo', $login, PDO::PARAM_STR);
			$stmt->bindParam(':login', $login, PDO::PARAM_STR);
			$stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);

			return $stmt->execute(); 
		} catch (PDOException $e) {
			die('Erreur lors de l\'ajout du joueur : ' . $e->getMessage());
		}
	}


}

?>