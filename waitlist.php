<?php
$var = $_GET;

if ($var['Code'] != 'e1')
{
  $err = "<div style='color: #D8000C; background-color: #FFBABA; boarder-radius: 5px;'>";
  if ($var['Code'] == 'e1')
    $err .= "&nbsp; &nbsp; The process was not successful, please try again.";
  $err .= "</div>";
}

?>
<form action='/l4l/waitlist_action.php'>
<div class = "form-style-1">
              Parents Name:<input name="ParentsName" type="text" value="<?php echo $var['ParentsName'];?>" required />
      	      Parents Email:<input name="ParentsEmail" type="email" value="<?php echo $var['ParentsEmail'];?>" required />
              Student's Name:<input name="StudentsName" type="text" value="<?php echo $var['StudentsName'];?>" required />
              Student's Age:<input name="StudentAge" type="number" min="2" max="5" step="1" value="3" value="<?php echo $var['StudentAge'];?>" required />
              Number of Years wishing to attend:
              1 Year:<input name="YearsToAttend" type="radio" value="1" <?php echo $var['YearsToAttend']; ?> required />  &nbsp; 2 Years:<input name="YearsToAttend" type="radio" value="2" <?php echo $var['ThreeDay']; ?>/>

             Would you like to come 2 or 3 times a week:

              2 Days:<input name="ClassType" type="radio" value="TwoDay" <?php echo $var['TwoDay']; ?>/>3 Days:<input name="ClassType" type="radio" value="ThreeDay" <?php echo $var['ThreeDay']; ?> required />

	      <input type="submit" value="Submit" class="submitButton btn-success">
	</div>
			</form>
