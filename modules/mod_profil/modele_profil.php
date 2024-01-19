<?php

require_once 'Connexion.php';

class ModeleProfil extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getDetail($idJoueur){
        $requete = $this->connexion->getBdd()->query("SELECT * FROM joueur WHERE id_joueur = '$idJoueur'");
        $bio = $requete->fetch(PDO::FETCH_ASSOC);
        return $bio;
    }

    public function verifierLoginExistant($login) {
	    try {
		$query = self::$bdd->prepare("SELECT id_joueur, login, pseudo, mdp, photo_profil, jeton FROM joueur WHERE login = :login");
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

    public function verifierMotDePasse($login, $mdp) {
        try {
            $query = self::$bdd->prepare("SELECT id_joueur, login, pseudo FROM joueur WHERE id_joueur = :id_joueur AND mdp = md5(:mdp)");
            $query->bindParam(':id_joueur', $login, PDO::PARAM_INT);
            $query->bindParam(':mdp', $mdp, PDO::PARAM_STR);
            $query->execute();
            $resultat = $query->fetch(PDO::FETCH_ASSOC);
            return ($resultat)?$resultat:null;
        } catch (PDOException $e) {
            die('Erreur lors de la vérification du mot de passe : ' . $e->getMessage());
        }
    }

    public function changerMotDePasse($id, $nouveauMdp) {
        try {
            $query = self::$bdd->prepare("UPDATE joueur SET mdp = md5(:nouveau_mdp) WHERE id_joueur = :id_joueur");
            $query->bindParam(':id_joueur', $id, PDO::PARAM_INT);
            $query->bindParam(':nouveau_mdp', $nouveauMdp, PDO::PARAM_STR);
            $query->execute();
    
            $nombreDeLignesAffectees = $query->rowCount();
            
            return ($nombreDeLignesAffectees > 0);
        } catch (PDOException $e) {
            die('Erreur lors de la modification du mot de passe : ' . $e->getMessage());
        }
    }

    public function changerInfo($id, $pseudo, $login, $photo_profil) {
        try {
            $query = self::$bdd->prepare("UPDATE joueur SET pseudo = :pseudo, login = :login, photo_profil = :photo_profil WHERE id_joueur = :id_joueur");
            $query->bindParam(':id_joueur', $id, PDO::PARAM_INT);
            $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $query->bindParam(':login', $login, PDO::PARAM_STR);
            $query->bindParam(':photo_profil', $photo_profil, PDO::PARAM_STR);
            $query->execute();
    
            $nombreDeLignesAffectees = $query->rowCount();
            
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}

?>