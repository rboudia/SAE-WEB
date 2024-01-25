<?php

require_once 'Connexion.php';

class ModeleInfo extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function ennemi() {
        $requete = $this->connexion->getBdd()->prepare("SELECT type_ennemi from ennemi");
        $requete->execute();
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function defense() {
        $requete = $this->connexion->getBdd()->prepare("SELECT nom_defense from defense");
        $requete->execute();
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function map() {
        $requete = $this->connexion->getBdd()->prepare("SELECT id_map from map");
        $requete->execute();
        $tableau = $requete->fetchAll();
        return $tableau;
    }
}

?>