<?php 
require_once 'modele_ami.php';
require_once 'vue_ami.php';

class ContAmi {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueAmi();
        $this->modele = new ModeleAmi();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "bienvenue" ;
    }

    public function trouveJoueur() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
        
		    if (!empty($pseudo)) {
                if(!$this->modele->recherche($pseudo)){
                    $_SESSION["erreur"] = "Pseudo introuvable";
                    $this->vue->affiche_barre();
                } else {
                    $this->vue->affiche_barre();
                    $this->vue->affiche_liste($this->modele->recherche($pseudo));
                    var_dump($this->modele->recherche($pseudo));
                }
            } else {
                $_SESSION["erreur"] = "Veuillez écrire le pseudo";
                $this->vue->affiche_barre();
            }
        } else {
            $this->vue_connexion->affiche_barre();
        }
    }

    function ajouter($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = $_POST["date"];

            if (!empty($choix) && !empty($sug) && !empty($date)) {
                
                if ($this->modele->verifJeton($id_utilisateur)) {
                    if($this->modele->ajouterSuggestion($id_utilisateur, $choix, $sug, $date)) {
                        $_SESSION["msg"] ="Suggestion envoyé.";
                        $this->modele->ajouterJetonUtilisateur($id_utilisateur);
                        $this->vue->affiche_suggestion();
                    }else {
                        $_SESSION["erreur"] = "Erreur lors de l'envoie'.";
                    }
                } else {
                    $_SESSION["erreur"] = "Pas assez de jeton.";
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

    function exec() {

        switch ($this->action) {
            case "bienvenue":
                $this->vue->affiche_barre();
                break;
            
            case "liste":
                $this->trouveJoueur();
                
            case "ajouter":
                $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                $this->ajouter($id);
                $dateTime = date('Y-m-d H:i:s');
                $this->modele->ajouterDemandeAmi($id, $_SESSION['user']['pseudo'], $dateTime);
                break;

            case "envoyerMessage":
                $this->modele->envoyerMessage("expediteur1", "destinataire1", "Ceci est un message de test.");
                $this->vue->afficherMessages($this->modele->recupererMessages("destinataire1"));
                break;


            default:
                $_SESSION["erreur"] = "Erreur action incorrecte.";
                $this->vue->affiche_barre();
                break;
        }

    }

    public function getAffichage() {
        return $this->vue->getAffichage();
     }
}
?>
