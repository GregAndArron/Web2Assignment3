<?php
$page_title = "Data entry";
$require_login = true;
require_once("scripts/header.php");

require_once("scripts/navbar.php");
?>
<div class="container">
    <div class="middle col-sm-6">
        <div class="middlepageName text-center col-sm-6">
            <h2>Data Entry</h2>
        </div>
        <div class="middleTop col-sm-6">
            <form id="myForm" action="#" method="POST">
                <div id="item">
                    <label>Category</label>
                    <select name="category">
                        <?php
                        //Get categories
                        $query = "SELECT * from tbl_category ORDER BY description ASC";

                        $result = mysqli_query($dbc, $query) or die("Couldn't get list of categories: " . mysqli_error($dbc));

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['category_id']}'>{$row['description']}</option>";
                        }
                        ?>
                    </select>

                    <label>Price</label>
                    <input type="number" step="0.01" name="price"/>

                    <label>Comment/place</label>
                    <input type="text" width="20" name="comment"/>

                    <label >Date</label>
                    <input type="date" name="date"/>

                    <input type="submit" value="Add item" name="submit"/>
                </div>
            </form>
        </div>
        <h2>Todays items</h2>
        <div class="middleBottom col-sm-6">
            <div class="shorttable">
                <?php
                $query = "SELECT tbl_category.description, amount, date, comment"
                        . " FROM tbl_item"
                        . " JOIN tbl_category"
                        . " USING (category_id)"
                        . " WHERE user_id='{$_SESSION['user_id']}'"
                        . " AND DATE(date)=DATE(NOW())";

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
                    echo "No items added for today";
                }
                ?>
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