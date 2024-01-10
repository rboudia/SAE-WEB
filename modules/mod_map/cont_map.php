<?php
    require_once 'modele_map.php';
    require_once 'vue_map.php';

    class ContMap {
        private $vue;
        private $modele;
        private $action;
        
        function __construct() {
            $this->vue = new VueMap();
            $this->modele = new ModeleMap();
            $this->action = isset($_GET['action']) ? $_GET['action'] : "liste_sans" ;
        }

        function liste() {
            $this->vue->affiche_liste($this->modele->getListe());
        }
    
        function liste_sans() {
            $this->vue->affiche_liste_sans($this->modele->getListe());
        }
    
        function id_map($idMap) {
            $this->vue->affiche_detail($this->modele->getDetail($idMap));
        }

        function exec(){

            switch ($this->action){
                case "liste":
                    $this->vue->menu();
                    $this->liste();
                    break;
                case "liste_sans":
                    $this->liste_sans();
                    break;
                case "details":
                    $this->vue->menu();
                    $id = isset($_GET['id']) ? $_GET['id'] : "Error" ;
                    $this->id_map($id);
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