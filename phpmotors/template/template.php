<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title> PHP Motors | TITLE </title>
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
<h1> Content Title Here</h1>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php';?>

    
    
    