<?php 

require_once 'Connexion.php';

class ModeleMessage extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }


}

?>