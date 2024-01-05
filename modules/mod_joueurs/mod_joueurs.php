<?php
    require_once 'cont_joueurs.php';  
    class ModJoueurs{

        private $controleur;

        function __construct(){
            $this->controleur = new ContJoueurs();
            $this->controleur->exec();

        }
        public function getAffichage() {
            return $this->controleur->getAffichage();
         }
    }
?>
