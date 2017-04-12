<?php
session_start();

if (!isset($_SESSION['user']))
{
  if (isset($_SESSION['timeout']))
    session_destroy();
  $login = 'yes';
  echo "<script>window.location='reports.php';</script>";
}



$var = $_GET;

include_once "sql.php";

$year  = date('Y', strtotime($var['Birthday']));
$month = date('m', strtotime($var['Birthday']));
$day   = date('d', strtotime($var['Birthday']));

$msg = '';

if ($var['Submit'] == 'Submit')
{
  $year  = preg_replace("/[^0-9]/", "", $var['Year']);
  $month = preg_replace("/[^0-9]/", "", $var['Month']);
    $err = 'date';
  $day   = preg_replace("/[^0-9]/", "", $var['Day']);

  $dob = "$year-$month-$day";

  $msg .= "<div class='row'><div class='col-sm-2'></div><div class='col-sm-8'>";
  if (checkdate($month, $day, $year))
  {
    $id       = sql_safe($var['StudentID']);
    $fname    = sql_safe($var['FirstName']);
    $lname    = sql_safe($var['LastName']);
    $nick     = sql_safe($var['Nickname']);
    $gender   = $var['Gender'] == 'Boy' ? 1 : 0;
    $dom      = sql_safe($var['DominantHand']);
    $add      = sql_safe($var['AdditionalInfo']);
    $physical = sql_safe($var['PhysicalImparments']);
    $aware    = sql_safe($var['AwareOfPhysical']);
    $trips    = sql_safe($var['FieldTrips']);
    $water    = sql_safe($var['Water']);
    $onSite   = $var['OnSitePictures'] == '' ? 0 : 1;
    $offSite  = $var['OffSitePictures'] == '' ? 0 : 1;
    $medicine = sql_safe($var['Medicine']);

    $saq = "UPDATE Students
            SET FirstName='$fname', LastName='$lname',
                Nickname='$nick', Gender=$gender,
                DominantHand=$dom, AdditionalInfo='$add',
                PhysicalImparments='$physical', AwareOfPhysical=$aware,
                FieldTrips=$trips, Water=$water,
                OnSitePictures=$onSite, OffSitePictures=$offSite,
                Medicine=$medicine, Birthday='$dob'
            WHERE StudentID=$id;";
    $conn = sql_open();
    $rq = $conn->query($saq);
    $conn->close();

    if ($rq)
      $msg .= "<div class='alert alert-success'>Student succesfully updated. <a href='reports.php?Class=". $var['ClassID']. "'>Click here</a> to go back to class display</div>";
    else
      $msg .= "<div class='alert alert-danger'>Something went wrong, please check your changes and try again.</div>";
  }
  else
    $msg .= "<div class='alert alert-danger'>Invalid birthday, please try again.</div>";
  $msg .= "</div><div class='col-sm-2'></div></div>";
}

?>
<html>
<head>
  <title>Edit Student</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <link rel='stylesheet' href="style.css">
 <script src="functions.js"></script>

</head>
<body>

<div class="container">
  <div>&nbsp;<br>&nbsp;</div>
  <div class="container-fluid" style='background-color: lightgrey;'>
    <h1 class='text-center'>Student Edit</h1>
    <?php echo $msg; ?>
    <form action="student_edit.php" method="Get">
      <input type="hidden" name="StudentID" value="<?php echo $var['StudentID']; ?>" />
      <input type="hidden" name="ClassID" value="<?php echo $var['ClassID']; ?>" />
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>First Name:</label>
        </div>
        <div class="col-sm-3 text-left-sm text-right">
          <input name="FirstName" class="formInput" type="text" value="<?php echo $var['FirstName']; ?>" required/>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Last Name:</label>
        </div>
        <div class="col-sm-3 text-left-sm text-right">
          <input name="LastName" class="formInput" type="text" value="<?php echo $var['LastName']; ?>" required/>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Nickname:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="Nickname" class="formInput" type="text" value="<?php echo $var['Nickname']; ?>" required/>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Birthday:</label>
        </div>
        <div class="col-sm-3 text-center">
          <div class="row">
            <div class="col-xs-4">
              Year:
            </div>
            <div class="col-xs-4">
              Month:
            </div>
            <div class="col-xs-4">
              Day:
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <input name="Year" class="dateInput" type="text" maxlength=4 value="<?php echo $year; ?>" required/>
            </div>
            <div class="col-xs-4">
              <input name="Month" class="dateInput" type="text" maxlength=2 value="<?php echo $month; ?>" required/>
            </div>
            <div class="col-xs-4">
              <input name="Day" class="dateInput" type="text" maxlength=2 value="<?php echo $day; ?>" required/>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Gender:</label>
        </div>
        <div class="col-sm-3 loginInputMatch">
          <div class="row">
            <div class="col-xs-3 text-left-sm text-right">
              <input name="Gender" type="radio" value="Boy" <?php echo $var['Gender'] ? '' : 'checked'; ?> required/>
            </div>
            <div class="col-xs-3">
              Boy
            </div>
            <div class="col-xs-3 text-left-sm text-right">
              <input name="Gender" type="radio" value="Girl" <?php echo $var['Gender'] ? 'checked' : ''; ?> />
            </div>
            <div class="col-sm-3">
              Girl
            </div>
          </div>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Dominant Hand:</label>
        </div>
        <div class="col-sm-3 loginInputMatch">
          <div class="row">
            <div class="col-xs-3 text-left-sm text-right">
              <input name="DominantHand" type="radio" value="1" <?php echo $var['DominantHand'] ? 'checked' : ''; ?> required/>
            </div>
            <div class="col-xs-3">
              Right
            </div>
            <div class="col-xs-3 text-left-sm text-right">
              <input name="DominantHand" type="radio" value="0" <?php echo $var['DominantHand'] ? '' : 'checked'; ?> />
            </div>
            <div class="col-xs-3">
              Left
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Field Trips:</label>
        </div>
        <div class="col-sm-3 loginInputMatch">
          <div class="row">
            <div class="col-xs-3 text-left-sm text-right">
              <input name="FieldTrips" type="radio" value="1" <?php echo $var['FieldTrips'] ? 'checked' : ''; ?> required/>
            </div>
            <div class="col-xs-3">
              Yes
            </div>
            <div class="col-xs-3 text-left-sm text-right">
              <input name="FieldTrips" type="radio" value="0" <?php echo $var['FieldTrips'] ? '' : 'checked'; ?> />
            </div>
            <div class="col-xs-3">
              No
            </div>
          </div>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Water Activites:</label>
        </div>
        <div class="col-sm-3 loginInputMatch">
          <div class="row">
            <div class="col-xs-3 text-left-sm text-right">
              <input name="Water" type="radio" value="1" <?php echo $var['Water'] ? 'checked' : ''; ?> required/>
            </div>
            <div class="col-xs-3">
              Yes
            </div>
            <div class="col-xs-3 text-left-sm text-right">
              <input name="Water" type="radio" value="0" <?php echo $var['Water'] ? '' : 'checked'; ?> />
            </div>
            <div class="col-xs-3">
              No
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Photographs:</label>
        </div>
        <div class="col-sm-3 loginInputMatch">
          <div class="row">
            <div class="col-xs-3 text-left-sm text-right ">
              <input name="OnSitePictures" type="checkbox" value="1" <?php echo $var['OnSitePictures'] ? 'checked' : ''; ?> />
            </div>
            <div class="col-xs-3">
              On Site
            </div>
            <div class="col-xs-3 text-left-sm text-right ">
              <input name="OffSitePictures" type="checkbox" value="1" <?php echo $var['OffSitePictures'] ? 'checked' : ''; ?> />
            </div>
            <div class="col-xs-3">
              Off Site
            </div>
          </div>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Medicine:</label>
        </div>
        <div class="col-sm-3 loginInputMatch">
          <div class="row">
            <div class="col-xs-3 text-left-sm text-right">
              <input name="Medicine" type="radio" value="1" <?php echo $var['Medicine'] ? 'checked' : ''; ?> required/>
            </div>
            <div class="col-xs-3">
              Yes
            </div>
            <div class="col-xs-3 text-left-sm text-right">
              <input name="Medicine" type="radio" value="0" <?php echo $var['Medicine'] ? '' : 'checked'; ?> />
            </div>
            <div class="col-xs-3">
              No
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Additional Info:</label>
        </div>
        <div class="col-sm-3 text-left-sm text-right">
          <textarea name="AdditionalInfo" class="formInput"><?php echo $var['AdditionalInfo']; ?></textarea>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Physical Limitation:</label>
        </div>
        <div class="col-sm-3 loginInputMatch">
          <div class="row">
            <div class="col-xs-3 text-left-sm text-right">
              <input name="AwareOfPhysical" type="radio" value="1" <?php echo $var['AwareOfPhysical'] ? 'checked' : ''; ?> required/>
            </div>
            <div class="col-xs-3">
              Aware
            </div>
            <div class="col-xs-3 text-left-sm text-right">
              <input name="AwareOfPhysical" type="radio" value="0" <?php echo $var['AwareOfPhysical'] ? '' : 'checked'; ?> />
            </div>
            <div class="col-xs-3">
              Unaware
            </div>
          </div>
          <div class="row">
            <textarea name="PhysicalImparments" class="formInput"><?php echo $var['PhysicalImparments']; ?></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
          <input type="submit" name='Submit' value="Submit" class='btn btn-success submitButton'/>
        </div>
        <div class="col-sm-5"></div>
      </div>
    </form>
  </div>
</div>

</body>
</html>
