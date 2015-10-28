<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['login']))
	{
		header("location: firstPage.html");//sends them back to the first page
	}
	
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><title>Home</title>
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

			<div class="login col-sm-3">
				<img id="profilePic" src="#" alt="profile pic" style="width:100px;height:100px;">
				<button id="topSideBtns" type="button" class="topSideBtns btn btn-primary">My Profile </button>
				<button id="topSideBtns" type="button" class="topSideBtns btn btn-primary">My settings</button>
				<button id="logoutBtn" class="logoutBtn btn btn-sm btn-primary btn-block" type="submit" href = "logOut.php">Logout</button>
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
	<div class="container">
		<div class="middle col-sm-6">
			<div class="middlepageName text-center col-sm-6">
			<h2>Home</h2>
			</div>
			<div class="middleTop col-sm-6">
			Tips on how to save money
			</div>
			<div class="middleMiddleHome col-sm-6">
				<div class="middleMiddleLeft col-sm-6">
				links to budget websites
				</div>
				<div class="middleMiddleRight col-sm-6">
				links to handy websites
				</div>
			</div>
			<div class="middleBottom col-sm-6">
			User feedback
			</div>
		</div>
	</div>

  <footer>
  </footer>

</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
