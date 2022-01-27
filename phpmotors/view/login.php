<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login page for phpMotors." />
    <link rel="shortcut icon" href="phpmotors/images/site/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/small.css" media="screen">
    <link rel="stylesheet" href="../css/medium.css" media="screen">
    <link rel="stylesheet" href="../css/large.css" media="screen">
    <title> PHP Motors | Login </title>
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '\phpmotors\common\header.php'; ?>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1> Sign in </h1>
        <div class="loginForm">
        <form action="..\accounts\accounts.php" name="login">
            <fieldset>
                <!-- email input of type email and use a placeholder to provide a demo email -->
                <label for="email">Email*
                </label><br><input type="text" id="email" name="email" placeholder="myaddress@gmail.com">
                <br>
                <!-- password input of type password -->
                <label class="password">Password*</label><br><input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                <p>* Field Required</p>
                <input type="submit" value="Sign-in" onclick="alert('You clicked the Sign-in button!')">
        </form>
        <p class="account">No account? <a href="/phpmotors/accounts/accounts.php?action=registration">Sign up</a></p>
        </fieldset>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '\phpmotors\common\footer.php'; ?>
        