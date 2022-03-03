<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

<h1>Update Account Information</h1>

<div class="updateAccount">


    <div class="updateUser">
        <h3>Update Account Info</h3>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        <form action="/phpmotors/accounts/" method="post">

            <label for="clientFirstname">First Name</label><br>
            <input type="text" name="clientFirstname" id="clientFirstname" <?php
                                                                            if (isset($clientFirstname)) {
                                                                                echo " value='$clientFirstname'";
                                                                            } elseif (isset($clientInfo['clientFirstname'])) {
                                                                                echo " value='$clientInfo[clientFirstname]'";
                                                                            } ?> required><br>
            <br>
            <label for="clientLastname">Last Name</label><br>
            <input type="text" name="clientLastname" id="clientLastname" <?php
                                                                            if (isset($clientLastname)) {
                                                                                echo " value='$clientLastname'";
                                                                            } elseif (isset($clientInfo['clientLastname'])) {
                                                                                echo " value='$clientInfo[clientLastname]'";
                                                                            } ?> required><br>
            <br>
            <label for="clientEmail">Email</label><br>
            <input type="email" name="clientEmail" id="clientEmail" placeholder="Enter a valid email address" <?php
                                                                                                                if (isset($clientEmail)) {
                                                                                                                    echo " value='$clientEmail'";
                                                                                                                } elseif (isset($clientInfo['clientEmail'])) {
                                                                                                                    echo " value='$clientInfo[clientEmail]'";
                                                                                                                } ?> required><br>
            <br>
            <input type="submit" value="Update Info">
            <input type="hidden" name="action" value="updateInfo">
            <input type="hidden" name="clientId" value="<?php if (isset($_SESSION['clientData']['clientId'])) {
                                                            echo $_SESSION['clientData']['clientId'];
                                                        } elseif (isset($clientId)) {
                                                            echo $clientId;
                                                        } ?>">

        </form>
    </div>

    <div class="updatePass">

        <h3>Update Password</h3>
        <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p>
        <p>*note your original password will be changed.</p>
        <form action="/phpmotors/accounts/" method="post">

            <label for="clientPassword">Password</label><br>
            <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>
            <br>
            <input type="submit" value="Update Password">
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="clientId" value="<?php if (isset($_SESSION['clientData']['clientId'])) {
                                                            echo $_SESSION['clientData']['clientId'];
                                                        } elseif (isset($clientId)) {
                                                            echo $clientId;
                                                        } ?>">

        </form>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php' ?>