<?php
require_once 'modele_strategie.php';
require_once 'vue_strategie.php';

class ContStrategie {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueStrategie();
        $this->modele = new ModeleStrategie();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "strategie" ;
    }

    function tour() {
        $this->vue->affiche_listeDefense($this->modele->getListeDefense());
    }

    function ennemi() {
        $this->vue->affiche_listeEnnemi($this->modele->getListeAttaqueEtDeplacement());
    }

    function envoiSuggestion($utilisateur) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $choix = isset($_POST['choix']) ? $_POST['choix'] : '';
		    $sug = isset($_POST['sug']) ? $_POST['sug'] : '';
            $date = $_POST["date"];

            if (!empty($choix) && !empty($sug) && !empty($date)) {
                
                if ($this->modele->ajouterSuggestion($utilisateur['id_joueur'], $choix, $sug, $date)) {
                    $_SESSION["msg"] ="Suggestion envoyé.";
                    $this->vue->affiche_suggestion();
                    
                } else {
                    $_SESSION["erreur"] = "Erreur lors de l'envoie'.";
                }
        
            } else {
                $_SESSION["erreur"] = "Veuillez remplir tous les champs du formulaire.";
            }
	    }else {
            $this->vue->affiche_suggestion();
        }
        if(isset($_SESSION["erreur"])){
            $this->vue->affiche_suggestion();
        }
    }

    function exec(){

        switch ($this->action){
            case "strategie":
                $this->vue->bienvenue();
                break;
            case "tour":
                $this->vue->menu();
                $this->tour();
                break;
            case "ennemi":
                $this->vue->menu();
                $this->ennemi();
                break;    
            case "suggestion":
                $this->vue->menu();
                $utilisateur = $_SESSION['user'];
                $this->envoiSuggestion($utilisateur);
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
