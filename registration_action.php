<?php

include_once "sql.php";
$variables = $_GET;

$conn = sql_open();

// Check to see if correct class code was entered
$class  = $variables['Code'];
$ssq = "select * from Class where RegistrationCode='$class'";
$rq = $conn->query($ssq);
$a = sql_array($rq);
if (isset($a['ClassID']))
  $classID = $a['ClassID'];
else
{
  $conn->close();
  $variables['Code'] = 'e1';
  $params = http_build_query($variables);
  echo "<script>window.location.href='/registration?$params';</script>";
}


$bday   = $variables['BDay'];
$bmonth = $variables['BMonth'];
$byear  = $variables['BYear'];

$dob = strtotime("$bday  $bmonth  $byear");
$dob = date('Y-m-d', $dob);
$d = date_parse($bmonth);
if (checkdate($d['month'], $bday, $byear) === false)
{
  $conn->close();
  $variables['Code'] = 'e2';
  $params = http_build_query($variables);
  echo "<script>window.location.href='/registration?$params';</script>";
}

//echo "<pre>"; print_r($variables); exit;
$err = '';

$parentFirstName1 = sql_safe(html_safe($variables['ParentFirstName1']));
$parentLastName1  = sql_safe(html_safe($variables['ParentLastName1']));
$parentFirstName2 = sql_safe(html_safe($variables['ParentFirstName2']));
$parentLastName2  = sql_safe(html_safe($variables['ParentLastName2']));
$email            = sql_safe(html_safe($variables['Email']));
$phone            = preg_replace("/[^0-9]/", "", $variables['Phone']);
$wPhone           = 1111111111;
$cPhone           = 1111111111;
$checkEmail       = $variables['CheckEmail'] == 'Yes' ? 1 : 0;
$address          = sql_safe(html_safe($variables['Address']));
$city             = sql_safe(html_safe($variables['City']));
$state            = sql_safe(html_safe($variables['State']));
$zip              = preg_replace("/[^0-9]/", "", $variables['Zip']);
$hobbies          = sql_safe(html_safe($variables['Hobbies']));
$fname            = sql_safe(html_safe($variables['fname']));
$lname            = sql_safe(html_safe($variables['lname']));
$nickName         = sql_safe(html_safe($variables['nickName']));
$schoolYear       = preg_replace("/[^0-9]/", "", $variables['schoolYear']);
$gender           = $variables['Gender'] == 'Boy' ? 1 : 0;
$dominantHand     = $variables['DominantHand'] == 'RightHand' ? 1 : 0;
$additionalInfo   = sql_safe(html_safe($variables['AdditionalInfo']));
$physical         = sql_safe(html_safe($variables['WaiverChildNameAware']));
$lengthInSchool   = preg_replace("/[^0-9]/", "", $variables['LengthInSchool']);
$sessionType      = $variables['SessionType'] == '2Day' ? 2 : 3;
$pottyTrained     = $variables['PottyTrained'] == 'on' ? 1 : 0;
$aware            = $variables['Physical'] == 'aware' ? 1 : 0;
$fieldTrip        = $variables['FieldTrip'] == 'on' ? 1 : 0;
$water            = $variables['Water']  == 'on'? 1 : 0;
$onSite           = $variables['PhotographOnSite'] == 'on' ? 1 : 0;
$offSite          = $variables['PhotographOffSite'] == 'on' ? 1 : 0;
$medicine         = $variables['Medicine'] == 'on' ? 1 : 0;
$sign             = sql_safe(html_safe($variables['Sign']));
$signedBy         = sql_safe(html_safe($variables['PrintedName']));
$eFirst           = sql_safe(html_safe($variables['EmergencyFirstName']));
$eLast            = sql_safe(html_safe($variables['EmergencyLastName']));
$ePhone           = preg_replace("/[^0-9]/", "", $variables['EmergencyPhone']);
if ((strlen($phone) != 10) || (strlen($ePhone) != 10))
{
  $err .= "One of the phone numbers entered is not a valid number, please check and resubmit.<br>";
  $err .= "$phone, $ephone";
}
$eAddress         = sql_safe(html_safe($variables['EmergencyAddress']));
$eCity            = sql_safe(html_safe($variables['EmergencyCity']));
$eState           = sql_safe(html_safe($variables['EmergencyState']));
$ezip             = preg_replace("/[^0-9]/", "", $variables['EmergencyZip']);
if ((strlen($zip) != 5) || (strlen($ezip) != 5))
{
  $err .= "One of the zip codes entered is not valid. Please check and resubmit.<br>";
}
$relationship     = sql_safe(html_safe($variables['EmergencyRelationship']));

if ($err != '')
{
  $variables['Code'] = $err;
  $params = http_build_query($variables);
  echo "<script>window.location.href='/registration?$params';</script>";
}

$signedDate = date('Y-m-d');
$saq = "call InsertRegisterSP('$parentFirstName1', '$parentLastName1', '$parentFirstName2',
      '$parentLastName2', '$email',
      '$phone', '$wPhone' ,'$cPhone', '$checkEmail', '$address', '$city', '$state', '$zip', '$hobbies',
      '$fname', '$lname', '$nickName', '$dob', $schoolYear, $gender, $dominantHand,
      '$additionalInfo', '$physical', '$lengthInSchool', '$sessionType', '$classID', '$aware', '$fieldTrip', '$water',
      '$onSite', '$offSite', '$medicine', '$pottyTrained', '$signedDate', '$signedBy', '$eFirst', '$eLast', '$ePhone',
      '$eAddress', '$eCity', '$eState', $ezip, '$relationship')";
$rq = $conn->query($saq);
if ($rq === false)
{
  $variables['Code'] = 'e3';
  $params = http_build_query($variables);
  echo "<script>window.location.href='/registration?$params';</script>";
}

$conn->close();

echo "<script>window.location.href='/success?reg=success';</script>";
?>
