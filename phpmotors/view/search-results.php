<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title> PHP Motors | Search Results </title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

<?php
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
// Get the searchbar model
require_once '../model/searchbar-model.php';
// Get the functions file
require_once '../library/functions.php';

 // Get the array of classifications
 $classifications = getClassifications();

 //display navigation
 $navList = getNavList($classifications);
 ?>
 <nav>
 <?php echo $navList; ?>
 </nav>
 <main>
<h1> Search Results </h1>
<?php
    echo $resultList;
 ?>

<p></p>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php';?>