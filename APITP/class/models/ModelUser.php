<?php
abstract class ModelUser {
    
    protected $id;
    
    function __construct( $datas=[] ){
        $this->hydrate( $datas );
    }
    
    function getId(){
        return $this -> id;
    }
    function setId($id){
        $this -> id=$id;
    }


    protected function hydrate( array $datas ){
        
                foreach( $datas as $key => $data){
                    //on recupere le nom du setter correspondant a l'attribut
                    $method = "set".ucfirst($key);
                    //si le setter coorespondant existe
                    if (method_exists( $this, $method)){
                        // on appelle le setter
                        $this -> $method( $data );
                    }
                }
        
    }
}