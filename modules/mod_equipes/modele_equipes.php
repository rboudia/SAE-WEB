<?php 

require_once 'Connexion.php';

class ModeleEquipe extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getListe(){
        $requete = $this->connexion->getBdd()->query("SELECT id, nom, annee_creation, pays FROM listeEquipe");
        $tableau = $requete->fetchAll();
        return $tableau;
    }

    function getDetail($idEquipe){
        $requete = $this->connexion->getBdd()->query("SELECT * FROM listeEquipe WHERE id = '$idEquipe'");
        $bio = $requete->fetch(PDO::FETCH_ASSOC);
        return $bio;
    }

    function ajouterEquipe($nom, $annee_creation, $description, $pays, $logo){

        $requete = $this->connexion->getBdd()->prepare('INSERT INTO listeEquipe (nom, annee_creation, description, pays, logo) VALUES (:nom, :annee_creation, :description, :pays, :logo)');
        $resultat =true;
        try{
        $resultat = $requete->execute(array(':nom' => $nom, ':annee_creation' => $annee_creation, ':description' => $description, ':pays' => $pays, ':logo' => $logo));
    }catch (PDOException $ex){
        $resultat = false;            
    }
    
        if ($resultat)
        $_SESSION["ajout"] = 'Ajouter avec succès';
        else
        $_SESSION["ajout"] = 'Erreur ajout';
    }

}

?>