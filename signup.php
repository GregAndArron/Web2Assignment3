<?php
$page_title="SignUp";
//$require_login
require_once("scripts/header.php");

//Ff user is logged in then send them to home.php!
if (isset($_SESSION['user_id'])) {
    header("location: home.php"); //Sends them back to the first page
}

?>
	<div class="container">
		<div class="middleSignupLeft col-sm-3">
		</div>
		<div class="middleSignup col-sm-6">
			<div class="middleSignupCenter col-sm-6">
			<form class="form-horizontal" action='' method="POST">
				<fieldset>
					<div id="legend">
						<legend class="">Register</legend>
					</div>
					<div class="control-group">
						<label class="control-label"  for="username">Username</label>
						<div class="controls">
							<input type="text" id="username" name="username" placeholder="" class="input-xlarge input-mysize">
							<p class="help-block">Username can contain any letters or numbers, without spaces</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"  for="fullName">Full name</label>
						<div class="controls">
							<input type="text" id="fullName" name="fullName" placeholder="" class="input-xlarge input-mysize">
							<p class="help-block">Your full Name can contain any letters, with spaces</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email">E-mail</label>
						<div class="controls">
							<input type="text" id="email" name="email" placeholder="" class="input-xlarge input-mysize">
							<p class="help-block">Please provide your E-mail</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="password">Password</label>
						<div class="controls">
							<input type="password" id="password" name="password" placeholder="" class="input-xlarge input-mysize">
							<p class="help-block">Password should be at least 4 characters</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"  for="password_confirm">Password (Confirm)</label>
						<div class="controls">
							<input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge input-mysize">
							<p class="help-block">Please confirm password</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"  for="secret_word">Registration word</label>
						<div class="controls">
							<input type="secret_word" id="secret_word" name="secret_word" placeholder="" class="input-xlarge input-mysize">
							<p class="help-block">Please enter the registration word you were given</p>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button class="btn btn-success">Register</button>
						</div>
					</div>
				</fieldset>
			</form>
			</div> 
		</div> 
		<div class="middleSignupright col-sm-3">
		</div>
	</div>
</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
