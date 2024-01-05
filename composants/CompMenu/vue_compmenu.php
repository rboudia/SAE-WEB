<?php
class VueCompMenu {
    private $menuHTML;

    public function __construct() {
        $this->menuHTML .= '<a href="index.php?module=accueil">Accueil</a>';
        $this->menuHTML .= '<a href="index.php?module=info">Informations jeu</a>';
        $this->menuHTML .= '<a href="index.php?module=strategie">Stratégie</a>';
        $this->menuHTML .= '<a href="index.php?module=defi">Défi</a>';

        if (isset($_SESSION['user'])) {
            $utilisateur = $_SESSION['user'];
            $this->menuHTML .= '<a href="index.php?module=profil">Profil</a>';
            $this->menuHTML .= '<a href="index.php?module=connexion&action=deconnexion">Déconnexion</a>';
            $this->menuHTML .= '<span style="color: green;">Vous êtes connecté sous le pseudo ' . $utilisateur['pseudo'] . ' !</span>';
        } else {
            $this->menuHTML .= '<a href="index.php?module=connexion&action=connexion">Connexion</a>';
            $this->menuHTML .= '<a href="index.php?module=connexion&action=afficher">Inscription</a>';
        }
    }

    public function affiche() {
        return $this->menuHTML;
    }


}
?>
