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

//Return user to landing page
header("location: firstPage.php"); //sends them back to the first page
?>