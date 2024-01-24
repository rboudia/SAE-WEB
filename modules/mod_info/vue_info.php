<?php
require_once 'vue_generique.php';

class VueInfo extends VueGenerique{

	public function bienvenue() {
		
?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .t {
        text-decoration: none;
        color: #5468F9;
        font-weight: bold;
        display: block;
        padding: 10px;
        transition: background-color 0.3s;
    }

    .t:hover {
        background-color: #f2f2f2;
    }
</style>
		<table>
			<tr>
				<td> <a class ="t" href="index.php?module=ennemi&action=liste">Liste des ennemi</a> </td>
				<td> <a class ="t" href="index.php?module=defense&action=liste">Liste des defense</a> </td>
				<td> <a class ="t" href="index.php?module=map&action=liste">Liste des maps</a> </td>
</tr>
		</table>

		<a>Cet onglet vous permet d'en apprendre plus sur notre jeu. Veuillez cliquez sur les liens dans le tableau au-dessus pour vous informer.</a>
		<?php

    }
}

?>