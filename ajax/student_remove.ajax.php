<?php

// delete a student, parent, and emergency contact from the db

include_once "../sql.php";
$conn = sql_open();

$sid = (int)$_POST['StudentID'];
//$saq = "CALL deleteRegisterSP(". $variables['StudentID']. ");";
$saq = "delete from Students where StudentID=$sid";
$rq = $conn->query($saq);
header('Content-type: application/json');
echo 'Done';

$conn->close();
?>
