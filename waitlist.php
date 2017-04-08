<?php
$var = $_GET;
?>
<form action='/l4l/waitlist_action.php'>
<div class = "form-style-1">
              Parents Name:<input name="ParentsName" type="text" value="<?php echo $var['ParentsName'];?>"/>
	      Parents Email:<input name="ParentsEmail" type="text" value="<?php echo $var['ParentsEmail'];?>"/>
              Student's Name:<input name="StudentsName" type="text" value="<?php echo $var['StudentsName'];?>"/>
              Student's Age:<input name="StudentAge" type="text" value="<?php echo $var['StudentAge'];?>"/>
              Number of Years wishing to attend:<input name="YearsToAttend" type="text" value="<?php echo $var['YearsToAttend'];?>"/>
             Would you like to come 2 or 3 times a week:

              2 Days:<input name="ClassType" type="radio" value="TwoDay" <?php echo $var['TwoDay']; ?>/>3 Days:<input name="ClassType" type="radio" value="ThreeDay" <?php echo $var['ThreeDay']; ?>/>

	      <input type="submit" value="Submit" class="submitButton btn-success">
	</div>
			</form>
