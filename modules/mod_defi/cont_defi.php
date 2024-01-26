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

    function traiterReponse() {
        if (isset($_POST['defiId']) && isset($_POST['reponse'])) {
            $defiId = $_POST['defiId'];
            $reponse = $_POST['reponse'];
            $id_utilisateur = $this->getIdUtilisateur();
            $dejaRepondu = $this->modele->aDejaReponduCorrectement($defiId, $id_utilisateur);

            $this->liste();
            if ($dejaRepondu === null) {
                $this->modele->enregistrerReponse($defiId, $id_utilisateur, 0);
                $dejaRepondu = $this->modele->aDejaReponduCorrectement($defiId, $id_utilisateur);
            }
            if ($dejaRepondu['repondu'] == 4) {
                $this->vue->dejaReponduCorrectement();
            }else{
                if($dejaRepondu['repondu'] == 1 || $dejaRepondu['repondu'] == 2 || $dejaRepondu['repondu'] == 0){
                    $reponseCorrecte = $this->modele->verifierReponse($defiId, $reponse);
                    if ($reponseCorrecte) {
                        $this->modele->bonneReponse($defiId, $id_utilisateur);
                        $this->modele->ajouterJetonUtilisateur($id_utilisateur);
                        $this->vue->bonneReponse();
                    } else {
                        $this->vue->mauvaiseReponse($dejaRepondu['repondu']);   
                        $this->modele->ajouterErreurReponse($defiId, $id_utilisateur);
                        
                    }
                } else {
                    $this->vue->mauvaiseDerniereReponse();
                }
            }
        } else {
             $_SESSION["erreur"] = "Erreur !";
         }
    }

    private function getIdUtilisateur() {
        return isset($_SESSION['user']['id_joueur']) ? $_SESSION['user']['id_joueur'] : null;
    }

    public function creerDefi() {
	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $defi = isset($_POST['defi']) ? $_POST['defi'] : '';
		    $reponse = isset($_POST['reponse']) ? $_POST['reponse'] : '';
            
            if (!empty($defi) && !empty($reponse)) {       
                $this->modele->creerDefi($defi, $reponse);
                $_SESSION["msg"] ="Defi ajouté";
                $this->liste();
            } else {
                $_SESSION["erreur"] = "Veuillez remplir tous les champs du formulaire.";
            } 
        }
        if(isset($_SESSION["erreur"])){
            $this->liste();
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
                $this->traiterReponse();
                break;
            case "creerDefi":
                $this->creerDefi();
                break;
            case "supprimer":
                $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                $_SESSION["msg"] = "Défi supprimé !";
                $this->modele->enleverDefiJoueurs($id);
                $this->modele->suppDefi($id);
                $this->liste();
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
