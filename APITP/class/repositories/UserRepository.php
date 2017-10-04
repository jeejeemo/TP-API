<?php
class UserRepository extends repository{

    function login($name_user, $password){
        
        $password = $password;// encodage pose pb
        
        $query = "SELECT * FROM users WHERE name_user=:name_user AND password=:password";
        
        $prep = $this->connexion->prepare($query);
        
        
        $prep->execute(array(
            'name_user'=>$name_user,
            'password'=>$password
        ));
        $result = $prep->fetch( PDO::FETCH_ASSOC );
            if( empty ($result)){
                return false;
            }
            else{
                return new User( $result );
                
            }

        
    }
    function logoff(){

    }

    function save( User $user ){
        if( empty( $user->getId() ) ){
            return $this->insert( $user );
        }
        else {
            return $this->update( $user );
        }
    }

    private function insert( User $user ){

        $query = "INSERT INTO users SET name_user=:name_user, password =:password";
        $prep = $this->connexion->prepare( $query );
        $prep->execute( [
            "name_user" => $user->getName_user(),
            "password" => $user->getPassword()
        ] );
        return $this->connexion->lastInsertId();

    }
    
    
    
    
}