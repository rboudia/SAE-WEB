 <?php
    require_once 'cont_profil.php';
    
    class ModProfil{

        private $controleur;

        function __construct(){
            $this->controleur = new ContProfil();
            $this->controleur->exec();
        }

        public function getAffichage() {
            return $this->controleur->getAffichage();
         }
    }
?>