<?php

require_once 'Connexion.php';

class ModeleProfil extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getDetail($idJoueur){
        $requete = $this->connexion->getBdd()->query("SELECT * FROM joueur WHERE id_joueur = '$idJoueur'");
        $bio = $requete->fetch(PDO::FETCH_ASSOC);
        return $bio;
    }


}

?>