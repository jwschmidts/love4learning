<?php

include_once "../sql.php";
$conn = sql_open();

$variables = $_POST;

$saq = "DELETE from Class where ClassID='". $variables['ClassID']. "';";
$rq = $conn->query($saq);
header('Content-type: application/json');
echo json_ecode($rq);


$conn->close();
?>
