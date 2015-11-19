<?php
$page_title = "SignUp";
//$require_login
require_once("scripts/header.php");

//If user is logged in then send them to home.php!
if (isset($_SESSION['user_id'])) {
    header("location: home.php"); //Sends them back to the first page
}

//Function for password encryption
function encrypt($password) {
    //A higher "cost" is more secure but consumes more processing power
    $cost = 10;

    //Create a random salt
    $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_RANDOM)), '+', '.');

    //Prefix information about the hash so PHP knows how to verify it later.
    //"$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
    $salt = sprintf("$2a$%02d$", $cost) . $salt;

    //Hash the password with the salt and return
    return crypt($password, $salt);
}
?>

<div class="container">
    <div class="middleSignupLeft col-sm-3">
    </div>
    <div class="middleSignup col-sm-6">
        <div class="middleSignupCenter col-sm-6">
            <?php
            //Set up varibles for sticky form
            $secret_word = $username = $fullName = $email = $fullName = "";
            //Set up varibles for error messages
            $secret_wordError = $usernameError = $fullNameError = $emailError = $passwordError = $password_confirmError = "";

            //Check for previously sumbitted data
            if (isset($_POST['submit'])) {
                //Check secret word
                if (isset($_POST['secret_word'])) {
                    //Sanitize secret word from form and strip leading/trailing spaces
                    $secret_word = mysqli_escape_string($dbc, trim($_POST['secret_word']));

                    //Check the secret word is correct
                    if ($secret_word != "BITRulez") {
                        $secret_wordError = "Registration word is incorrect";
                    }
                }

                //TODO Check username is valid and not taken
                if (isset($_POST['username'])) {
                    //Sanitize username from form and strip leading/trailing spaces
                    $username = mysqli_escape_string($dbc, trim($_POST['username']));
                    //CHeck username isn't empty after trimming spaces
                    if (!empty($username)) {
                        //Check validity with regex(letters, numbers and _)
                        if (!preg_match("/([^\w]+)/i", $username)) {
                            //Check username is not already in the database
                            $selectQuery = "SELECT username FROM `tbl_user` WHERE username='$username'";
                            $result = mysqli_query($dbc, $selectQuery) or die("Couldn't check username is not in database already: " . mysqli_error($dbc));
                            if (mysqli_num_rows($result) != 0) {
                                $usernameError = "Username is already taken, please choose another";
                            }
                        } else {
                            $usernameError = "Please enter a username using only letters, numbers or the underscore";
                        }
                    } else {
                        $usernameError = "Please enter a username";
                    }
                } else {
                    $usernameError = "Please enter a username";
                }

                //Check fullName
                if (isset($_POST['fullName'])) {
                    $fullName = mysqli_escape_string($dbc, trim($_POST['fullName']));
                    //Check there is a name entered after trimming spaces
                    if (!empty($fullName)) {
                        //Check validity with regex(letters and spaces)
                        if (preg_match("/([^a-z\s]+)/i", $fullName)) {
                            $fullNameError = "Please enter a name using only letters and spaces";
                        }
                    } else {
                        $fullNameError = "Please enter your name";
                    }
                } else {
                    $fullNameError = "Please enter your name";
                }

                //Check email is valid and not already used?
                if (isset($_POST['email'])) {
                    //Sanitize username from form and strip leading/trailing spaces
                    $email = mysqli_escape_string($dbc, trim($_POST['email']));
                    //Check email is of a valid format, using PHPs inbuilt functions, applies RFC 822
                    //Regex, what regex? D.R.Y. ...

                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        //Check email has not already been used
                        $selectQuery = "SELECT email FROM `tbl_user` WHERE email='$email'";
                        $result = mysqli_query($dbc, $selectQuery) or die("Couldn't check database for email address: " . mysqli_error($dbc));
                        if (mysqli_num_rows($result) != 0) {
                            $emailError = "Email address has already been used, please try another";
                        }
                    } else {
                        $emailError = "Please enter an email address in the format \"name@provider.domain\"";
                    }
                } else {
                    $emailError = "Please enter an email address";
                }

                //Check password is valid and matches password_confirm, no check on second password validity
                if (isset($_POST['password'])) {
                    //Sanitize password and trim leading/trailing spaces
                    $password = mysqli_escape_string($dbc, trim($_POST['password']));
                    //No checks as we'll allow all characters in a password(SQL injection aside as escape_string deals with it)
                } else {
                    $passwordError = "Please enter a password";
                }

                //Check password 2 is valid and matches password_confirm, no check on second password validity
                if (isset($_POST['password_confirm'])) {
                    //Sanitize password and trim leading/trailing spaces
                    $password_confirm = mysqli_escape_string($dbc, trim($_POST['password_confirm']));
                    //No checks as we'll allow all characters in a password(SQL injection aside as escape_string deals with it)
                } else {
                    $password_confirmError = "Please enter the second password";
                }

                //Check the password actually match
                if ($password != $password_confirm) {
                    $password_confirmError = "Passwords do not match";
                }


                $password_confirm = mysqli_escape_string($dbc, trim($_POST['password_confirm']));
                //Check if there has been no errors, so create new user and place into databse
                if ($secret_wordError . $usernameError . $fullNameError . $emailError . $passwordError . $password_confirmError == "") {
                    $insertQuery = "INSERT INTO `tbl_user` (`username`, `fullName`, `email`, `password`) "
                            . "VALUES ('$username','$fullName','$email','" . encrypt($password) . "')";

                    debug($insertQuery);

                    $result = mysqli_query($dbc, $insertQuery) or die("Couldn't add new user to the system: " . mysqli_error($dbc));

                    //Send them to the log in page
                    //TODO: Auto log in and send them to the profile page?
                    header("location: firstPage.php");
                }
            }
            ?>
            <form class="form-horizontal" action='#' method="POST">
                <fieldset>
                    <div id = "legend">
                        <legend class = "">Register</legend>
                    </div>

                    <div class = "control-group">
                        <label class = "control-label" for = "username">Username</label>
                        <div class = "controls">
                            <input type = "text" id = "username" name = "username" placeholder = "" class = "input-xlarge input-mysize" required value="<?php echo $username; ?>">
                            <p class = "help-block">Username can contain any letters or numbers, without spaces</p>
                            <span class="error"><?php echo $usernameError; ?></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"  for="fullName">Full name</label>
                        <div class="controls">
                            <input type="text" id="fullName" name="fullName" placeholder="" class="input-xlarge input-mysize" required value="<?php echo $fullName; ?>">
                            <p class="help-block">Your full Name can contain any letters, with spaces</p>
                            <span class="error"><?php echo $fullNameError; ?></span>
                        </div>
                        <div class = "control-group">
                            <label class = "control-label" for = "email">E-mail</label>
                            <div class = "controls">
                                <input type = "text" id = "email" name = "email" placeholder = "" class = "input-xlarge input-mysize" required value="<?php echo $email; ?>">
                                <p class = "help-block">Please provide your E-mail</p>
                                <span class="error"><?php echo $emailError; ?></span>
                            </div>
                        </div>

                        <div class = "control-group">
                            <label class = "control-label" for = "password">Password</label>
                            <div class = "controls">
                                <input type = "password" id = "password" name = "password" placeholder = "" class = "input-xlarge input-mysize" required>
                                <p class = "help-block">Password should be at least 8 characters</p>
                                <span class="error"><?php echo $passwordError; ?></span>
                            </div>
                        </div>
                        <div class = "control-group">
                            <label class = "control-label" for = "password_confirm">Password (Confirm)</label>
                            <div class = "controls">
                                <input type = "password" id = "password_confirm" name = "password_confirm" placeholder = "" class = "input-xlarge input-mysize" required>
                                <p class = "help-block">Please confirm password</p>
                                <span class="error"><?php echo $password_confirmError; ?></span>
                            </div>
                        </div>
                        <div class = "control-group">
                            <label class = "control-label" for = "secret_word">Registration word</label>
                            <div class = "controls">
                                <input type = "secret_word" id = "secret_word" name = "secret_word" placeholder = "" class = "input-xlarge input-mysize" required value="<?php echo $secret_word; ?>">
                                <p class = "help-block">Please enter the registration word you were given</p>
                                <span class="error"><?php echo $secret_wordError; ?></span>
                            </div>
                        </div>
                        <div class = "control-group">
                            <div class = "controls">
                                <input type="submit" value="Register" name="submit" class = "btn btn-success"/>
                            </div>
                        </div>
                </fieldset>
            </form>
        </div>
    </div>
    <div class = "middleSignupright col-sm-3">
    </div>
</div>
</div>
<!--Latest compiled and minified JavaScript -->
<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
