<!DOCTYPE html>
<?php
//Start the session
session_start();

//used for debugging
function debug($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

//Check if login is required and there is a logged in user
if (isset($require_login) && !isset($_SESSION['user_id'])) {
    //TODO: Message saying you need to log in?
    header("location: firstPage.php"); //sends them back to the first page
}

//Connect to database
require_once('scripts/connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head><title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="css/fouc.css" type="text/css" media="all" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"/>
        <link href="style.css" type="text/css" rel="stylesheet" />
        <link href="signin.css" type="text/css" rel="stylesheet" />
		<link href="tabs.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="scripts/dataEntry.js"></script>
    </head>

    <body>

        <div id="pagewrap">

            <header>
                <div class="headerCont">
                    <div class="logo col-md-3 col-lg-3">
                        
                    </div>

                    <div class="banner col-md-6 col-lg-6">
                        <img class="img-responsive" src="images/bannerFinal.png" alt="Smiley face" height="215" width="900">
                    </div>
                    <?php
                    //Check for profile or login box to be displayed
                    if (!isset($_SESSION['user_id'])) {
                        ?>
                        <div class="form-signin col-md-3 col-lg-2">
                            <form  action='login.php' method='POST' >
                                <fieldset >
                                    <legend>Login</legend>
                                    <input type='hidden' name='submitted' id='submitted' value='1'/>
                                    <input type='name' name='username' class='form-control' placeholder='Username' required autofocus/> 
                                    <input type='password' name='password' class='form-control' placeholder='Password' required />
                                    <input type='submit' name='login' value='Login' />
                                    <a href = "signUp.php">Signup</a>
                                </fieldset>
                            </form>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="login col-sm-3">
                            <img id="profilePic" src="<?php echo "images/profile/{$_SESSION['image']}"; ?>" alt="profile pic" style="width:100px;height:100px;">
                                <button id="topSideBtns" type="button" class="topSideBtns btn btn-primary">My Profile </button>
                                <button id="topSideBtns" type="button" class="topSideBtns btn btn-primary">My settings</button>
                                <button id="logoutBtn" class="logoutBtn btn btn-sm btn-primary btn-block" type="submit" onclick="location.href = 'logout.php';">Logout</button>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </header>