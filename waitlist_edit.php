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
  $pname    = sql_safe($var['ParentName']);
  $email    = sql_safe($var['ParentEmail']);
  $sname    = sql_safe($var['StudentName']);
  $age      = preg_replace("/[^0-9]/", "", $var['Age']);
  $years    = preg_replace("/[^0-9]/", "", $var['YearsDesired']);
  $days     = preg_replace("/[^0-9]/", "", $var['3DaySchool']);
  $id       = $var['WaitlistID'];

  $saq = "UPDATE Waitlist
          SET ParentName='$pname', ParentEmail='$email',
          Age=$age, StudentName='$sname',
          YearsDesired=$years, 3DaySchool=$days
          WHERE WaitlistID=$id;";
  $rq = $conn->query($saq);

  if ($rq)
  {
    $waitlist = $days ? 'Waitlist3Day' : 'Waitlist2Day';
    $msg .= "<div class='alert alert-success'>Waiver item succesfully updated. <a href='reports.php?report=$waitlist'>Click here</a> to go back to contact display</div>";
  }
  else
    $msg .= "<div class='alert alert-danger'>Something went wrong, please check your changes and try again.</div>";
  $msg .= "</div><div class='col-sm-2'></div></div>";
}

$ssq = "select * from Waitlist where WaitlistID=". $var['WaitlistID'];
$rq = $conn->query($ssq);
$dbval = sql_assoc($rq);

$conn->close();

?>
<html>
<head>
  <title>Wait list edit</title>
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
    <h1 class='text-center'>Wait list edit</h1>
    <?php echo $msg; ?>
    <form action="waitlist_edit.php" method="Get">
      <input type="hidden" name="WaitlistID" value="<?php echo $var['WaitlistID']; ?>" />
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Parent Name:</label>
        </div>
        <div class="col-sm-3 text-left-sm text-right">
          <input name="ParentName" class="formInput" type="text" value="<?php echo $dbval['ParentName']; ?>" required/>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Email:</label>
        </div>
        <div class="col-sm-3 text-left-sm text-right">
          <input name="ParentEmail" class="formInput" type="text" value="<?php echo $dbval['ParentEmail']; ?>" required/>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Student Name:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="StudentName" class="formInput" type="text" value="<?php echo $dbval['StudentName']; ?>" required/>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Student Age:</label>
        </div>
        <div class="col-sm-3 text-center">
          <input name="Age" class="formInput" type="text" value="<?php echo $dbval['Age']; ?>" required/>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>3 Days a Week:</label>
        </div>
        <div class="col-sm-3 loginInputMatch">
          <div class="row">
            <div class="col-xs-3 text-left-sm text-right">
              <input name="3DaySchool" type="radio" value="1" <?php echo $var['3DaySchool'] ? 'checked' : ''; ?> required/>
            </div>
            <div class="col-xs-3">
              Yes
            </div>
            <div class="col-xs-3 text-left-sm text-right">
              <input name="3DaySchool" type="radio" value="0" <?php echo $var['3DaySchool'] ? '' : 'checked'; ?> />
            </div>
            <div class="col-xs-3">
              No
            </div>
          </div>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Years Desired:</label>
        </div>
        <div class="col-sm-3 loginInputMatch">
          <div class="row">
            <div class="col-xs-3 text-left-sm text-right">
              <input name="YearsDesired" type="radio" value="1" <?php echo ($var['YearsDesired'] == 1) ? 'checked' : ''; ?> required/>
            </div>
            <div class="col-xs-3">
              1
            </div>
            <div class="col-xs-3 text-left-sm text-right">
              <input name="YearsDesired" type="radio" value="2" <?php echo ($var['YearsDesired'] > 1) ? 'checked' : ''; ?> />
            </div>
            <div class="col-xs-3">
              2
            </div>
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
