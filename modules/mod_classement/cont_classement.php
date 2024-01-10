<?php 
require_once 'modele_classement.php';
require_once 'vue_classement.php';

class ContClassement {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueClassement();
        $this->modele = new ModeleClassement();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "affichage" ;
    }

    function exec(){

        switch ($this->action){
            
            case "affichage":
                $this->vue->classement($this->modele->getTop5Players());
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
?>
