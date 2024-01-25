<?php
require_once 'vue_generique.php';

class VueClassement extends VueGenerique {

    public function classement($tab) {
        $num = 1;
        ?>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="modules/mod_classement/Css-Classement.Css">
            <title>Classement</title>
        </head>
        <body class = "classementbdy">
            <section class="section-classement1">
                <h2 class="titre-classement1">Classement</h2>
                <table class="tableau-classement1">
                    <thead>
                        <tr>
                            <th class="entete-classement1">Classement</th>
                            <th class="entete-classement1">Pseudo</th>
                            <th class="entete-classement1">Statut</th>
                            <th class="entete-classement1">Vague atteinte</th>
                            <th class="entete-classement1">Ennemis tués</th>
                            <th class="entete-classement1">PV de la base</th>
                            <th class="entete-classement1">Argent restant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tab as $defi): ?>
                            <tr class="ligne-classement1">
                                <td class="donnees-classement1"><?= $num ?></td>
                                <td class="donnees-classement1"><?= $defi['pseudo'] ?></td>
                                <td class="donnees-classement1"><?= $defi['status'] ?></td>
                                <td class="donnees-classement1"><?= $defi['vague_atteinte'] ?></td>
                                <td class="donnees-classement1"><?= $defi['nb_ennemis_tues'] ?></td>
                                <td class="donnees-classement1"><?= $defi['pv_base'] ?></td>
                                <td class="donnees-classement1"><?= $defi['argent_restant'] ?></td>
                            </tr>
                            <?php
                            $num = $num + 1;
                        endforeach;
                        ?> 
                    </tbody>
                </table>
            </section>
        </body>
        </html>
        <?php
    }
}
?>
