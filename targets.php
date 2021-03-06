<?php
$page_title = "My goals";
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
            <li role="presentation" class="active"><a href="#">All Data</a></li>
            <li role="presentation"><a href="#">Graphs</a></li>
            <li role="presentation"><a href="#">Calendar</a></li>
            <li role="presentation"><a href="#">Goals</a></li>
        </ul>
        <div class="middleMyData text-center col-sm-8">
            <div class="middleMyDataTop text-center col-sm-8">
                <div class="middleMyDataTopLeft text-center col-sm-6">
                    <h2>Graphs</h2>
                    <p>Category comparisons</p>
                </div>
                <div class="middleMyDataTopRight text-center col-sm-8">
                    <div class="col-lg-4">
                        <div class="input-group">
                            <section id="rdoBtns">
                                <label class="block"><input type="radio" name="radgroup" value="A">Comparisons</label>
                                <label class="block"><input type="radio" name="radgroup" value="B">Last 7 days</label>
                                <label class="block"><input type="radio" name="radgroup" value="C">Last month</label>
                            </section>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
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
