
<?php
require_once 'vue_generique.php';

class VueInfo extends VueGenerique {

    public function bienvenue() {
?>
<head>
    <link rel="stylesheet" href="modules/mod_info/Css-Info.css">
</head>
        <div class="center-container">
            <table>
                <tr>
                    <td> <a class="t" href="index.php?module=ennemi&action=liste">Liste des ennemis</a> </td>
                    <td> <a class="t" href="index.php?module=defense&action=liste">Liste des défenses</a> </td>
                    <td> <a class="t" href="index.php?module=map&action=liste">Liste des maps</a> </td>
                </tr>
            </table>

            <p class="texte">Cet onglet vous permet d'en apprendre plus sur notre jeu. Veuillez cliquer sur les liens dans le tableau ci-dessus pour vous informer.</p>
        </div>
<?php
    }
}

?>
