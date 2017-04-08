<?php

include_once "sql.php";
$variables = $_GET;

$parentFirstName1 = sql_safe($variables['ParentFirstName1']);
$parentLastName1  = sql_safe($variables['ParentLastName1']);
$parentFirstName2 = sql_safe($variables['ParentFirstName2']);
$parentLastName2  = sql_safe($variables['ParentLastName2']);
$email            = sql_safe($variables['Email']);
$phone            = (int)$variables['Phone'];
$wPhone           = (int)$variables['WorkPhone'];
$cPhone           = (int)$variables['CellPhone'];
$checkEmail       = $variables['CheckEmail'] == 'CheckEmail' ? 1 : 0;
$address          = sql_safe($variables['Address']);
$city             = sql_safe($variables['City']);
$state            = sql_safe($variables['State']);
$zip              = (int)$variables['Zip'];
$hobbies          = sql_safe($variables['Hobbies']);
$fname            = sql_safe($variables['fname']);
$lname            = sql_safe($variables['lname']);
$nickName         = sql_safe($variables['nickName']);
$dob              = strtotime($variables['DateOfBirth']);
$schoolYear       = (int)$variables['schoolYear'];
$gender           = $variables['Gender'] == 'Boy' ? 1 : 0;
$dominantHand     = $variables['DominantHand'] == 'RightHand' ? 1 : 0;
$additionalInfo   = sql_safe($variables['AdditionalInfo']);
$lengthInSchool   = (int)$variables['LengthInSchool'];
$sessionType      = $variables['SessionType'] == '2Day' ? 2 : 3;
$pottyTrained     = $variables['PottyTrained'] == 'checked' ? 1 : 0;
$unaware          = $variables['WaiverChildNameUnware'] == 'checked' ? 1 : 0;
$aware            = $variables['WaiverChildNameAware'] == 'checked' ? 1 : 0;
$bus              = $variables['Bus'] == 'checked' ? 1 : 0;
$water            = $variables['Water']  == 'checked'? 1 : 0;
$onSite           = $variables['PhotographOnSite'] == 'checked' ? 1 : 0;
$offSite          = $variables['PhotographOffSite'] == 'checked' ? 1 : 0;
$medicine         = $variables['Medicine'] == 'checked' ? 1 : 0;
$sign             = sql_safe($variables['Sign']);
$eFirst           = sql_safe($variables['EmergencyFirstName']);
$eLast            = sql_safe($variables['EmergencyLastName']);
$ePhone           = (int)$variables['EmergencyPhone'];
$eAddress         = sql_safe($variables['EmergencyAddress']);
$eCity            = sql_safe($variables['EmergencyCity']);
$eState           = sql_safe($variables['EmergencyState']);
$ezip             = (int)$variables['EmergencyZip'];
$relationship     = sql_safe($variables['EmergencyRelationship']);

$saq = "call InsertRegisterSP('$parentFirstName1', '$parentLastName1', '$parentFirstName2',
      '$parentLastName2', '$email',
      $phone, $wPhone ,$cPhone, $checkEmail, '$address', '$city', '$state', '$zip', '$hobbies',
      '$fname', '$lname', '$nickName', 2017-03-2014, $schoolYear, $gender, $dominantHand,
      '$additionalInfo', $lengthInSchool, $sessionType, 1, 1, $unaware, $aware, $bus, $water,
      $onSite, $offSite, $medicine, $pottyTrained, '$eFirst', '$eLast', $ePhone,
      '$eAddress', '$eCity', '$eState', $ezip, '$relationship')";
sql_query($saq);

echo "<script>window.location.href='/success?reg=success';</script>";
?>
