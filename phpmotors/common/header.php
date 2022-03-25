</head>

<body>
    <header>
        <div id="header">
            <!--- logo site name motto-->
            <img class="logo" src="/phpmotors/images/site/logo.png" alt="PHP Motors logo">
            <!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <!-- cookies make a welcome message -->
            <!-- <?php // if(isset($cookieFirstname)){
                    //echo "<span>Welcome $cookieFirstname</span>";
                    //} 
                    ?>   -->
            <!-- add a link to the welcome message that will allow the logged in client to click it to be directed to the client admin view through the controller -->
            <?php if (isset($_SESSION['loggedin'])) {
                if ($_SESSION['loggedin'] === TRUE) {
                    echo '<a id="logout" class="acc" href="/phpmotors/accounts/index.php/?action=Logout">Logout </a>';
                }
            } else {
                echo '<a class="myaccount" href="/phpmotors/accounts/index.php/?action=login">My Account</a>';
            } ?>

            <?php
            if (isset($_SESSION['loggedin'])) {
                $user = $_SESSION['clientData']['clientFirstname'];
                echo "<a id='welcomeUser' class='acc' href='/phpmotors/accounts/'>Welcome $user</a>";
            }
            ?>
            <!-- Searchbar -->
            <div class=search>
                <form action='/phpmotors/searchbar/index.php/?action=search' name = "searchf" class="searchf"method="get">
            <input type="text" placeholder="Search.." name="searchbar" aria-label="Search">
            <button type="submit" value ="Search" class="searchbttn"> <i class="fa fa-search"> </i> </button>
        </form>
            </div>
        </div>
    </header>