<?php
class VueCompMenu {
    private $menuHTML;

    public function __construct() {
        $this->menuHTML .= '<a href="index.php">Acceuil</a>';
        $this->menuHTML .= '<a href="">Informations jeu</a>';
        $this->menuHTML .= '<a href="">Stratégie</a>';
        $this->menuHTML .= '<a href="index.php?module=joueur">Liste des joueurs</a>';
        $this->menuHTML .= '<a href="index.php?module=equipe">Liste des équipes</a>';
        if (isset($_SESSION['user'])) {
            $utilisateur = $_SESSION['user'];
            $this->menuHTML .= '<a href="index.php?module=connexion&action=deconnexion">Déconnexion</a>';
            $this->menuHTML .= '<span style="color: green;">Vous êtes connecté sous l\'identifiant ' . $utilisateur['login'] . ' !</span>';
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
