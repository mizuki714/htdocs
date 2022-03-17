
    <?php
    //this is the Vehicles Model

    //Function for inserting a new vehicle to the inventory table

    function addNewVehicle($class, $make, $model, $description, $image, $thumbnail, $price, $stock, $color)
    {
        //creates the connection using PHPMotors connect function 
        $db = phpmotorsConnect();
        //SQL statment to insert into inventory table
        $sql = 'INSERT INTO inventory (classificationId, invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor)
                VALUES (:classificationId, :invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor)';
        //A prepared statement using PHPMototrs connection
        $stmt = $db->prepare($sql);
        /* The next four lines will replace placeholders 
        in the SQL statement with  actual values in the 
        variables and then will tell the database the 
        type of data it is */
        $stmt->bindValue(':classificationId', $class, PDO::PARAM_STR);
        $stmt->bindValue(':invMake', $make, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $model, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $description, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $image, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $thumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $price, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $stock, PDO::PARAM_STR);
        $stmt->bindValue(':invColor', $color, PDO::PARAM_STR);

        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
    //Function for inserting a new classification to the carclassifications table.
    function addclass($class)
    {
        //connection object using connections.php function
        $db = phpmotorsConnect();
        //sql statement
        $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';
        //creates sql statement using connections.php connection
        $stmt = $db->prepare($sql);
        //this replaces the placeholders in the sql statement with the actual
        //values in the variables and tells the database the type of data it is
        $stmt->bindValue(':classificationName', $class, PDO::PARAM_STR);
        //inserts the data
        $stmt->execute();
        //asks how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        //closes the database interaction
        $stmt->closeCursor();
        //returns the indication that we were successful (rows changed)
        return $rowsChanged;
    }


    // Get vehicles by classificationId 
    function getInventoryByClassification($classificationId)
    {
        //Call the database connection
        $db = phpmotorsConnect();
        //Sql statement to query all inventory from the inventory table with a classificationId that matches the value passed
        $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId';
        //create PDO prepared statement
        $stmt = $db->prepare($sql);
        //Replace the named placeholder with the actual value as an integer
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        //Run the prepared statement with the actual value.
        $stmt->execute();
        // Request a multi-dimensional array of the vehicles as an associative array, stores the array in a variable.
        $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //Close the database connection
        $stmt->closeCursor();
        //Return the array
        return $inventory;
    }

    // Get vehicle information by invId
    function getInvItemInfo($invId)
    {
        $db = phpmotorsConnect();
        //get image path for the large primary
        $sql = 'SELECT i.invId, invMake, invModel, invDescription, im.imgPath AS imgPath, invPrice, invStock, invColor, classificationId 
      FROM inventory i 
        LEFT JOIN images im ON i.invId = im.invId AND im.imgName NOT LIKE "%-tn%" AND im.imgPrimary = 1 
      WHERE i.invId = :invId ';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }
    //Update vehicle
    function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId)
    {
        //creates the connection using PHPMotors connect function 
        $db = phpmotorsConnect();
        //SQL statment to insert into inventory table
        $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
        //A prepared statement using PHPMototrs connection
        $stmt = $db->prepare($sql);
        /* The next four lines will replace placeholders 
        in the SQL statement with  actual values in the 
        variables and then will tell the database the 
        type of data it is */
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }
//function to delete a vehicle
    function deleteVehicle($invId) {
        $db = phpmotorsConnect();
        $sql = 'DELETE FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }
    
    // //get a list of vehicles based on the classification.
    // function getVehiclesByClassification($classificationName){
    //     $db = phpmotorsConnect();
    //     $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    //     $stmt = $db->prepare($sql);
    //     $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    //     $stmt->execute();
    //     $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     $stmt->closeCursor();
    //     return $vehicles;
    //    }
//lter the functionality for displaying vehicles by classification. The primary thumbnail image for each vehicle should now be obtained from the images table and not the inventory table
    function getVehiclesByClassification($classificationName){
        $db = phpmotorsConnect();
        $sql = 'SELECT i.invId, invMake, invModel, invDescription, im.imgPath AS invImage, 
                  imtn.imgPath AS invThumbnail, invPrice, invStock, invColor, classificationId 
                FROM inventory i 
                  LEFT JOIN images im ON i.invId = im.invId AND im.imgName NOT LIKE "%-tn%" AND im.imgPrimary = 1 
                  LEFT JOIN images imtn ON i.invId = imtn.invId AND imtn.imgName LIKE "%-tn%" AND imtn.imgPrimary = 1
                WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $vehicles;
      }
       // Get information for all vehicles
function getVehicles(){
    $db = phpmotorsConnect();
    $sql = 'SELECT invId, invMake, invModel FROM inventory';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}


    ?>