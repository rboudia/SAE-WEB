<?php 

require_once 'Connexion.php';

class ModelePartie extends Connexion{

    private $connexion;

    function __construct(){
        $this->connexion = new Connexion();
        $this->connexion::initConnexion();
    }

    function partieJoueur($pseudo) {
        try {
            $requete = $this->connexion->getBdd()->prepare('
                SELECT joueur.pseudo, partie.id_partie, partie.status, partie.vague_atteinte, partie.pv_base, partie.nb_ennemis_tues, partie.argent_restant
                FROM joueur
                INNER JOIN partie ON joueur.id_joueur = partie.id_joueur
                WHERE joueur.pseudo = :pseudo
                ORDER BY partie.status DESC, partie.vague_atteinte DESC, partie.pv_base DESC, partie.nb_ennemis_tues DESC, partie.argent_restant DESC
            ');
            $requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $requete->execute();
            
            $tableau = $requete->fetchAll(PDO::FETCH_ASSOC);
    
            return $tableau;
        } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
            return false;
        }
    }

    function getDetail($idPartie){
        $requete = $this->connexion->getBdd()->query("SELECT * FROM partie WHERE id_partie = '$idPartie'");
        $bio = $requete->fetch(PDO::FETCH_ASSOC);
        return $bio;
    }

    function getTop3Players() {
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
            LIMIT 3;
        ');

        $tableau = $requete->fetchAll(); 
        return $tableau;
    }

    function recherche($pseudo) {
        try {
            $requete = $this->connexion->getBdd()->prepare('SELECT * FROM joueur WHERE pseudo = :pseudo');
            $requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $requete->execute();
            
            $tableau = $requete->fetchAll(PDO::FETCH_ASSOC);
            
            if (!$tableau) {
                return false;
            }
    
            return $tableau;
        } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
            return false;
        }
    }
    
}

?>