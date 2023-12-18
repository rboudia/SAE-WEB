<?php
require_once 'modele_connexion.php';
require_once 'vue_connexion.php';

class ContConnexion {
    public $vue_connexion;
    public $modele_connexion;
    private $action;

    public function __construct() {
        $this->vue_connexion = new VueConnexion();
        $this->modele_connexion = new ModeleConnexion();
        $this->action = isset($_GET['action']) ? $_GET['action'] : '';
    }


	public function inscription() {
	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
		    $login = isset($_POST['login']) ? $_POST['login'] : '';
		    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';

		if (!empty($pseudo) && !empty($login) && !empty($mdp)) {
		    $login_existant = $this->modele_connexion->verifierLoginExistant($login);
		    $pseudo_existant = $this->modele_connexion->verifierPseudoExistant($pseudo);

            if ($pseudo_existant) {
		        $_SESSION["erreur"] = "Ce pseudo est déjà utilisé. Veuillez choisir un autre.";
		    }else{
		    if ($login_existant) {
		        $_SESSION["erreur"] = "Ce login est déjà utilisé. Veuillez choisir un autre.";
		    } else {
		        if ($this->modele_connexion->ajouterUtilisateur($pseudo, $login, $mdp)) {
                    $_SESSION["msg"] ="Inscription réussie";
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
    
    public function connexion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = isset($_POST['login']) ? $_POST['login'] : '';
            $mot_de_passe = isset($_POST['mdp']) ? $_POST['mdp'] : '';
    
		$utilisateur = $this->modele_connexion->verifierLoginExistant($login);
    
            if ($utilisateur !== null && $this->modele_connexion->verifierMotDePasse($login, $mot_de_passe)) {
                $_SESSION['user'] = $utilisateur;

            } else {
                $_SESSION["erreur"] = "Informations de connexion incorrectes.";
                $this->vue_connexion->form_connexion();
            }
        } else {
            $this->vue_connexion->form_connexion();
        }
    }
    
	 public function deconnexion() {
    unset($_SESSION['user']);
	    }

    public function form_inscription() {
        $this->vue_connexion->form_inscription();
  }
    

    public function exec() {
        switch ($this->action) {
            case 'afficher':
                $this->form_inscription();
                break;
            case'inscription':
                $this->inscription();
                break;
            case 'connexion':
                 $this->connexion();
                break;
            case 'deconnexion':
                $this->deconnexion();
                break;
        }
    }
    public function getAffichage() {
        return $this->vue_connexion->getAffichage();
     }
}
?>
