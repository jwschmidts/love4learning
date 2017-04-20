<?php

// delete a student, parent, and emergency contact from the db 

include_once "../sql.php";
$conn = sql_open();

$variables = $_POST;

$saq = "CALL deleteRegisterSP(". $variables['StudentID']. ");";
$rq = $conn->query($saq);
header('Content-type: application/json');
echo json_ecode($rq);


$conn->close();
?>
