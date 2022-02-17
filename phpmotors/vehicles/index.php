<?php
//controller for the vehicles process


//Get the database connection file
require_once '../library/connections.php';
//Get the main model for use as needed
require_once '../model/main-model.php';
//Get the vehicle model file
require_once '../model/vehicles-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions file
require_once '../library/functions.php';

//Get the array of classifications from DB using model
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
/*$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
//echo $navList;
//exit;
*/

//nav bar
$navList = getNavList($classifications);


$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){   
    case 'add-vehicle':
      
      
      include '../view/add-vehicle.php';
      break;

    case 'add-class':
      include '../view/add-classification.php';
      break;

    case 'add-classfication':
        if (addclass($_POST['classificationName']))
        header("Location: index.php");
        else
        $message = "Failure to add classification";
   
    include '../view/classification.php';
      break;

    case 'add-vehicle-form':

      //filter and store data 
      $classificationId = trim(filter_input (INPUT_POST,'classificationId', FILTER_SANITIZE_STRING));
      $invMake = trim(filter_input (INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
      $invModel = trim(filter_input (INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
      $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
      $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
      $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
      $invPrice =trim( filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_STRING,FILTER_FLAG_ALLOW_FRACTION ));
      $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING));
      $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
      

      //idk if this is useful anymore or not so it stays for now but hopefully i fixed it
        $class = $_POST['classificationId'];
        $make = $_POST['invMake'];
        $model = $_POST['invModel'];
        $description = $_POST['invDescription'];
        $image = $_POST['invImage'];
        $thumbnail = $_POST['invThumbnail'];
        $price = $_POST['invPrice'];
        $stock = $_POST['invStock'];
        $color = $_POST['invColor'];
        
        if (empty($invMake)||empty($invModel)||empty($invDescription)||empty($invImage)||empty($invThumbnail)||empty($invPrice)||empty($invStock)||empty($invColor)){
            $message = "Form not complete. Please fill in all fields.";
        }
        else{
            addNewVehicle($classificationId, $invMake, $invModel, $invDescription, "/phpmotors/images/no-image.png", "/phpmotors/images/no-image.png", $invPrice, $invStock, $invColor);
            $message = "Form submission successful.";
    }
        include '../view/add-vehicle.php';
        break;
    default:
      include '../view/vehicle-management.php';
   }
   ?>