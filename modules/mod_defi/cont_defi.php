<?php
require_once 'modele_defi.php';
require_once 'vue_defi.php';

class ContDefi {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueDefi();
        $this->modele = new ModeleDefi();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "bienvenue";
    }

    function liste() {
        $this->vue->affiche_liste($this->modele->getListe());
    }

    function exec(){

        switch ($this->action){
            case "bienvenue":
                $this->vue->bienvenue();
                break;
            default:
                echo "erreur";
                break;
        }

    }

    public function getAffichage() {
        return $this->vue->getAffichage();
    }
}
?>
