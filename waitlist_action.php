<?php

include_once "sql.php";
$variables = $_GET;

$pName = sql_safe($variables['ParentsName']);
$email = sql_safe($variables['ParentsEmail']);
$sName = sql_safe($variables['StudentsName']);
$sAge  = preg_replace("/[^0-9]/", "", $variables['StudentAge']);
$years = preg_replace("/[^0-9]/", "", $variables['YearsToAttend']);
$class = $variables['ClassType'] == 'ThreeDay' ? 1 : 0;

$saq = "insert into Waitlist (ParentName, ParentEmail, StudentName, Age, YearsDesired, 3DaySchool)
        values('$pName', '$email', '$sName', $sAge, $years, $class)";
sql_query($saq);

echo "<script>window.location.href='/success/';</script>";
?>
