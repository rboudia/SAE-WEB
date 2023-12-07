<?php

class ModeleConnexion extends Connexion {
    
	public function verifierLoginExistant($login) {
	    try {
		$query = self::$bdd->prepare("SELECT id, login, mdp FROM tableUtilisateur WHERE login = :login");
		$query->bindParam(':login', $login, PDO::PARAM_STR);
		$query->execute();
		$resultat =  $query->fetch(PDO::FETCH_ASSOC);
		return ($resultat)?$resultat:null;
	    } catch (PDOException $e) {
		die('Erreur lors de la vérification du login : ' . $e->getMessage());
	    }
	}

    public function ajouterUtilisateur($login, $mdp) {
	try {
         $stmt = self::$bdd->prepare("INSERT INTO tableUtilisateur (login, mdp) VALUES (:login, :mdp)");
        $stmt->bindParam(':login', $login,PDO::PARAM_STR);
        $stmt->bindParam(':mdp', $mdp,PDO::PARAM_STR);
         return $stmt->execute(); 
    } catch (PDOException $e) {
          die('Erreur lors de l\'ajout du joueur : ' . $e->getMessage());
     }
}
}
?>
