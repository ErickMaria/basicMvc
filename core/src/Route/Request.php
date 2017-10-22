<?php
  namespace Basic\Route;

  class Request{
    
   public static function request(){
     $obj = new \stdClass();
      
      /*
      foreach( $_GET as $value){
        
        $obj->get =  $value;
        
      }
      */
      
     
      foreach($_POST as $key => $value){
        
        $obj->$key = $value;
        
      }
      
      return $obj;
      
    }
    
  }