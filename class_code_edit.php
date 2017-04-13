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
  $code = sql_safe($var['RegistrationCode']);
  $name = sql_safe($var['ClassName']);
  $id   = $var['ClassID'];

  $saq = "UPDATE Class
          SET RegistrationCode='$code', ClassName='$name'
          WHERE ClassID=$id;";
  $rq = $conn->query($saq);

  if ($rq)
  {
    $msg .= "<div class='alert alert-success'>Class Info Successfully updated<a href='reports.php?report=DisplayClasses'> Click here</a> to go back to class display</div>";
  }
  else
    $msg .= "<div class='alert alert-danger'>Something went wrong, please check your changes and try again.</div>";
  $msg .= "</div><div class='col-sm-2'></div></div>";
}

$ssq = "select * from Class where ClassID=". $var['ClassID'];
$rq = $conn->query($ssq);
$dbval = sql_assoc($rq);

$conn->close();

?>
<html>
<head>
  <title>Class Edit</title>
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
    <form action="class_code_edit.php" method="Get">
      <input type="hidden" name="ClassID" value="<?php echo $var['ClassID']; ?>" />
      <div class="row">
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Class Name:</label>
        </div>
        <div class="col-sm-3 text-left-sm text-right">
          <input name="ClassName" class="formInput" type="text" value="<?php echo $dbval['ClassName']; ?>" required/>
        </div>
        <div class="col-sm-2 text-left-sm text-right loginInputMatch">
          <label>Code:</label>
        </div>
        <div class="col-sm-3 text-left-sm text-right">
          <input name="RegistrationCode" class="formInput" type="text" value="<?php echo $dbval['RegistrationCode']; ?>" required/>
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
