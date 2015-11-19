<?php
$page_title = "First page";
//$require_login
require_once("scripts/header.php");

//If user is logged in then send them to home.php!
if (isset($_SESSION['user_id'])) {
    header("location: home.php"); //Sends them back to the first page
}
?>
<div class="container">
    <div class="middleIndex col-sm-6">
        <div class="middleTop col-sm-6">
            Description of what this sight is for
        </div>
        <div class="middleMiddle col-sm-6">
            Budgeting advice
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
