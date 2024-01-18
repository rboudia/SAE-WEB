<?php 
require_once 'vue_generique.php';

class VueMessage extends VueGenerique{

	public function bienvenue() {
        ?>
		Bienvenue sur le site <br>
		<?php
    }

	public function afficherMessages($messages) {
        echo "<h2>Messages:</h2>";
        foreach ($messages as $message) {
            echo "De: {$message['expediteur']} | Pour: {$message['destinataire']} | Date: {$message['date']} | Message: {$message['contenu']}<br>";
        }
    }
}

?>