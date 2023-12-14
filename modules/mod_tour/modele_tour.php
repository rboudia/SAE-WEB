<?php

require_once 'Connexion.php';

class ModeleTour extends Connexion {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getListe() {
        $requete = $this->connexion->getBdd()->query("SELECT id_defense,type_defense from defense");
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function getDetail($idDefense){
        $requete = $this->connexion->getBdd()->query("SELECT * FROM defense WHERE id_defense = '$idDefense'");
        $bio = $requete->fetch(PDO::FETCH_ASSOC);
        return $bio;
    }
}

?>