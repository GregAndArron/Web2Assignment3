<!DOCTYPE html>
<?php
//Start the session
session_start();

//Check if login is required and there is a logged in user
if (isset($require_login) && !isset($_SESSION['user_id'])) {

    header("location: firstPage.html"); //sends them back to the first page
}

//Connect to database
require_once('scripts/connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head><title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="css/fouc.css" type="text/css" media="all" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <!-- Optional theme -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
                <link href="style.css" type="text/css" rel="stylesheet" />
                <link href="signin.css" type="text/css" rel="stylesheet" />
                </head>

                <body>

                    <div id="pagewrap">

                        <header>
                            <div class="headerCont">
                                <div class="logo col-sm-2">
                                    <h2>Logo</h2>
                                </div>

                                <div class="banner col-sm-7">
                                    <h2>Banner</h2>
                                </div>
                                <?php
//Check for profile or login box'
                                if (!isset($_SESSION['user_id'])) {
                                    ?>
                                    <div class="form-signin col-sm-3">
                                        <form  action='login.php' method='POST' >
                                            <fieldset >
                                                <legend>Login</legend>
                                                <input type='hidden' name='submitted' id='submitted' value='1'/>
                                                <input type='name' name='username' class='form-control' placeholder='Username' required autofocus/> 
                                                <input type='password' name='password' class='form-control' placeholder='Password' required />
                                                <input type='submit' name='login' value='Login' />
                                                <a href = "signUp.html">Signup</a>
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
                                <div class="login col-sm-3">
                                    <img id="profilePic" src="<?php echo "images/profile/{$_SESSION['image']}"; ?>" alt="profile pic" style="width:100px;height:100px;">
                                        <button id="topSideBtns" type="button" class="topSideBtns btn btn-primary">My Profile </button>
                                        <button id="topSideBtns" type="button" class="topSideBtns btn btn-primary">My settings</button>
                                        <button id="logoutBtn" class="logoutBtn btn btn-sm btn-primary btn-block" type="submit" onclick="location.href = 'logout.php';">Logout</button>
                                </div>
                            </div>
                        </header>
                        <nav class="navbar navbar-default" role="navigation">
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
                                        <li class="active"><a href="#">Home</a></li>
                                        <li><a href="#">Data Entry</a></li>
                                        <li><a href="myDataAll.html">My Data</a></li>
                                        <li><a href="#">Friends</a></li>
                                        <li><a href="#">Profile</a></li>

                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </div><!-- /.container-fluid -->
                        </nav>