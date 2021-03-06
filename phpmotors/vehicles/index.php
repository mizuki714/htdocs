<?php
//controller for the vehicles process

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
// Get the search model
//require_once '../model/searchbar-model.php';
// Get the uploads model
require_once '../model/uploads-model.php';
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
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  case 'add-vehicle':


    include '../view/add-vehicle.php';
    break;

  case 'add-class':
    include '../view/add-classification.php';
    break;

  case 'add-classfication':
    // Get data from forms
    $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

    // Check for missing data
    if (empty($classificationName)) {
      $message = '<p class="warning" >Please provide information for all empty form fields.</p>';
      include '../view/add-classification.php';
      exit;
    }

    // Send the data to the model
    $regOutcome = addclass($classificationName);

    // Check and report the result
    if ($regOutcome === 1) {
      $message = "<p class='success' >The new car $classificationName classification was succesfully added!</p>";
      include '../view/add-classification.php';
      exit;
    } else {
      $message = "<p class='warning' >Sorry the car $classificationName classification failed to be added </p>";
      include '../view/add-classification.php';
      exit;
    }
    //old code
    /*
        if (addclass($_POST['classificationName']))
        header("Location: index.php");
        else
        $message = "Failure to add classification";*/

    include '../view/classification.php';
    break;

  case 'add-vehicle-form':

    //filter and store data 
    $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING));
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
    $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
    $imgPath = trim(filter_input(INPUT_POST, 'imgPath', FILTER_SANITIZE_STRING));
    $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_STRING, FILTER_FLAG_ALLOW_FRACTION));
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING));
    $invMiles = trim(filter_input(INPUT_POST, 'invMiles', FILTER_SANITIZE_NUMBER_INT));
    $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));


    //idk if this is useful anymore or not so it stays for now but hopefully i fixed it
    $class = $_POST['classificationId'];
    $make = $_POST['invMake'];
    $model = $_POST['invModel'];
    $description = $_POST['invDescription'];
    $image = $_POST['imgPath'];
    $thumbnail = $_POST['invThumbnail'];
    $price = $_POST['invPrice'];
    $stock = $_POST['invStock'];
    $miles = $_POST['invMiles'];
    $color = $_POST['invColor'];

    if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($imgPath) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invMiles) || empty($invColor)) {
      $message = "Form not complete. Please fill in all fields.";
    } else {
      addNewVehicle($classificationId, $invMake, $invModel, $invDescription, "/phpmotors/images/vehicles/no-image.png", "/phpmotors/images/vehicles/no-image.png", $invPrice, $invStock, $invMiles, $invColor);
      $message = "Form submission successful.";
    }
    include '../view/add-vehicle.php';
    break;
    /* * ********************************** 
* Get vehicles by classificationId 
* Used for starting Update & Delete process 
* ********************************** */
  case 'getInventoryItems':
    // Get the classificationId 
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    // Fetch the vehicles by classificationId from the DB 
    $inventoryArray = getInventoryByClassification($classificationId);
    // Convert the array to a JSON object and send it back 
    //Note the use of echo, not return to send back the JSON object
    echo json_encode($inventoryArray);
    break;
  case 'mod':
    $invId = filter_input(INPUT_GET, 'invId');
    $invDescription = getInvItemInfo($invId);
    //Thanks, I fixed it!
    $invMake = $invDescription['invMake'];
    $invModel = $invDescription['invModel'];
    $invDesc = $invDescription['invDescription'];
    $imgPath = $invDescription['imgPath'];
   // $invThumbnail = $invDescription['invThumbnail'];
    $invPrice = $invDescription['invPrice'];
    $invStock = $invDescription['invStock'];
    $invMiles = $invDescription['invMiles'];
    $invColor = $invDescription['invColor'];
    if (count($invDescription) < 1) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-update.php';
    exit;
    break;
  case 'updateVehicle':
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
    $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
    //change invImg to imgPath
    $imgPath = trim(filter_input(INPUT_POST, 'imgPath', FILTER_SANITIZE_STRING));
    //$invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
    $invMiles = trim(filter_input(INPUT_POST, 'invMiles', FILTER_SANITIZE_NUMBER_INT));
    $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
    $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
    $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_STRING));

    if (
      empty($classificationId) || empty($invMake) || empty($invModel)
      || empty($invDescription) || empty($imgPath) || empty($invThumbnail)
      || empty($invPrice) || empty($invStock) || empty($invMiles) || empty($invColor)
    ) {
      $message = '<p class="warning" >Please complete all information for the item! Double check the classification of the item.</p>';
      include '../view/vehicle-update.php';
      exit;
    }
   

    $updateResult = updateVehicle($invMake, $invModel, $invDescription, $imgPath, $invThumbnail, $invPrice, $invStock, $invMiles, $invColor, $classificationId, $invId);
    if ($updateResult) {
      $message = "<p class='success' >Congratulations, the $invMake $invModel was successfully updated.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    } else {
      $message = "<p class='warning' >Error. the $invMake $invModel was not updated.</p>";
      include '../view/vehicle-update.php';
      exit;
    }
    break;
  case 'del':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if (count($invInfo) < 1) {
      $message = '<p class="warning" >Sorry, no vehicle information could be found.</p>';
    }
    include '../view/vehicle-delete.php';
    exit;
    break;
  case 'deleteVehicle':
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    $deleteResult = deleteVehicle($invId);
    if ($deleteResult) {
      $message = "<p class='success'>Congratulations the $invMake $invModel was	successfully deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    } else {
      $message = "<p class='warning' >Error: $invMake $invModel was not deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    }
    break;
  case 'classification':
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $vehicles = getVehiclesByClassification($classificationName);
    if (!count($vehicles)) {
      $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
    } else {
      $vehicleDisplay = buildVehiclesDisplay($vehicles);
    }
    //Testing
    //echo $vehicleDisplay;
   // exit;
    include '../view/classification.php';
    break;
  case 'pullVehicleData':
    //changed from INT to STRING
      $invId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_STRING);
      $invInfo = getInvItemInfo($invId);
      $thumbnailArray = getThumbnails($invId);

      if (isset($_SESSION['loggedin'])) {
         $clientEmail = $_SESSION['clientData']['clientEmail'];
         $clientInfo = getClient($clientEmail);
     }
      
      $_SESSION['message'] = null;
      if (!$invInfo) {
         $_SESSION['message'] = '<p class"warning" >Sorry, no vehicle information could be found.</p>';
         } else {
           $thumbnails = buildThumbnailDisplay($thumbnailArray);

            $vehicle = vehicleDetailPage($invInfo);
         }
         include '../view/vehicle-detail.php';
         break;
   case 'searchbar':
          echo "<p> Searchbar</p>";
          include '../view/search-results.php';
         break;
  case 'searchf':
            echo "<p> SearchfF</p>";
            include '../view/search-results.php';  

  default:
    $classificationList = buildClassificationList($classifications);
    include '../view/vehicle-management.php';
}
