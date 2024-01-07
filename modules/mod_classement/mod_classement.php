<?php
    require_once 'cont_classement.php';  
    class ModClassement{

        private $controleur;

        function __construct(){
            $this->controleur = new ContClassement();
            $this->controleur->exec();

        }
        public function getAffichage() {
            return $this->controleur->getAffichage();
         }
    }
?>
