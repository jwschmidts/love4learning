<?php
session_start();
$login = 'no';

if ($_SESSION['timeout'] + 30 * 60 < time())
{
  echo 'timeout <br>';
  $login = 'yes';
}

$_SESSION['timeout'] = time();

$user = $_POST['user'];
$pass = $_POST['pass'];

$base = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
if (($user == "l4l") && ($pass == "love4learning" ))
{
  $_SESSION['user'] = $user;
  $login = 'no';
}

if (!isset($_SESSION['user']))
{
  echo 'user <br>';
  $login = 'yes';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

<title>Love4Learning Reports</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel='stylesheet' href="style.css">
</head>
<body>

<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <img src="http://love4learningpreschool.com/wp-content/uploads/2017/03/7e13f7_a65b8e5e8abd31fc0393b944abdc2785.jpg" alt="Love4Learning Preschool" style="height:70px; width:auto;">
  </div>
</nav>

<?php
if ($login == 'yes')
{
  if(isset($_POST))
  {?>
    <div class='container'>
      <div class='container-fluid'>
        <form method="POST" action="reports.php">
          <div class='row'>
            <div class='col-sm-2'></div>
            <div class='col-sm-2 loginInputMatch text-right'>
              Username:
            </div>
            <div class='col-sm-3'>
              <input type="text" name="user" class="formInput" required>
            </div>
            <div class='col-sm-3'></div>
          </div>
          <div class='row'>
            <div class='col-sm-2'></div>
            <div class='col-sm-2 loginInputMatch text-right'>
              Password:
            </div>
            <div class='col-sm-3'>
              <input type="text" name="pass" class="formInput" required>
            </div>
            <div class='col-sm-3'></div>
          </div>
          <div class='row'>
            <div class='col-sm-4'></div>
            <div class='col-sm-3'>
              <input type="submit" name="submit" value="Login" class="btn btn-success">
            </div>
            <div class='col-sm-5'></div>
          </div>
        </form>
      </div>
    </div>
  </body>
  </html>
  <?}
}
else
{

include_once "sql.php";

?>
<div class='container'>
  <div class='container-fluid'>
    <div class='row'>
      <div class='col-sm-3 text-right loginInputMatch'>
        <label class=''>Select an Action:</label>
      </div>
      <div class='col-sm-6'>
        <form action='reports.php'>
          <select name="report" class='formInput'>
            <option selected disabled>Select a Report</option>
            <option value='CreateClass'>Create New Class</option>
          </select>
          <div class='row'>
            <div class='col-sm-3'></div>
            <div class='col-sm-4'>
              <input type='Submit' class='btn btn-success'>
            </div>
            <div class='col-sm-5'></div>
          </div>
        </form>
      </div>
      <div class='col-sm-3'></div>
    </div>
  </div>
</div>

<?php
$variables = $_GET;

if ($variables['report'] == 'CreateClass')
{
?>
  <div class='row'>
    <div class='col-sm-3'></div>
    <div class='col-sm-6'>
      Create a New Class:
    </div>
    <div class='col-sm-3'></div>
  </div>
<?php
}

?>
</body>
</html>
<?php
}
?>
