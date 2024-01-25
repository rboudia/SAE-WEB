<?php
require_once 'modele_tournoi.php';
require_once 'vue_tournoi.php';

class ContTournoi {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueTournoi();
        $this->modele = new ModeleTournoi();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "afficheTournoi";
    }

    function liste() {
        $this->vue->affiche_liste($this->modele->getListe());
    }

    function traiterReponse($id) {
        if ($this->modele->verifTournoiJoueur($_SESSION['user']['id_joueur'])) {
            $this->modele->enregistrerTournoi($_SESSION['user']['id_joueur'], $id);
        } else {
             $_SESSION["erreur"] = "Dèjà inscrit à un tournoi !";
        }
    }


    function exec(){
        switch ($this->action){
            case "afficheTournoi":
                 $this->liste();
                break;
            case "traiterReponse":
                $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                $this->traiterReponse($id);
                $this->liste();
                break;
            default:
            $_SESSION["erreur"] = "erreur";
                break;
        }

    }

    public function getAffichage() {
        return $this->vue->getAffichage();
    }
}
?>
