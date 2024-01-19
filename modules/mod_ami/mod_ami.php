<?php
    require_once 'cont_ami.php';

    class ModAmi {

    private $controleur;

    function __construct() {
        $this->controleur = new ContAmi();
        $this->controleur->exec();
    }

    public function getAffichage() {
        return $this->controleur->getAffichage();
    }
}
?>