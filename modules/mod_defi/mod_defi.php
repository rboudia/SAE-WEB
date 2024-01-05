<?php
require_once 'cont_defi.php';

class ModDefi {
    private $cont_defi;

    public function __construct() {
        $this->cont_defi = new ContDefi();
        $this->cont_defi->exec();
    }

    public function getAffichage() {
        return $this->cont_defi->getAffichage();
     }
 
}
?>

