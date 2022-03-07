<?php 
//library file created to store custom functions


//check the email 

function checkEmail($clientEmail){
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character

function checkPassword($clientPassword){
 $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
 return preg_match($pattern, $clientPassword);
}

//code to build the navigation bar and store it to a variable
function getNavList($classifications){
// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
  // ? in the path represents an indicator to the server that a name-value pair is being sent
  // & in the path represents that another name-value pair is being sent (yes, these can be repeated for as many name-value pairs as you want to send)
   $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
return $navList;
}

  // Build the classifications select list 
function buildClassificationList($classifications){ 
   //Begin the select element
   $classificationList = '<select name="classificationId" id="classificationList">'; 
   //Creates a default option with no value
   $classificationList .= "<option>Choose a Classification</option>"; 
   //foreach loop to create a new option for each element within the array
   foreach ($classifications as $classification) { 
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
   } 
   //End the select element
   $classificationList .= '</select>';
   //Return the finished select element 
   return $classificationList; 
  }
?>