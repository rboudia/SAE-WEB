 <?php
    require_once 'cont_equipes.php';
    
    class ModEquipe{

        private $controleur;

        function __construct(){
            $this->controleur = new ContEquipe();
            $this->controleur->exec();
        }

        public function getAffichage() {
            return $this->controleur->getAffichage();
         }
    }
?>