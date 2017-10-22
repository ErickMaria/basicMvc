<?php
  namespace Basic\View;
  use Basic\View\Engine\BaseCompiler;
    
  class BaseView extends BaseCompiler{
   
    private static $viewDir = './app/Views/';
    private static $extension = ['.php', '.basic.php'];    
    
    public static function render($uri){
      //$protocol = $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http' . '://';
      
      //$location . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . $uri;
      //return header("Location: " . $location) or die('view not found!');
  

      
      if(file_exists(self::$viewDir . $uri . self::$extension[0])){
        require_once(self::$viewDir . $uri . self::$extension[0]);
      }else if(file_exists(self::$viewDir . $uri . self::$extension[1])){
        require_once(self::$viewDir . $uri . self::$extension[1]);
      }else{
        require_once(self::$viewDir . 'errors/404.php');
      }
      
    }
    
  }