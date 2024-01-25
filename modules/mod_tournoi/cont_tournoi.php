<?php
require_once 'modele_tournoi.php';
require_once 'vue_tournoi.php';

class ContTournoi {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueTournoi();
        $this->modele = new ModeleTournoi();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "afficheTournoi";
    }

    function liste() {
        $this->vue->affiche_liste($this->modele->getListe());
    }

    function traiterReponse() {
        if ($this->modele->verifTournoiJoueur($_SESSION['user']['id_joueur'])) {
            
            
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
             $_SESSION["erreur"] = "Dèjà inscrit à un tournoi !";
         }
    }

    private function getIdUtilisateur() {
        return isset($_SESSION['user']['id_joueur']) ? $_SESSION['user']['id_joueur'] : null;
    }


    function exec(){
        switch ($this->action){
            case "afficheTournoi":
                 $this->liste();
                break;
            case "traiterReponse":
                $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                $this->traiterReponse($id);
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
