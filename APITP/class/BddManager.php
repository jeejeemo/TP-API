<?php
//BddManager va contenir les intances de nos repository

class BddManager {

    private $evenRepository;
    private $connexion;
    private $userRepository;

    function __construct(){
        $this->connexion=Connexion::getConnexion();
        $this->evenRepository = new EvenementRepository( $this ->connexion );
        $this->userRepository = new UserRepository($this->connexion );
    }

    function getEvenRepository(){
        return $this ->evenRepository;
    }
    function getUserRepository(){
        return $this ->userRepository;
    }
}