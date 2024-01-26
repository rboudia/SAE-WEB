<?php
require_once 'vue_generique.php';

class VueStrategie extends VueGenerique{

	public function bienvenue() {
        ?>
        <head>
            <link rel="stylesheet" href="modules/mod_strategie/Css-Strategie.css">
        </head>
      <div class="section_strategie">
        <h1 class="titre_strategie">Stratégie : Sélectionnez un item pour consulter ses stratégies :</h1> 
        <div class="liens_strategie"> 
            <a class="lien_strategie" href="index.php?module=strategie&action=tour">Tour</a> 
            <a class="lien_strategie" href="index.php?module=strategie&action=ennemi">Ennemi</a> 
        </div>
    </div>

		<?php
    }

	function affiche_listeEnnemi($tab) {
        ?>
        <head>
            <link rel="stylesheet" href="modules/mod_strategie/Css-Strategie.css">
        </head>
        <div class="section_strategie">
            <h1 class="titre_strategie">Stratégie des ennemis :</h1>
    
            <table class="table_strategie">
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
            <div class="suggestion_strategie">
                <p><a class="lien_strategie" href="index.php?module=strategie&action=suggestion">Suggérer une stratégie</a></p>
            </div>
        <?php
        } else {
            if (isset($_SESSION['admin'])) {
                ?>
                <div class="suggestion_strategie">
                    <p><a class="lien_strategie" href="index.php?module=strategie&action=afficheSuggestion">Afficher les suggestions</a></p>
                </div>
                <?php
            } else {
        ?>
            <div class="connexion_strategie">Pour accéder aux défis, veuillez vous <a class="lien_strategie" href="index.php?module=connexion&action=connexion"> connecter</a> SVP !</div>
        </div>
        <?php
            }
        }
        ?>
        </div>
        <?php
    }
    

	function affiche_listeDefense($tab) {
        ?>
        <head>
            <link rel="stylesheet" href="modules/mod_strategie/Css-Strategie.css">
        </head>
        <div class="section_strategie">

        <h1 class="titre_strategie">Stratégie des défenses :</h1>

        <table class="table_strategie">
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
            <div class="suggestion_strategie">
                <p><a class="lien_strategie" href="index.php?module=strategie&action=suggestion">Suggérer une stratégie</a></p>
            </div>
        <?php
        } else {
            if (isset($_SESSION['admin'])) {
                ?>
                <div class="suggestion_strategie">
                    <p><a class="lien_strategie" href="index.php?module=strategie&action=afficheSuggestion">Afficher les suggestions</a></p>
                </div>
                <?php
            } else {
        ?>
            <div class="connexion_strategie">Pour accéder aux défis, veuillez vous <a class="lien_strategie" href="index.php?module=connexion&action=connexion"> connecter</a> SVP !</div>
        </div>
        <?php
            }
        }
    }

    function affiche_sugg($tab) {
        ?>
        <head>
            <link rel="stylesheet" href="modules/mod_strategie/Css-Strategie.css">
        </head>
        <div class="section_strategie">
            <h1 class="titre_strategie">Stratégie des ennemis :</h1>
    
            <table class="table_strategie">
                <tr><th>Suggestion</th><th>Type</th><th>Date</th><th>Proposé par</th><th>Supprimer</th></tr>
                <?php
                foreach($tab as $liste) {
                    ?>
                    <tr>
                        <td><?= $liste['suggestion'] ?> </td>
                        <td><?= $liste['type'] ?> </td>
                        <td><?= $liste['date'] ?> </td>
                        <td><?= $liste['pseudo'] ?> </td>
                        <td><form action="index.php?module=strategie&action=supprimerSugg&id=<?= $liste['id_suggestion'] ?>" method="post">
                        <button type="submit" name="supprimerSugg">Supprimer</button>
                        </form></td>
                    </tr>
                    <?php
                }
                ?> 
            </table>       
        </div>
        <?php
    }

    function affiche_suggestion() {
        ?>
        <head>
            <link rel="stylesheet" href="modules/mod_strategie/Css-Strategie.css">
        </head>
        <div class="section_strategie">
            <h1 class="titre_strategie">Suggestion de stratégie :</h1>
            <h2 class="sous-titre_strategie">Vous avez la possibilité de suggérer de nouvelles stratégies pour les tours ou les obstacles. Écrivez-la dans un court texte pour que nous puissions la traiter (Cela vous coûtera 1 jeton) :</h2>
    
            <form class="formulaire_strategie" method="post" action="index.php?module=strategie&action=suggestion">
                <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
    
                <label for="choix" class="suggestion-label">Choisir le type :</label>
                <select name="choix" id="choix" class="element-form_strategie">
                    <option value="ennemi">ennemi</option>
                    <option value="tour">tour</option>
                </select>
    
                <br>
    
                <input type="text" name="sug" id="sug" class="element-form_strategie">
    
                <br>
    
                <input type="submit" value="Envoyer" class="envoyer_strategie">
            </form>
    
            <?php
            if(isset($_SESSION['erreur'])){
                ?>
                <div class="erreur_strategie" style="color:red"><?=$_SESSION['erreur']?></div><br>
                <?php
                unset($_SESSION['erreur']);
            }
            ?>
        </div>
        <?php
    }
    


	function menu() {
        ?>
        <head>
            <link rel="stylesheet" href="modules/mod_strategie/Css-Strategie.css">
        </head>
        <div class="section_strategie">
            <ul class="liste-menu_strategie">
                <li><a class="lien-menu_strategie" href="index.php?module=strategie">Retour aux stratégies</a></li>
                <?php if($_GET['action']=='suggestion' || $_GET['action']=='afficheSuggestion' || $_GET['action']=='supprimerSugg') {
                ?>
                <li><a class="lien-menu_strategie" href="index.php?module=strategie&action=ennemi">Retour à la liste de suggestion des ennemis</a></li>
                <li><a class="lien-menu_strategie" href="index.php?module=strategie&action=tour">Retour à la liste de suggestion des tours</a></li>
                <?php } ?>
            </ul>
        </div>
        <?php
    }
    
	
}
?>
