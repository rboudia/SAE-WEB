<?php

require_once 'Connexion.php';

class ModeleAmelioration extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getSoldeJoueur($idJoueur) {
        $requete = $this->connexion->getBdd()->query("SELECT jeton FROM joueur WHERE id_joueur = '$idJoueur'");
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
    
    
}

?>

