<?php 

require_once 'Connexion.php';

class ModeleAmi extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function recherche($pseudo) {
        try {
            $requete = $this->connexion->getBdd()->prepare('SELECT pseudo, id_joueur FROM joueur WHERE pseudo = :pseudo');
            $requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
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

    public function ajouterDemandeAmi($id, $idAmi, $date) {
		try {
			$stmt = self::$bdd->prepare("INSERT INTO demande_ami (id_joueur, id_joueur_demande, date, demande) VALUES (?, ?, ?, 1)");
			return $stmt->execute([$id, $idAmi, $date]); 
		} catch (PDOException $e) {
			die('Erreur lors de l\'ajout du joueur : ' . $e->getMessage());
		}
	}

    public function verifdemande($id, $idJoueur) {
        $requete = "SELECT * FROM demande_ami WHERE id_joueur = ? AND id_joueur_demande = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id, $idJoueur]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verifdemandeami($id, $idJoueur) {
        $requete = "SELECT * FROM demande_ami WHERE id_joueur = ? AND id_joueur_demande = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$idJoueur, $id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verifami($id, $idJoueur) {
        $requete = "SELECT * FROM amis WHERE (id_joueur = ? AND id_joueur_ami = ?) OR (id_joueur = ? AND id_joueur_ami = ?)";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id, $idJoueur, $idJoueur, $id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function recupererDemandes($id) {
        try {
            $requete = $this->connexion->getBdd()->prepare('SELECT demande_ami.id_joueur, date, pseudo FROM demande_ami INNER JOIN joueur on demande_ami.id_joueur = joueur.id_joueur WHERE id_joueur_demande = :id ORDER BY date DESC;
            ');
            $requete->bindParam(':id', $id, PDO::PARAM_STR);
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

    function supprimerDemande($id_joueur, $id_joueur_demande) {
        $stmt = $this->connexion->getBdd()->prepare("DELETE FROM demande_ami WHERE id_joueur = :id_joueur AND id_joueur_demande = :id_joueur_demande");
        $stmt->bindParam(':id_joueur', $id_joueur, PDO::PARAM_INT);
        $stmt->bindParam(':id_joueur_demande', $id_joueur_demande, PDO::PARAM_INT);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
        }
    }

    public function supprimerAmi($id, $idJoueur) {
        $requete = "DELETE FROM amis WHERE (id_joueur = ? AND id_joueur_ami = ?) OR (id_joueur = ? AND id_joueur_ami = ?)";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$id, $idJoueur, $idJoueur, $id]);
        $rowCount = $stmt->rowCount();

        if ($rowCount == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ajouterAmi($id, $idAmi) {
		try {
			$stmt = self::$bdd->prepare("INSERT INTO amis (id_joueur, id_joueur_ami) VALUES (?, ?)");
			return $stmt->execute([$id, $idAmi]); 
		} catch (PDOException $e) {
			die('Erreur lors de l\'ajout du joueur : ' . $e->getMessage());
		}
	}

    function recupererAmi($id) {
        try {
            $requete = $this->connexion->getBdd()->prepare('
            SELECT pseudo, id_joueur FROM joueur 
            WHERE id_joueur IN (
                SELECT id_joueur_ami 
                FROM amis
                WHERE id_joueur = :id

                UNION

                SELECT id_joueur 
                FROM amis
                WHERE id_joueur_ami = :id
            );
            ');
            $requete->bindParam(':id', $id, PDO::PARAM_STR);
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
}

?>