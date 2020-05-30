<?php
/*
* Base controller
*  Loads models and views
*/
class Controller{
   //Load models
   public function model($model){
      // require or include model files
      require_once '../app/models/' .$model. '.php';

      //instantiate model files
      return new $model();
   }

   // Load view files
   public function view($view, $data = []){
      // check if file exists
      if (file_exists('../app/views/' .$view. '.php')) {
         // include that file
         require_once '../app/views/' .$view. '.php';
      }else{
         // if file doesn't exists
         die("View File doesn't exist");
      }
   }

}