<?php
$pages['Home'] = "home.php";
$pages['Data Entry'] = "dataEntry.php";
$pages['My Data'] = "myDataAll.php";
$pages['Friends'] = "friends.php";
$pages['Profile'] = "profile.php";
?>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                //Create list of pages while highlighting the active page
                foreach ($pages as $key => $value) {
                    $active = "";
                    //Check if it is the active page
                    //Check for data sub pages, this is very hacky
                    if (basename($_SERVER['PHP_SELF']) === $value || (substr(basename($_SERVER['PHP_SELF']), 0, 6) === "myData" && substr($value,0,6)==="myData")) {
                        $active = " class='active'";
                    }
                    echo "<li$active><a href='$value'>$key</a><li>\n";
                }
                ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>