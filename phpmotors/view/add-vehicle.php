<!-- Add Vehicle form -->
<?php
//add protection to the vehicle management views
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><?php 

    $classificationList = '<select name="classificationId" id="classificationId">';
    $classificationList .= '<option value="0">Choose Car Classification</option>';
    foreach ($classifications as $classification){
          $classificationList .= "<option value='$classification[classificationId]'";
          if(isset($classificationId)){
              if($classification['classificationId'] === $classificationId){
                  $classificationList .= ' selected ';
              }
          }
          $classificationList .= ">$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';

?><?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title> PHP Motors | Add Vehicle </title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <h1>Add Vehicle</h1>
        <form method="post" action="/phpmotors/vehicles/index.php">
            <fieldset>
                <label for="classificationId">Classification</label> <br>

                <?php echo $classificationList; ?>
               
                <br><br>
                <label for="make">Make</label><br>
                <input type="text" placeholder="Enter Vehicle Make" name="invMake" id="make" <?php if (isset($invMake)) {
                                                                                                echo "value='$invMake'";
                                                                                            }  ?> required><br><br>
                <label for="model">Model</label><br>
                <input type="text" placeholder="Enter Vehicle Model" name="invModel" id="model" <?php if (isset($invModel)) {
                                                                                                    echo "value='$invModel'";
                                                                                                }  ?> required><br><br>
                <label for="invDescription">Description</label><br>
                <textarea id="invDescription" rows="4" cols="50" name="invDescription" placeholder="Enter Vehicle description here... " <?php if (isset($invDescription)) {
                                                                                                                        echo "value='$invDescription'";
                                                                                                                    }  ?> required></textarea><br><br>
                <label for="image">Image Path</label><br>
                <input type="text" placeholder="Enter Vehicle image" name="imgPath" id="image" value="/phpmotors/images/vehicles/no-image.png" <?php if (isset($imgPath)) {
                                                                                                                                            echo "value='$imgPath'";
                                                                                                                                        }  ?> required><br><br>
                <label for="thumbnail">Thumbnail Path</label><br>
                <input type="text" placeholder="Enter Vehicle thumbnail" name="invThumbnail" value="/phpmotors/images/vehicles/no-image.png" id="thumbnail" <?php if (isset($invThumbnail)) {
                                                                                                                                                        echo "value='$invThumbnail'";
                                                                                                                                                    }  ?> required><br><br>
                <label for="price">Price</label><br>
                <input type="text" placeholder="Enter Vehicle price" name="invPrice" id="price" <?php if (isset($invPrice)) {
                                                                                                    echo "value='$invPrice'";
                                                                                                }  ?> required><br><br>
                <label for="stock"># In Stock</label><br>
                <input type="text" placeholder="Enter Vehicle Ammount" name="invStock" id="stock" <?php if (isset($invStock)) {
                                                                                                        echo "value='$invStock'";
                                                                                                    }  ?> required><br><br>
                                                                                                    <label for="Mileage"># In Stock</label><br>
                <input type="text" placeholder="Enter Vehicle Mileage" name="invMiles" id="miles" <?php if (isset($invMiles)) {
                                                                                                        echo "value='$invMiles'";
                                                                                                    }  ?> required><br><br>
                <label for="color">Color</label><br>
                <input type="text" placeholder="Enter  Vehicle color" name="invColor" id="color" <?php if (isset($invColor)) {
                                                                                                        echo "value='$invColor'";
                                                                                                    }  ?> required><br><br>
                                                                                                    
                <button type="submit">Add Vehicle</button>
                <input type="hidden" name="action" value="add-vehicle-form">
            </fieldset>
        </form>
    
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>