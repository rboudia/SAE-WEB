<?php
    require_once 'cont_message.php';

    class ModMessage {

    private $controleur;

    function __construct() {
        $this->controleur = new ContMessage();
        $this->controleur->exec();
    }

    public function getAffichage() {
        return $this->controleur->getAffichage();
    }
}
?>