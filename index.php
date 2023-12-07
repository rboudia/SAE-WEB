<?php
    session_start();
    require_once 'modules/mod_joueurs/mod_joueurs.php';
    require_once 'modules/mod_equipes/mod_equipes.php';
    require_once 'modules/mod_connexion/mod_connexion.php';
    require_once 'composants/CompMenu/comp_menu.php';

    Connexion::initConnexion();

    $tampon = "";

    $module = isset($_GET['module']) ? $_GET['module'] : "" ;

    switch ($module){
        case "debut":
            break;
        case "joueur":
            $modJoueurs = new ModJoueurs();
            $tampon = $modJoueurs->getAffichage();
            break;
            
        case "equipe":
            $modEquipe = new ModEquipe();
            $tampon = $modEquipe->getAffichage();
            break;
        
        case 'connexion':
            $modConnexion = new ModConnexion();
            $tampon = $modConnexion->getAffichage();
            break;
            
    }
    $menuComponent = new CompMenu();
    require_once 'template.php';
?>