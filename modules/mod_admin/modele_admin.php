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
			$stmt = self::$bdd->prepare("INSERT INTO joueur (pseudo, login, mdp, admin) VALUES (:pseudo, :login, md5(:mdp), 2)");
			$stmt->bindParam(':pseudo', $login, PDO::PARAM_STR);
			$stmt->bindParam(':login', $login, PDO::PARAM_STR);
			$stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);

			return $stmt->execute(); 
		} catch (PDOException $e) {
			die('Erreur lors de l\'ajout du joueur : ' . $e->getMessage());
		}
	}

    function recupererJoueurs() {
        try {
            $requete = $this->connexion->getBdd()->prepare('
            SELECT pseudo, id_joueur FROM joueur WHERE admin IS NULL;
            ');
            $requete->execute();
            
            $tableau = $requete->fetchAll(PDO::FETCH_ASSOC);
            
            if (!$tableau) {
                return false;
            }
    
            return $tableau;
        } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
            return false;
        }
    }

    function recupererTypeAdmin($id) {
        try {
            $requete = $this->connexion->getBdd()->prepare('
                SELECT admin FROM joueur WHERE id_joueur = :id;
            ');
            $requete->execute([':id' => $id]);
    
            $adminType = $requete->fetchColumn();
    
            if ($adminType === false) {
                return false;
            }
    
            return $adminType == 1; // Return true if admin type is 1, false otherwise
        } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
            return false;
        }
    }

    function recupererAdmin() {
        try {
            $requete = $this->connexion->getBdd()->prepare('
            SELECT pseudo, id_joueur FROM joueur WHERE admin = 2;
            ');
            $requete->execute();
            
            $tableau = $requete->fetchAll(PDO::FETCH_ASSOC);
            
            if (!$tableau) {
                return false;
            }
    
            return $tableau;
        } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
            return false;
        }
    }


    

    public function supprimerJoueur($id) {
        $requete = "DELETE FROM joueur WHERE id_joueur = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function supprimerJoueurTournoi($id) {
        $requete = "UPDATE joueur SET tournoi = NULL WHERE id_joueur = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function supprimerJoueurMessage($id) {
        $requete = "DELETE FROM message WHERE id_joueur = ? OR id_joueur_message = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id, $id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }
    public function supprimerJoueurCommunaute($id) {
        $requete = "DELETE FROM communaute WHERE id_joueur = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }
    public function supprimerJoueurAmelioration($id) {
        $requete = "DELETE FROM amelioration WHERE id_joueur = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }
    public function supprimerJoueurAmis($id) {
        $requete = "DELETE FROM amis WHERE id_joueur = ? OR id_joueur_ami = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id, $id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }
    public function supprimerJoueurDefi($id) {
        $requete = "DELETE FROM joueurDefi WHERE id_joueur = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }
    public function supprimerJoueurDemandeAmis($id) {
        $requete = "DELETE FROM demande_ami WHERE id_joueur = ? OR id_joueur_demande = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id, $id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }
    public function supprimerJoueurPartie($id) {
        $requete = "DELETE FROM partie WHERE id_joueur = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>