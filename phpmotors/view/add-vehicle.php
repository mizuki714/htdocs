<?php 

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

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="page for phpMotors." />
    <link rel="shortcut icon" href="phpmotors/images/site/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/small.css" media="screen">
    <link rel="stylesheet" href="../css/medium.css" media="screen">
    <link rel="stylesheet" href="../css/large.css" media="screen">
    <title> PHP Motors | Add Vehicle Form </title>
</head>

<body>
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
                <label for="class">Classification</label></br>

                <?php echo $classificationList; ?>
                <!--comment out maybe idk 
                    <?php /*
                $classifications = getClassifications();
                echo '<select name="classificationId" id="car-class">';
                foreach ($classifications as $classification) {
                    echo '<option value="' . $classification['classificationId'] . '">' . $classification['classificationName'] . '</option>';
                }

               */ ?> -->


                </select><br><br>
                <label for="make">Make</label></br>
                <input for="text" placeholder="Enter Vehicle Make" name="invMake" id="make" <?php if (isset($invMake)) {
                                                                                                echo "value='$invMake'";
                                                                                            }  ?> required><br><br>
                <label for="model">Model</label></br>
                <input for="text" placeholder="Enter Vehicle Model" name="invModel" id="model" <?php if (isset($invModel)) {
                                                                                                    echo "value='$invModel'";
                                                                                                }  ?> required><br><br>
                <label for="description">Description</label></br>
                <textarea rows="4" cols="50" name="invDescription" placeholder="Enter Vehicle description here... " <?php if (isset($invDescription)) {
                                                                                                                        echo "value='$invDescription'";
                                                                                                                    }  ?> required></textarea><br><br>
                <label for="image">Image Path</label></br>
                <input type="text" placeholder="Enter Vehicle image" name="invImage" id="image" value="/phpmotors/images/no-image.png" <?php if (isset($invImage)) {
                                                                                                                                            echo "value='$invImage'";
                                                                                                                                        }  ?> required><br><br>
                <label for="thumbnail">Thumbnail Path</label></br>
                <input for="text" placeholder="Enter Vehicle thumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png" id="thumbnail" <?php if (isset($invThumbnail)) {
                                                                                                                                                        echo "value='$invThumbnail'";
                                                                                                                                                    }  ?> required><br><br>
                <label for="price">Price</label></br>
                <input type="text" placeholder="Enter Vehicle price" name="invPrice" id="price" <?php if (isset($invPrice)) {
                                                                                                    echo "value='$invPrice'";
                                                                                                }  ?> required><br><br>
                <label for="stock"># In Stock</label></br>
                <input for="text" placeholder="Enter Vehicle Ammount" name="invStock" id="stock" <?php if (isset($invStock)) {
                                                                                                        echo "value='$invStock'";
                                                                                                    }  ?> required><br><br>
                <label for="color">Color</label></br>
                <input type="text" placeholder="Enter  Vehicle color" name="invColor" id="color" <?php if (isset($invColor)) {
                                                                                                        echo "value='$invColor'";
                                                                                                    }  ?> required><br><br>
                <button type="submit">Add Vehicle</button>
                <input type="hidden" name="action" value="add-vehicle-form">
            </fieldset>
        </form>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>