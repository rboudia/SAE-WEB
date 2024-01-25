<?php
require_once 'vue_generique.php';

class VueAmelioration extends VueGenerique {

    public function messageErreur() {
        ?>
        <div class="erreur-container">
            <p class="erreur">Pas assez de jetons, il en faut au moins 4 !</p>
        </div>
        <?php
    }
   
    public function voirAmeliorations($ameliorations) {
        ?>
        <head>
            <link rel="stylesheet" href="modules/mod_amelioration/css-amelioration.css"> 
        </head>
        <body>
            <h1 class = "ame">Mes améliorations</h1>
            <table>
                <tr>
                    <th>Défense</th>
                    <th>Pseudo</th>
                    <th>Valeur d'Amélioration</th>
                </tr>
                <?php foreach ($ameliorations as $amelioration) { ?>
                    <tr>
                        <td><?php echo $amelioration['nom_defense']; ?></td>
                        <td><?php echo $amelioration['pseudo']; ?></td>
                        <td><?php echo $amelioration['val_amelioration']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </body>
        </html>
        <?php
    }

    public function bienvenue($solde) {
        ?>
        <head>
            <link rel="stylesheet" href="modules/mod_amelioration/css-amelioration.css"> 
        </head>
        <body>
            <div class="bvnue-container">
                <h1>Bienvenue !</h1>
                <p class="balance">Votre solde de jeton pour les améliorations : <?php echo $solde; ?></p>
                <a href="index.php?module=amelioration&action=voir_ameliorations" class="button2">Voir mes améliorations</a>
            </div>
        </body>
        </html>
        <?php
    }

    public function affichageDefense($donneesDefense) {
        ?>
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Affichage de la Défense</title>
        <link rel="stylesheet" href="modules/mod_amelioration/css-amelioration.css">
    </head>
    <body>
        <h1 class = "aff">Affichage de la Défense</h1>
        <table>
            <tr>
                <th>Nom de la Défense</th>
                <th>Améliorer</th>
            </tr>
            <?php foreach ($donneesDefense as $defense) { ?>
                <tr>
                    <td><?php echo $defense['nom_defense']; ?></td>
                    <td>
                        <form method="post" action="index.php?module=amelioration&action=amelioration">
                            <input type="hidden" name="id_defense" value="<?php echo $defense['id_defense']; ?>">
                            <button type="submit" class="button">Améliorer</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </body>
    </html>
    <?php
}
}

?>
