<?php
    session_start();
    require_once 'modules/mod_profil/mod_profil.php';
    require_once 'modules/mod_accueil/mod_accueil.php';
    require_once 'modules/mod_info/mod_info.php';
    require_once 'modules/mod_strategie/mod_strategie.php';
    require_once 'modules/mod_connexion/mod_connexion.php';
    require_once 'modules/mod_ennemi/mod_ennemi.php';
    require_once 'modules/mod_defense/mod_defense.php';
    require_once 'modules/mod_map/mod_map.php';
    require_once 'modules/mod_defi/mod_defi.php';
    require_once 'modules/mod_classement/mod_classement.php';
    require_once 'modules/mod_partie/mod_partie.php';
    require_once 'modules/mod_message/mod_message.php';
    require_once 'modules/mod_ami/mod_ami.php';

    require_once 'composants/CompMenu/comp_menu.php';

    Connexion::initConnexion();

    $tampon = "";

    $module = isset($_GET['module']) ? $_GET['module'] : "accueil" ;

    switch ($module){
        case "debut":
            break;
        case "accueil":
            $modAccueil = new ModAccueil();
            $tampon = $modAccueil->getAffichage();
            break;    
        case "info":
            $modInfo = new ModInfo();
            $tampon = $modInfo->getAffichage();
            break;  
        case "strategie":
            $modStrategie = new ModStrategie();
            $tampon = $modStrategie->getAffichage();
            break;  
        case 'connexion':
            $modConnexion = new ModConnexion();
            $tampon = $modConnexion->getAffichage();
            break;
        case 'ennemi':
            $modEnnemi = new ModEnnemi();
            $tampon = $modEnnemi->getAffichage();
            break;
        case 'defense':
            $modDefense = new ModDefense();
            $tampon = $modDefense->getAffichage();
            break;
        case 'map':
            $modMap = new ModMap();
            $tampon = $modMap->getAffichage();
            break;
        case 'defi':
            $modDefi = new ModDefi();
            $tampon = $modDefi->getAffichage();
            break;
        case "profil":
            $modProfil = new ModProfil();
            $tampon = $modProfil->getAffichage();
            break; 
        case "classement":
            $modClassement = new ModClassement();
            $tampon = $modClassement->getAffichage();
            break;
        case "partie":
            $modPartie = new ModPartie();
            $tampon = $modPartie->getAffichage();
            break;
        case "message":
            $modMessage = new ModMessage();
            $tampon = $modMessage->getAffichage();
            break;
        case "ami":
            $modAmi = new ModAmi();
            $tampon = $modAmi->getAffichage();
            break;
    }
    $menuComponent = new CompMenu();
    require_once 'template.php';
?>