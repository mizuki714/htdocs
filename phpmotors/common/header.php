</head>
<body>
    <header>
        <div id="header">
        <!--- logo site name motto-->
        <img class="logo" src="/phpmotors/images/site/logo.png" alt="PHP Motors logo">
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

    