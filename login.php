<?php

//Start the session
session_start();
//Set up vars for database connection
include "scripts/connectvars.php";


//Check required form data is present and has content
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    //Connect to database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Cant connect to database: ' . mysqli_error($dbc));

    //Grab the user-entered log-in data and sanitize
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

    //Create query
    //TODO Check wchat we actually need for database aside from user_id
    //TODO: Salting on password!
    $query = "SELECT user_id, username, image FROM tbl_user WHERE username='$username' AND password='$password'";

    $result = mysqli_query($dbc, $query) or die('Cant query for user details: ' . mysqli_error($dbc));

    //Close connection as we are done with it
    mysqli_close($dbc);

    //Check results for query
    if (mysqli_num_rows($result) == 1) {
        //We have a matching user in the database so grab that data and set session vars
        $data = mysqli_fetch_assoc($result);
        //Stuff retrieved data into $_SESSION
        //This depends on the data returned from the query...
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
        //Redirect to landing page
        echo "You have successfully logged in<br/><a href='home.php'>Click here to return home</a>";
    } else {
        echo "No user found or password wrong</br><a href='home.php'>Click here to return home</a>";
    }
} else {
    //Username and/or password not supplied, this should happen due to checking on form!
    //This will trip if page is directly visited!!
    echo "Username and/or password required<br/><a href='home.php'>Click here to return home</a>";
}
?>
