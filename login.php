<?php

session_start();
include "scripts/connectvars.php"; //including connection file

if(isset($_SESSION['login']))
{
	if(isset($_GET['logout']) && $_GET['logout'] == "true")
	{
		$_SESSION['login'] = $username;
		header("location: logOut.php"); // redirects the user to a new page
	}
	else
	{
		$_SESSION['login'] = $username;
		header("location: home.php"); // redirects the user to a new page
	}
}
else
{
	if(isset($_POST['login']))
	{
	$username = strip_tags/*HTML and PHP tags stripped*/(trim(mysqli_real_escape_string($connection, $_POST['username'])));
	$password = strip_tags(trim(mysqli_real_escape_string($connection, $_POST['password'])));

		if(!$username || !$password)
		{
			echo "Username and or password is incorrect. <a href='index.html'>Back</a>";
		}
		else
		{
			$find = "SELECT userName, userPassword FROM tblUsernames WHERE userName = '$username' and userPassword = '$password'";
			$query = mysqli_fetch_assoc(mysqli_query($connection, $find)) or die('Error: ' . mysqli_error($connection));
			
			$query_username = $query['userName'];
			$query_password = $query['userPassword'];
			if($username == "$query_username" && $password == "$query_password")
			{
				$_SESSION['login'] = $username;
				header("location: home.php"); // redirects the user to a new page
			}
			else
			{
				echo"Invalid";
			}
		}
	}
}

mysqli_close($connection);
?>