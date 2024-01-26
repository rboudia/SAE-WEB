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
        if (isset($_SESSION['admin'])){
            $pseudo = $_SESSION['admin']['pseudo'];
        } else if(isset($_SESSION['user'])) {
            $pseudo = $_SESSION['user']['pseudo'];
        }
        if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
        ?>
    
            <div class="messBien">Bienvenue <?= $pseudo ?> !</div>
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
        if (isset($_SESSION['admin'])) {
            ?>
            <table class="styled-table">
                <tr><th>Numéro</th><th>Défi</th><th>Solution</th><th>Supprimer</th></tr>
            <?php
            foreach($tab as $defi) {
                ?>
                <tr>
                <td><?= $defi['id_defi'] ?> </td>
                <td><?= $defi['defi'] ?> </td>
                <td><?= $defi['Solution'] ?> </td>
                <td><form action="index.php?module=defi&action=supprimer&id=<?= $defi['id_defi'] ?>" method="post">
                    <button type="submit" name="supprimerDefi">Supprimer le défi</button>
                </form></td>
                </tr>
                <?php
            }
            ?>
            </table>  
            <table class="styled-table">
            <form action="index.php?module=defi&action=creerDefi" method="post">
            <tr>
            <td><input type="text" name="defi" placeholder="Défi"></td>
            <td><input type="text" name="reponse" placeholder="Réponse"></td>
            <td><button type="submit" name="creerDefi" class="styled-button">Créer Defi</button></td>
            </tr>
            </form> 
            </table>       
            <?php
        } else {
        ?>
        <table class="styled-table">
            <tr><th>Numéro</th><th>Défi</th><th>Réponse (Tout en minuscule)</th><th>Envoyer</th></tr>
        <?php
        foreach($tab as $defi) {
            ?>
            <form action="index.php?module=defi&action=traiterReponse" method="post">
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
        <?php
        }
    }

    function mauvaiseReponse($reponse) {
        $reponse = 2 - $reponse 
        ?>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' type='text/css' href='modules/mod_defi/Css-Defi.css'>
            </head>
            <body>
                <div class='messErr2'>Faux ! La réponse est incorrecte. Il vous reste <?= $reponse ?> essai(s) </div>
            </body>
            </html>
        <?php
    }

    function mauvaiseDerniereReponse() {
        ?>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' type='text/css' href='modules/mod_defi/Css-Defi.css'>
            </head>
            <body>
                <div class='messErr2'>Faux ! La réponse est incorrecte. Vous n'avez plus d'essais... </div>
            </body>
            </html>
        <?php
    }

    function dejaReponduCorrectement() {
        ?>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' type='text/css' href='modules/mod_defi/Css-Defi.css'>
            </head>
            <body>
                <div class='messErr2'>Vous avez déjà répondu correctement à cette question.</div>
            </body>
            </html>
        <?php
    }

    function bonneReponse() {
        ?>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' type='text/css' href='modules/mod_defi/Css-Defi.css'>
            </head>
            <body>
                <div class='messBrep'>Bravo, +2 jetons !</div>
            </body>
            </html>
        <?php
    }
}
    ?>
