<?php
/* Main PHP Motors Model */

/*Function getClassification will get the classification information from the carclassification table in the phpmotors database. */

function getClassifications(){
    // Creates a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    /* The SQL statement to be used with the database 
    alter the existing getClassifications() function to also select the classificationId from the database and use it in building the drop-down select list.*/
    $sql = 'SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC'; 
    // creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    // runs the prepared statement 
    $stmt->execute(); 
    // gets the data from the database and 
    // stores it as an array in the $classifications variable 
    $classifications = $stmt->fetchAll(); 
    // close the interaction with the database 
    $stmt->closeCursor(); 
    // send the array of data back to where the function 
    // was called (the controller) 
    return $classifications;
   }
