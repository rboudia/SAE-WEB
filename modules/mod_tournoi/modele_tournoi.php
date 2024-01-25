<?php

require_once 'Connexion.php';

class ModeleTournoi extends Connexion {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getListe() {
        $requete = $this->connexion->getBdd()->query("SELECT
        id_tournoi,
        t.nom AS nom_tournoi,
        t.date AS date_tournoi,
        t.nombre_max_participant,
        COUNT(j.id_joueur) AS nombre_de_joueurs
    FROM
        tournoi t
    LEFT OUTER JOIN
        joueur j ON t.id_tournoi = j.tournoi
    GROUP BY
        t.id_tournoi, t.nom, t.date, t.nombre_max_participant;
    ");
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function ajouterErreurReponse($defiId, $id_utilisateur) {
        $requete = $this->connexion->getBdd()->prepare("UPDATE joueurDefi SET repondu = repondu + 1 WHERE id_defi = ? AND id_joueur = ?");
        $requete->execute([$defiId, $id_utilisateur]);
    }

    function bonneReponse($defiId, $id_utilisateur) {
        $requete = $this->connexion->getBdd()->prepare("UPDATE joueurDefi SET repondu = 4 WHERE id_defi = ? AND id_joueur = ?");
        $requete->execute([$defiId, $id_utilisateur]);
    }


    function aDejaReponduCorrectement($defiId, $id_utilisateur) {
        $requete = $this->connexion->getBdd()->prepare("SELECT repondu FROM joueurDefi WHERE id_defi = ? AND id_joueur = ?");
        $requete->execute([$defiId, $id_utilisateur]);
        $resultat = $requete->fetch();
        if (isset($resultat["repondu"])) {
            return $resultat;
        } else {
            return null; 
        }

    }

    function enregistrerReponse($defiId, $id_utilisateur, $numero) {
        $requete = $this->connexion->getBdd()->prepare("INSERT INTO joueurDefi (id_joueur, id_defi, repondu) VALUES (?, ?, ?)");
        $requete->execute([$id_utilisateur, $defiId, $numero]);
    }

    function verifierReponse($defiId, $reponse) {
        $requete = $this->connexion->getBdd()->prepare("SELECT solution FROM defi WHERE id_defi = ?");
        $requete->execute([$defiId]);
        $resultat = $requete->fetch();
        
        if ($resultat && strtolower($resultat['solution']) == strtolower($reponse)) {
            return true; 
        } else {
            return false; 
        }
    }

    function ajouterJetonUtilisateur($id_utilisateur) {
        $requete = $this->connexion->getBdd()->prepare("UPDATE joueur SET jeton = jeton + 2 WHERE id_joueur = ?");
        $requete->execute([$id_utilisateur]);
    }


}

?>