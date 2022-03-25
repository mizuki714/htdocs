<!-- Update Vehicle form -->
<?php
//add protection to the vehicle management views
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
?><?php
    $classificationList = '<select name="classificationId" id="classificationId">';
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'";
        if (isset($classificationId)) {
            if ($classification['classificationId'] === $classificationId) {
                $classificationList .= ' selected ';
            }
        } elseif (isset($invInfo['classificationId'])) {
            if ($classification['classificationId']  === $invInfo['classificationId']) {
                $classificationList .= ' selected ';
            }
        }
        $classificationList .= ">$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    ?><?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Modify $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invModel)) {
            echo "Modify $invMake $invModel";
        } ?> | PHP Motors</title>
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
    <h1><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Modify $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invModel)) {
            echo "Modify$invMake $invModel";
        } ?></h1>
    <h3>Note all Fields are Required</h3>
    <form method="post" action="/phpmotors/vehicles/index.php">
        <fieldset>
            <label for="classificationId">Classification</label> <br>
            <?php echo $classificationList; ?>

            <br><br>
            <label for="make">Make</label><br>
            <input type="text" name="invMake" id="invMake" required <?php if (isset($invMake)) {
                                                                        echo "value='$invMake'";
                                                                    } elseif (isset($invInfo['invMake'])) {
                                                                        echo "value='$invInfo[invMake]'";
                                                                    } ?>><br><br>

            <label for="model">Model</label><br>
            <input type="text" name="invModel" id="invModel" required <?php if (isset($invModel)) {
                                                                            echo "value='$invModel'";
                                                                        } elseif (isset($invInfo['invModel'])) {
                                                                            echo "value='$invInfo[invModel]'";
                                                                        } ?>><br><br>

            <label for="invDescription">Description</label><br>
            <textarea id="invDescription" rows="4" cols="50" name="invDescription" placeholder="Enter Vehicle description here... " required>
                <?php if (isset($invDescription)) {
                    echo "$invDesc";
                } elseif (isset($invInfo['invDescription'])) {
                    echo $invInfo['invDescription'];
                } ?></textarea><br><br>

            <label for="image">Image Path</label><br>
            <input type="text" name="imgPath" id="image"  required <?php if (isset($imgPath)) {
                                                                                                                                                echo "value='$imgPath'";
                                                                                                                                            } elseif (isset($invInfo['imgPath'])) {
                                                                                                                                                echo "value='$invInfo[imgPath]'";
                                                                                                                                            } ?>><br><br>

            <label for="thumbnail">Thumbnail Path</label><br>
            <input type="text"  name="invThumbnail" id="thumbnail" required <?php
                                                                                                                                                        if (isset($invThumbnail)) {
                                                                                                                                                            echo "value='$invThumbnail'";
                                                                                                                                                        } elseif (isset($invInfo['invThumbnail'])) {
                                                                                                                                                            echo "value='$invInfo[invThumbnail]'";
                                                                                                                                                        }
                                                                                                                                                        ?>><br><br>
            <label for="price">Price</label><br>
            <input type="text" placeholder="Enter Vehicle price" name="invPrice" id="price" required <?php
                                                                                                        if (isset($invPrice)) {
                                                                                                            echo "value='$invPrice'";
                                                                                                        } elseif (isset($invInfo['invPrice'])) {
                                                                                                            echo "value='$invInfo[invPrice]'";
                                                                                                        }
                                                                                                        ?>><br><br>
            <label for="stock"># In Stock</label><br>
            <input type="text" placeholder="Enter Vehicle Ammount" name="invStock" id="stock" required <?php 
                                                                                                        if (isset($invStock)) {
                                                                                                            echo "value='$invStock'";
                                                                                                        } elseif (isset($invInfo['invStock'])) {
                                                                                                            echo "value='$invInfo[invStock]'";
                                                                                                        }
                                                                                                        ?>><br><br>
                                                                                                        <label for="Mileage"># In Stock</label><br>
            <input type="text" placeholder="Enter Vehicle Miles" name="invMiles" id="miles" required <?php 
                                                                                                        if (isset($invMiles)) {
                                                                                                            echo "value='$invMiles'";
                                                                                                        } elseif (isset($invInfo['invMiles'])) {
                                                                                                            echo "value='$invInfo[invMiles]'";
                                                                                                        }
                                                                                                        ?>><br><br> 
            <label for="color">Color</label><br>
            <input type="text" placeholder="Enter  Vehicle color" name="invColor" id="color" required <?php
                                                                                                        if (isset($invColor)) {
                                                                                                            echo "value='$invColor'";
                                                                                                        } elseif (isset($invInfo['invColor'])) {
                                                                                                            echo "value='$invInfo[invColor]'";
                                                                                                        }
                                                                                                        ?>><br><br>
            <input type="submit" value="Update Vehicle">
            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                            echo $invInfo['invId'];
                                                        } elseif (isset($invId)) {
                                                            echo $invId;
                                                        } ?>">
        </fieldset>
    </form>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>