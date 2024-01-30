<?php
require_once 'modele_connexion.php';
require_once 'vue_connexion.php';
require_once 'token.php';

class ContConnexion {
    public $vue_connexion;
    public $modele_connexion;
    private $action;

    public function __construct() {
        $this->vue_connexion = new VueConnexion();
        $this->modele_connexion = new ModeleConnexion();
        $this->action = isset($_GET['action']) ? $_GET['action'] : '';
    }

    function isValidExtension($file) {
        $exts = ['gif', 'png', 'jpg', 'GIF', 'PNG', 'JPG'];
        $info = pathinfo($file);
        
        if (in_array($info['extension'], $exts))
         return true;
        return false;
       }


	public function inscription() {
	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (CsrfTokenManager::verifyToken($_POST['csrf_token'])) {
                $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
                $login = isset($_POST['login']) ? $_POST['login'] : '';
                $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
                $filename = $_FILES['logo']['name'];

                if (!empty($filename)){
                    $error = $this->isValidExtension($filename);
                    if ($error === false){
                        $_SESSION["erreur"] = "Fichier invalide.";
                        $this->form_inscription();
                        return;
                    }
                    $logo = $this->telechargementImage();
                }     
                if (!empty($pseudo) && !empty($login) && !empty($mdp)) {
                    $login_existant = $this->modele_connexion->verifierLoginExistant($login);
                    $pseudo_existant = $this->modele_connexion->verifierPseudoExistant($pseudo);
                    if ($pseudo_existant) {
                        $_SESSION["erreur"] = "Ce pseudo est déjà utilisé. Veuillez choisir un autre.";
                    }else{
                    if ($login_existant) {
                        $_SESSION["erreur"] = "Ce login est déjà utilisé. Veuillez choisir un autre.";
                    } else {
                        if(empty($logo)){
                            $logo = '';
                        }
                        if ($this->modele_connexion->ajouterUtilisateur($pseudo, $login, $mdp, $logo)) {
                            $_SESSION["msg"] ="Inscription réussie";
                            $token = CsrfTokenManager::generateToken();
                            $this->vue_connexion->form_connexion($token);
                        } else {
                            $_SESSION["erreur"] = "Erreur lors de l'inscription.";
                        }
                    }
                }
            } else {
                    $_SESSION["erreur"] = "Veuillez remplir tous les champs du formulaire.";
                }
            } else{
                $_SESSION["erreur"] = "Token invalide.";
            }
        }

        if(isset($_SESSION["erreur"])){
            $this->form_inscription();
        }
	}
    
    public function connexion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (CsrfTokenManager::verifyToken($_POST['csrf_token'])) {
                $login = isset($_POST['login']) ? $_POST['login'] : '';
                $mot_de_passe = isset($_POST['mdp']) ? $_POST['mdp'] : '';

                if($this->modele_connexion->verifierAdmin($login, $mot_de_passe)){
                    $_SESSION['admin'] = $this->modele_connexion->verifierAdmin($login, $mot_de_passe);
                    $token = CsrfTokenManager::generateToken();
                    $this->vue_connexion->form_connexion($token);
                } else{

                    $utilisateur = $this->modele_connexion->verifierLoginExistant($login);
            
                    if ($utilisateur !== null && $this->modele_connexion->verifierMotDePasse($login, $mot_de_passe)) {
                        $_SESSION['user'] = $utilisateur;
                        $token = CsrfTokenManager::generateToken();
                    $this->vue_connexion->form_connexion($token);

                    } else {
                        $_SESSION["erreur"] = "Informations de connexion incorrectes.";
                        $token = CsrfTokenManager::generateToken();
                        $this->vue_connexion->form_connexion($token);
                    }
                }
            }else {
                $_SESSION["erreur"] = "Token invalide.";
                $token = CsrfTokenManager::generateToken();
                $this->vue_connexion->form_connexion($token);
            }
        } else {
            $token = CsrfTokenManager::generateToken();
            $this->vue_connexion->form_connexion($token);
        }
    }
    
	public function deconnexion() {
        unset($_SESSION['admin']);
        unset($_SESSION['user']);
        $token = CsrfTokenManager::generateToken();
        $this->vue_connexion->form_connexion($token);
	}

    public function form_inscription() {
        $token = CsrfTokenManager::generateToken();
        $this->vue_connexion->form_inscription($token);
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
