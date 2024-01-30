<?php
require_once 'modele_tournoi.php';
require_once 'vue_tournoi.php';
require_once 'token.php';

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
        $token = CsrfTokenManager::generateToken();
        $this->vue->affiche_liste($this->modele->getListe(), $token);
    }

    function traiterReponse($id) {
        if (CsrfTokenManager::verifyToken($_POST['csrf_token'])) {
            if(!$this->modele->verifTournoi($id)){
                if ($this->modele->verifTournoiJoueur($_SESSION['user']['id_joueur'])) {
                    $this->modele->enregistrerTournoi($_SESSION['user']['id_joueur'], $id);
                    $_SESSION['user']['tournoi'] = $id;
                    $_SESSION["msg"] = "Inscription réussi !";
                } else {
                    $_SESSION["erreur"] = "Dèjà inscrit à un tournoi !";
                }
            } else {
                $_SESSION["erreur"] = "Tournoi complet !";
            }
        } else {
            $_SESSION["erreur"] = "Token invalide.";
        } 
    }

    public function creerTournoi() {
	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (CsrfTokenManager::verifyToken($_POST['csrf_token'])) {
                $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
                $nb_max = isset($_POST['nb_max']) ? $_POST['nb_max'] : '';
                $date = isset($_POST['date']) ? $_POST['date'] : '';
                
                if (!empty($nom) && !empty($nb_max) && !empty($date)) {
                    if (!is_numeric($nb_max)) {
                        $_SESSION["erreur"] = "Choisir un nombre pour le nombre de participant.";
                    } else {
                        $nom_existant = $this->modele->verifierNomExistant($nom);
                        if ($nom_existant) {
                            $_SESSION["erreur"] = "Choisir un autre nom.";
                        } else {
                            $this->modele->creerTournoi($nom, $nb_max, $date);
                            $_SESSION["msg"] ="Tournoi ajouté";
                            $this->liste();
                        }
                    }
                } else {
                    $_SESSION["erreur"] = "Veuillez remplir tous les champs du formulaire.";
                } 
            } else {
                $_SESSION["erreur"] = "Token invalide.";
            } 
        }
        if(isset($_SESSION["erreur"])){
            $this->liste();
        }
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
            case "supprimerTournoi":
                if (CsrfTokenManager::verifyToken($_POST['csrf_token'])) {
                    $this->modele->supprimerTournoi($_SESSION['user']['id_joueur']);
                    $_SESSION["msg"] = "Vous avez quitté le tournoi !";
                    $_SESSION['user']['tournoi'] = null;
                    $this->liste();
                } else {
                    $_SESSION["erreur"] = "Token invalide.";
                    $this->liste();
                }
                break;
            case "creerTournoi":
                $this->creerTournoi();
                break;
            case "supprimer":
                if (CsrfTokenManager::verifyToken($_POST['csrf_token'])) {
                    $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                    $_SESSION["msg"] = "Tournoi supprimé !";
                    $this->modele->enleverTournoiJoueurs($id);
                    $this->modele->suppTournoi($id);
                    $this->liste();
                }else {
                    $_SESSION["erreur"] = "Token invalide.";
                    $this->liste();
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
