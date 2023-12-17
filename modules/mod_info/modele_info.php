<?php

require_once 'Connexion.php';

class ModeleInfo extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }


}

?>