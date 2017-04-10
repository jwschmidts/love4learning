<?php
session_start();
$login = 'no';

if ($_SESSION['timeout'] + 60 * 60 < time())
{
  if (isset($_SESSION['timeout']))
    session_destroy();
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
  if (isset($_SESSION['timeout']))
    session_destroy();
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
              <input type="password" name="pass" class="formInput" required>
            </div>
            <div class='col-sm-3'></div>
          </div>
          <div class='row'>
            <div class='col-sm-4'></div>
            <div class='col-sm-3'>
              <input type="submit" value="Login" class="btn btn-success" name='form_submit'>
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
$conn = sql_open();


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
            <option value='DisplayClass'>Display a Class</option>
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
  if ($variables['form_submit'] == "Create Class")
  {
    $className   = sql_safe($variables['ClassName']);
    $numStudents = sql_safe($variables['NumberStudents']);
    $saq = "insert into Class (ClassName, ClassSize, TeacherID)
            values ('$className', '$numStudents', 1)";
    $rq = $conn->query($saq);

    printf ("New Record has id %d.\n", $conn->insert_id);

    echo $saq. '<br>';
    echo '<pre>';
    print_r($variables);
    echo '</pre>';
  }
  else
  {
?>
<div class='container'>
  <div class='container-fluid'>
    <form action='reports.php'>
      <input type="hidden" name="report" value="CreateClass">
      <div class='row' style="padding-top: 20px;">
        <div class='col-sm-3'></div>
        <div class='col-sm-12 text-center'>
          <h2>Create a New Class</h2>
        </div>
      </div>
      <div class='row'>
        <div class='col-sm-3 text-right loginInputMatch'>
          Class Name:
        </div>
        <div class='col-sm-6'>
          <input type="text" name="ClassName" class="formInput" required>
        </div>
        <div class='col-sm-3'></div>
      </div>
      <div class='row'>
        <div class='col-sm-3 text-right loginInputMatch'>
          Number of Students:
        </div>
        <div class='col-sm-6'>
          <input type="text" name="NumberStudents" class="formInput" required>
        </div>
        <div class='col-sm-3'></div>
      </div>
      <div class='row'>
        <div class='col-sm-3'></div>
        <div class='col-sm-9'>
          <input type="submit" class="btn btn-success" value="Create Class" name='form_submit'>
        </div>
      </div>
    </form>
  </div>
</div>

<?php
  }
}
else if ($variables['report'] == 'DisplayClass')
{
?>
  <div class='row'>
    <div class='col-sm-3'></div>
    <div class='col-sm-6'>
      Display a Class:
    </div>
    <div class='col-sm-3'></div>
  </div>
<?php
}

$conn->close();
?>
</body>
</html>
<?php
}
?>
