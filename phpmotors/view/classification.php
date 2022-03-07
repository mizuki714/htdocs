<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
<?php
// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
 require_once '../model/main-model.php';
// Get the functions file
require_once '../library/functions.php';

 // Get the array of classifications
 $classifications = getClassifications();

 //display navigation
 $navList =getNavList($classifications);
 ?>
<nav>
 <?php echo $navList; ?>
 </nav>
 <main>
 <h1 class="classificationTitle"><?php echo $classificationName; ?> vehicles</h1>
<?php if(isset($message)){
 echo $message; }
 ?>
<?php if(isset($vehicleDisplay)){
 echo $vehicleDisplay;
} ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php';?>
