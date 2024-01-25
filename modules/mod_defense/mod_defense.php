<?php
    require_once 'cont_defense.php';

    class ModDefense {

        private $controleur;
    
        function __construct() {
            $this->controleur = new ContDefense();
            $this->controleur->exec();
        }
    
        public function getAffichage() {
            return $this->controleur->getAffichage();
        }
    
    }
?>