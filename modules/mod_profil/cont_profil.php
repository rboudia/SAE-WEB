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
            $ancienmdp = isset($_POST['ancienmdp']) ? $_POST['ancienmdp'] : '';
		    $nouveaumdp = isset($_POST['nouveaumdp']) ? $_POST['nouveaumdp'] : '';
		    $confirmermdp = isset($_POST['confirmermdp']) ? $_POST['confirmermdp'] : '';

		if (!empty($ancienmdp) && !empty($nouveaumdp) && !empty($confirmermdp)) {
            $login = $_SESSION['user'];
		    $mdpvalide = $this->modele->verifierMotDePasse($login['id_joueur'], $ancienmdp);
            if (!$mdpvalide) {
		        $_SESSION["erreur"] = "Mot de passe incorrect.";
		    }else{
                if ($nouveaumdp != $confirmermdp) {
		        $_SESSION["erreur"] = "Les mots de passe ne sont pas les mêmes.";
		    } else {
		        if ($this->modele->changerMotDePasse($login['id_joueur'], $nouveaumdp)) {
                    $_SESSION["msg"] ="Mot de passe mis à jour.";
                    $_SESSION['user']['mdp'] = $nouveaumdp;
                    $this->vue->affiche_detail($this->modele->getDetail(($_SESSION['user']['id_joueur'])));
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

    public function modif($ancienjoueur) {
	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
		    $login = isset($_POST['login']) ? $_POST['login'] : '';


            $logo = $this->telechargementImage();

            if (empty($logo)){
               $logo = $_SESSION['user']['photo_profil'];

            }

            if (!empty($pseudo) && !empty($login)) {
                $login_existant = $this->modele->verifierLoginExistant($login);
                $pseudo_existant = $this->modele->verifierPseudoExistant($pseudo);
                if ( $ancienjoueur["login"] !== $login) {
                    if ($login_existant) {
                        $_SESSION["erreur"] = "Ce login est déjà utilisé. Veuillez choisir un autre.";
                        $this->vue->formulaireModification($ancienjoueur);
                        return;
                    } 
                }
                if ( $ancienjoueur["pseudo"] !== $pseudo) {
                    if ($pseudo_existant) {
                        $_SESSION["erreur"] = "Ce pseudo est déjà utilisé. Veuillez choisir un autre.";
                        $this->vue->formulaireModification($ancienjoueur);
                        return;
                    }         
                } 
                if ($this->modele->changerInfo($ancienjoueur['id_joueur'], $pseudo, $login, $logo)) {
                    $_SESSION["msg"] ="Informations mis à jour.";
                    $_SESSION['user']['login'] = $login;
                    $_SESSION['user']['pseudo'] = $pseudo;
                    $_SESSION['user']['photo_profil'] = $logo;
                    $this->vue->affiche_detail($this->modele->getDetail(($_SESSION['user']['id_joueur'])));
                    

                } else {
                    $_SESSION["erreur"] = "Erreur lors de la mise à jour.";
                }
                    
        
            } else {
                $_SESSION["erreur"] = "Veuillez remplir tous les champs du formulaire.";
            }
	    }else {
            $this->vue->formulaireModification($ancienjoueur);
        }
	}

    public function form_changer() {
        $this->vue->form_changer();
    }

    public function telechargementImage() {
        $logo = ''; 
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK) {

            $extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $dossierCible = "modules/mod_connexion/logos/";
            $nomFichier = uniqid("logo_") . '.' . $extension;
            $fichierCible = $dossierCible . $nomFichier;
    
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $fichierCible)) {
                $logo = $fichierCible;
            } else {
                $_SESSION["erreur"] = "Erreur lors du téléchargement du fichier.";
                return $logo; 
            }
        }

        return $logo; 
    }

    function exec(){

        switch ($this->action){
            case "profil":
                $utilisateur = $_SESSION['user'];
                $this->id_ennemi($utilisateur["id_joueur"]);
                break;
            
            case "changermdp":
                $this->changermdp();
                break;

            case "afficher":
                $this->form_changer();
                break;                

            case "modifier":
                $utilisateur = $_SESSION['user'];
                $this->modif($utilisateur);
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
