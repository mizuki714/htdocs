<?php

//Accounts Controller 


// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';


// Get the array of classifications
$classifications = getClassifications();

//Demo to see if the array of classifications is functional (it is)
// var_dump($classifications);
//	exit;

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

//Accounts Controller
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
   $action = filter_input(INPUT_GET, 'action');

   //this is where the form stuff is located
   $firstName = filter_input(INPUT_POST, 'firstName');
   $lastName = filter_input(INPUT_POST, 'lastName');
   $email = filter_input(INPUT_POST, 'email');
   $password = filter_input(INPUT_POST, 'password');
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
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
      $clientLastname = filter_input(INPUT_POST, 'clientLastname');
      $clientEmail = filter_input(INPUT_POST, 'clientEmail');
      $clientPassword = filter_input(INPUT_POST, 'clientPassword');;

      // Check for missing data
      if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
         $message = '<p>Please provide information for all empty form fields.</p>';
         include '../view/registration.php';
         exit;
      }
      // Send the data to the model
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

      // Check and report the result
      if ($regOutcome === 1) {
         $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
         include '../view/login.php';
         exit;
      } else {
         $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
         include '../view/registration.php';
         exit;
      }

      break;
   default:
      break;
}
