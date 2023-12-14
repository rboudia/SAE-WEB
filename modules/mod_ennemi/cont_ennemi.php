<?php
require_once 'modele_ennemi.php';
require_once 'vue_ennemi.php';

class ContEnnemi {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueEnnemi();
        $this->modele = new ModeleEnnemi();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "bienvenue" ;
    }

    function liste() {
        $this->vue->affiche_liste($this->modele->getListe());
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