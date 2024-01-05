<?php
require_once 'modele_defense.php';
require_once 'vue_defense.php';

class ContDefense {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueDefense();
        $this->modele = new ModeleDefense();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "liste_sans" ;
    }

    function liste() {
        $this->vue->affiche_liste($this->modele->getListe());
    }

    function liste_sans() {
        $this->vue->affiche_liste_sans($this->modele->getListe());
    }

    function id_defense($idDefense) {
        $this->vue->affiche_detail($this->modele->getDetail($idDefense));
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
                $this->id_defense($id);
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