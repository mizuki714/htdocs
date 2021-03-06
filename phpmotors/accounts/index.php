<?php

//Accounts Controller 

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


//nav bar
$navList = getNavList($classifications);

//Demo to see if the array of classifications is functional (it is)
//var_dump($classifications);
//	exit;
/*
// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
   $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

// testing $navList if it appears"High Five"! This DOES appear below the footer when not commented out
//echo $navList;
//exit;
*/

//Accounts Controller
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
   $action = filter_input(INPUT_GET, 'action');

   //this is where the form stuff is located
   $firstName = filter_input(INPUT_POST, 'firstName');
   $lastName = filter_input(INPUT_POST, 'lastName');
   $email = filter_input(INPUT_POST, 'clientEmail');
   $password = filter_input(INPUT_POST, 'clientPassword');
}

switch ($action) {
   case 'login':
      include '../view/login.php';
      break;
   case 'registration':
      include '../view/registration.php';
      break;
   case 'register':
      // Filter and store the data
      //added a different filter type to the input to sanitize anything out that shouldn't be there using FILTER_SANITIZE_EMAIL. surrounded each of the filter_input functions with a trim()function to remove any extra spaces before or after the values.
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

      //Recreate the $clientEmail variable and assign to it what is returned from calling the checkEmail($clientEmail) function.

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);

      /* 
   * check if the email address that is being 
   * submitted already exists in the databaseIf 
   * so, we will abort the registration process
   *  and suggest that the visitor may want to 
   * login instead. If the email does not exist, 
   * we then proceed with the registration normally.
   */

      $existingEmail = checkExistingEmail($clientEmail);

      // Check for existing email address in the table
      if ($existingEmail) {
         $message = '<p class="notice">That email address already exists. Would you like to login instead?</p>';
         include '../view/login.php';
         exit;
      }

      // Check for missing data
      if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
         $message = '<p>Please provide information for all empty form fields.</p>';
         include '../view/registration.php';
         exit;
      }

      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

      // Send the data to the model
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);


      // Check and report the result
      if ($regOutcome === 1) {
         setcookie('firstName', $clientFirstname, strtotime('+1 year'), '/');
         $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
         include header('Location: /phpmotors/accounts/?action=login');
         exit;
      } else {
         $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
         include '../view/registration.php';
         exit;
      }

      break;

   case 'LOGIN':
      //testing
      //  echo "this is the LOGIN page";
      //  exit;

      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      // echo $clientEmail;
      // exit;

      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

      //testing
      // echo  $clientPassword;
      // echo $clientEmail;
      //exit;

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);


      // Check for missing data
      if (empty($clientEmail) || empty($checkPassword)) {
         $message = '<p>Please provide information for all empty form fields.</p>';
         include '../view/login.php';
         exit;
      }

      //testing
      //echo "this is the LOGIN page check for missing data ";
      // exit;

      // When a valid password exists, proceed with the login process
      // Query  client data based on the email address
      $clientData = getClient($clientEmail);
      /*
      * Compare  password just submitted against the hashed 
      * password for the matching client
      */
      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
      // If the hashes don't match create an error
      // and return to the login view
      if (!$hashCheck) {
         $message = '<p class="warning" >Please check your password and try again.</p>';
         include '../view/login.php';
         exit;
      } else {
         // A valid user exists, log them in
         $_SESSION['loggedin'] = TRUE;
         // Remove the password from the array
         // the array_pop function removes the last
         // element from an array
         array_pop($clientData);
         // Store the array into the session
         $_SESSION['clientData'] = $clientData;
         // Send them to the admin view
         include '../view/admin.php';
         exit;
      }
      break;
   case 'Logout':
      session_unset();
      session_destroy();
      $_SESSION = array();
      include '../index.php';
      exit;
      break;

      case 'client-update':
         $clientId = $_SESSION['clientData']['clientId'];
         $clientInfo = getClientInfo($clientId);
         include '../view/client-update.php';
         break;
      case 'updateInfo':
         // A valid password exists, proceed with the login process
         // Query the client data based on the email address
         $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
         $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
         $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
         $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);
   
         $clientEmail = checkEmail($clientEmail);
         $currentEmail = $_SESSION['clientData']['clientEmail'];
   
         // Check for existing email
         $existingEmail = checkExistingEmail($clientEmail);
   
         // Check for existing email address in the table
         if ($currentEmail != $clientEmail) {
            if($existingEmail){
               $message = '<p class="warning" >That email address already exists. Do you want to login instead?</p>';
               include '../view/client-update.php';
               exit;
            }
         }
         
         // Check for missing data
         if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientId)){
            $message = '<p class="warning" >Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
           }
         $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
         $clientId = $_SESSION['clientData']['clientId'];
         $clientInfo = getClientInfo($clientId);
         array_pop($clientInfo);
         $_SESSION['clientData'] = $clientInfo;
         if ($updateOutcome === 1) {
            setcookie('firstname', $clientFirstname, 0, '/');
            $_SESSION['message'] = "<p class='success' > $clientFirstname, your information has been updated. </p>";
            header('Location: /phpmotors/accounts');
            exit;
         } else {
            $message = "<p class='warning'> Sorry $clientFirstname, we could not update your account information. Please try again.</p>";
            include '../view/client-update.php';
            exit;
         }
         
         break;
      case 'updatePassword':
         $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
         $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
         $passwordCheck = checkPassword($clientPassword);
         $clientInfo = getClientInfo($clientId);
         // Run basic checks, return if errors
         if (empty($passwordCheck)) {
         $message = '<p class="warning" >Please provide a valid password.</p>';
         include '../view/client-update.php';
         exit;
         }
   
         $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
         $updateOutcome = updateClientPassword($hashedPassword, $clientId);
         if ($updateOutcome === 1) {
            setcookie('firstname', $clientInfo['clientFirstname'], 0, '/');
            $_SESSION['message'] = "<p class='success'> $clientInfo[clientFirstname], your password has been updated </p>";
            header('Location: /phpmotors/accounts');
            exit;
         } else {
            $message = "<p class='warning'> Sorry $clientFirstname, the password failed to update. Please try again.</p>";
            include '../view/client-update.php';
            exit;
         }
         case 'searchbar':
            echo "<p> Searchbar</p>";
            include '../view/search-results.php';
           break;
           case 'searchf':
              echo "<p> SearchF</p>";
              include '../view/search-results.php';
   default:
      //var_dump($_POST);
      //exit;
      include '../view/admin.php';
      break;
}
