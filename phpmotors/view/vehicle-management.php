<!DOCTYPE html>
<html lang="en">
<!---Vehicle management-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="page for phpMotors." />
    <link rel="shortcut icon" href="phpmotors/images/site/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/small.css" media="screen">
    <link rel="stylesheet" href="../css/medium.css" media="screen">
    <link rel="stylesheet" href="../css/large.css" media="screen">
    <title> PHP Motors | Vehicle Management </title>
</head>

<body>
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
            </div>
            <div class="addcar">
                <!--A link to the controller that will trigger the delivery of the add vehicle view. -->
                <li><a href="?action=add-vehicle">Add Vehicle</a></li>
                </ul>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>