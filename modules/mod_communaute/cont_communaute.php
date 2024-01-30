<?php 
require_once 'modele_communaute.php';
require_once 'vue_communaute.php';
require_once 'token.php';

class ContCommunaute {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueCommunaute();
        $this->modele = new ModeleCommunaute();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "message" ;
    }


    function envoyerMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (CsrfTokenManager::verifyToken($_POST['csrf_token'])) {
                $message = isset($_POST['message']) ? $_POST['message'] : '';
                $date = date('Y-m-d H:i:s');
                if (isset($_SESSION['admin'])){
                    $id = $_SESSION['admin']['id_joueur'];
                } else {
                    $id = $_SESSION['user']['id_joueur'];
                }
                if (!empty($date)) {
                    if (!empty($message)) {
                        $this->modele->envoieMessage($id, $date, $message);
                        $_SESSION["msg"] ="Message envoyé";
                        $_POST['message'] = "";
                        $token = CsrfTokenManager::generateToken();
                        $this->listeMessage($token);
                        $this->vue->envoyer($token);
                    } else {
                        $_SESSION["erreur"] = "Ecrire un message.";
                    }
                } else {
                    $_SESSION["erreur"] = "Erreur date.";
                }
            } else {
                $_SESSION["erreur"] = "Token invalide.";
            }
        }
        if(isset($_SESSION["erreur"])){
            $token = CsrfTokenManager::generateToken();
            $this->listeMessage($token);
            $this->vue->envoyer($token);
        }
    }

    function listeMessage($token) {
        if($this->modele->listeMessage() === false){
            $_SESSION["affiche_message_erreur"] = "Pas de message";
        }
        $this->vue->afficherMessage($this->modele->listeMessage(), $token);
    }

    function exec() {

        switch ($this->action) {

            case "message":
                $token = CsrfTokenManager::generateToken();
                $this->listeMessage($token);
                $this->vue->envoyer($token);
                break;

            case "envoyer":
                $this->envoyerMessage();
                break;
            
            case "supprimer":
                if (CsrfTokenManager::verifyToken($_POST['csrf_token'])) {
                    $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                    $this->modele->supprimerMessage($id);
                    $token = CsrfTokenManager::generateToken();
                    $this->listeMessage($token);
                    $this->vue->envoyer($token);
                } else {
                    $_SESSION["erreur"] = "Token invalide.";
                    $token = CsrfTokenManager::generateToken();
                    $this->listeMessage($token);
                    $this->vue->envoyer($token);
                }
                break;

            default:
                $_SESSION["erreur"] = "Erreur action incorrecte.";
                break;
        }

    }

    public function getAffichage() {
        return $this->vue->getAffichage();
     }
}
?>
