<?php   

class Connexion {
    static private $connexion;

    static public function getConnexion(){
        if(empty(self::$connexion) ){
            self::$connexion = new PDO('mysql:host=localhost;dbname=eventsbdd;charset=UTF8','root','');

        }
        return self::$connexion;
        
        
        }
    
        private function __construct(){
            

    }

}

//
//->getConnection(); Tout le temps la meme connexion
//new connection()