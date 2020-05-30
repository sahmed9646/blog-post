<?php
// Load config file
require_once 'config/config.php';



// Load Helper
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/format.php';


//Load Libraries
// require_once "lib/Controller.php";
// require_once "lib/Core.php";
// require_once "lib/Database.php";

// Auto load files
spl_autoload_register(function($className){
   require_once "lib/".$className.".php";
});