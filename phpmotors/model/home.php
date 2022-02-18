<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title> PHP Motors | Home </title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>

<nav>
    <?php echo $navList; ?>
</nav>
<main>
    <h1> Welcome to PHP Motors!</h1>
    <div class="herocontainer">
        <section class="hero">
            <section class="hero-text" onclick="window.location.href='home.php'">
                <h2>DMC Delorean</h2>
                <h3>3 cup holders<br>Superman Doors<br>Fuzzy Dice!</h3>
                <img class="OwnTodayButton" src="/phpmotors/images/site/own_today.png" alt="Own Today Button">
            </section>
            <picture class="hero-picture">
                <source srcset="/phpmotors/images/delorean.jpg" media="(min-width:50rem)">
                <img class="hero-img" src="/phpmotors/images/delorean.jpg" alt="Image of a Delorean">
            </picture>
        </section>
    </div>
    <div class="contentcontainer">
        <section class="upgrades">
            <h4>Delorean Upgrades</h4>
            <div class="upgrade1">
                <img class="FluxCapacitorimg" src="/phpmotors/images/upgrades/flux-cap.png" alt="Image of a Flux Capacitor for a Delorean">
                <h5 class="FluxCapacitor">Flux Capacitor</h5>
            </div>
            <div class="upgrade2">
                <img class="FlameDetailsimg" src="/phpmotors/images/upgrades/flame.jpg" alt="Image of a Flame">
                <h5 class="FlameDetails">Flame Details</h5>
            </div>
            <div class="upgrade3">
                <img class="bumperstickerimg" src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Image of a bumper sticker">
                <h5 class="BumperStickers">Bumper Stickers</h5>
            </div>
            <div class="upgrade4">
                <img class="hubcapimg" src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Image of a Hub Cap">
                <h5 class="HubCaps">Hub Caps</h5>
            </div>
        </section>

        <section class="reviews">
            <h4>DMC Delorean Reviews</h4>
            <ul>
                <li>
                    <p>"So fast it's almost like traveling in time." (4/5)</p>
                </li>
                <li>
                    <p>"Coolest ride on the road."(4/5)</p>
                </li>
                <li>
                    <p>"I'm feeling Marty McFly!"(5/5)</p>
                </li>
                <li>
                    <p>"The most futuristic ride of our day."(4.5/5)</p>
                </li>
                <li>
                    <p>"80's livin' and I love it!"(5/5)</p>
                </li>
            </ul>
        </section>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>