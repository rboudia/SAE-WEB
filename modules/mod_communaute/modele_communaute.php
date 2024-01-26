<?php 

require_once 'Connexion.php';

class ModeleCommunaute extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    public function listeMessage() {
        try {
            $requete = "SELECT id_communaute, joueur.pseudo, communaute.message, communaute.id_joueur FROM communaute INNER JOIN joueur on communaute.id_joueur = joueur.id_joueur ORDER BY date ASC;
            ";
            $stmt = $this->connexion->getBdd()->prepare($requete);
            $stmt->execute();
            $tableau = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$tableau) {
                return false;
            }

            return $tableau;
        } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
            return false;
        }
    }

    public function envoieMessage($id, $date, $message) {
		try {
			$stmt = self::$bdd->prepare("INSERT INTO communaute (id_joueur, date, message) VALUES (?, ?, ?)");
			return $stmt->execute([$id, $date, $message]); 
		} catch (PDOException $e) {
			die('Erreur lors de l\'ajout du joueur : ' . $e->getMessage());
		}
	}

    public function supprimerMessage($id) {
		try {
			$stmt = self::$bdd->prepare("DELETE FROM communaute WHERE id_communaute = ?");
			return $stmt->execute([$id]); 
		} catch (PDOException $e) {
			die('Erreur lors de l\'ajout du joueur : ' . $e->getMessage());
		}
	}

}

?>