<?php
require_once 'modele_tour.php';
require_once 'vue_tour.php';

class ContTour {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueTour();
        $this->modele = new ModeleTour();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "bienvenue" ;
    }

    function liste() {
        $this->vue->affiche_liste($this->modele->getListe());
    }

    function id_ennemi($idEnnemi) {
        $this->vue->affiche_detail($this->modele->getDetail($idEnnemi));
    }

    function exec(){

        switch ($this->action){
            case "bienvenue":
                $this->vue->bienvenue();
                $this->vue->menu();
                break;
            
            case "liste":
                $this->vue->menu();
                $this->liste();
                break;
            case "details":
                $this->vue->menu();
                $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                $this->id_ennemi($id);
                break;
            default:
                $_SESSION["erreur"] = "Erreur action incorrecte.";
                $this->vue->menu();
                break;
        }

    }

    public function getAffichage() {
        return $this->vue->getAffichage();
    }
}