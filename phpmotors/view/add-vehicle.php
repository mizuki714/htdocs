<!DOCTYPE html>
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
        <form method="post" action="/phpmotors/vehicles/">
            <fieldset>
                <label for="class">Classification</label></br>
                <?php
                $classifications = getClassifications();
                echo '<select name="log_class" id="car-class">';
                foreach ($classifications as $classification) {
                    echo '<option value="' . $classification['classificationId'] . '">' . $classification['classificationName'] . '</option>';
                }

                ?>
                </select><br><br>
                <label for="make">Make</label></br>
                <input for="text" placeholder="Enter Vehicle Make" name="log_make" id="make"><br><br>
                <label for="model">Model</label></br>
                <input for="text" placeholder="Enter Vehicle Model" name="log_model" id="model"><br><br>
                <label for="description">Description</label></br>
                <textarea rows="4" cols="50" name="log_description" placeholder="Enter Vehicle description here..."></textarea><br><br>
                <label for="image">Image Path</label></br>
                <input type="text" placeholder="Enter Vehicle image" name="log_image" id="image" value="/phpmotors/images/no-image.png"><br><br>
                <label for="thumbnail">Thumbnail Path</label></br>
                <input for="text" placeholder="Enter Vehicle thumbnail" name="log_thumbnail" value="/phpmotors/images/no-image.png" id="thumbnail"><br><br>
                <label for="price">Price</label></br>
                <input type="text" placeholder="Enter Vehicle price" name="log_price" id="price"><br><br>
                <label for="stock"># In Stock</label></br>
                <input for="text" placeholder="Enter Vehicle Ammount" name="log_stock" id="stock"><br><br>
                <label for="color">Color</label></br>
                <input type="text" placeholder="Enter  Vehicle color" name="log_color" id="color"><br><br>
                <button type="submit">Add Vehicle</button>
                <input type="hidden" name="action" value="add-vehicle-form">
            </fieldset>
        </form>
    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>