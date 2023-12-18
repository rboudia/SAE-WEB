 <?php
    require_once 'cont_strategie.php';
    
    class ModStrategie{

        private $controleur;

        function __construct(){
            $this->controleur = new ContStrategie();
            $this->controleur->exec();
        }

        public function getAffichage() {
            return $this->controleur->getAffichage();
         }
    }
?>