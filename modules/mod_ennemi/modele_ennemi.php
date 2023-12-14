<?php

require_once 'Connexion.php';

class ModeleEnnemi extends Connexion {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getListe() {
        $requete = $this->connexion->getBdd()->query("SELECT id_ennemi,type_ennemi,pv,point_defense,degat_base,degat_obstacle,butin,immunite,capacite_obstacle,strategie_attaque,strategie_deplacement from ennemi");
        $tableau = $requete->fetchAll();
        return $tableau;
    }
}

?>