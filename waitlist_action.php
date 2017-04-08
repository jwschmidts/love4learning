<?php

include_once "sql.php";
$variables = $_GET;
echo "<pre>";
print_r($variables);

$pName = sql_safe($variables['ParentsName']);
$email = sql_safe($variables['ParentsEmail']);
$sName = sql_safe($variables['StudentsName']);
$sAge  = (int)$variables['StudentAge'];
$years = (int)$variables['YearsToAttend'];
$class = $variables['ClassType'] == 'ThreeDay' ? 1 : 0;

$saq = "insert into Waitlist (ParentName, ParentEmail, StudentName, Age, YearsDesired, 3DaySchool)
        values('$pName', '$email', '$sName', $sAge, $years, $class)";
sql_query($saq);

?>
