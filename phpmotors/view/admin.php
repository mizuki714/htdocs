<!-- Landing Page  when a client logs in-->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title> PHP Motors | Logged In  </title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
<!-- make sure the visitor is "logged in" write an if() test to see if the visitor is NOT logged in. If the visitor is NOT logged in, use a header function to send them to the main PHP Motors controller in order for the PHP Motors home view to be delivered.-->
<?php
if ($_SESSION['loggedin'] == false) {
    header("Location: /phpmotors/");
}
?>
<!--create an <h1> element and display the "logged in" user's full name-->
<h1 class="adminTitle">

    <?php echo $_SESSION['clientData']['clientFirstname']; ?>
    <?php echo " "; ?>
    <?php echo $_SESSION['clientData']['clientLastname']; ?>
</h1>

<?php
if (isset($message)) {
    echo $message;
}

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>
    <!-- create an unordered list. In each list item display the user's data that has been stored into the session, preceeded by a meaningful label (e.g. First name: Bill, Email Address: wildbill@ok.com, etc...).-->
<div class="adminData">
    <p>You are logged in.</p>
    <ul>
        <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
        <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
        <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
    </ul>
    <!-- add a link to the welcome message that will allow the logged in client to click it to be directed to the client admin view through the controller -->
    <div class="adminManage">
        <div class="adminAccount admin">
            <h2>Account Management</h2>
            <p>Use this link to update account information.</p>
            <p><a href="/phpmotors/accounts/index.php/?action=client-update">Update Account Information</a></p>
        </div>
<!--view to show a link to the vehicle controller but only if the logged in visitor has a clientLevel greater than "1"-->
        <div class="adminInventory admin">
            <?php if ($_SESSION['clientData']['clientLevel'] > 1) {
                echo '<h2>Inventory Management</h2>
                  <p>Use this link to manage the inventory.</p>
                  <p><a href="/phpmotors/vehicles/index.php">Vehicle Management</a></p>';
            }
            ?>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php' ?>