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

    function exec() {

        switch ($this->action) {
            case "bienvenue":
                $this->vue->bienvenue();
                break;

            case "envoyerMessage":
                $this->modele->envoyerMessage("expediteur1", "destinataire1", "Ceci est un message de test.");
                $this->vue->afficherMessages($this->modele->recupererMessages("destinataire1"));
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
