<?php
require_once 'cont_admin.php';

class ModAdmin {
    private $cont_admin;

    public function __construct() {
        $this->cont_admin = new ContAdmin();
        $this->cont_admin->exec();
    }

    public function getAffichage() {
        return $this->cont_admin->getAffichage();
     }
 
}
?>

