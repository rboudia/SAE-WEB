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
			$stmt = self::$bdd->prepare("INSERT INTO demande_ami (id_joueur, id_joueur_demande, date, demande) VALUES (:id, :idAmi, :date, 1)");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':idAmi', $idAmi, PDO::PARAM_INT);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
			return $stmt->execute(); 
		} catch (PDOException $e) {
			die('Erreur lors de l\'ajout du joueur : ' . $e->getMessage());
		}
	}
}

?>