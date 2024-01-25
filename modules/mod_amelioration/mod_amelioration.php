<?php
    require_once 'cont_amelioration.php';
    
    class ModAmelioration{

        private $controleur;

        function __construct(){
            $this->controleur = new ContAmelioration();
            $this->controleur->exec();
        }

        public function getAffichage() {
            return $this->controleur->getAffichage();
         }
    }
?>