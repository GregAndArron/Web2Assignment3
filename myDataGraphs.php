<?php
$page_title = "My data";
$require_login = true;
require_once("scripts/header.php");

require_once("scripts/navbar.php");
?>
<div class="container">
    <div class="middle col-sm-6">
        <div class="middlepageName text-center col-sm-6">
            <h1>My Data</h1>
        </div>

        <ul class="nav nav-tabs col-sm-12">
            <li role="presentation"><a href="myDataAll.php">All Data</a></li>
            <li role="presentation" class="active"><a href="myDataGraphs.php">Graphs</a></li>
            <li role="presentation"><a href="myDataCalendar.php">Calendar</a></li>
            <li role="presentation"><a href="myDataGoals.php">Goals</a></li>
        </ul>
        <div class="middleMyData text-center col-sm-8">
            <div class="middleMyDataTop text-center col-sm-8">
                <div class="middleMyDataTopLeft text-center col-sm-6">
                    <h2>Graphs</h2>
                    <p>Category comparisons</p>
                </div>
                <div class="middleMyDataTopRight text-left col-sm-8">
					<div class="form">

						<label class="radio"><input value="1" type="radio">Comparisons</label>
						<label class="radio"><input value="2" type="radio">Last 7 days</label>
						<label class="radio"><input value="3" type="radio">Last month</label>
					</div>
                </div>
            </div>
            <div class="middleMyDataBottom text-center col-sm-8">
                <h2>Pie graph goes here</h2>
            </div>
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
