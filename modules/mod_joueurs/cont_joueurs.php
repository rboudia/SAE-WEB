<?php 
require_once 'modele_joueurs.php';
require_once 'vue_joueurs.php';

class ContJoueurs {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueJoueurs();
        $this->modele = new ModeleJoueurs();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "bienvenue" ;
    }

    function liste() {
        $this->vue->affiche_liste($this->modele->getListe());
    }

    function id_joueur($idJoueur){
        $this->vue->affiche_details($this->modele->getDetail($idJoueur));
    }


    function exec(){

        switch ($this->action){
            case "bienvenue":
                $this->vue->bienvenue();
                $this->vue->menu();
                break;
            
            case "liste":
                $this->vue->menu();
                $this->liste();
                break;
            
            case "details":
                $this->vue->menu();
                $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                $this->id_joueur($id);
                break;

            case "ajout":
                $this->vue->menu();
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $this->ajout();
                }
                $this->vue->form_ajout();
                break;

            default:
                $_SESSION["erreur"] = "Erreur action incorrecte.";
                $this->vue->menu();                
                break;
        }

    }
    public function ajout() {
        if (isset($_POST['nom']) && isset($_POST['description'])) {
            $nom = $_POST['nom'];
            $biographie = $_POST['description'];
    
            $this->modele->ajouterJoueur($nom, $biographie);
        } else {
            $_SESSION["erreur"] = "Des données du formulaire sont manquantes.";
        }
    }
    public function getAffichage() {
        return $this->vue->getAffichage();
     }
}
?>
