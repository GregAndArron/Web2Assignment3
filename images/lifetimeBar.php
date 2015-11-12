<?php

session_start();

include('../scripts/phpgraphlib.php');
$graph = new PHPGraphLib(400, 400);

//Null array so the array_push works
$data = array();

//Get database paramters
require_once("../scripts/connectvars.php");

//Attempt connection to database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Couldn't connect to server: " . mysqli_error());

//Create query to get required data
$query = "SELECT description, coalesce(total.amount,0)
FROM tbl_category
LEFT JOIN
	(SELECT category_id, sum(amount) AS 'amount'
	FROM tbl_item
	WHERE user_id='{$_SESSION['user_id']}'
	GROUP BY category_id) total
USING (category_id)";

$result = mysqli_query($dbc, $query) or die("Couldn't get user data: ") . mysqli_error();

while ($row = mysqli_fetch_row($result)) {
    $data[$row[0]] = $row[1];
}

$graph->addData($data);
$graph->setGradient('red','maroon');
$graph->createGraph();
?>
