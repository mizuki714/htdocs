<?php
//controller for the vehicles process


//Get the database connection file
require_once '../library/connections.php';
//Get the main model for use as needed
require_once '../model/main-model.php';
//Get the vehicle model file
require_once '../model/vehicles-model.php';

//Get the array of classifications from DB using model
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
//echo $navList;
//exit;

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
        $class = $_POST['log_class'];
        $make = $_POST['log_make'];
        $model = $_POST['log_model'];
        $description = $_POST['log_description'];
        $image = $_POST['log_image'];
        $thumbnail = $_POST['log_thumbnail'];
        $price = $_POST['log_price'];
        $stock = $_POST['log_stock'];
        $color = $_POST['log_color'];
        if (empty($make)||empty($model)||empty($description)||empty($image)||empty($thumbnail)||empty($price)||empty($stock)||empty($color)){
            $message = "Form not complete. Please fill in all fields.";
        }
        else{
            addNewVehicle($class, $make, $model, $description, "/phpmotors/images/no-image.png", "/phpmotors/images/no-image.png", $price, $stock, $color);
            $message = "Form submission successful.";
    }
        include '../view/add-vehicle.php';
        break;
    default:
      include '../view/vehicle-management.php';
   }
   ?>