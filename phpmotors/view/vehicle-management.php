
<!---Vehicle management-->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
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
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>