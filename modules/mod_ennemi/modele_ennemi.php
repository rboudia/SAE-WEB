<?php

    require_once 'Connexion.php';

    class ModeleEnnemi extends Connexion {

        private $connexion;

        function __construct() {
            $this->connexion = new Connexion();
            $this->connexion::initConnexion();
        }

        function getListe() {
            $requete = $this->connexion->getBdd()->query("SELECT id_ennemi,type_ennemi from ennemi");
            $tableau = $requete->fetchAll();
            return $tableau;
        }

        function getDetail($idEnnemi){
            $requete = $this->connexion->getBdd()->query("SELECT * FROM ennemi WHERE id_ennemi = '$idEnnemi'");
            $bio = $requete->fetch(PDO::FETCH_ASSOC);
            return $bio;
        }
    }

?>