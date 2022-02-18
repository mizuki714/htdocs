<?php
// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
 require_once '../model/main-model.php';
// Get the functions file
require_once '../library/functions.php';

 // Get the array of classifications
 $classifications = getClassifications();

 //display navigation
 $navList =getNavList($classifications);

 $action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
   case 'template':
   include '/template.php';
   break;
   default:
   include '../model/home.php';
   break;
  }

 
?>
