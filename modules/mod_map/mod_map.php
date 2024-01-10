<?php
    require_once 'cont_map.php';

    class ModMap {
        private $controleur;

        function __construct() {
            $this->controleur = new ContMap();
            $this->controleur->exec();
        
        }

        public function getAffichage() {
            return $this->controleur->getAffichage();
        }
    }
?>