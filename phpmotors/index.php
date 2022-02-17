<?php
// Get the database connection file
 require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
 require_once 'model/main-model.php';
// Get the functions file
require_once 'library/functions.php';

 // Get the array of classifications
 $classifications = getClassifications();

 //display navigation
 $navList =getNavList($classifications);
//Demo to see if the array of classifications is functional (it is)
// var_dump($classifications);
//	exit;

// Build a navigation bar using the $classifications array
//$navList = '<ul>';
//$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home ///page'>Home</a></li>";
//foreach ($classifications as $classification) {
//   $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode ($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
//}
//$navList .= '</ul>';

// testing $navList if it appears"High Five"! This DOES appear below the footer when not commented out
//echo $navList;
//exit;


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

/* kept for posterity
switch ($action){
    case 'something':
     break;
    default:
     include 'model/home.php';
   }
*/
//controller Switch statement, for template and home. 
   switch ($action){
      case 'template':
      include 'template/template.php';
      break;
      default:
      include 'model/home.php';
      break;
     }
?>
