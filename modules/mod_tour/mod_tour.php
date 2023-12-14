<?php
    require_once 'cont_tour.php';

    class ModTour {

        private $controleur;
    
        function __construct() {
            $this->controleur = new ContTour();
            $this->controleur->exec();
        }
    
        public function getAffichage() {
            return $this->controleur->getAffichage();
        }
    
        }

?>