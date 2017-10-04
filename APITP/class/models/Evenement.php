<?php
class Evenement extends Model implements JsonSerializable{

    
    private $title;
    private $descriptevent;
    private $datedeb;
    private $datefin;
    private $userid;

    
    function getTitle(){
        return $this->title;
    }
    function getDescriptevent(){
        return $this->descriptevent;
    }
    function getDatedeb(){
        return $this->datedeb;
    }
    function getDatefin(){
        return $this->datefin;
    }
    function getUserid(){
        return $this->userid;
    }

    
    function setTitle($title){
        $this->title = $title;
    }
    function setDescriptevent($descriptevent){
        $this->descriptevent = $descriptevent;
    }
    function setDatedeb($datedeb){
        $this->datedeb = $datedeb;
    }
    function setDatefin($datefin){
        $this->datefin = $datefin;
    }
    function setUserid($userid){
        $this->userid = $userid; 
    }

    
    function jsonSerialize(){
        return [
            "id"=>$this->id,
            "userid"  =>$this->userid,
            "title"=>$this->title,
            "descevent" => $this->descriptevent,
            "datedeb" => $this->datedeb,
            "datefin" => $this->datefin,
        ];
    }
}