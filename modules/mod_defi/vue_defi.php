<?php
require_once 'vue_generique.php';

class VueDefi extends VueGenerique {

    public function bienvenue() {    
        if(isset($_SESSION['erreur'])){
            ?>
            <div style="color:red"><?=$_SESSION['erreur']?></div><br>
            <?php
            unset($_SESSION['erreur']);
        }
        if (isset($_SESSION['user'])) {
        ?>
    
            <div class="messBien">Bienvenue <?php $_SESSION['user']['pseudo'] ?> !</div>
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
            </form> <?php
        }else{
             ?> <div class="messErr">Pour accéder aux défis, veuillez vous <a href="index.php?module=connexion&action=connexion"> connecter</a> SVP !</div> <?php ;
        };
        ?>            
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' type='text/css'  href='modules/mod_defi/Css-Defi.css'>
            </head>
        <?php
    }
    
    function affiche_liste($tab) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="modules/mod_defi/Css-Defi.css">
        </head>
        
        <?php
        if(isset($_SESSION['erreur'])){
            ?>
            <div style="color:red"><?=$_SESSION['erreur']?></div><br>
            <?php
            unset($_SESSION['erreur']);
        }
        ?>
        <table class="styled-table">
            <tr><th>Numéro</th><th>Défi</th><th>Réponse (Tout en minuscule)</th><th>Envoyer</th></tr>
        <?php
        foreach($tab as $defi) {
            ?>
            <form action="i ndex.php?module=defi&action=traiterReponse" method="post">
            <input type="hidden" name="defiId" value="<?= $defi['id_defi'] ?>">
            <tr>
            <td><?= $defi['id_defi'] ?> </td>
            <td><?= $defi['defi'] ?> </td>
            <td><input type="text" name="reponse" placeholder="Votre réponse"></td>
            <td><button type="submit" name="envoyerReponse" class="styled-button">Envoyer Réponse</button></td>
            </tr>
            
            </form>
            <?php
        }
        ?> 
        </table>       
        </body>
        </html>
        <?php
    }
}
?>
