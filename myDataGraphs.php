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
                        <label class="radio"><input value="1" name="myGraphs" type="radio">Comparisons</label>
                        <label class="radio"><input value="2" name="myGraphs" type="radio" onclick="changeType('all');">All data</label>
                        <label class="radio"><input value="3" name="myGraphs" type="radio" onclick="changeType('week');">Last 7 days</label>
                        <label class="radio"><input value="4" name="myGraphs" type="radio" onclick="changeType('month');">Last month</label>
                    </div>
                </div>
            </div>
            <div class="middleMyDataBottom text-center col-sm-8">
                <h2>Life time spending</h2>
                <div><img id="pieGraph" src="images/graphPie.php"/><img id="barGraph" src="images/graphBar.php"/></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function changeType(type) {
        var request;
        switch (type) {
            case "all":
                request = "";
                break;
            case "week":
                request = "?type=week";
                break;
            case "month":
                request = "?type=month";
                break;
            default:
                request = "";
                break;
        }

        document.getElementById("pieGraph").src = "images/graphPie.php" + request;
        document.getElementById("barGraph").src = "images/graphBar.php" + request;
    }
</script>

<footer>
</footer>

</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
