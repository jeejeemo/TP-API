<?php

abstract class Repository {
    protected $connexion;
    function __construct( $connexion){
        $this->connexion = $connexion;
    }
}