<?php

session_start();

//Check for request two show current month/current week
$range = ""; //Default show all
//Check for range request
if (isset($_REQUEST['type'])) {
    if ($_REQUEST['type'] == "week") {
        //Last 7 days
        $range = "AND date > DATE_SUB(NOW(), INTERVAL 7 DAY)";
    } else if ($_REQUEST['type']=="month"){
        //Previous month
        $range = "AND YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
    }
}

include('../scripts/phpgraphlib.php');
include('../scripts/phpgraphlib_pie.php');
$graph = new PHPGraphLibPie(400, 400);
//
//Null array so the array_push works
$data = array();

//Get database paramters
require_once("../scripts/connectvars.php");

//Attempt connection to database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Couldn't connect to server: " . mysqli_error());

//Create query to get required data
//Ignore categories where nothing has been spent
$query = "SELECT tbl_category.description AS 'Expense', SUM(tbl_item.amount) AS 'Total'
FROM tbl_item
JOIN (tbl_category) USING (category_id)
WHERE tbl_item.user_id='{$_SESSION['user_id']}' " . $range .
        " GROUP BY tbl_category.description
ORDER BY tbl_category.description ASC;";

echo $query;
$result = mysqli_query($dbc, $query) or die("Couldn't get user data: ") . mysqli_error($dbc);

while ($row = mysqli_fetch_row($result)) {
    $data[$row[0]] = $row[1];
}

$graph->addData($data);
$graph->setLabelTextColor('50,50,50');
$graph->setLegendTextColor('50,50,50');
$graph->createGraph();
?>
