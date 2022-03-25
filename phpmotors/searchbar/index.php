<?php
// Create or access a Session
session_start();

//Get the database connection file
require_once '../library/connections.php';
//Get the main model for use as needed
require_once '../model/main-model.php';
//Get the vehicle model file
require_once '../model/vehicles-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the uploads model
require_once '../model/uploads-model.php';
 // Get the search file
// require_once '../model/searchbar-model.php';
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
   case 'searchbar':
    echo "<p> Searchbar</p>";
    include '../view/search-results.php';
   break;
   case 'searchf':
      echo "<p> SearchF</p>";
      include '../view/search-results.php';
default:
   include '../view/search-results.php';
   break;
   }
 
?>