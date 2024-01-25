<?php
require_once 'modele_accueil.php';
require_once 'vue_accueil.php';

class ContAccueil {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueAccueil();
        $this->modele = new ModeleAccueil();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "accueil" ;
    }


    function exec(){

        switch ($this->action){
            case "accueil":
                $this->vue->bienvenue();
                break;

            default:
                $_SESSION["erreur"] = "Erreur action incorrecte.";
                $this->vue->bienvenue();
                break;
        }

    }

    public function getAffichage() {
        return $this->vue->getAffichage();
     }
}
?>
