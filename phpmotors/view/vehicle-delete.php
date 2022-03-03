<!-- Delete Vehicle form -->
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
<title><?php if (isset($invInfo['invMake'])) {
            echo "Delete $invInfo[invMake] $invInfo[invModel]";
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
    <h1><?php if (isset($invInfo['invMake'])) {
            echo "Delete $invInfo[invMake] $invInfo[invModel]";
        } ?></h1>
    <div class="deleteVehicle">
        <h3 class="center red">Confirm Vehicle Deletion. The delete is permanent.</h3>
        <form method="post" action="/phpmotors/vehicles/">
            <fieldset>
                <label for="classificationId">Classification</label> <br>
                <?php echo $classificationList; ?>

                <br><br>
                <label for="make">Make</label><br>
                <input type="text" readonly name="invMake" id="invMake" <?php
                                                                        if (isset($invInfo['invMake'])) {
                                                                            echo "value='$invInfo[invMake]'";
                                                                        } ?>><br><br>
                <label for="model">Vehicle Model</label><br>
                <input type="text" readonly name="invModel" id="invModel" <?php
                                                                            if (isset($invInfo['invModel'])) {
                                                                                echo "value='$invInfo[invModel]'";
                                                                            } ?>><br><br>
                <label for="invDescription">Vehicle Description</label><br>
                <textarea name="invDescription" readonly id="invDescription"><?php
                                                                                if (isset($invInfo['invDescription'])) {
                                                                                    echo $invInfo['invDescription'];
                                                                                }
                                                                                ?></textarea><br><br>
                <p class="warning">Confirm Vehicle Deletion. The delete is permanent.</p>
                <input type="submit" class="regbtn" name="submit" value="Delete Vehicle">
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                                echo $invInfo['invId'];
                                                            } ?>">
            </fieldset>
        </form>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>