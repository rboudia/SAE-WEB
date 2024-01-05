<?php
require_once 'vue_generique.php';

class VueDefi extends VueGenerique {

    public function bienvenue() {
        $cssChemin = "modules/mod_defi/Css-Defi.css";
    
        $contenu = isset($_SESSION['user'])
            ? '
                <div class="messBien">Bienvenue ' . $_SESSION['user']['pseudo'] . '!</div>
                <div class="expli">
                    <div class="box">
                        <h2>A quoi servent les défis ?</h2>
                        <p>Vous trouverez ci-dessous une liste de questions de culture général.
                        <br>Vous avez ensuite un champ qui vous permet de répondre et vous rapporte des jetons visibles sur votre profil.<br>
                            Ces jetons vous permetteront ensuite d ameliorer vos défenses depuis le site !</p>
                    </div>
                </div>
                <form action="index.php?module=defi&action=afficheDefi" method="post">
                    <button type="submit" name="afficheDefi" class="bouttonAff">Afficher Défi</button>
                </form>'
            : '<div class="messErr">Pour accéder aux défis, veuillez vous connecter SVP !</div>';
    
        echo "
            <!DOCTYPE html>
            <html lang='fr'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' type='text/css' href='$cssChemin'>
            </head>
            <body>
                $contenu
            </body>
            </html>";
    }
    
    function affiche_liste($tab) {
        echo '<!DOCTYPE html>';
        echo '<html lang="fr">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<link rel="stylesheet" type="text/css" href="modules/mod_defi/Css-Defi.css">'; 
        echo '</head>';
        echo '<body>';

        foreach($tab as $defi) {
            echo '<form action="index.php?module=defi&action=traiterReponse" method="post">';
            echo '<input type="hidden" name="defiId" value="'.$defi['id_defi'].'">'; 
            echo '<table class="styled-table">';
            echo '<tr><th>Défi</th><th>Réponse (Tout en minuscule)</th><th>Envoyer</th></tr>';
            echo '<tr>';
            echo '<td>'.$defi['defi'].'</td>';
            echo '<td><input type="text" name="reponse" placeholder="Votre réponse"></td>'; 
            echo '<td><button type="submit" name="envoyerReponse" class="styled-button">Envoyer Réponse</button></td>';
            echo '</tr>';
            echo '</table>';
            echo '</form>'; 
        }

        echo '</body>';
        echo '</html>';
    }
    }
    ?>
