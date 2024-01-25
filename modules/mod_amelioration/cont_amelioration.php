<?php
require_once 'modele_amelioration.php';
require_once 'vue_amelioration.php';

class ContAmelioration {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueAmelioration();
        $this->modele = new ModeleAmelioration();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "bienvenue" ;
    }


    function exec(){
        switch ($this->action){
            case "bienvenue":
                $utilisateur = $_SESSION['user'];
                $solde = $this->modele->getSoldeJoueur($utilisateur["id_joueur"]);
                $this->vue->bienvenue($solde);
                $def = $this->modele->getDefense();
                $this->vue->affichageDefense($def);
                break;

                case "amelioration":
                    $utilisateur = $_SESSION['user'];
                    $solde = $this->modele->getSoldeJoueur($utilisateur["id_joueur"]);
        
                    if ($solde >= 4) {
                       
                        $this->modele->decrementerSoldeJoueur($utilisateur["id_joueur"], 4);
        
                        $idDefense = isset($_POST['id_defense']) ? $_POST['id_defense'] : null;
        
                        $this->modele->ameliorerDefense($utilisateur["id_joueur"], $idDefense);
                    } else {
                        $this->vue->messageErreur();
                    }
                    $this->vue->bienvenue($solde);
                    $def = $this->modele->getDefense();
                    $this->vue->affichageDefense($def);
                    break;

                    case "voir_ameliorations":
                        $utilisateur = $_SESSION['user'];
                        $ameliorations = $this->modele->getAmeliorationsJoueur($utilisateur["id_joueur"]);
                        $this->vue->voirAmeliorations($ameliorations);
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
