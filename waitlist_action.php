<?php

include_once "sql.php";

// get all values
$variables = $_GET;

// make sure they are sql and html safe
$pName = sql_safe(html_safe($variables['ParentsName']));
$email = sql_safe(html_safe($variables['ParentsEmail']));
$sName = sql_safe(html_safe($variables['StudentsName']));
$sAge  = preg_replace("/[^0-9]/", "", $variables['StudentAge']);
$years = preg_replace("/[^0-9]/", "", $variables['YearsToAttend']);
$class = $variables['ClassType'] == 'ThreeDay' ? 1 : 0;

// insert into DB
$saq = "insert into Waitlist (ParentName, ParentEmail, StudentName, Age, YearsDesired, 3DaySchool)
        values('$pName', '$email', '$sName', $sAge, $years, $class)";
$conn = sql_open();
$rq = $conn->query($saq);
$conn->close();
// if insert fails return an error
if ($rq === false)
{
  //echo $saq; exit;
  $variables['Code'] = 'e1';
  $params = http_build_query($variables);
  echo "<script>window.location.href='/waitlist?$params';</script>";
}

echo "<script>window.location.href='/success/';</script>";
?>
