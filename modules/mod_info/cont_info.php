<?php
require_once 'modele_info.php';
require_once 'vue_info.php';

class ContInfo {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueInfo();
        $this->modele = new ModeleInfo();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "info" ;
    }

    function bienvenue() {
        $this->vue->bienvenue($this->modele->ennemi(),$this->modele->defense(),$this->modele->map());
    }


    function exec(){

        switch ($this->action){
            case "info":
                $this->bienvenue();
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
