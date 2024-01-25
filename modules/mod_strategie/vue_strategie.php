<?php
require_once 'vue_generique.php';

class VueStrategie extends VueGenerique{

	public function bienvenue() {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_strategie/Css-Strategie.css">
        </head>
        <body>

        <h1>Stratégie : Sélectionnez un item pour consulter ses stratégies :</h1> 
		<div> 
		    <a href="index.php?module=strategie&action=tour">Tour</a> 
		    <a href="index.php?module=strategie&action=ennemi">Ennemi</a> 
		</div>

		<?php
    }

	function affiche_listeEnnemi($tab) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_strategie/Css-Strategie.css">
        </head>
        <body>

        <h1>Stratégie des ennemis :</h1>

        <table>
            <tr><th>Nom</th><th>Description</th></tr>
            <?php
            foreach($tab as $liste) {
            ?>
                <tr>
                    <td><?= $liste['nom'] ?> </td>
                    <td><?= $liste['description'] ?> </td>
                </tr>
            <?php
            }
            ?> 
        </table>       
        <?php
        if (isset($_SESSION['user'])) {
        ?>
            <div>
                <p><a href="index.php?module=strategie&action=suggestion">Suggérer une stratégie</a></p>
            </div>
        <?php
        } else {
        ?>
            <div>Pour accéder aux défis, veuillez vous <a href="index.php?module=connexion&action=connexion"> connecter</a> SVP !</div>
        <?php
        }
    }

	function affiche_listeDefense($tab) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_strategie/Css-Strategie.css">
        </head>
        <body>

        <h1>Stratégie des défenses :</h1>

        <table>
            <tr><th>Nom</th><th>Description</th></tr>
            <?php
            foreach($tab as $liste) {
            ?>
                <tr>
                    <td><?= $liste['nom'] ?> </td>
                    <td><?= $liste['description'] ?> </td>
                </tr>
            <?php
            }
            ?> 
        </table>       
        <?php
        if (isset($_SESSION['user'])) {
        ?>
            <div>
                <p><a href="index.php?module=strategie&action=suggestion">Suggérer une stratégie</a></p>
            </div>
        <?php
        } else {
        ?>
            <div>Pour accéder aux défis, veuillez vous <a href="index.php?module=connexion&action=connexion"> connecter</a> SVP !</div>
        <?php
        }
    }

    function affiche_suggestion() {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_strategie/Css-Strategie.css">
        </head>
        <body>

        <h1>Suggestion de stratégie :</h1>
        <h2>Vous avez la possibilité de suggérer de nouvelles stratégies pour les 
        <br>tours ou les obstacles, écrivez-la dans un court texte pour que nous 
        <br>puissions la traiter (Cela vous coûtera 1 jeton) :</h2>

        <form  method="post" action="index.php?module=strategie&action=suggestion">

            <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">

            <label for="choix">Choisir le type :</label>
            <select name="choix" id="choix">
                <option value="ennemi">ennemi</option>
                <option value="tour">tour</option>
            </select>

            <br>

            <input type="text" name="sug" id="sug">

            <br>

            <input type="submit" value="Envoyer">
        </form>
        <?php
        if(isset($_SESSION['erreur'])){
            ?>
            <div style="color:red"><?=$_SESSION['erreur']?></div><br>
            <?php
            unset($_SESSION['erreur']);
        }
    }


	function menu(){
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_strategie/Css-Strategie.css">
        </head>
        <body>
        <?php
		if(isset($_SESSION['erreur'])){
            ?>
            <div style="color:red"><?=$_SESSION['erreur']?></div><br>
            <?php
            unset($_SESSION['erreur']);
        }
		?>
		<ul>
            <li><a href="index.php?module=strategie">Retour aux stratégies</a></li>
            <?php if($_GET['action']=='suggestion') {
            ?>
            <li><a href="index.php?module=strategie&action=ennemi">Retour à la liste de suggestion des ennemis</a></li>
            <li><a href="index.php?module=strategie&action=tour">Retour à la liste de suggestion des tours</a></li>
            <?php } ?>
        </ul>
        <?php
	}
	
}
?>
