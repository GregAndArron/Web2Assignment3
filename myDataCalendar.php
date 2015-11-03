<?php
$page_title = "My data";
$require_login = true;
require_once("scripts/header.php");

require_once("scripts/navbar.php");
?>
<div class="container">
    <div class="middle col-sm-6">
        <div class="middlepageName text-center col-sm-6">
            <h2>My Data</h2>
        </div>

        <ul class="nav nav-tabs col-sm-12">
            <li role="presentation"><a href="myDataAll.php">All Data</a></li>
            <li role="presentation"><a href="myDataGraphs.php">Graphs</a></li>
            <li role="presentation" class="active"><a href="myDataCalendar.php">Calendar</a></li>
            <li role="presentation"><a href="myDataGoals.php">Goals</a></li>
        </ul>
        <div class="middleMyData text-center col-sm-8">
            <div class="middleMyDataHeading text-center col-sm-8">
                <h2>Calender</h2>
            </div>
            <div class="middleMyDataCal text-center col-sm-8">
                <h2>Calender goes here</h2>
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
