</head>
<body>
    <header>
        <div id="header">
        <!--- logo site name motto-->
        <img class="logo" src="/phpmotors/images/site/logo.png" alt="PHP Motors logo">
        <!-- cookies make a welcome message -->
        <?php if(isset($cookieFirstname)){
 echo "<span>Welcome $cookieFirstname</span>";
} ?>   
 <!-- add a link to the welcome message that will allow the logged in client to click it to be directed to the client admin view through the controller -->
             <?php if(isset($_SESSION['loggedin'])) {
                    if ($_SESSION['loggedin'] === TRUE) {
                        echo '<a id="logout" class="acc" href="/phpmotors/accounts/index.php/?action=Logout">Logout</a>';}
            } else {
                echo '<a class="myaccount" href="/phpmotors/accounts/index.php/?action=login">My Account</a>';
                    } ?>
            
            <?php 
            if(isset($_SESSION['loggedin'])) {
                $user = $_SESSION['clientData']['clientFirstname'];
                echo "<a id='welcomeUser' class='acc' href='/phpmotors/accounts/'>Welcome $user</a>";
            }
            ?>
            </div>
    </header>

    