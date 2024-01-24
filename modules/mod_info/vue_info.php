<?php
require_once 'vue_generique.php';

class VueInfo extends VueGenerique{

	public function bienvenue() {
		
?>
		<table>
			<tr>
				<td> <a href="index.php?module=ennemi&action=liste">Liste des ennemi</a> </td>
				<td> <a href="index.php?module=defense&action=liste">Liste des defense</a> </td>
				<td> <a href="index.php?module=map&action=liste">Liste des maps</a> </td>
			</tr>
		</table>
		<?php

    }
}

?>