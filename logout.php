<?php

//Start the session
session_start();

//Remove all session varibles
foreach ($_SESSION as $key=>$value){
    unset($_SESSION[$key]);
}

//Destroy the session
session_destroy();

//TODO: Check there is anything else that needs deleted/unset

//TODO: Return user to landing page

?>
<meta http-equiv="refresh" content="3;url=firstPage.php" />
<h1>You have been logged out</h1>