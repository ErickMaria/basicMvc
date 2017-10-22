<?php
  namespace App\Controllers;

  use Basic\Controller\BaseController;
  use Basic\View\BaseView as View;

  class AppController extends BaseController{
    
    public function home(){
      
      return View::render('home');
    }
    
    public function test($request){
      
      return View::render('test',compact($request));
    }
    
  }
  