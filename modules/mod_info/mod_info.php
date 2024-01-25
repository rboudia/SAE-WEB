<?php
    require_once 'cont_info.php';
    
    class ModInfo{

        private $controleur;

        function __construct(){
            $this->controleur = new ContInfo();
            $this->controleur->exec();
        }

        public function getAffichage() {
            return $this->controleur->getAffichage();
         }
    }
?>