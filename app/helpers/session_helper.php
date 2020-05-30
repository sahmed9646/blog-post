<?php
session_start();

function flash($name = "", $message = "", $class = "alert alert-success"){
   if (!empty($name)) {
      if (!empty($message) && empty($_SESSION[$name])) {
         if (!empty($_SESSION[$name])) {
            unset($_SESSION[$name]);
         }
         if (!empty($_SESSION[$name.'_class'])) {
            unset($_SESSION[$name.'_class']);
         }

         $_SESSION[$name] = $message;
         $_SESSION[$name.'_class'] = $class;
      }elseif(empty($message) && !empty($_SESSION[$name])){
         $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
         echo '<div class="'.$class.'" id="msg-flash" >'.$_SESSION[$name].'</div>';
         unset($_SESSION[$name]);
         unset($_SESSION[$name.'_class']);
      }
   }
}

function userLoggedIn(){
   if (isset($_SESSION['user-id'])) {
      return true;
   }else{
      return false;
   }
}

function adminLoggedIn(){
   if (isset($_SESSION['admin-id'])) {
      return true;
   }else{
      return false;
   }
}