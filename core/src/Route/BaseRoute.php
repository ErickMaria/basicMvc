<?php

  namespace Basic\Route;

  use Basic\Route\Request;
  use Clojore;

  class BaseRoute extends Request{
  
    private static $route = [];
    private static $params = [];
    private static $controllerDir = './app/Controllers/';
    private static $viewDir = './app/Views/';
    
    function __construct(){
      
    }
    
    // call the view directly
    static function view($uri, $callback){
      
      $url = $_GET['url'];
      
      if($url == $uri){
        if(is_callable($callback)){
          return call_user_func($callback);
        }
      }
    }


    static function add($request, $uri, $controller){
        
        self::$route[] = strtoupper($request) . '|' . $uri . '|' . $controller;
        //self::$rcm[] = [$uri, $controller[0], $controller[1]];
        $contr = explode('::', $controller);
        $file = self::$controllerDir . $contr[0];

        if(file_exists($file.'.php') or file_exists($file.'.class.php')){
        }else{
           throw new \Exception($file . ' not found');
        }
    }
    
    private static function getUrl(){
      return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    }
    
    
    public static function run(){
      
      
      $uri = preg_replace('/(\/+)$/', '', self::getUrl());
      $uri = explode('/', preg_replace('/^(\/)/','', $uri));
      
      
      foreach(self::$route as $route){
        
        $r = explode('|', $route);
        $route = explode('/', $r[1]);
      
        if($r[0] == 'GET'){  
          
          if(self::getUrl() == '/' and $r[1] == '/'){
            
            self::controllerByGet(0, $r[2]);
            
          }

          if($route[1] == $uri[0]){
            if(count($route) == count($uri)){
              if(count($route) == 1 and count($uri) == 1){
                  self::controllerByGet(0, $r[2]);
              }else{
                for($i = 0; $i < count($route); $i++){
                  if(preg_match('/({)(\w+)(})/',$route[$i]) and count($route) == count($uri)){
                    $aux = str_replace('{', '', $route[$i]);
                    $aux = str_replace('}', '', $aux);
                    self::$params[$aux] = $uri[$i];
                  }
                }
                self::controllerByGet(self::$params, $r[2]);
              }
            }
          }
          
        }else if($r[0] == 'POST'){
          
          if(isset($_POST) and !empty($_POST)){
            $post = Request::request();
            self::controllerByPost($post, $r[2]);
          }
          
        }
        
      }
      
      
      
    }
    
    static function controllerByPost($request, $routContr){
      
      $Cclass = explode('::', $routContr);
      
      $controller_obj = 'App\\Controllers\\'.$Cclass[0];
        
      if(method_exists($controller_obj, $Cclass[1])){
        $controller = new $controller_obj;
        $action = strval($Cclass[1]); 
        $controller->$action($request);
      }else{
        throw new \Exception('Method: '.$Cclass[1].' in Controller: '.$Cclass[0].'. not found in route/routes.php');
      }
      
    }
    
    private static function controllerByGet($params = [], $routContr){
      
      $Cclass = explode('::', $routContr);
      
      $controller_obj = 'App\\Controllers\\'.$Cclass[0];
        
      if(method_exists($controller_obj, $Cclass[1])){
        $controller = new $controller_obj;
        $action = strval($Cclass[1]); 
        if($params != null){
          $controller->$action($params);
        }else{
          $controller->$action();
        }
      }else{
        throw new \Exception('Method: '.$Cclass[1].' in Controller: '.$Cclass[0].'. not found in route/routes.php');
      }
      
    }
    
  }