<?php
  namespace Basic\View\Engine;
  
  class BaseCompiler{
    
    protected static $path = './app/Views/';
    //protected $templeteExtension = 'basic';
    /*
    public function __construct($path) {
        self::$path = $path;
    }    
    */
    public function setDir($newPath){
      self::$path = $newPath;
    }
       
    public function set($file){
   
        
        $pathfile = self::$path . $file . '.basic.php';
        
        if(!file_exists($pathfile)) {
          return "Error loading template file " . $pathfile . ".<br />";
        }
      
      $output = file_get_contents($pathfile);
         
      $output = preg_replace("/(<!([ a-zA-Z]*)!>)/", "<?php  ?>", $output);
      

      return $output;
    
    }     
  }

