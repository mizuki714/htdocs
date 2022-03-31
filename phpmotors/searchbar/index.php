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
require_once '../model/searchbar-model.php';
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
   case 'search':
 //the page goes here and then i get an error. 
	if(ISSET($_POST['save'])){
 	
 
 
		try{
      $db = phpmotorsConnect();
      $sql = 'SELECT * FROM inventory';
      $stmt = $db->prepare($sql);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
		}catch(PDOException $e){
			// Display error message
		echo $e->getMessage();
		}
 		//Closing the connection
		$stmt->closeCursor();
 		//redirecting to the index page
		header("location: /searchbar/index.php");
      
 
	}

       //search
   $search_keyword = '';
   if(!empty($_POST['keyword'])) {
     $search_keyword = $_POST['keyword'];
     $results= probablybrokentoo($search_keyword);
     if(!empty ($results)){
    $resultList= buildtable($results,$search_keyword);
   }
   else {
    $resultList="There are no results for the term $search_keyword.";
  }
  }
      include '../view/search-results.php';
      break;
 
default:
//it currently loads the default page atm. 
   include '../view/500.php';
   break;
   }
   ?>