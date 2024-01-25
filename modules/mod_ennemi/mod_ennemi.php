<?php
    require_once 'cont_ennemi.php';

    class ModEnnemi {

    private $controleur;

    function __construct() {
        $this->controleur = new ContEnnemi();
        $this->controleur->exec();
    }

    public function getAffichage() {
        return $this->controleur->getAffichage();
    }

    }
?>
<?php
    require_once 'cont_ennemi.php';

    class ModEnnemi {

    private $controleur;

    function __construct() {
        $this->controleur = new ContEnnemi();
        $this->controleur->exec();
    }

    public function getAffichage() {
        return $this->controleur->getAffichage();
    }

    }
?>