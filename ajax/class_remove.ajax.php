<?php

// Delete a class from the database

include_once "../sql.php";
$conn = sql_open();

$saq = "DELETE from Class where ClassID='". (int)$_POST['ClassID']. "';";
$rq = $conn->query($saq);
header('Content-type: application/json');
echo json_ecode($rq);


$conn->close();
?>
