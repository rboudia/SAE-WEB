<?php 
require_once 'vue_generique.php';

class VueMessage extends VueGenerique{

	public function afficherAmi($amis) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_message/Css-Message.css">
        </head>
        <div id="message-container">
            <h2>Messages:</h2>
            <?php
            if(isset($_SESSION['message_erreur'])){
                ?>
                <div class="erreur-message" style="text-align: center;">
                    <?=$_SESSION['message_erreur']?> Envoyez des <a href="index.php?module=ami">demandes d'amis</a> et faites vous plein d'amis !
                </div><br>
                <?php
                unset($_SESSION['message_erreur']);
            } else {
                ?>
                <ul class="ami-liste">
                    <?php foreach ($amis as $ami) : ?>
                        <li><a href="index.php?module=message&action=message&id=<?= $ami['id_joueur'] ?>"><?= $ami['pseudo'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php
            }
            ?>
        </div>
        <?php
    }
    

    public function afficherMessage($messages) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_message/Css-Message.css">
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var messageContainer = document.getElementById("message-container");
                    messageContainer.scrollTop = messageContainer.scrollHeight;
                });
            </script>
        </head>
    
        <div id="message-container">
            <h2>Messages:</h2>
            <?php
            if (isset($_SESSION['affiche_message_erreur'])) {
                ?>
                <div style="color:red; text-align: center;"><?=$_SESSION['affiche_message_erreur']?></div><br>
                <?php
                unset($_SESSION['affiche_message_erreur']);
            } else {
                foreach ($messages as $message) {
                    $messageClass = ($message['id_joueur'] == $_SESSION['user']['id_joueur']) ? 'user-message' : 'other-message';
                    ?>
                    <div class="message <?= $messageClass ?>">
                        <?= $message['message'] ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
    

    public function envoyer($ami) {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_message/Css-Message.css">
        </head>

        <div id="message-form">
            <form action="index.php?module=message&action=envoyer&id=<?= $ami ?>" method="post">
                <label for="message">Message:</label>
                <input type="text" id="message" name="message"><br>
                <input type="submit" id="submit-btn" value="Envoyer">
            </form>
        </div>
        <?php
    }
    


    public function menu() {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="modules/mod_message/Css-Message.css">
        </head>
        <?php
        if (isset($_SESSION['erreur'])) {
            ?>
            <div class="erreur-message"><?=$_SESSION['erreur']?></div><br>
            <?php
            unset($_SESSION['erreur']);
        }
        ?>
        <ul class="menu-liste">
            <?php if (isset($_GET['action']) && $_GET['action'] == 'message' || $_GET['action'] == 'envoyer') : ?>
                <li> <a href="index.php?module=message">Retour aux amis</a></li>
            <?php endif; ?>
        </ul>
        <?php
    }
}

?>