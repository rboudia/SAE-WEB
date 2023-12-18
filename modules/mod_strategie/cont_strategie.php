<?php
require_once 'modele_strategie.php';
require_once 'vue_strategie.php';

class ContStrategie {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueStrategie();
        $this->modele = new ModeleStrategie();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "strategie" ;
    }


    function exec(){

        switch ($this->action){
            case "strategie":
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
