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

    function traiterReponse($defiId, $reponse) {
        $reponseCorrecte = $this->modele->verifierReponse($defiId, $reponse);

        if ($reponseCorrecte) {
            echo "Bravo, la réponse est correcte !"; 
        } else {
            echo "Faux, la réponse est incorrecte."; 
        }
    }

    function exec(){

        switch ($this->action){
            case "bienvenue":
                $this->vue->bienvenue();
                break;
            case "afficheDefi":
                 $this->liste();
                break;
            case "traiterReponse":
                    if (isset($_POST['defiId']) && isset($_POST['reponse'])) {
                        $defiId = $_POST['defiId'];
                        $reponse = $_POST['reponse'];
                        $this->traiterReponse($defiId, $reponse);
                    } else {
                        echo "Erreur !";
                    }
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
