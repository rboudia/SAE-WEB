<?php
    require_once 'cont_communaute.php';

    class ModCommunaute {

    private $controleur;

    function __construct() {
        $this->controleur = new ContCommunaute();
        $this->controleur->exec();
    }

    public function getAffichage() {
        return $this->controleur->getAffichage();
    }
}
?>