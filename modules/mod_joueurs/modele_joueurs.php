<?php 

require_once 'Connexion.php';

class ModeleJoueurs extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getListe(){
        $requete = $this->connexion->getBdd()->query("SELECT id, nom FROM listeJoueur");
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function getDetail($idJoueur){
        $requete = $this->connexion->getBdd()->query("SELECT id, nom, description FROM listeJoueur WHERE id = '$idJoueur'");
        $bio = $requete->fetch(PDO::FETCH_ASSOC);
        return $bio;
    }

    function ajouterJoueur($nom, $bio){

        $requete = $this->connexion->getBdd()->prepare('INSERT INTO listeJoueur (nom, description) VALUES (:nom, :bio)');

        $resultat = $requete->execute(array(':nom' => $nom, ':bio' => $bio));
        
        if ($resultat)
        $_SESSION["ajout"] = 'Ajouter avec succès';
        else
        $_SESSION["ajout"] = 'Erreur ajout';
    }

}

?>