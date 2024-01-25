<?php 
require_once 'vue_generique.php';

class VueCommunaute extends VueGenerique{

    public function afficherMessage($messages) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_communaute/Css-Communaute.css">
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var messageContainer = document.getElementById("message-container");
                    messageContainer.scrollTop = messageContainer.scrollHeight;
                });
            </script>
        </head>
        <div id="message-container">
            <h2>Communauté:</h2>
            <?php
            if (isset($_SESSION['affiche_message_erreur'])) {
                ?>
                <div style="color:red; text-align: center;"><?=$_SESSION['affiche_message_erreur']?></div><br>
                <?php
                unset($_SESSION['affiche_message_erreur']);
            } else {
                foreach ($messages as $message) {
                    if (isset($_SESSION['user']['id_joueur'])) {
                        $messageClass = ($message['id_joueur'] == $_SESSION['user']['id_joueur']) ? 'user-message' : 'other-message';
                    } else {
                        $messageClass = 'other-message';
                    }
                    ?>
                    <div class="message <?= $messageClass ?>">
                        <?= $message['pseudo'] ?> :
                        <?= $message['message'] ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
    

    public function envoyer() {
        
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_message/Css-Message.css">
        </head>
        <?php
        if (isset($_SESSION['user'])) {
        ?>
        <div id="message-form">
            <form action="index.php?module=communaute&action=envoyer" method="post">
                <label for="message">Message:</label>
                <input type="text" id="message" name="message"><br>
                <input type="submit" id="submit-btn" value="Envoyer">
            </form>
        </div>
        <?php
        }else{
            ?> <div class="messErr">Pour pouvoir envoyer des messages, veuillez vous <a href="index.php?module=connexion&action=connexion"> connecter</a> SVP !</div> <?php ;
       };
    }
    
}

?>