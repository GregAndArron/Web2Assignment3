<?php
$page_title="My data";
$require_login=true;
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
			<li><a href="dataEntry.php">Data Entry</a></li>
			<li class="active"><a href="myDataAll.php">My Data</a></li>
			<li><a href="#">Friends</a></li>
			<li><a href="#">Profile</a></li>
		   
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<div class="container">
		<div class="middle col-sm-6">
			<div class="middlepageName text-center col-sm-6">
			<h2>My Data</h2>
			</div>
		
			<ul class="nav nav-tabs col-sm-12">
			  <li role="presentation"><a href="myDataAll.php">All Data</a></li>
			  <li role="presentation"><a href="myDataGraphs.php">Graphs</a></li>
			  <li role="presentation"><a href="myDataCalendar.php">Calendar</a></li>
			  <li role="presentation" class="active"><a href="myDataGoals.php">Goals</a></li>
			</ul>
			<div class="middleMyData col-sm-8">
				<div class="middleMyDataHeading text-center col-sm-8">
				<h2>Goals</h2>
				</div>
				<div class="middleMyDataAllDataTop col-sm-8">
					
					<div class="middleMyDataGoalsLeft col-sm-6">
						<div class="marTop">
							<label class="marTop"for="goals">Spend less than: $</label><input id="goals" type="number" value="0"/>
						</div>
						<div class="marLeft marTop">
							<label for="goals">On </label>
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							Choose Item
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
								<li><a href="#">Gambling</a></li>
								<li><a href="#">Entertainment</a></li>
								<li><a href="#">Lunch</a></li>
								<li><a href="#">Tobacco</a></li>
								<li><a href="#">Junkfood</a></li>
								<li><a href="#">Toys and games</a></li>
							</ul>
						</div>
						<div class="marTop">
							<div class="form-inline">
								<label class="radio"><input value="1" type="radio" name="length" id="length" value="day" checked>Day</label>
								<label class="radio"><input value="2" type="radio" name="length" id="length" value="week">Week</label>
								<label class="radio"><input value="3" type="radio" name="length" id="length" value="month">Month</label>
							</div>
						</div>
						<div class="marTop">
							<form id="dateRangeForm" method="post" class="form-horizontal">
								<div class="form-group">
									<label class="col-xs-3 control-label">complete by: </label>
									<div class="col-xs-5 date">
										<div class="input-group input-append date" id="dateRangePicker">
											<input type="text" class="form-control" name="date" />
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					
					<div class="middleMyDataGoalsRight text-center col-sm-6">
						<div class="form-group">
							<label for="comment">Comment:</label>
							<textarea class="form-control" rows="12" id="comment"></textarea>
						</div>
					</div>
					<div class="middleMyDataGoalsBtn text-center col-sm-8">
						<div class="form-group">
							<div class="col-xs-5 col-xs-offset-3">
								<button type="submit" class="btn btn-default">Submit</button>
							</div>
						</div>
					</div>
				</div>
				<div class="middleMyDataAllDataBottom text-center col-sm-8">
				<h2>Goal/target table goes here</h2>
				</div>
			</div>
		</div>
	</div>

  <footer>
  </footer>

</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script>
$(document).ready(function() {
    $('#dateRangePicker')
        .datepicker({
            format: 'mm/dd/yyyy',
            startDate: '01/01/2010',
            endDate: '12/30/2020'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#dateRangeForm').formValidation('revalidateField', 'date');
        });

    $('#dateRangeForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            date: {
                validators: {
                    notEmpty: {
                        message: 'The date is required'
                    },
                    date: {
                        format: 'MM/DD/YYYY',
                        min: '01/01/2010',
                        max: '12/30/2020',
                        message: 'The date is not a valid'
                    }
                }
            }
        }
    });
});
</script>
</body>
</html>
