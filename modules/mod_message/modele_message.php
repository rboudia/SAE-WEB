<?php 

require_once 'Connexion.php';

class ModeleMessage extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
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

    public function listeMessage($id, $idJoueur) {
        try {
            $requete = "SELECT * FROM message WHERE (id_joueur = ? AND id_joueur_message = ?) OR (id_joueur = ? AND id_joueur_message = ?) ORDER BY date ASC;
            ";
            $stmt = $this->connexion->getBdd()->prepare($requete);
            $stmt->execute([$id, $idJoueur, $idJoueur, $id]);
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

    public function envoieMessage($id, $idAmi, $date, $message) {
		try {
			$stmt = self::$bdd->prepare("INSERT INTO message (id_joueur, id_joueur_message, date, message) VALUES (?, ?, ?, ?)");
			return $stmt->execute([$id, $idAmi, $date, $message]); 
		} catch (PDOException $e) {
			die('Erreur lors de l\'ajout du joueur : ' . $e->getMessage());
		}
	}

}

?>