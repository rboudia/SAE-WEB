 <?php
    require_once 'cont_accueil.php';
    
    class ModAccueil{

        private $controleur;

        function __construct(){
            $this->controleur = new ContAccueil();
            $this->controleur->exec();
        }

        public function getAffichage() {
            return $this->controleur->getAffichage();
         }
    }
?>