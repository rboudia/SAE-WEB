<?php
require_once 'vue_generique.php';

class VueAmelioration extends VueGenerique {

   
    public function bienvenue($solde) {
        ?>
        <head>
            <link rel="stylesheet" href="modules/mod_amelioration/css-amelioration.css"> 
        </head>
        <body>
            <div class="bvnue-container">
                <h1>Bienvenue !</h1>
                <p class="balance">Votre solde de jeton pour les améliorations : <?php echo $solde; ?></p>
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
                    <td><button class="button">Améliorer</button></td>
                </tr>
            <?php } ?>
        </table>
    </body>
    </html>
    <?php
}
}

?>