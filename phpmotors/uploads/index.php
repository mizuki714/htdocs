<?php
//controller for Image Uploads

session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';

// Get the uploads model
require_once '../model/uploads-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';
// Get the functions file
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = getNavList($classifications);

//collect the "action" value from the "post" or "get" options of the "request" from the browser:
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

/* * ****************************************************
* Variables for use with the Image Upload 
* Functionality
* By declaring these here, it makes it easy to 
* update or change the name or location in one 
* place and have it apply throughout the 
* application You will, in fact, be asked to do 
* this during the enhancement
* **************************************************** */
// directory name where uploaded images are stored
//test path
//$image_dir = '/phpmotors/uploads/images';
//true path
$image_dir = '/phpmotors/images/vehicles';
// The path is the full path from the server root
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;

switch ($action) {
    case 'upload':
        // Store the incoming vehicle id and primary picture indicator
        $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
        $imgPrimary = filter_input(INPUT_POST, 'imgPrimary', FILTER_VALIDATE_INT);
        
        // Store the name of the uploaded image
        $imgName = $_FILES['file1']['name'];
            
        $imageCheck = checkExistingImage($imgName);
            
        if($imageCheck){
        $message = '<p class="warning" >An image by that name already exists.</p>';
        } elseif (empty($invId) || empty($imgName)) {
        $message = '<p class="warning" >You must select a vehicle and image file for the vehicle.</p>';
        } else {
        // Upload the image, store the returned path to the file
        $imgPath = uploadFile('file1');
            
        // Insert the image information to the database, get the result
        $result = storeImages($imgPath, $invId, $imgName, $imgPrimary);
            
        // Set a message based on the insert result
        if ($result) {
        $message = '<p class="success" >The upload succeeded.</p>';
        } else {
        $message = '<p class="warning" >Sorry, the upload failed.</p>';
        }
        }
            
        // Store message to session
        $_SESSION['message'] = $message;
            
        // Redirect to this controller for default action
        header('location: .');
        break;
    case 'delete':
        // Get the image name and id
        $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_STRING);
        $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);
            
        // Build the full path to the image to be deleted
        $target = $image_dir_path . '/' . $filename;
            
        // Check that the file exists in that location
        if (file_exists($target)) {
        // Deletes the file in the folder
        $result = unlink($target); 
        }
            
        // Remove from database only if physical file deleted
        if ($result) {
        $remove = deleteImage($imgId);
        }
            
        // Set a message based on the delete result
        if ($remove) {
        $message = "<p class='success' >$filename was successfully deleted.</p>";
        } else {
        $message = "<p class='warning' >$filename was NOT deleted.</p>";
        }
            
        // Store message to session
        $_SESSION['message'] = $message;
            
        // Redirect to this controller for default action
        header('location: .');
        break;
    default:
        // Call function to return image info from database
        $imageArray = getImages();
            
        // Build the image information into HTML for display
        if (count($imageArray)) {
        $imageDisplay = buildImageDisplay($imageArray);
        } else {
        $imageDisplay = '<p class="warning" >Sorry, no images could be found.</p>';
        }
            
        // Get vehicles information from database
        $vehicles = getVehicles();
        // Build a select list of vehicle information for the view
        $prodSelect = buildVehiclesSelect($vehicles);
            
        include '../view/image-admin.php';
        exit;
        break;
   }