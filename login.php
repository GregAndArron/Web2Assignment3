<?php
//Start the session
session_start();

//Set up vars for database connection
include "scripts/connectvars.php";

//Varible to indicate sucessful login
$success = false;

//Check required form data is present and has content
if (!empty($_POST['username']) && !empty($_POST['password'])) {
//Connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Cant connect to database: ' . mysqli_error($dbc));

    //Grab the user-entered log-in data and sanitize
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

    //Create query
    //TODO Check wchat we actually need for database aside from user_id
    //TODO is it secure to actually return passwords?
    $query = "SELECT user_id, username, password, image FROM tbl_user WHERE username='$username'";

    $result = mysqli_query($dbc, $query) or die('Cant query for user details: ' . mysqli_error($dbc));

    //Close connection as we are done with it
    mysqli_close($dbc);

    //Check results of query
    //Checks there is one record of the username
    if (mysqli_num_rows($result) == 1) {
        //Grab data from query
        $row = mysqli_fetch_assoc($result);

        //Hashing the password with its hash as the salt returns the same hash(symetrical?)
        //Checks password is correct
        if (crypt($password, $row['password']) === $row['password']) {
            //We have a matching user/password combo in the database so grab the data and set session vars
            //This depends on the data requested in the select query!
            foreach ($row as $key => $value) {
                //Ignore the password field!
                if ($key != "password") {
                    $_SESSION[$key] = $value;
                }
            }
            $success = true;
        }
    }
}

if ($success == true) {
    echo "You have successfully logged in<br/><a href='home.php'>Click here to return home</a>";
} else {
    echo "Username and/or password incorrect<br/><a href='home.php'>Click here to return home</a>";
}
//TODO: Insert footer?
?>

</body>
</html>
