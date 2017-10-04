<?php
require "flight/Flight.php";
require "autoload.php";

// Enregistrer en global dans le Flight le BddManager
Flight::set("BddManager", new BddManager());

//Lire toutes les evenements
Flight::route ("GET /events", function(){
    
    $bddManager = new BddManager();
    $repo = new EvenementRepository( Connexion::getConnexion());
    $events = $repo ->getAll();

    echo json_encode( $events);

});

//Recuperer les evenements @id
Flight::route("GET /event/@id", function($id){

    $status = [
        "success" => false,
        "event" => false
    ];
    $event = new Evenement();
    $event->setId($id); // on modifie le $id
    
    $bddManager = Flight::get("BddManager");
    $repo = $bddManager->getEvenRepository();
    
    $event = $repo ->getById( $event );
    
    if( $event != false ){
        $status["success"] = true;
        $status["event"] = $event;
    }
    echo json_encode ( $status );
    
});

//Creer un evenement

Flight::route("POST /event", function(){
        
        $userid = Flight::request()->data["userid"];
        $title = Flight::request()->data["title"];
        $descriptevent = Flight::request()->data["descriptevent"];
        $datedeb = Flight::request()->data["datedeb"];
        $datefin = Flight::request()->data["datefin"];  
        
        
        $status = [
            "success" => false,
            "id" => 0
        ];
    
        if( strlen( $title ) > 0 && strlen( $descriptevent ) > 0 ) {
    
            $event = new Evenement();
            $event->setUserid($userid);
            $event->setTitle( $title );
            $event->setDescriptevent( $descriptevent );
            $event->setDatedeb( $datedeb );
            $event->setDatefin( $datefin);
    
            $bddManager = Flight::get("BddManager");
            $repo = $bddManager->getEvenRepository();
            $id = $repo->save( $event );
    
            if( $id != 0 ){
                $status["success"] = true;
                $status["id"] = $id;
            }
    
        }
        echo json_encode( $status );
});

// Supprimer evenement

Flight::route("DELETE /event/@id",function( $id ){

    $status = [
        "success" => false
    ];

    $event = new Evenement();
    $event -> setId( $id );
    $bddManager = Flight::get("BddManager");
    $repo = $bddManager ->getEvenRepository();
    $rowCount = $repo->delete( $event);

    if( $rowCount != 1 ){
        $status["success"] = true;
    }

    echo json_encode( $status );

});

//Mettre à jour un événement
Flight::route("POST /event/@id", function( $id ){
    
        //Pour récuperer des données PUT -> les données sont encodé en json string
        //avec ajax, puis décodé ici en php
        $json = Flight::request()->getBody();
        $_PUT = json_decode( $json , true);//true pour tableau associatif
    
        $status = [
            "success" => false
        ];
    
        if( isset($_PUT["userid"] ) && isset( $_PUT["title"] ) && isset( $_PUT["descriptevent"]) && isset($_PUT["datedeb"]) && isset($_PUT["datefin"])  ){
          
            $title = $_PUT["title"];
            $descriptevent = $_PUT["descriptevent"];
            $datedeb = $_PUT["datedeb"];
            $datefin = $_PUT("datefin");
            $userid = $_PUT("userid");

            $event = new Evenement();
            $event->setId( $id );
            $event->setUserid( $userid);
            $event->setTitle( $title );
            $event->setDescriptevent( $descriptevent );
            $event->setDatedeb( $datedeb );
            $event->setDatefin( $datefin);
    
            $bddManager = Flight::get("BddManager");
            $repo = $bddManager->getEvenRepository();
            $rowCount = $repo->save( $event );
    
            if( $rowCount == 1 ){
                $status["success"] = true;
            }
    
        }
    
        echo json_encode( $status );
    
    });

//Creer un utilisateur

Flight::route("POST /user", function(){
    $name_user = Flight::request()->data["name_user"];
    $password = Flight ::request()->data["password"];

    $status = [
        "success" => false,
        "id" => 0
    ];

    if(!empty($name_user) && !empty($password)){
        $user = new User();
        $name_user =$user->setName_user($name_user);
        $password = $user->setPassword($password);

        $bddManager = Flight::get("BddManager");
        $repo = $bddManager->getuserRepository();
        $id = $repo->save( $user );
    
        if( $id != 0 ){
            $status["success"] = true;
            $status["id"] = $id;
        }
        else{
            $status["success"] = Symfony\Component\Validator\Constraints\False;
            $status["id"] =0;
        }
    }

    echo json_encode($user);

});

//Recuperer tous les evenements de l'utilisateur loggé
Flight::route("GET /eventlog/@id", function($id){
        
        $bddManager = new BddManager();
        

        $repo = $bddManager->getEvenRepository();


        $events = $repo ->getAllById($event);
    
        echo json_encode( $events);
    
    });



Flight::route("POST /login", function(){
    
    $bddManager = new BddManager(); 
    $repo = $bddManager->getUserRepository();
    
    $name_user = Flight::request()->data["name_user"]; 
    $password = Flight::request()->data["password"]; 
    
    $result = $repo->login($name_user, $password) ;
   
    $status = [
        "success" => false,
        "errors" => [],
        "user" => []
    ];
    if( $result == false ){
        $status["success"] = false;
        $status["errors"] = "Utilisateur non trouvé";
    }
    // else if( $password != $result["password"]){
    //     $status["success"] = false;
    //     $status["errors"] = "Mot de passe incorrect";
    // }
    else {
        $status["success"] = true;
        $status["user"] = $result;
    }
    echo json_encode( $status );
    
});
Flight::start();