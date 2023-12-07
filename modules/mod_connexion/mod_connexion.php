<?php
require_once 'cont_connexion.php';
class ModConnexion {
    private $cont_connexion;

    public function __construct() {
        $this->cont_connexion = new ContConnexion();
        $this->cont_connexion->exec();
    }

    public function getAffichage() {
        return $this->cont_connexion->getAffichage();
     }
 
}

?>

