<head>
<link rel="stylesheet" href="modules/mod_info/Css-Info.css">
</head>
<?php
require_once 'vue_generique.php';

class VueInfo extends VueGenerique {

    public function bienvenue($tab1,$tab2,$tab3) {
        ?>
        
            <div class="tab_info">
            <table>
    <tr>
        <th> <a href="index.php?module=ennemi&action=liste">Liste des ennemis</a> </th>
        <th> <a href="index.php?module=defense&action=liste">Liste des défenses</a> </th>
        <th> <a href="index.php?module=map&action=liste">Liste des maps</a> </th>
    </tr>
    <tr>
        <td>
            <?php
            foreach ($tab1 as $index => $element) {
                if ($index < 5) {
            ?>
                    <li class="item"><?= $element['type_ennemi'] ?></li>
            <?php
                } else {
                    break;
                }
            }
            ?>
        </td>
        <td>
            <?php
            foreach ($tab2 as $index => $element) {
                if ($index < 5) {
            ?>
                    <li class="item"><?= $element['nom_defense'] ?></li>
            <?php
                } else {
                    break;
                }
            }
            ?>
        </td>
        <td>
            <?php
            foreach ($tab3 as $index => $element) {
                if ($index < 5) {
            ?>
                    <li class="item">Map <?= $element['id_map'] ?></li>
            <?php
                } else {
                    break;
                }
            }
            ?>
        </td>
    </tr>
</table>
        
<p>Cet onglet vous permet d'en apprendre plus sur notre jeu. 
    Veuillez cliquer sur l'une des listes ci-dessus pour avoir la liste exhaustive des éléments de la liste que vous avez choisie.
</p>
            </div>
            
        <?php
        }
        
}

?>
