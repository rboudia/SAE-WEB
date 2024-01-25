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

    function enregistrerTournoi($id, $idtournoi) {
        $requete = $this->connexion->getBdd()->prepare("UPDATE joueur SET tournoi = ? WHERE id_joueur = ?");
        $requete->execute([$idtournoi, $id]);
    }

    function supprimerTournoi($id) {
        $requete = $this->connexion->getBdd()->prepare("UPDATE joueur SET tournoi = NULL WHERE id_joueur = ?");
        $requete->execute([$id]);
    }

    function verifTournoiJoueur($id) {
        $requete = $this->connexion->getBdd()->prepare("SELECT tournoi FROM joueur WHERE id_joueur = ?");
        $requete->execute([$id]);
        $resultat = $requete->fetch();
        
        return ($resultat['tournoi'] === null);
    }
}

?>