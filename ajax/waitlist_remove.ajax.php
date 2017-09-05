<?php

// delete a waitlist entry

include_once "../sql.php";
$conn = sql_open();

$saq = "DELETE from Waitlist where WaitlistID='". (int)$_POST['WaitlistID']. "';";
$rq = $conn->query($saq);
header('Content-type: application/json');
echo json_ecode($rq);


$conn->close();
?>
