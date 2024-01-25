<?php
    require_once 'Connexion.php';

    class ModeleMap extends Connexion {
        private $connexion;

        function __construct() {
            $this->connexion = new Connexion();
            $this->connexion::initConnexion();
        }

        function getListe() {
            $requete = $this->connexion->getBdd()->prepare("SELECT id_map from map");
            $requete->execute();
            $tableau = $requete->fetchAll();
            return $tableau;
        }

        function getDetail($idMap){
            $requete = $this->connexion->getBdd()->prepare("SELECT * FROM map WHERE id_map = '$idMap'");
            $requete->execute();
            $detail = $requete->fetch();
            return $detail;
        }
    }
?>