<?php 

require_once 'Connexion.php';

class ModeleClassement extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function getTop5Players() {
        $requete = $this->connexion->getBdd()->query('WITH PartiClasse AS (
            SELECT
              joueur.pseudo,
              partie.status,
              partie.vague_atteinte,
              partie.pv_base,
              partie.nb_ennemis_tues,
              partie.argent_restant,
              RANK() OVER (PARTITION BY joueur.id_joueur
                           ORDER BY partie.status DESC,
                                    partie.vague_atteinte DESC,
                                    partie.nb_ennemis_tues DESC,
                                    partie.pv_base DESC,
                                    partie.argent_restant DESC) AS rnk
            FROM joueur
            INNER JOIN partie ON joueur.id_joueur = partie.id_joueur
          )
            SELECT
            pseudo,
            status,
            vague_atteinte,
            pv_base,
            nb_ennemis_tues,
            argent_restant
            FROM PartiClasse
            WHERE rnk = 1
            ORDER BY status DESC,
            vague_atteinte DESC,
            nb_ennemis_tues DESC,
            pv_base DESC,
            argent_restant DESC
            LIMIT 5;
        ');

        $tableau = $requete->fetchAll(); 
        return $tableau;
    }
}

?>