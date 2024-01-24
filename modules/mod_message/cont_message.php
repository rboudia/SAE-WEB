<?php 
require_once 'modele_message.php';
require_once 'vue_message.php';

class ContMessage {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueMessage();
        $this->modele = new ModeleMessage();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "bienvenue" ;
    }


    function listeAmi() {
        if($this->modele->recupererAmi($_SESSION['user']['id_joueur']) === false){
            $_SESSION["message_erreur"] = "Vous n'avez pas d'ami.";
        }
        $this->vue->afficherAmi($this->modele->recupererAmi($_SESSION['user']['id_joueur']));
    }

    function envoyerMessage($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = isset($_POST['message']) ? $_POST['message'] : '';
            $date = date('Y-m-d H:i:s');
            if (!empty($date)) {
                if (!empty($message)) {
                    $this->modele->envoieMessage($_SESSION['user']['id_joueur'], $id, $date, $message);
                    $_SESSION["msg"] ="Message envoyé";
                    $message = '';
                    $this->vue->menu();
                    $this->listeMessage($id);
                    $this->vue->envoyer($id);
                } else {
                    $_SESSION["erreur"] = "Ecrire un message.";
                }
            } else {
                $_SESSION["erreur"] = "Erreur date.";
            }
        }
        if(isset($_SESSION["erreur"])){
            $this->vue->menu();
            $this->listeMessage($id);
            $this->vue->envoyer($id);
        }
    }

    function listeMessage($id) {
        if($this->modele->listeMessage($_SESSION['user']['id_joueur'], $id) === false){
            $_SESSION["affiche_message_erreur"] = "Pas de message";
        }
        $this->vue->afficherMessage($this->modele->listeMessage($_SESSION['user']['id_joueur'], $id));
    }

    function exec() {

        switch ($this->action) {
            case "bienvenue":
                $this->listeAmi();
                break;

            case "message":
                $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                $this->vue->menu();
                $this->listeMessage($id);
                $this->vue->envoyer($id);
                break;

            case "envoyer":
                $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                $this->envoyerMessage($id);
                break;

            default:
                $_SESSION["erreur"] = "Erreur action incorrecte.";
                $this->vue->menu();
                break;
        }

    }

    public function getAffichage() {
        return $this->vue->getAffichage();
     }
}
?>
