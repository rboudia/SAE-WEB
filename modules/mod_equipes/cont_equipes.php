<?php
require_once 'modele_equipes.php';
require_once 'vue_equipes.php';

class ContEquipe {

    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->vue = new VueEquipes();
        $this->modele = new ModeleEquipe();
        $this->action = isset($_GET['action']) ? $_GET['action'] : "bienvenue" ;
    }

    function liste() {
        $this->vue->affiche_liste($this->modele->getListe());


    }

    function id_equipe($idEquipe){
        $this->vue->affiche_detail($this->modele->getDetail($idEquipe));

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
                $this->id_equipe($id);
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
        if (isset($_POST['nom']) && isset($_POST['annee_creation']) && isset($_POST['description']) && isset($_POST['pays']) && isset($_POST['logo'])) {
            $nom = $_POST['nom'];
            $annee_creation = $_POST['annee_creation'];
            $description = $_POST['description'];
            $pays = $_POST['pays'];
            $logo = $_POST['logo'];
    
            $this->modele->ajouterEquipe($nom, $annee_creation, $description, $pays, $logo);
        } else {
            $_SESSION["erreur"] = "Des données du formulaire sont manquantes.";
        }
    }
    public function getAffichage() {
        return $this->vue->getAffichage();
     }
}
?>
