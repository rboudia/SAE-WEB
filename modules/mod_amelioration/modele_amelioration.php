<?php

require_once 'Connexion.php';

class ModeleAmelioration extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getSoldeJoueur($idJoueur) {
        $requete = $this->connexion->getBdd()->prepare("SELECT jeton FROM joueur WHERE id_joueur = :idJoueur");
        $requete->bindParam(':idJoueur', $idJoueur, PDO::PARAM_INT);
        $requete->execute();
        $solde = $requete->fetch(PDO::FETCH_ASSOC);
        if ($solde !== false && isset($solde['jeton'])) {
            return $solde['jeton'];
        } else {
            return 0; 
        }
    }

    function getDefense() {
        $requete = $this->connexion->getBdd()->query("SELECT * FROM defense");
        $defenses = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $defenses;
    }

    function decrementerSoldeJoueur($idJoueur, $montant) {
        $requete = $this->connexion->getBdd()->prepare("UPDATE joueur SET jeton = jeton - :montant WHERE id_joueur = :idJoueur");
        $requete->bindParam(':montant', $montant, PDO::PARAM_INT);
        $requete->bindParam(':idJoueur', $idJoueur, PDO::PARAM_INT);
        $requete->execute();
    }

    function ameliorerDefense($idJoueur, $idDefense) {
       
        $requeteVerif = $this->connexion->getBdd()->prepare("SELECT * FROM amelioration WHERE id_joueur = :idJoueur AND id_defense = :idDefense");
        $requeteVerif->bindParam(':idJoueur', $idJoueur, PDO::PARAM_INT);
        $requeteVerif->bindParam(':idDefense', $idDefense, PDO::PARAM_INT);
        $requeteVerif->execute();
        $result = $requeteVerif->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            $requeteUpdate = $this->connexion->getBdd()->prepare("UPDATE amelioration SET val_amelioration = val_amelioration + 1 WHERE id_joueur = :idJoueur AND id_defense = :idDefense");
            $requeteUpdate->bindParam(':idJoueur', $idJoueur, PDO::PARAM_INT);
            $requeteUpdate->bindParam(':idDefense', $idDefense, PDO::PARAM_INT);
            $requeteUpdate->execute();
        } else {
            $requeteInsert = $this->connexion->getBdd()->prepare("INSERT INTO amelioration (id_joueur, id_defense, val_amelioration) VALUES (:idJoueur, :idDefense, 1)");
            $requeteInsert->bindParam(':idJoueur', $idJoueur, PDO::PARAM_INT);
            $requeteInsert->bindParam(':idDefense', $idDefense, PDO::PARAM_INT);
            $requeteInsert->execute();
        }
    }

    function getAmeliorationsJoueur($idJoueur) {
        $requete = $this->connexion->getBdd()->prepare("SELECT a.*, d.nom_defense, j.pseudo FROM amelioration a
                                                        INNER JOIN defense d ON a.id_defense = d.id_defense
                                                        INNER JOIN joueur j ON a.id_joueur = j.id_joueur
                                                        WHERE a.id_joueur = :idJoueur");
        $requete->bindParam(':idJoueur', $idJoueur, PDO::PARAM_INT);
        $requete->execute();
        $ameliorations = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $ameliorations;
    }
}

?>

