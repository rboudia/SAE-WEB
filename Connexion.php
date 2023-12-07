<?php

class Connexion{

    protected static $bdd;

    function __construct(){
    }

    public static function initConnexion(){
        $dsn = 'mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201641;charset=utf8';
        $utilisateur = 'dutinfopw201641';
        $mot_de_passe = 'teraqagu';
        try{
            self::$bdd = new PDO($dsn, $utilisateur, $mot_de_passe);
        }catch (PDOException $e){
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
        }
    }

    public function getBdd(){
        return self::$bdd;
    }
    
}

?>