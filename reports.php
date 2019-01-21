<?php
session_start();
$login = 'no';

// log user out if it is past time
if ($_SESSION['timeout'] + 60 * 60 < time())
{
  if (isset($_SESSION['timeout']))
    session_destroy();
  $login = 'yes';
}

$_SESSION['timeout'] = time();

$user = $_POST['user'];
$pass = $_POST['pass'];
$logout = $_GET['logout'];
// logout user
if ($logout == 'logout')
{
  session_destroy();
  $login = 'yes';
}

// try to log user in
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
 <script src="functions.js"></script>
</head>
<body>

<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <img src="http://love4learningpreschool.com/wp-content/uploads/2017/03/7e13f7_a65b8e5e8abd31fc0393b944abdc2785.jpg" alt="Love4Learning Preschool" style="height:70px; width:auto;">
    <a href='/l4l/reports.php?logout=logout' class="btn">Log Out</a>
  </div>
</nav>

<?php
// show login page if needed
if ($login == 'yes')
{
  if(isset($_POST))
  {?>
    <div class='container'>
      <div class='container-fluid'>
        <form method="POST" action="reports.php">
          <div class='row'>
            <div class='col-xs-2'></div>
            <div class='col-xs-2 loginInputMatch text-right'>
              Username:
            </div>
            <div class='col-xs-3'>
              <input type="text" name="user" class="formInput" required>
            </div>
            <div class='col-xs-3'></div>
          </div>
          <div class='row'>
            <div class='col-xs-2'></div>
            <div class='col-xs-2 loginInputMatch text-right'>
              Password:
            </div>
            <div class='col-xs-3'>
              <input type="password" name="pass" class="formInput" required>
            </div>
            <div class='col-xs-3'></div>
          </div>
          <div class='row'>
            <div class='col-xs-4'></div>
            <div class='col-xs-3'>
              <input type="submit" value="Login" class="btn btn-success" name='form_submit'>
            </div>
            <div class='col-xs-5'></div>
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
    <div class='row' style="padding-bottom: 15px;">
      <div class='col-xs-3 text-right loginInputMatch'>
        <label class=''>Select an Action:</label>
      </div>
      <form action='reports.php'>
        <div class='col-xs-6'>
          <select name="report" class='formInput' onchange='this.form.submit()'>
            <option selected disabled>Select a Report</option>
            <option value='Waitlist2Day'>View 2 Day Wait List</option>
            <option value='Waitlist3Day'>View 3 Day Wait List</option>
            <option value='CreateClass'>Create New Class</option>
            <option value='DisplayClasses'>Display Classes</option>
          </select>
        </div>
        <div class='col-xs-3'> </div>
      </form>
    </div>
  </div>
</div>

<?php
$variables = $_GET;

// display 2 day waitlist
if ($variables['report'] == 'Waitlist2Day')
{
?>
  <div class='container'>
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-xs-12 text-center'>
          <h2>Wait List for 2 Days</h2>
        </div>
      </div>
      <div class='row'>
        <div class='col-xs-3'>
          Parent Name:
        </div>
        <div class='col-xs-3'>
          Parent Email:
        </div>
        <div class='col-xs-2'>
          Student Name:
        </div>
        <div class='col-xs-1'>
          Student Age:
        </div>
        <div class='col-xs-1'>
          Years Desired:
        </div>
        <div class='col-xs-2'>
          Date Added:
        </div>
      </div>
<?php

  $ssq = "select * from Waitlist where 3DaySchool=0";
  $rq = $conn->query($ssq);
  while ($rs = sql_assoc($rq))
  {
  ?>
  <div class='row' id='contact-<?php echo $rs['WaitlistID']; ?>'>
    <div class='col-xs-3 well'>
      <span class="glyphicon glyphicon-remove" style="color: #b20000; cursor: pointer;" onclick="remove_waitlist('<?php echo $rs['WaitlistID']; ?>');"></span> &nbsp; &nbsp; <a href="waitlist_edit.php?WaitlistID=<?php echo $rs['WaitlistID']; ?>"><span class="glyphicon glyphicon-pencil" style="color: green;"></span></a>
 <?php echo $rs['ParentName']; ?>
    </div>
    <div class='col-xs-3 well'>
      <?php echo $rs['ParentEmail']; ?>
    </div>
    <div class='col-xs-2 well'>
      <?php echo $rs['StudentName']; ?>
    </div>
    <div class='col-xs-1 well'>
      <?php echo $rs['Age']; ?>
    </div>
    <div class='col-xs-1 well'>
      <?php echo $rs['YearsDesired']; ?>
    </div>
    <div class='col-xs-2 well'>
      <?php echo date("F j, Y",strtotime($rs['WaitlistDate'])); ?>
    </div>
  </div>
  <?php
  }
?>
  </div>
</div>
<?php
}
// display 3 day waitlist
else if ($variables['report'] == 'Waitlist3Day')
{
  ?>
    <div class='container'>
      <div class='container-fluid'>
        <div class='row'>
          <div class='col-xs-12 text-center'>
            <h2>Wait List for 3 Days</h2>
          </div>
        </div>
        <div class='row'>
          <div class='col-xs-3'>
            Parent Name:
          </div>
          <div class='col-xs-3'>
            Parent Email:
          </div>
          <div class='col-xs-2'>
            Student Name:
          </div>
          <div class='col-xs-1'>
            Student Age:
          </div>
          <div class='col-xs-1'>
            Years Desired:
          </div>
          <div class='col-xs-2'>
            Years Desired:
          </div>
        </div>
  <?php

    $ssq = "select * from Waitlist where 3DaySchool=1";
    $rq = $conn->query($ssq);
    while ($rs = sql_assoc($rq))
    {
    ?>
    <div class='row' id='contact-<?php echo $rs['WaitlistID']; ?>'>
      <div class='col-xs-3 well'>
        <span class="glyphicon glyphicon-remove" style="color: #b20000; cursor: pointer;" onclick="remove_waitlist('<?php echo $rs['WaitlistID']; ?>');"></span> &nbsp; &nbsp; <a href="waitlist_edit.php?WaitlistID=<?php echo $rs['WaitlistID']; ?>"><span class="glyphicon glyphicon-pencil" style="color: green;"></span></a> <?php echo $rs['ParentName']; ?>
      </div>
      <div class='col-xs-3 well'>
        <?php echo $rs['ParentEmail']; ?>
      </div>
      <div class='col-xs-2 well'>
        <?php echo $rs['StudentName']; ?>
      </div>
      <div class='col-xs-1 well'>
        <?php echo $rs['Age']; ?>
      </div>
      <div class='col-xs-1 well'>
        <?php echo $rs['YearsDesired']; ?>
      </div>
      <div class='col-xs-2 well'>
        <?php echo date("F j, Y",strtotime($rs['WaitlistDate'])); ?>
      </div>
    </div>
    <?php
    }
  ?>
    </div>
  </div>
  <?php
}
// display create class form
else if ($variables['report'] == 'CreateClass')
{
  if ($variables['form_submit'] == "Create Class")
  {
    $className   = sql_safe($variables['ClassName']);
    $numStudents = sql_safe($variables['NumberStudents']);
    $regCode     = sql_safe($variables['RegistrationCode']);
    $ssq = "select * from Class where RegistrationCode='$regCode'";
    $rq = $conn->query($ssq);
    $a = sql_array($rq);
    if (isset($a['ClassID']))
    {
      echo "
      <div class='row'>
        <div class='col-xs-3'>
        </div>
        <div class='col-xs-6 alert alert-danger'>
          <span class='glyphicon glyphicon-ok'></span> &nbsp; &nbsp;The registration code <b>". htmlspecialchars($regCode). "</b> is already in use. Please select another.</b>
        </div>
        <div class='col-xs-3'></div>
      </div>";
    }
    else
    {
      $saq = "insert into Class (ClassName, ClassSize, RegistrationCode)
              values ('$className', '$numStudents', '$regCode')";
      $rq = $conn->query($saq);

      echo "
      <div class='row'>
        <div class='col-xs-3'>
        </div>
        <div class='col-xs-6 alert alert-success'>
          <span class='glyphicon glyphicon-ok'></span> &nbsp; &nbsp;A new class has been created. The registration code is <b>". htmlspecialchars($regCode). "</b>
        </div>
        <div class='col-xs-3'></div>
      </div>";
    }
  }
  else
  {
?>
<div class='container'>
  <div class='container-fluid'>
    <form action='reports.php'>
      <input type="hidden" name="report" value="CreateClass">
      <div class='row'>
        <div class='col-xs-12 text-center'>
          <h2>Create a New Class</h2>
        </div>
      </div>
      <div class='row'>
        <div class='col-xs-3 text-right loginInputMatch'>
          Class Name:
        </div>
        <div class='col-xs-6'>
          <input type="text" name="ClassName" class="formInput" required>
        </div>
        <div class='col-xs-3'></div>
      </div>
      <div class='row'>
        <div class='col-xs-3 text-right loginInputMatch'>
          Number of Students:
        </div>
        <div class='col-xs-6'>
          <input type="text" name="NumberStudents" class="formInput" required>
        </div>
        <div class='col-xs-3'></div>
      </div>
      <div class='row'>
        <div class='col-xs-3 text-right loginInputMatch'>
          Registration Code:
        </div>
        <div class='col-xs-6'>
          <input type="text" name="RegistrationCode" class="formInput" required>
        </div>
        <div class='col-xs-3'></div>
      </div>
      <div class='row'>
        <div class='col-xs-3'></div>
        <div class='col-xs-9'>
          <input type="submit" class="btn btn-success" value="Create Class" name='form_submit'>
        </div>
      </div>
    </form>
  </div>
</div>

<?php
  }
}
// display list of classes
else if ($variables['report'] == 'DisplayClasses')
{
?>
<div class='container'>
  <div class='container-fluid'>
    <div class='row'>
      <div class='col-xs-12 text-center'>
        <h2>Display Classes</h2>
      </div>
    </div>
    <div class='row'>
      <div class='col-xs-3'>
        Class Name:
      </div>
      <div class='col-xs-3'>
        Number of Possible Students:
      </div>
      <div class='col-xs-3'>
        # Students Enrolled:
      </div>
      <div class='col-xs-3'>
        Registration Code:
      </div>
    </div>
<?php

  $ssq = 'SELECT Class.ClassID, ClassName, ClassSize, RegistrationCode, COUNT(Students.ClassID) as CountStudents
          FROM Class LEFT JOIN Students on Class.ClassID=Students.ClassID GROUP BY Class.ClassID';
  $rq = $conn->query($ssq);
  while ($rs = sql_assoc($rq))
  {
    $allow = '';
    if ($rs['CountStudents'] != 0)
      $allow = "<span class='glyphicon glyphicon-remove' style='color: lightgrey; cursor: pointer;' data-toggle='tooltip' title='Cannot remove classes that have students in them.'></span>";
    else
      $allow = "<span class='glyphicon glyphicon-remove' style='color: #b20000; cursor: pointer;' onclick=\"remove_class('". $rs['ClassID']. "');\"></span>";
    ?>
    <div class='row' id='class-<?php echo $rs['ClassID'] ?>'>
      <div class='col-xs-3 well'>
         <?php echo $allow; ?> &nbsp; <a href="class_code_edit.php?ClassID=<?php echo $rs['ClassID']; ?>"><span class="glyphicon glyphicon-pencil" style="color: green;"></span></a> <a href='reports.php?Class=<?php echo $rs['ClassID']; ?>'><?php echo $rs['ClassName']; ?></a>
      </div>
      <div class='col-xs-3 well'>
        <?php echo $rs['ClassSize']; ?>
      </div>
      <div class='col-xs-3 well'>
        <?php echo $rs['CountStudents']; ?>
      </div>
      <div class='col-xs-3 well'>
        <?php echo $rs['RegistrationCode']; ?>
      </div>
    </div>
    <?php
  }
  echo "</div>\n</div>";
  exit;

}
// display a specific class
else if ($variables['Class'] != '')
{
  $ssq = 'select ClassName from Class where ClassID='. $variables['Class'];
  $rq = $conn->query($ssq);
  $rs = sql_assoc($rq);
?>
  <div class='container'>
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-xs-12 text-center'>
          <h2>Displaying Class: <?php echo $rs['ClassName']; ?></h2>
        </div>
      </div>
      <div class='row'>
        <div class='col-xs-3'>
          Student Name:
        </div>
        <div class='col-xs-3'>
          Birthday:
        </div>
        <div class='col-xs-3'>
          Gender:
        </div>
        <div class='col-xs-3'>
          Additional Info:
        </div>
      </div>
<?php
  $ssq = 'select * from Students where ClassID='. $variables['Class'];
  $rq = $conn->query($ssq);
  while ($rs = sql_assoc($rq))
  {
    //echo '<pre>'; print_r($rs); echo '</pre>';
    $name   = $rs['FirstName']. ' '. $rs['LastName'];
    $gender = $rs['Gender'] == '1' ? 'Boy' : 'Girl';

    $infoDiv = '';
    $params = http_build_query($rs);
    $rs['Edit'] = "<a href='student_edit.php?$params';>Edit</a>";
    foreach ($rs as $key => $value)
    {
      $skip = 'no';
      switch ($key)
      {
        case 'StudentID':
        case 'ClassID':
        case 'ClassType':
                      $skip = 'yes';
        case 'ParentID':
                      $ssq2 = "select FirstName, LastName, ParentID from Parents where ParentID=$value";
                      $rq2 = $conn->query($ssq2);
                      $rs2 = sql_assoc($rq2);
                      $key = 'Parent Name';
                      $value = "<a href='reports.php?ParentID=". $rs2['ParentID']. "'>". $rs2['FirstName']. " ". $rs2['LastName']. "</a>";
                      break;
        case 'ContactID':
                      $ssq2 = "select FirstName, LastName, ContactID from EmergencyContact where ContactID=$value";
                      $rq2 = $conn->query($ssq2);
                      $rs2 = sql_assoc($rq2);
                      $key = 'Emergency Contact';
                      $value = "<a href='reports.php?ContactID=". $rs2['ContactID']. "'>". $rs2['FirstName']. " ". $rs2['LastName']. "</a>";
                      break;
        case 'Gender':
                      $value = $gender;
                      break;
        case 'FieldTrips':
        case 'OnSitePictures':
        case 'Medicine':
        case 'AwareOfPhysical':
        case 'Water':
        case 'OffSitePictures':
                      $value = $value ? 'Yes' : 'No' ;
                      break;
        case 'DominantHand':
                      $value = $value == '1' ? 'Right' : 'Left';
      }

      if ($skip != 'yes')
      {
        $infoDiv .= "<div class='col-xs-6'>
                  <div class='col-xs-6 text-right'>
                    <b>$key:</b>
                  </div>
                  <div class='col-xs-6'>
                    $value
                  </div>
                </div>";
      }
    }
  ?>
    <div class='row' onclick="show_student_info('<?php echo $rs['StudentID']; ?>')" style="cursor: pointer;" id='student-<?php echo $rs['StudentID']; ?>'>
      <div class='col-xs-3 well'>
        <span class="glyphicon glyphicon-remove" style="color: #b20000; cursor: pointer;" onclick="remove_student('<?php echo $rs['StudentID']; ?>');"></span> <?php echo $name; ?>
      </div>
      <div class='col-xs-3 well'>
        <?php echo $rs['Birthday']; ?>
      </div>
      <div class='col-xs-3 well'>
        <?php echo $gender; ?>
      </div>
      <div class='col-xs-3 well'>
        <?php echo $rs['AdditionalInfo']; ?>
      </div>
    </div>
    <div class='row well' style='display: none;' id='<?php echo $rs['StudentID']; ?>'>
      <?php echo $infoDiv; ?>
    </div>

  <?php
  }
?>
    </div>
  </div>
<?php
}
// display a parent
else if ($variables['ParentID'] != '')
{
  $ssq = "select * from Parents where ParentID=". $variables['ParentID'];
  $rq = $conn->query($ssq);
  $rs = sql_assoc($rq);
?>
  <div class='container'>
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-xs-12 text-center'>
          <h2>Parent Display</h2>
        </div>
      </div>
      <div class='row'>
        <div class='col-xs-3'>
          Name(s):
        </div>
        <div class='col-xs-3'>
          Email:
        </div>
        <div class='col-xs-3'>
          Phone Numbers:
        </div>
        <div class='col-xs-3'>
          Address:
        </div>
      </div>
      <div class='row'>
        <div class='col-xs-3 well'>
          <a href="parent_edit.php?ParentID=<?php echo $variables['ParentID']; ?>"><span class="glyphicon glyphicon-pencil" style="color: green;"></span></a>
          <?php
            echo $rs['FirstName']. ' '. $rs['LastName']. '<br>';
            echo $rs['FirstName2']. ' '. $rs['LastName2'];
          ?>
        </div>
        <div class='col-xs-3 well'>
          <?php echo $rs['Email']; ?>
        </div>
        <div class='col-xs-3 well'>
          <?php echo $rs['Phone1']; ?>
        </div>
        <div class='col-xs-3 well'>
          <?php
            echo $rs['Address']. '<br>';
            echo $rs['City']. ', '. $rs['State']. ' '. $rs['ZipCode'];
          ?>
        </div>
      </div>
    </div>
  </div>
<?php
}
// display an emergency contact
else if ($variables['ContactID'] != '')
{
  $ssq = "select * from EmergencyContact where ContactID=". $variables['ContactID'];
  $rq = $conn->query($ssq);
  $rs = sql_assoc($rq);
?>
  <div class='container'>
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-xs-12 text-center'>
          <h2>Emergency Contact</h2>
        </div>
      </div>
      <div class='row'>
        <div class='col-xs-3'>
          Name:
        </div>
        <div class='col-xs-3'>
          Relationship:
        </div>
        <div class='col-xs-3'>
          Phone Number:
        </div>
        <div class='col-xs-3'>
          Address:
        </div>
      </div>
      <div class='row'>
        <div class='col-xs-3 well'>
          <a href="emergency_contact_edit.php?ContactID=<?php echo $variables['ContactID']; ?>"><span class="glyphicon glyphicon-pencil" style="color: green;"></span></a>
          <?php
            echo $rs['FirstName']. ' '. $rs['LastName'];
          ?>
        </div>
        <div class='col-xs-3 well'>
          <?php echo $rs['Relationship']; ?>
        </div>
        <div class='col-xs-3 well'>
          <?php
            echo $rs['Phone'];
          ?>
        </div>
        <div class='col-xs-3 well'>
          <?php
            echo $rs['Address']. '<br>';
            echo $rs['City']. ', '. $rs['State']. ' '. $rs['ZipCode'];
          ?>
        </div>
      </div>
    </div>
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
