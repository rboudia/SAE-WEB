<?php

require_once 'Connexion.php';

class ModeleDefense extends Connexion {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getListe() {
        $requete = $this->connexion->getBdd()->prepare("SELECT id_defense,nom_defense,type_defense from defense");
        $requete->execute();
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function getDetail($idDefense){
        $requete = $this->connexion->getBdd()->prepare("SELECT * FROM defense WHERE id_defense = '$idDefense'");
        $requete->execute();
        $detail = $requete->fetch();
        return $detail;
    }
}

?>