<?php

require_once 'Connexion.php';

class ModeleStrategie extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getListeAttaqueEtDeplacement() {
        $requete = $this->connexion->getBdd()->query("SELECT nom, description FROM strategie WHERE type = 'ennemi';");
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function getListeDefense() {
        $requete = $this->connexion->getBdd()->query("SELECT nom, description FROM strategie WHERE type = 'tour';");
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function getDetail($idEnnemi){
        $requete = $this->connexion->getBdd()->query("SELECT * FROM ennemi WHERE id_ennemi = '$idEnnemi'");
        $bio = $requete->fetch(PDO::FETCH_ASSOC);
        return $bio;
    }

    function ajouterSuggestion($utilisateur, $choix, $sug, $date) {
        $requete = $this->connexion->getBdd()->prepare("INSERT INTO suggestion (suggestion, type, date, id_joueur) VALUES (?, ?, ?, ?)");
        $requete->execute([$sug, $choix, $date, $utilisateur]);
        return $requete->rowCount() > 0;

    }

}

?>