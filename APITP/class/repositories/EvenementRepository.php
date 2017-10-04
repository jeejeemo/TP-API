<?php
// le but du postit$postitRepository est de rassembler les éléments de connexion pour postit$postit

class EvenementRepository extends Repository {

    function getAll(){
        
        $query = "SELECT * FROM events";
        $result = $this -> connexion->query ($query);
        $result = $result->fetchAll( PDO::FETCH_ASSOC );

        $events = [];
        foreach( $result as $data ){
            $events[] = new Evenement( $data);
        
        }
       
        return $events;

    }

    function getById ( Evenement $event ){
        
        $query = "SELECT * FROM  events WHERE id=:id";
        $prep = $this ->connexion-> prepare ( $query );
        $prep -> execute( [ 
            "id" => $event -> getId(),

        ]);

        $result = $prep ->fetch(PDO::FETCH_ASSOC);
        
        if( empty( $result ) ){
            return false;
        }
        else{
            return new Evenement( $result );
            
        }
        
        
    }

    
    function getAllById ( Evenement $event ){
        
        $query = "SELECT *
        FROM events
        INNER JOIN users ON events.user_id = users.id";
        $prep = $this ->connexion-> prepare ( $query );
        $prep -> execute( [ 
            "Id" => $event -> getId(),

        ]);

        $result = $prep ->fetch(PDO::FETCH_ASSOC);

        if( empty( $result ) ){
            return false;
        }
        else{
            return new Evenement( $result );
        }
        

    }

    function save ( Evenement $event ){
        
        if (empty ($event -> getId() ) ){
            $this->insert ( $event );
        }
        else{
            return $this -> update( $event );
        }
    }


    private function insert ( Evenement $event ){
        $query = "INSERT INTO events SET userid= :userid,title = :title, descriptevent = :descriptevent, datedeb = :datedeb, datefin = :datefin";
        $prep = $this ->connexion-> prepare ( $query );
        $prep -> execute( [ 
            "userid"=>$event->getUserid(),
            "title" => $event->getTitle(),
            "descriptevent" => $event->getDescriptevent(),
            "datedeb" => $event->getDatedeb(),
            "datefin" => $event->getDatefin(),
            
        ]);
        return $this->connexion->lastInsertId();
    }

    private function update( Evenement $event ){
        $query = "UPDATE events SET userid= :userid, title=:title, descriptevent =: descriptevent, datedeb =: datedeb, datefin =: datefin WHERE id=:id";
        $prep = $this->connexion->prepare( $query );
    
        $prep->execute( [
            "id"=>$event>getId(),
            "userid"=>$event->getUserid(),
            "title" => $event->getTitle(),
            "descriptevent" => $event->getDescription(),
            "datedeb" => $event->getDatedeb(),
            "datefin" => $event->getDatefin(),
        ] );
        return $prep->rowCount();
    }
    function delete( Evenement $event ) {
        $query = "DELETE FROM events WHERE id=:id";
        $prep = $this ->connexion-> prepare ( $query );
        $prep -> execute( [ 
            "id" => $event -> getId(),
        ]);

    }

   
}
