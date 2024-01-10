<?php

require_once 'Connexion.php';

class ModeleDefi extends Connexion {

    private $connexion;

    function __construct() {
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getListe() {
        $requete = $this->connexion->getBdd()->query("SELECT * from defi");
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function traiterReponse($defiId, $reponse, $id_utilisateur) {
        $dejaRepondu = $this->aDejaReponduCorrectement($defiId, $id_utilisateur);

        if (!$dejaRepondu) {
            $reponseCorrecte = $this->verifierReponse($defiId, $reponse);

            if ($reponseCorrecte) {
                $this->ajouterJetonUtilisateur($id_utilisateur);
                $this->enregistrerReponse($defiId, $id_utilisateur);
            }

            return $reponseCorrecte;
        } else {
            return false;
        }
    }

    function aDejaReponduCorrectement($defiId, $id_utilisateur) {
        $requete = $this->connexion->getBdd()->prepare("SELECT repondu FROM joueurDefi WHERE id_defi = ? AND id_joueur = ?");
        $requete->execute([$defiId, $id_utilisateur]);
        $resultat = $requete->fetch();

        return ($resultat && $resultat['repondu'] == 1);
    }

    function enregistrerReponse($defiId, $id_utilisateur) {
        $requete = $this->connexion->getBdd()->prepare("INSERT INTO joueurDefi (id_joueur, id_defi, repondu) VALUES (?, ?, 1)");
        $requete->execute([$id_utilisateur, $defiId]);
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