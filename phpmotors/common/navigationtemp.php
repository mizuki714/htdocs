<?php
//contents here to keep things cleaner and convenient for me whne using the template! 

// Get the database connection file
 require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
 require_once '../model/main-model.php';


 // Get the array of classifications
 $classifications = getClassifications();

//Dump to see if the array of classifications is functional (it is)
 //var_dump($classifications);
//	exit;

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='../index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='../index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
// testing $navList if it appears"High Five"! This DOES appear below the footer when not commented out
//echo $navList;
//exit;
?>
 
 <!--- Navigation-->
 <nav>
<!-- This is where I start having issues if I comment out the nav my nav clearly and obviouslt dissappears but... "Warning: Undefined variable $navList in C:\xampp\htdocs\phpmotors\common\navigation.php on line 4"-->
 <?php echo $navList; ?>
     <!--- Comment out all the stuff in NAV-->
     <!---
     <button onclick="toggleMenu()"> &#9776; Menu </button>
     <ul id="menu" class="hide_navigation">
         <li class="active"><a href="home.php"> Home </a></li>
         <li><a href="Classic.html"> Classic </a></li>
         <li><a href="Sports.html"> Sports </a></li>
         <li><a href="SUV.html"> SUV </a></li>
         <li><a href="Trucks.html"> Trucks </a></li>
         <li><a href="Used.html"> Used </a></li>
     </ul>
    -->
 </nav>
 <main>