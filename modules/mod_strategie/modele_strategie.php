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
        $requete = $this->connexion->getBdd()->prepare("SELECT * FROM ennemi WHERE id_ennemi = :idEnnemi");
        $requete->bindParam(':idEnnemi', $idEnnemi, PDO::PARAM_INT);
        $requete->execute();
        $bio = $requete->fetch(PDO::FETCH_ASSOC);
        return $bio;
    }

    function ajouterSuggestion($utilisateur, $choix, $sug, $date) {
        $requete = $this->connexion->getBdd()->prepare("INSERT INTO suggestion (suggestion, type, date, id_joueur) VALUES (?, ?, ?, ?)");
        $requete->execute([$sug, $choix, $date, $utilisateur]);
        return $requete->rowCount() > 0;
    }
    
    public function verifJeton($idJoueur) {
        $requete = "SELECT jeton FROM joueur WHERE id_joueur = ?";
        $stmt = $this->connexion->getBdd()->prepare($requete);
        $stmt->execute([$idJoueur]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['jeton'] > 0) {
            return true;
        } else {
            return false;
        }
    }
    function ajouterJetonUtilisateur($id_utilisateur) {
        $requete = $this->connexion->getBdd()->prepare("UPDATE joueur SET jeton = jeton - 1 WHERE id_joueur = ?");
        $requete->execute([$id_utilisateur]);
    }

    function getListeSugg() {
        $requete = $this->connexion->getBdd()->query("SELECT * FROM suggestion s INNER JOIN joueur j on s.id_joueur = j.id_joueur");
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function suppSugg($id) {
        $requete = $this->connexion->getBdd()->prepare("DELETE FROM suggestion WHERE id_suggestion = ? ");
        $requete->execute([$id]);
    }
}

?>