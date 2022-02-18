<!--a form for adding a new classification -->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title> PHP Motors | Home </title>
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
                <label for= "classificationName">Classification Name</label><br>
                <input type="text" placeholder="Enter Car Classification Here" name="classificationName" id="classificationName" maxlength='30' <?php if (isset($invModel)) {
                                                                                                                                                echo "value='$invModel'";
                                                                                                                                            }  ?><?php if (isset($classificationName)) {
                                                                                                            echo "value='$classificationName'";
                                                                                                        }  ?> required><br><br>
                <button type="submit">Add Classification</button>
                <input type="hidden" name="action" value="add-classfication">
            </fieldset>
        </form>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>