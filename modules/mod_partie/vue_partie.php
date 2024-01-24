
<?php 
require_once 'vue_generique.php';

class VuePartie extends VueGenerique{

	public function affiche_barre(){
		?>
        <head>
<link rel="stylesheet" type="text/css" href="modules\mod_partie\Css-partie.css">
</head>
		<div class="conteneur">
    <h1 class="titre-principal">Partie</h1>
    <h2 class="titre-secondaire">Trouvez les statistiques des parties :</h2>
    <form class="formulaire" action="index.php?module=partie&action=partie" method="post">
        <label class="label-formulaire" for="pseudo">Entrez un pseudo :</label><br>
        <input class="champ-texte" type="text" id="pseudo" name="pseudo"><br>
        <input class="bouton-submit" type="submit" value="Afficher les statistiques">
    </form>
    <br>
    <br>
</div>
		<?php 
	}

	public function affiche_liste($tab) {
        echo '<ul class="liste-parties">';
        foreach ($tab as $element) {
            ?>
            <head>
<link rel="stylesheet" type="text/css" href="modules\mod_partie\Css-partie.css">
</head>
            <li class="partie-item">
                <?php if (isset($_SESSION['user'])) : ?>
                    <a class="partie-link" href="index.php?module=partie&action=details&id=<?= $element['id_partie'] ?>"> Partie <?= $element['id_partie'] ?></a>
                <?php else : ?>
                    Partie <?= $element['id_partie'] ?>
                <?php endif; ?> <?= $element['status'] ?>
            </li>
            <?php
        }
        echo '</ul>';
        if (!isset($_SESSION['user'])) {
            ?>
            <div class="connexion-message">Pour accéder aux défis, veuillez vous <a class="connexion-link" href="index.php?module=connexion&action=connexion">connecter</a> SVP !</div>
            <?php
        }
    }

    public function classement($elements) {
        $num = 1;
        ?>
        <head>
<link rel="stylesheet" type="text/css" href="modules\mod_partie\Css-partie.css">
</head>
        <section class="classement-section">
            <h2 class="classement-title">Les 3 meilleurs !</h2>
            <table class="classement-table">
                <thead>
                    <tr>
                        <th class="classement-header">Classement</th>
                        <th class="classement-header">Pseudo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($elements as $defi) {
                        ?>
                        <tr class="classement-row">
                            <td class="classement-data"><?= $num ?></td>
                            <td class="classement-data"><a class="classement-link" href="index.php?module=classement"><?= $defi['pseudo'] ?></a></td>
                        </tr>
                        <?php
                        $num = $num + 1;
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <?php
    }

    public function menu() {
        if (isset($_SESSION['erreur'])) {
            ?>
            
            <div class="erreur-message"><?=$_SESSION['erreur']?></div><br>
            <?php
            unset($_SESSION['erreur']);
        }
        ?>
        <head>
<link rel="stylesheet" type="text/css" href="modules\mod_partie\Css-partie.css">
</head>
        <ul class="menu-liste">
            <?php if (isset($_GET['action']) && $_GET['action'] == 'details') : ?>
                <li class="menu-item"><a class="menu-link" href="index.php?module=partie">Retour aux parties</a></li>
            <?php endif; ?>
        </ul>
        <?php
    }

    public function affiche_detail($detailEnnemi) {
        ?>
        <head>
<link rel="stylesheet" type="text/css" href="modules\mod_partie\Css-partie.css">
</head>
        <center>
            <table class="detail-table">
                <tr class="detail-row">
                    <td class="detail-label">Id</td> <td class="detail-data"><?= $detailEnnemi['id_partie'] ?></td>
                </tr>
                <tr class="detail-row">
                    <td class="detail-label">Nombre d'ennemis tués</td> <td class="detail-data"><?= $detailEnnemi['nb_ennemis_tues'] ?></td>
                </tr>
                <tr class="detail-row">
                    <td class="detail-label">Argent restant</td> <td class="detail-data"><?= $detailEnnemi['argent_restant'] ?></td>
                </tr>
                <tr class="detail-row">
                    <td class="detail-label">Vague atteinte</td> <td class="detail-data"><?= $detailEnnemi['vague_atteinte'] ?></td>
                </tr>
                <tr class="detail-row">
                    <td class="detail-label">Pv base</td> <td class="detail-data"><?= $detailEnnemi['pv_base'] ?></td>
                </tr>
                <tr class="detail-row">
                    <td class="detail-label">Status</td> <td class="detail-data"><?= $detailEnnemi['status'] ?></td>
                </tr>
            </table>
        </center>
        <?php
    }
}

?>
