<?php 
require_once 'vue_generique.php';

class VueClassement extends VueGenerique{

	public function classement($tab) {
		$num = 1;
        ?>
		<section>
			<h2>Classement</h2>
			<table>
				<thead>
					<tr>
						<th>Classement</th>
						<th>Pseudo</th>
						<th>Status</th>
						<th>Vague atteinte</th>
						<th>Ennemis tués</th>
						<th>Pv de la base</th>
						<th>Argent restant</th>
					</tr>
				</thead>
				<tbody>
				<?php
        foreach($tab as $defi) {
            ?>
            <tr>
				<td><?= $num ?></td>
				<td><?= $defi['pseudo'] ?></td>
				<td><?= $defi['status'] ?></td>
				<td><?= $defi['vague_atteinte'] ?></td>
				<td><?= $defi['nb_ennemis_tues'] ?></td>
				<td><?= $defi['pv_base'] ?></td>
				<td><?= $defi['argent_restant'] ?></td>
			</tr>
            </form>
            <?php
			$num = $num + 1;
        }
        ?> 

				</tbody>
			</table>
		</section>		
		<?php
    }
}

?>