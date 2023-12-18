<?php

require_once 'Connexion.php';

class ModeleDefi extends Connexion {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getListe() {
        $requete = $this->connexion->getBdd()->query("SELECT defi from defi");
        $tableau = $requete->fetchAll();
        return $tableau;
    }
}

?>