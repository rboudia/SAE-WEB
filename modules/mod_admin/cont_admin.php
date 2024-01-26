<?php
require_once 'modele_admin.php';
require_once 'vue_admin.php';

class ContAdmin {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueAdmin();
        $this->modele = new ModeleAdmin();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "bienvenue";
    }

    public function inscription() {
	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		    $login = isset($_POST['login']) ? $_POST['login'] : '';
		    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';     

            if (!empty($login) && !empty($mdp)) {
                $login_existant = $this->modele->verifierLoginExistant($login);
                $pseudo_existant = $this->modele->verifierPseudoExistant($login);
                if ($pseudo_existant) {
                    $_SESSION["erreur"] = "Ce pseudo est déjà utilisé. Veuillez choisir un autre.";
                }else{
                if ($login_existant) {
                    $_SESSION["erreur"] = "Ce login est déjà utilisé. Veuillez choisir un autre.";
                } else {
                    if ($this->modele->ajouterUtilisateur($login, $mdp)) {
                        $_SESSION["msg"] ="Inscription réussie";
                        $this->form_inscription();
                    } else {
                        $_SESSION["erreur"] = "Erreur lors de l'inscription.";
                    }
                }
            }
        } else {
                $_SESSION["erreur"] = "Veuillez remplir tous les champs du formulaire.";
            }
        }

        if(isset($_SESSION["erreur"])){
            $this->form_inscription();
        }
	}

    public function form_inscription() {
        $this->vue->form_inscription();
    }

    function demander() {
        if($this->modele->recupererJoueurs() === false){
            $_SESSION["message"] = "Pas d'utilisateur";
        }
        $this->vue->affiche_joueurs($this->modele->recupererJoueurs());
    }

    function supprimer() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = isset($_GET['id']) ? $_GET['id'] : "" ;
            if (!empty($id)) {
                $_SESSION["msg"] ="Joueur supprimé";
                $this->modele->supprimerJoueurMessage($id);
                $this->modele->supprimerJoueurCommunaute($id);
                $this->modele->supprimerJoueurAmelioration($id);
                $this->modele->supprimerJoueurAmis($id);
                $this->modele->supprimerJoueurDefi($id);
                $this->modele->supprimerJoueurDemandeAmis($id);
                $this->modele->supprimerJoueurTournoi($id);
                $this->modele->supprimerJoueur($id);
                $this->form_inscription();
                $this->demander();
                }
        }
    }


    function exec(){
        switch ($this->action){
            case "bienvenue":
                $this->form_inscription();
                $this->demander();
                break;
            case'inscription':
                $this->inscription();
                break;
           case "supprimer":
                $this->supprimer();
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
