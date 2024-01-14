<?php 
require_once 'modele_partie.php';
require_once 'vue_partie.php';

class ContPartie {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VuePartie();
        $this->modele = new ModelePartie();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "menu" ;
    }

    public function trouvePartie() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
        
		    if (!empty($pseudo)) {
                if(!$this->modele->recherche($pseudo)){
                    $_SESSION["erreur"] = "Pseudo introuvable";
                    $this->vue->menu();
                    $this->vue->affiche_barre();
                    $this->vue->classement($this->modele->getTop3Players());
                } else {
                    $this->vue->menu();
                    $this->vue->affiche_barre();
                    $this->vue->affiche_liste($this->modele->partieJoueur($pseudo));
                    $this->vue->classement($this->modele->getTop3Players());
                }
            } else {
                $_SESSION["erreur"] = "Veuillez écrire le pseudo";
                $this->vue->menu();
                $this->vue->affiche_barre();
                $this->vue->classement($this->modele->getTop3Players());
            }
        } else {
            $this->vue_connexion->form_connexion();
        }
    }

    function id_partie($idPartie) {
        $this->vue->affiche_detail($this->modele->getDetail($idPartie));
    }

    function exec(){

        switch ($this->action){

            case "partie":
                $this->trouvePartie();
                break;

             case "details":
                $this->vue->menu();
                $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                $this->id_partie($id);
                break;
            
            case "menu":
                $this->vue->menu();
                $this->vue->affiche_barre();
                $this->vue->classement($this->modele->getTop3Players());
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
