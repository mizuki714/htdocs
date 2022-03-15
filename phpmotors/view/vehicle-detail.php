<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title> PHP Motors | <?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "View Detail $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invModel)) {
            echo "Modify $invMake $invModel";
        } ?></title>
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
 <?php
echo $vehicle;
 ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php';?>

    
    
    