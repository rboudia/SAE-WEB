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
        $id_utilisateur = $this->getIdUtilisateur();
        $reponseCorrecte = $this->modele->traiterReponse($defiId, $reponse, $id_utilisateur);

        $this->liste();

        if ($reponseCorrecte) {
            $this->vue->BonneReponse();
        } else {
            $this->vue->mauvaiseReponse();
        }
    }

    private function getIdUtilisateur() {
        return isset($_SESSION['user']['id_joueur']) ? $_SESSION['user']['id_joueur'] : null;
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
                    $_SESSION["erreur"] = "Erreur !";
                }
                break;
            default:
            $_SESSION["erreur"] = "erreur";
                break;
        }

    }

    public function getAffichage() {
        return $this->vue->getAffichage();
    }
}
?>
