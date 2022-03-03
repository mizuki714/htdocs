
<!---Vehicle management-->
<?php
//add protection to the vehicle management views
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
   }
   if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title> PHP Motors | Vehicle Management </title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1> Vehicle Management</h1>
        <div class="vman">
            <div class="addclass">
                <ul>
                    <!--A link to the controller that will trigger the delivery of the add classification view. -->
                    <li>
                        <a href="?action=add-class">Add Classification</a>
                    </li>
                </ul>
            </div>
            <div class="addcar">
                <ul>
                    <!--A link to the controller that will trigger the delivery of the add vehicle view. -->
                    <li><a href="?action=add-vehicle">Add Vehicle</a></li>
                </ul>
            </div>
        </div>
        <div class="vehicleManagement">

    <?php
    // PHP code block that will: 1) display a message if there is one, 2) display a heading and directions and the classification list if there is one.
    if (isset($message)) {
        echo $message;
    }
    if (isset($classificationList)) {
        echo '<h2>Vehicles By Classification</h2>';
        echo '<p>Choose a classification to see those vehicles</p>';
        echo $classificationList;
         //test this also returns gibberish need to find out how I broke it, it was a typo! hooray! 
         //echo $invInfo['invId'];
    }
    ?>
    <noscript>
        <!-- tell the client that JavaScript is required -->
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <table id="inventoryDisplay"></table>
</div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
        <?php unset($_SESSION['message']); ?>