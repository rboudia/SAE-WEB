<?php
require_once 'modele_profil.php';
require_once 'vue_profil.php';

class ContProfil {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueProfil();
        $this->modele = new ModeleProfil();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "profil" ;
    }

    function id_ennemi($idEnnemi) {
        $this->vue->affiche_detail($this->modele->getDetail($idEnnemi));
    }

    public function changermdp() {
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
            $this->form_changer();
                }
	}

    public function form_changer() {
        $this->vue_connexion->form_changer();
  }

    function exec(){

        switch ($this->action){
            case "profil":
                $utilisateur = $_SESSION['user'];
                $this->id_ennemi($utilisateur["id_joueur"]);
                break;
            
            case "changermdp":
                $this->id_ennemi($utilisateur["id_joueur"]);
                break;

            case "form_changer":
                $this->id_ennemi($utilisateur["id_joueur"]);
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
