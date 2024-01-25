<?php
require_once 'cont_tournoi.php';

class ModTournoi {
    private $cont_tournoi;

    public function __construct() {
        $this->cont_tournoi = new ContTournoi();
        $this->cont_tournoi->exec();
    }

    public function getAffichage() {
        return $this->cont_tournoi->getAffichage();
     }
 
}
?>

