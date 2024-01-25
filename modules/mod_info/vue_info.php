<head>
	<link rel="stylesheet" href="modules/mod_info/Css-Info.css">
</head>
<?php
require_once 'vue_generique.php';

class VueInfo extends VueGenerique {

    public function bienvenue($tab1,$tab2,$tab3) {
        ?>
            <div class="center-container">
            <table>
    <tr>
        <td> <a href="index.php?module=ennemi&action=liste">Liste des ennemis</a> </td>
        <td> <a href="index.php?module=defense&action=liste">Liste des défenses</a> </td>
        <td> <a href="index.php?module=map&action=liste">Liste des maps</a> </td>
    </tr>
    <tr>
        <td>
            <?php
            foreach ($tab1 as $index => $element) {
                if ($index < 5) {
            ?>
                    <p><?= $element['type_ennemi'] ?></p>
            <?php
                } else {
                    break; // Arrête la boucle après 5 itérations
                }
            }
            ?>
        </td>
        <td>
            <?php
            foreach ($tab2 as $index => $element) {
                if ($index < 5) {
            ?>
                    <p><?= $element['nom_defense'] ?></p>
            <?php
                } else {
                    break; // Arrête la boucle après 5 itérations
                }
            }
            ?>
        </td>
        <td>
            <?php
            foreach ($tab3 as $index => $element) {
                if ($index < 5) {
            ?>
                    <p>Map <?= $element['id_map'] ?></p>
            <?php
                } else {
                    break; // Arrête la boucle après 5 itérations
                }
            }
            ?>
        </td>
    </tr>
</table>
        
                <p>Cet onglet vous permet d'en apprendre plus sur notre jeu. Veuillez cliquer sur les liens dans le tableau ci-dessus pour vous informer.</p>
            </div>
        <?php
        }
        
}

?>
