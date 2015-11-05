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
            <li role="presentation" class="active"><a href="myDataAll.php">All Data</a></li>
            <li role="presentation"><a href="myDataGraphs.php">Graphs</a></li>
            <li role="presentation"><a href="myDataCalendar.php">Calendar</a></li>
            <li role="presentation"><a href="myDataGoals.php">Goals</a></li>
        </ul>
        <div class="middleMyData text-center col-sm-8">

            <div class="middleMyDataHeading text-center col-sm-8">
                <h2>All expenditure to date:</h2>
            </div>
            <div class="middleMyDataAllData text-center col-sm-8">
                <div class="shorttable">
                    <?php
                    $query = "SELECT tbl_category.description, amount, date, comment"
                            . " FROM tbl_item"
                            . " JOIN tbl_category"
                            . " USING (category_id)"
                            . " WHERE user_id='{$_SESSION['user_id']}'"
                            . " ORDER BY date DESC";

                    $result = mysqli_query($dbc, $query) or die("Couldn't get user data; " . mysqli_error($dbc));

                    //Show results in a pretty table
                    if (mysqli_num_rows($result) > 0) {
                        //Table header
                        echo "<table class='table table-striped'><tr><th>Category</th><th>Amount</th><th>Date</th><th>Comment</th></tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            //TODO format date
                            echo "<tr><td>{$row['description']}</td>";
                            echo "<td>\${$row['amount']}</td>";
                            echo "<td>{$row['date']}</td>";
                            echo "<td>{$row['comment']}</td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No data for user";
                    }
                    ?>
                </div>
            </div>
            <div class="middleMyDataHeading text-center col-sm-8">
                <h2>Summary all data to date:</h2>
            </div>
            <div class="middleMyDataSumData text-center col-sm-8">
                <div class="shorttable">
                    <?php
                    $query = "SELECT tbl_category.description, SUM(tbl_item.amount) as total"
                            . " FROM tbl_item"
                            . " JOIN (tbl_category) USING (category_id)"
                            . " WHERE tbl_item.user_id='{$_SESSION['user_id']}'"
                            . " GROUP BY tbl_category.description"
                            . " ORDER BY tbl_category.description ASC";

                    $result = mysqli_query($dbc, $query) or die("Couldn't get user data; " . mysqli_error($dbc));

                    //Show results in a pretty table
                    if (mysqli_num_rows($result) > 0) {
                        //Table header
                        echo "<table class='table table-striped'><tr><th>Category</th><th>Total</th></tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            //TODO format date
                            echo "<tr><td>{$row['description']}</td>";
                            echo "<td>\${$row['total']}</td>";
                        }
                        echo "</table>";
                    } else {
                        echo "No data for user";
                    }
                    ?>
                </div>
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
