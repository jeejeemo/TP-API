<?php
class User extends Model implements jsonSerializable{
    
    private $name_user;
    private $password;

    
    function getName_user(){
        return $this->name_user;
    }
    function getPassword(){
        return $this->password;
    }
    function setName_user($name_user){
        $this->name_user = $name_user;
    }
    function setPassword($password){
        $this->password = $password;
    }

    function jsonSerialize(){
        return [
            "id"=>$this->id,
            "name"=>$this->name_user,
            "password" => $this->password,
        ];
    }

}