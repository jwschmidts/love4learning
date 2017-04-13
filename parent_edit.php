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
  $fname2   = sql_safe($var['FirstName2']);
  $lname2   = sql_safe($var['LastName2']);
  $email    = sql_safe($var['Email']);
  $phone1   = preg_replace("/[^0-9]/", "", $var['Phone1']);
  $phone2   = preg_replace("/[^0-9]/", "", $var['Phone2']);
  $phone3   = preg_replace("/[^0-9]/", "", $var['Phone3']);
  $check    = preg_replace("/[^0-9]/", "", $var['CheckEmail']);
  $address  = sql_safe($var['Address']);
  $city     = sql_safe($var['City']);
  $state    = sql_safe($var['State']);
  $zip      = preg_replace("/[^0-9]/", "", $var['ZipCode']);
  $hobbies  = sql_safe($var['Hobbies']);
  $id       = $var['ParentID'];

  $saq = "UPDATE Parents
          SET FirstName='$fname', LastName='$lname',
          FirstName2='$fname2', LastName2='$lname2',
          Phone1=$phone1, Phone2='$phone2',
          Phone3=$phone3, Address='$address',
          City='$city', State='$state',
          ZipCode='$zip', Hobbies='$hobbies',
          Email='$email', CheckEmail='$check'
          WHERE ParentID=$id;";
  $rq = $conn->query($saq);

  if ($rq)
    $msg .= "<div class='alert alert-success'>Parent succesfully updated. <a href='reports.php?ParentID=". $var['ParentID']. "'>Click here</a> to go back to parent display</div>";
  else
    $msg .= "<div class='alert alert-danger'>Something went wrong, please check your changes and try again.</div>";
  $msg .= "</div><div class='col-sm-2'></div></div>";
}

$ssq = "select * from Parents where ParentID=". $var['ParentID'];
$rq = $conn->query($ssq);
$dbval = sql_assoc($rq);

$conn->close();

?>
<html>
<head>
  <title>Parent Edit</title>
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
    <h1 class='text-center'>Parent Edit</h1>
    <?php echo $msg; ?>
    <form action="parent_edit.php" method="Get">
      <input type="hidden" name="ParentID" value="<?php echo $var['ParentID']; ?>" />
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
          <label>First Name 2(optional):</label>
        </div>
        <div class="col-sm-3 text-left-sm text-right">
          <input name="FirstName2" class="formInput" type="text" value="<?php echo $dbval['FirstName2']; ?>" />
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Last Name 2(optional):</label>
        </div>
        <div class="col-sm-3 text-left-sm text-right">
          <input name="LastName2" class="formInput" type="text" value="<?php echo $dbval['LastName2']; ?>" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Phone:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="Phone1" class="formInput" type="text" value="<?php echo $dbval['Phone1']; ?>" required/>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Phone(cell):</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="Phone2" class="formInput" type="text" value="<?php echo $dbval['Phone2']; ?>" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Phone(work):</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="Phone3" class="formInput" type="text" value="<?php echo $dbval['Phone3']; ?>" />
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Email:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="Email" class="formInput" type="text" value="<?php echo $dbval['Email']; ?>" required/>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Check Email:</label>
        </div>
        <div class="col-sm-3 loginInputMatch">
          <div class="row">
            <div class="col-xs-3 text-left-sm text-right">
              <input name="CheckEmail" type="radio" value="1" <?php echo $dbval['CheckEmail'] ? 'checked' : ''; ?> required/>
            </div>
            <div class="col-xs-3">
              Yes
            </div>
            <div class="col-xs-3 text-left-sm text-right">
              <input name="CheckEmail" type="radio" value="0" <?php echo $dbval['CheckEmail'] ? '' : 'checked'; ?> />
            </div>
            <div class="col-xs-3">
              No
            </div>
          </div>
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
          <input name="ZipCode" class="formInput" type="text" value="<?php echo $dbval['ZipCode']; ?>" required/>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Hobbies:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="Hobbies" class="formInput" type="text" value="<?php echo $dbval['Hobbies']; ?>" />
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
