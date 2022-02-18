<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title> PHP Motors | Login </title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1> Sign in </h1>
        <div class="loginForm">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form action="/phpmotors/accounts/" name="login">
                <fieldset>
                    <!-- email input of type email and use a placeholder to provide a demo email -->
                    <label for="email">Email*
                    </label><br><input type="text" id="email" name="email" placeholder="myaddress@gmail.com" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
                    <br>
                    <!-- password input of type password -->
                    <label class="password">Password*</label><br> <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br><input type="password" id="password" name="password"pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder="Password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <p>* Field Required</p>
                    <input type="submit" value="Sign-in">
                    <input type="hidden" name="action" value="Login">
            </form>
            <p class="account">No account? <a href="/phpmotors/accounts/?action=registration">Sign up</a></p>
            </fieldset>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>