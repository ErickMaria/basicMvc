<?php

  use Basic\Route\BaseRoute as Route;
  use Basic\View\ViewBase as View;
  

  Route::add('get','/','AppController::home');

  Route::add('post','test','AppController::test');
  
  Route::run();