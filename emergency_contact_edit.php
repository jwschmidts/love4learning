<?php
session_start();

// if not logged in then jump to reports.php with login page
if (!isset($_SESSION['user']))
{
  if (isset($_SESSION['timeout']))
    session_destroy();
  $login = 'yes';
  echo "<script>window.location='reports.php';</script>";
}

$var = $_GET;

include_once "sql.php";

$msg = '';
$conn = sql_open();

if ($var['Submit'] == 'Submit')
{
  $msg .= "<div class='row'><div class='col-sm-2'></div><div class='col-sm-8'>";
  $fname    = sql_safe($var['FirstName']);
  $lname    = sql_safe($var['LastName']);
  $phone    = preg_replace("/[^0-9]/", "", $var['Phone']);
  $address  = sql_safe($var['Address']);
  $city     = sql_safe($var['City']);
  $state    = sql_safe($var['State']);
  $zip      = preg_replace("/[^0-9]/", "", $var['Zip']);
  $relation = sql_safe($var['Relationship']);
  $id       = $var['ContactID'];

  $saq = "UPDATE EmergencyContact
          SET FirstName='$fname', LastName='$lname',
          Phone=$phone, Address='$address',
          City='$city', State='$state',
          Zip='$zip', Relationship='$relation'
          WHERE ContactID=$id;";
  $rq = $conn->query($saq);

  if ($rq)
    $msg .= "<div class='alert alert-success'>Contact succesfully updated. <a href='reports.php?ContactID=". $var['ContactID']. "'>Click here</a> to go back to contact display</div>";
  else
    $msg .= "<div class='alert alert-danger'>Something went wrong, please check your changes and try again.</div>";
  $msg .= "</div><div class='col-sm-2'></div></div>";
}

$ssq = "select * from EmergencyContact where ContactID=". $var['ContactID'];
$rq = $conn->query($ssq);
$dbval = sql_assoc($rq);

$conn->close();

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
    <h1 class='text-center'>Emergency Contact Edit</h1>
    <?php echo $msg; ?>
    <form action="emergency_contact_edit.php" method="Get">
      <input type="hidden" name="ContactID" value="<?php echo $var['ContactID']; ?>" />
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>First Name:</label>
        </div>
        <div class="col-sm-3 text-left-sm text-right">
          <input name="FirstName" class="formInput" type="text" value="<?php echo $dbval['FirstName']; ?>" required/>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Last Name:</label>
        </div>
        <div class="col-sm-3 text-left-sm text-right">
          <input name="LastName" class="formInput" type="text" value="<?php echo $dbval['LastName']; ?>" required/>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Phone:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="Phone" class="formInput" type="text" value="<?php echo $dbval['Phone']; ?>" required/>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Street Address:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="Address" class="formInput" type="text" value="<?php echo $dbval['Address']; ?>" required/>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>City:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="City" class="formInput" type="text" value="<?php echo $dbval['City']; ?>" required/>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>State:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="State" class="formInput" type="text" value="<?php echo $dbval['State']; ?>" required/>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Zip:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="Zip" class="formInput" type="text" value="<?php echo $dbval['Zip']; ?>" required/>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Relationship:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="Relationship" class="formInput" type="text" value="<?php echo $dbval['Relationship']; ?>" required/>
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
