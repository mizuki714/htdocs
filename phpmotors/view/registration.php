<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Registration page for phpMotors." />
    <link rel="shortcut icon" href="phpmotors/images/site/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/small.css" media="screen">
    <link rel="stylesheet" href="../css/medium.css" media="screen">
    <link rel="stylesheet" href="../css/large.css" media="screen">
    <title> PHP Motors | Registration </title>
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1> Register </h1>
        <div class="registrationForm">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/accounts/">
                <!-- This was where I had the form linked -->
                <!--"phpmotors/"-->
                <!-- This was what the instructions had the form linked  to-->
                <!--"/phpmotors/accounts/index.php"-->
                <form action="phpmotors/accounts/" name="registration" method="post">
                    <fieldset>
                        <!-- first and last name -->
                        <label for="firstName">First Name*</label><br><input type="text" id="fname" name="clientFirstname" pattern="[a-zA-Z\s]+" minlength="2" placeholder="First Name" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br>
                        <label for="lastName">Last Name*</label><br><input type="text" id="lname" name="clientLastname" pattern="[a-zA-Z\s]+" minlength="2" placeholder="Last Name" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required><br>
                        <!-- email input of type email and use a placeholder to provide a demo email -->
                        <label for="email">Email*
                        </label><br><input type="email" id="clientEmail" name="clientEmail" placeholder="myaddress@gmail.com" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
                        <!--<div id="message">
                            <h3>Password must contain the following:</h3>
                            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                            <p id="number" class="invalid">A <b>number</b></p>
                            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                        </div>-->
                        <!-- password input of type password -->
                        <label class="password"><br>Password*</label><br> <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> <input type="password" id="password" name="clientPassword"  pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder="Password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        <p>* Field Required</p>
                        <input type="submit" name="submit" id="regbtn" value="register">
                        <!-- Add the action name - value pair -->
                        <input type="hidden" name="action" value="register">

                    </fieldset>
                </form>
        </div>
</body>

</html>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>