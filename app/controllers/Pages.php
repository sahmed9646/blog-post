<?php
class Pages extends Controller{
   public function __construct(){
   }
   public function index(){
      if (userLoggedIn()) {
         redirect("posts");
      }

      $data = [ 
         'title' => 'SabbirMVC',
         'description' => 'simple social network built with SabbirMVC PHP Framework'
   ];
      $this->view("pages/index", $data);
   }

   public function about(){
      $data = [ 
         'title' => 'About Us'
      ];
      $this->view("pages/about", $data);
   }
}