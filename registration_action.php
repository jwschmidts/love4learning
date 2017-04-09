<?php

include_once "sql.php";
$variables = $_GET;

$bday   = $variables['BDay'];
$bmonth = $variables['BMonth'];
$byear  = $variables['BYear'];

$dob = strtotime("$bday  $bmonth  $byear");
$dob = date('Y-m-d', $dob);

//echo "<pre>"; print_r($variables); exit;
$parentFirstName1 = sql_safe($variables['ParentFirstName1']);
$parentLastName1  = sql_safe($variables['ParentLastName1']);
$parentFirstName2 = sql_safe($variables['ParentFirstName2']);
$parentLastName2  = sql_safe($variables['ParentLastName2']);
$email            = sql_safe($variables['Email']);
$phone            = (int)$variables['Phone'];
$wPhone           = (int)$variables['WorkPhone'];
$cPhone           = (int)$variables['CellPhone'];
$checkEmail       = $variables['CheckEmail'] == 'Yes' ? 1 : 0;
$address          = sql_safe($variables['Address']);
$city             = sql_safe($variables['City']);
$state            = sql_safe($variables['State']);
$zip              = (int)$variables['Zip'];
$hobbies          = sql_safe($variables['Hobbies']);
$fname            = sql_safe($variables['fname']);
$lname            = sql_safe($variables['lname']);
$nickName         = sql_safe($variables['nickName']);
$schoolYear       = (int)$variables['schoolYear'];
$gender           = $variables['Gender'] == 'Boy' ? 1 : 0;
$dominantHand     = $variables['DominantHand'] == 'RightHand' ? 1 : 0;
$additionalInfo   = sql_safe($variables['AdditionalInfo']);
$physical         = sql_safe($variables['WaiverChildNameAware']);
$lengthInSchool   = (int)$variables['LengthInSchool'];
$sessionType      = $variables['SessionType'] == '2Day' ? 2 : 3;
$pottyTrained     = $variables['PottyTrained'] == 'on' ? 1 : 0;
$aware            = $variables['Physical'] == 'aware' ? 1 : 0;
$fieldTrip        = $variables['FieldTrip'] == 'on' ? 1 : 0;
$water            = $variables['Water']  == 'on'? 1 : 0;
$onSite           = $variables['PhotographOnSite'] == 'on' ? 1 : 0;
$offSite          = $variables['PhotographOffSite'] == 'on' ? 1 : 0;
$medicine         = $variables['Medicine'] == 'on' ? 1 : 0;
$sign             = sql_safe($variables['Sign']);
$signedBy         = sql_safe($variables['PrintedName']);
$eFirst           = sql_safe($variables['EmergencyFirstName']);
$eLast            = sql_safe($variables['EmergencyLastName']);
$ePhone           = (int)$variables['EmergencyPhone'];
$eAddress         = sql_safe($variables['EmergencyAddress']);
$eCity            = sql_safe($variables['EmergencyCity']);
$eState           = sql_safe($variables['EmergencyState']);
$ezip             = (int)$variables['EmergencyZip'];
$relationship     = sql_safe($variables['EmergencyRelationship']);

$signedDate = date('Y-m-d');
$saq = "call InsertRegisterSP('$parentFirstName1', '$parentLastName1', '$parentFirstName2',
      '$parentLastName2', '$email',
      $phone, $wPhone ,$cPhone, $checkEmail, '$address', '$city', '$state', '$zip', '$hobbies',
      '$fname', '$lname', '$nickName', '$dob', $schoolYear, $gender, $dominantHand,
      '$additionalInfo', '$physical', $lengthInSchool, $sessionType, 1, $aware, $fieldTrip, $water,
      $onSite, $offSite, $medicine, $pottyTrained, '$signedDate', '$signedBy', '$eFirst', '$eLast', $ePhone,
      '$eAddress', '$eCity', '$eState', $ezip, '$relationship')";
sql_query($saq);

echo "<script>window.location.href='/success?reg=success';</script>";
?>
