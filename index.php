<?php
session_start();

require 'engine/classes/Application.class.php';

try{
  $application = new \engine\classes\Application();
}
catch(Exception $e){
  die('Error : '.$e->getMessage());
}

?>
