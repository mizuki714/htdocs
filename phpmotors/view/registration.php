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
    <?php include $_SERVER['DOCUMENT_ROOT'] . '\phpmotors\common\header.php'; ?>
    <nav>
 <?php echo $navList; ?>
 </nav>
 <main>
    <h1> Register </h1>
    <div class="registrationForm">
    <form action="..\accounts\accounts.php" name="registration">
        <fieldset>
            <!-- first and last name -->
            <label for="firstName">First Name*</label><br><input type="text" id="firstName" name="firstName" pattern="[a-zA-Z\s]+" minlength="2" placeholder="First Name" required><br>
            <label for="lastName">Last Name*</label><br><input type="text" id="lastName" name="lastName" pattern="[a-zA-Z\s]+" minlength="2" placeholder="Last Name" required><br>
            <!-- email input of type email and use a placeholder to provide a demo email -->
            <label for="email">Email*
            </label><br><input type="text" id="email" name="email" placeholder="myaddress@gmail.com">
            <div id="message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <!-- password input of type password -->
            <label class="password">Password*</label><br> <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            <p>* Field Required</p>
            <input type="submit" value="Register" onclick="alert('You clicked the register button!')">
        </fieldset>
    </form>
    </div>
</body>

</html>

<?php include $_SERVER['DOCUMENT_ROOT'] . '\phpmotors\common\footer.php'; ?>
