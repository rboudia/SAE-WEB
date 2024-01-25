<?php
    require_once 'Connexion.php';

    class ModeleMap extends Connexion {
        private $connexion;

        function __construct() {
            $this->connexion = new Connexion();
            $this->connexion::initConnexion();
        }

        function getListe() {
            $requete = $this->connexion->getBdd()->query("SELECT id_map from map");
            $tableau = $requete->fetchAll();
            return $tableau;
        }

        function getDetail($idMap){
            $requete = $this->connexion->getBdd()->query("SELECT * FROM map WHERE id_map = '$idMap'");
            $bio = $requete->fetch(PDO::FETCH_ASSOC);
            return $bio;
        }
    }
?>