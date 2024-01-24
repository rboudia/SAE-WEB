<?php
require_once 'modele_amelioration.php';
require_once 'vue_amelioration.php';

class ContAmelioration {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueAmelioration();
        $this->modele = new ModeleAmelioration();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "bienvenue" ;
    }


    function exec(){
        switch ($this->action){
            case "bienvenue":
                $utilisateur = $_SESSION['user'];
                $solde = $this->modele->getSoldeJoueur($utilisateur["id_joueur"]);
                $this->vue->bienvenue($solde);
                $def = $this->modele->getDefense();
                $this->vue->affichageDefense($def);
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
