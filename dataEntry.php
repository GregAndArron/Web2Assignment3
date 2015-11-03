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
                <input type="button" value="Add another item" onclick="javascript:addItem();"/>        
                <input type="submit" value="Enter items" name="submit"/>
                <div style="visibility:hidden">
                    <div id="item">
                        <label>Category</label>
                        <select name="category[]">
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
                        <input type="number" step="0.01" name="price[]"/>

                        <label>Comment/place</label>
                        <input type="text" width="20" name="comment[]"/>

                        <label >Date</label>
                        <input type="date" name="date[]"/>           

                        <input type="button" value="Delete" onclick="javascript:removeItem(this);"/>
                    </div>
                </div>
            </form>
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