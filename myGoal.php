<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/styleSheet.css" />
	<title>Fitness Site - Add a Goal</title>
	
	<!--////////////////////////////Sticky Nav Script//////////////////////////////////// -->
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">

	$(document).ready(function ()
	{	
    $(window).scroll(function ()
	{
		var scroll = $(window).scrollTop();
  
		if (scroll >= 200)
		{
			$('#nav').addClass('navbar-fixed');
		}
		if (scroll <= 201)
		{
			$('#nav').removeClass('navbar-fixed');
		}
  });
});
</script>

</head>

<body>
	
	
	<div id="banner">
	<div id="banImg"><img src="ImageBank/BanImg4.png" height="193px"></div>
	<div id="logo"><img src="ImageBank/Logo.png"></div>	
	<?php
			include'connect.inc.php';
			
			session_start();
			
			if(isset($_SESSION['userName']) && !empty($_SESSION['userName']))
			{
				$userName = $_SESSION['userName'];
				$id = $_SESSION['id'];
				
				$selectString = "SELECT image FROM user WHERE id = $id";
				$result = mysql_query($selectString);
				
				echo("<div id='user'>
					<div id='userContent'>
					<div id='words'>
						Welcome:<br>$userName<br><br>
						<a href='EditUser.php'>Edit User</a>
					</div>");
			while ($row = mysql_fetch_row($result))
			{
					foreach($row as $field => $value)
					{
					echo("<img id='userImg' src='upload/$value' alt='ProfilePicture' width='100px' height='100px'/>
					</div></div>");
					}
			}
			}
			else
			{
				header("location:login.php");
			}
			 mysql_free_result($result);
	?>
	
	</div>
	<!--//////////////////////////////   Navigation Bar   /////////////////////////////////////////////////////////////-->
	<nav id='nav'>
	<div id="navContainer">
    <ul class='nav_links'>
      <a href="home.php"><li class="Navbtn">Home</li></a>
      <a href="Entry.php"><li class="Navbtn">Entry</li></a>
      <a href="myData.php"><li class="Navbtn">My Data</li></a>
      <a href="friends.php"><li class="Navbtn">Friends</li></a>
	  <a href="leaderBoard.php"><li class="Navbtn">Leader Board</li></a>
	  <a href="logout.php"><li class="Navbtn">Log Out</li></a>
    </ul>
	</div>
	</nav>
	<div id="sideCol">
		<div id="content">
				<img src="ImageBank/myData.png" width="100%">
			<a href="TabView.php"><h2>Tabular View</h2></a>
			<a href="CalendarView.php"><h2>Calendar View</h2></a>
			<a href="PropView.php"><h2>Proportional View</h2></a>
			<a href="myGoal.php"><h2>Add a Goal</h2></a>
		</div>
	</div>
	<div id="dataPage">
		<div id="container"> 
			<div id="content">
			<?php
			
			include 'connect.inc.php';
			
			if (isset($_POST['submit']))
			{
				checkInput(); // Check's user input
			}
			else
			{
				showForm(); // Display form
			}
			
			function checkInput()
			{
				addActivity(); // Add activity
				confirmAdded(); // Pompt user
			}
			
			function addActivity()
			{
				$goal = $_POST['name'];
				$id = $_SESSION['id'];
		
				$insertQuery = "UPDATE user SET goal = '$goal' WHERE id = '$id'";
				mysql_query($insertQuery);
			
			}
			
			function showForm()
			{
				$self = htmlentities($_SERVER['PHP_SELF']);

				echo("<form action = '$self' method='POST'>
		
				Enter Goal: <input type='text' name='name' value=''>
				
				<input type='submit' name = 'submit' value='Add Goal'>
				</form>");
			}
			
			function confirmAdded()
			{
			
				$goal = $_POST['name'];
				
				echo("<h1>Your current goal: $goal</h1>");
			}

			
			?>
			</div>
		</div>
	</div>
</body>

</html>