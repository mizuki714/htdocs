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
    <title> PHP Motors | Add Classification </title>
</head>
<!--a form for adding a new classification -->

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
        <h1>Add Car Classification</h1>
        <form method="post" action="/phpmotors/vehicles/">
            <fieldset>
                <label for="class-name">Classification Name</label></br>
                <input type="text" placeholder="Enter Car Classification Here" name="classificationName" id="classificationName" <?php if (isset($classificationName)) {

                                                                                                                                        echo "value='$classificationName'";
                                                                                                                                    }  ?> required><br><br>
                <button type="submit">Add Classification</button>
                <input type="hidden" name="action" value="add-classfication">
            </fieldset>
        </form>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>