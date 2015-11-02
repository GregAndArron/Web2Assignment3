<?php
$page_title = "Data entry";
$require_login = true;
require_once("scripts/header.php");
?>
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
                <li><a href="home.php">Home</a></li>
                <li class="active"><A href="dataEntry.php">Data Entry</a></li>
                <li><a href="myDataAll.php">My Data</a></li>
                <li><a href="#">Friends</a></li>
                <li><a href="#">Profile</a></li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
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