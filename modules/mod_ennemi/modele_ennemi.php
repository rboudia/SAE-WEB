<?php

    require_once 'Connexion.php';

    class ModeleEnnemi extends Connexion {

        private $connexion;

        function __construct() {
            $this->connexion = new Connexion();
            $this->connexion::initConnexion();
        }

        function getListe() {
            $requete = $this->connexion->getBdd()->prepare("SELECT id_ennemi,type_ennemi from ennemi");
            $requete->execute();
            $tableau = $requete->fetchAll();
            return $tableau;
        }

        function getDetail($idEnnemi){
            $requete = $this->connexion->getBdd()->prepare("SELECT * FROM ennemi WHERE id_ennemi = '$idEnnemi'");
            $requete->execute();
            $detail = $requete->fetch();
            return $detail;
        }
    }

?>