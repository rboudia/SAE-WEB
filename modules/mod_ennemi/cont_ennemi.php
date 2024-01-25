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
        $this->action = isset($_GET['action']) ? $_GET['action'] : "r" ;
    }

    function liste() {
        $this->vue->affiche_liste($this->modele->getListe());
    }

    function liste_sans() {
        $this->vue->affiche_liste_sans($this->modele->getListe());
    }

    function id_ennemi($idEnnemi) {
        $this->vue->affiche_detail($this->modele->getDetail($idEnnemi));
    }

    function exec(){

        switch ($this->action){
            case "liste":
                $this->vue->menu();
                $this->liste();
                break;
            case "liste_sans":
                $this->liste_sans();
                break;
            case "details":
                $this->vue->menu();
                $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                $this->id_ennemi($id);
                break;
            case "r":
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