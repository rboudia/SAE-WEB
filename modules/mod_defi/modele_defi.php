<?php

require_once 'Connexion.php';

class ModeleDefi extends Connexion {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getListe() {
        $requete = $this->connexion->getBdd()->query("SELECT * from defi");
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function verifierReponse($defiId, $reponse) {
        $requete = $this->connexion->getBdd()->prepare("SELECT solution FROM defi WHERE id_defi = ?");
        $requete->execute([$defiId]);
        $resultat = $requete->fetch();
        
        if ($resultat && strtolower($resultat['solution']) == strtolower($reponse)) {
            return true; 
        } else {
            return false; 
        }
    }

    function ajouterJetonUtilisateur($id_utilisateur) {
        $requete = $this->connexion->getBdd()->prepare("UPDATE joueur SET jeton = jeton + 1 WHERE id_joueur = ?");
        $requete->execute([$id_utilisateur]);
    }


}

?>