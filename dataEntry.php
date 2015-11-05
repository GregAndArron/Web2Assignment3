<?php
$page_title = "Data entry";
$require_login = true;
require_once("scripts/header.php");

require_once("scripts/navbar.php");
?>
<div class="container">
    <div class="middle col-sm-6">
        <div class="middlepageName text-center col-sm-6">
            <h1>Data Entry</h1>
        </div>
        <div class="middleTop col-sm-6">
            <?php
            //Before starting the form, get previous if posted
            //Used for sticky data
            $category = $price = $comment = $date = "";
            //Used for errors, comment not included here
            $categoryError = $priceError = $dateError = "";
            //TODO: data validation
            if (isset($_POST['submit'])) {
                //Get submitted data and sanitize
                //Category
                if (isset($_POST['category'])) {
                    $category = mysqli_escape_string($dbc, trim($_POST['category']));
                    //Check category_id is within the category table
                    $checkQuery = "SELECT * FROM tbl_category WHERE category_id='$category'";
                    $result = mysqli_query($dbc, $checkQuery) or die("Couldn't get list of categories: ") . mysqli_error($dbc);
                    if (mysqli_num_rows($result) != 1) {
                        $categoryError = "Please select a valid category.";
                    }
                } else {
                    $categoryError = "Category is required.";
                }

                //Price
                if (isset($_POST['price'])) {
                    $price = mysqli_escape_string($dbc, trim($_POST['price']));

                    //Check price is a valid number
                    if ((float) ($price / 0.01) != (int) ($price / 0.01) || $price == "") {
                        $price = "";
                        $priceError = "Please reenter price.";
                    }
                } else {
                    $priceError = "Price is required.";
                }

                //Comment
                if (isset($_POST['comment'])) {
                    $comment = mysqli_escape_string($dbc, trim($_POST['comment']));
                }

                //Date
                if (isset($_POST['date'])) {
                    //TODO Check valid date
                    //According to Dale, this is not required to be checked if we are using a date picker on our form, even in the real world...
                    //TODO: Use todays date if not provided or default to that date on form?
                    $date = mysqli_escape_string($dbc, trim($_POST['date']));
                    if ($date=="") {
                        $dateError = "Date is required.";
                    }
                } else {
                    $dateError = "Date is required.";
                }
                //Check all required data is provided and valid(ie no errors have been made)
                if ($categoryError . $priceError . $dateError == "") {
                    $insertQuery = "INSERT INTO tbl_item (user_id,category_id,amount,comment,date)"
                            . " VALUES ('{$_SESSION['user_id']}','$category','$price','$comment','$date')";

                    mysqli_query($dbc, $insertQuery) or die("Couldn't add item to database " . mysqli_error($dbc));
                    //Clear out previous sticky data as it is now been added to database
                    $category = $price = $comment = $date = "";
                }
            }//End (isset($_POST['submit']))
            //Enter a default date
            if ($date==""){
                $date=date('Y-m-d');
            }
            ?>
            <form id="myForm" action="#" method="POST">
                <div id="item">
                    <label>Category</label>
                    <select name="category">
                        <option>Select...</option>
                        <?php
                        //Get categories
                        $query = "SELECT * from tbl_category ORDER BY description ASC";

                        $result = mysqli_query($dbc, $query) or die("Couldn't get list of categories: " . mysqli_error($dbc));

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['category_id']}'";
                            //Sticky data
                            if ($row['category_id'] == $category) {
                                echo " selected ";
                            }
                            echo ">{$row['description']}</option>";
                        }
                        ?>
                    </select>

                    <label>Price</label>
                    <input type="number" step="0.01" name="price" value="<?php echo $price; ?>"/>

                    <label>Comment/place</label>
                    <input type="text" width="20" name="comment" value="<?php echo $comment; ?>"/>

                    <label >Date</label>
                    <input type="date" name="date" value="<?php echo $date; ?>"/>

                    <input type="submit" value="Add item" name="submit"/>
                </div>
            </form>
            <?php
            //Print out errors
            //TODO: put it on the actaul form...
            echo $categoryError." ".$priceError ." ".$dateError ;
            ?>
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
