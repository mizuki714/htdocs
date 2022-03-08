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
  function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $money = number_format($vehicle['invPrice'], 2, ".", ",");
     $dv .= '<li>';
     $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<a href='/phpmotors/vehicles/?action=pullVehicleData&vehicleId={$vehicle["invId"]}'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
     $dv .= "<span>$$money</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;  
}
function buildThumbnailDisplay($thumbnailArray) {
  $thumbs = '<ul id="thumb-display">';
  foreach ($thumbnailArray as $image) {
   $thumbs .= '<li>';
   $thumbs .= "<img src='$image[imgPath]' alt='Image on PHP Motors.com'>";
   $thumbs .= '</li>';
 }
  $thumbs .= '</ul>';
  return $thumbs;
}

function vehicleDetailPage($vehicle) {
  $money = number_format($vehicle['invPrice'], 2, ".", ",");
  $dv = "<h1 class='carDetailsHead'>$vehicle[invMake] $vehicle[invModel]</h1>";
  $dv .= "<img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com' class='carImg'>";
  $dv .= "<p class='price'>Price: $$money</p>";
  $dv .= '<hr class="detailsHr">';
  $dv .= "<h2 class='detailsTitle'>$vehicle[invMake] $vehicle[invModel] Details</h2>";
  $dv .= "<p class='carDescription'>$vehicle[invDescription]</p>";
  $dv .= "<p class='carColor'><b>Color: </b>$vehicle[invColor]</p>";
  $dv .= "<p class='quantity'><b>Quantity in Stock: </b>$vehicle[invStock]</p>";   
  return $dv; 
}

?>