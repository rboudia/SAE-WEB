<?php
    require_once 'cont_partie.php';  
    class ModPartie{

        private $controleur;

        function __construct(){
            $this->controleur = new ContPartie();
            $this->controleur->exec();

        }
        public function getAffichage() {
            return $this->controleur->getAffichage();
         }
    }
?>
