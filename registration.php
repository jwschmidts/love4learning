<?php
$var = $_GET;
$err = '';
if ($var['Code'] == 'e1')
{
  $err = "<div style='color: #D8000C; background-color: #FFBABA; boarder-radius: 5px;'>
             &nbsp; &nbsp; Invalid registration code entered, please try again.
          </div>";
 }
?>
<h1>Student Registration Form</h1>
<?php echo $err; ?>
<form action="/l4l/registration_action.php" method="Get">
Registration Code: <input name="Code" type="text" required />
<h2>Student Information</h2>
First name:
<input name="fname" type="text" value="<?php echo $var['fname']; ?>" required/>

Last name:
<input name="lname" type="text" value="<?php echo $var['lname']; ?>" required/>

Name that student goes by:
<input name="nickName" type="text" value="<?php echo $var['nickName']; ?>" required/>

School Year:
<input name="schoolYear" type="text" value="<?php echo $var['schoolYear']; ?>" required/>

Two Day Session<input name="SessionType" type="radio" value="2Day" required/>        Three Day Session<input name="SessionType" type="radio" value="3Day" required/>

Date of Birth:
<select name="BMonth" required>
  <option selected disabled>Month</option>
  <option value='January'>January</option>
  <option value='February'>February</option>
  <option value='March'>March</option>
  <option value='April'>April</option>
  <option value='May'>May</option>
  <option value='June'>June</option>
  <option value='July'>July</option>
  <option value='August'>August</option>
  <option value='September'>September</option>
  <option value='October'>October</option>
  <option value='November'>November</option>
  <option value='December'>December</option>
</select>
<select name="BDay" required>
  <option selected disabled>Month</option>
  <option value='1'>1</option>
  <option value='2'>2</option>
  <option value='3'>3</option>
  <option value='4'>4</option>
  <option value='5'>5</option>
  <option value='6'>6</option>
  <option value='7'>7</option>
  <option value='8'>8</option>
  <option value='9'>9</option>
  <option value='10'>10</option>
  <option value='11'>11</option>
  <option value='12'>12</option>
  <option value='13'>13</option>
  <option value='14'>14</option>
  <option value='15'>15</option>
  <option value='16'>16</option>
  <option value='17'>17</option>
  <option value='18'>18</option>
  <option value='19'>19</option>
  <option value='20'>20</option>
  <option value='21'>21</option>
  <option value='22'>22</option>
  <option value='23'>23</option>
  <option value='24'>24</option>
  <option value='25'>25</option>
  <option value='26'>26</option>
  <option value='27'>27</option>
  <option value='28'>28</option>
  <option value='29'>29</option>
  <option value='30'>30</option>
  <option value='31'>31</option>
</select>
<select name="BYear" required>
  <option selected disabled>Year</option>
<?php
$currYear = date('Y');
for ($i=2;$i<7;$i++)
{
  $d = $currYear - $i;
  echo "<option value='$d'>$d</option>";
}
?>
</select>

Age of Child:
<input name="Age" type="text" value="<?php echo $var['Age']; ?>" required/>

Age of Child after first day of Preschool:
<input name="AgeFirstDay" type="text" value="<?php echo $var['AgeFirstDay']; ?>" required/>

Boy <input name="Gender" type="radio" value="Boy" required/>                       Girl <input name="Gender" type="radio" value="Girl" />

Right Handed<input name="DominantHand" type="radio" value="RightHand" required/>      Left Handed <input name="DominantHand" type="radio" value="LeftHand" />

Additional Information about the child (i.e. food allergies, health issues, etc.):
<input name="AdditionalInfo" type="text" value="<?php echo $var['AdditionalInfo']; ?>" />

How many years would you like your child to attend Love 4 Learning Preschool?

One Year<input name="LengthInSchool" type="radio" value="1" required/>            Two Years<input name="LengthInSchool" type="radio" value="2" />
<h2>Parent Information</h2>
Parent #1:
First Name <input name="ParentFirstName1" type="text" value="<?php echo $var['ParentFirstName1']; ?>" required/>

Last Name <input name="ParentLastName1" type="text" value="<?php echo $var['ParentLastName1']; ?>" required/>

Parent #2: (Optional)
First Name <input name="ParentFirstName2" type="text" value="<?php echo $var['ParentFirstName2']; ?>" />

Last Name <input name="ParentLastName2" type="text" value="<?php echo $var['ParentLastName2']; ?>" />

Phone (home):
<input name="Phone" type="text" value="<?php echo $var['Phone']; ?>" required/>
(work)
<input name="WorkPhone" type="text" value="<?php echo $var['WorkPhone']; ?>" />
(cell)
<input name="CellPhone" type="text" value="<?php echo $var['CellPhone']; ?>" />

E-Mail:
<input name="Email" type="email" value="<?php echo $var['Email']; ?>" required/>

Do you regularly check email?  &nbsp;  Yes <input name="CheckEmail" type="radio" value="Yes" /> &nbsp;   No <input name="CheckEmail" type="radio" value="No" />

Address:
<input name="Address" type="text" value="<?php echo $var['Address']; ?>" required/>

City:
<input name="City" type="text" value="<?php echo $var['City']; ?>" required/>

State:
<input name="State" type="text" value="<?php echo $var['State']; ?>" required/>

Zip Code:
<input name="Zip" type="text" value="<?php echo $var['Zip']; ?>" required/>

Hobbies or professions you would be willing to share with the class (i.e. dentist, policeman, foreign country, etc.):
<input name="Hobbies" type="text" value="<?php echo $var['Hobbies']; ?>" />
<h2>Emergency Contact</h2>
First Name:
<input name="EmergencyFirstName" type="text" value="<?php echo $var['EmergencyFirstName']; ?>" required/>

Last Name:
<input name="EmergencyLastName" type="text" value="<?php echo $var['EmergencyLastName']; ?>" required/>

Relationship:
<input name="EmergencyRelationship" type="text" value="<?php echo $var['EmergencyRelationship']; ?>" required/>

Phone:
<input name="EmergencyPhone" type="text" value="<?php echo $var['EmergencyPhone']; ?>" required/>

Address:
<input name="EmergencyAddress" type="text" value="<?php echo $var['EmergencyAddress']; ?>" required/>

City:
<input name="EmergencyCity" type="text" value="<?php echo $var['EmergencyCity']; ?>" required/>

State:
<input name="EmergencyState" type="text" value="<?php echo $var['EmergencyState']; ?>" required/>

Zip Code:
<input name="EmergencyZip" type="text" value="<?php echo $var['EmergencyZip']; ?>" required/>

<h2>Waiver</h2>

I, <input style="width: 100px;" name="WavierName" type="text" value="<?php echo $var['WaiverName']; ?>" required/> (name parent or legal gaurding), for myself and for my child, agree to all of the following.
<ol>
 	<li>I wish to enroll my child in Love 4 Learning Preschool</li>
 	<li>I realize that while attending Love 4 Learning Preschool that my child will be supervised by a teacher or assistant teacher during the time they are at school. I understand that Love 4 Learning Preschool has attempted to create a injury free play area for my child; however, I acknowledge that young children may get hurt while playing with other children and while engaging in physical activities, and that there is a risk of property damage, serious injury or death inherent in my child participating in preschool classes and activities. I also understand that there are risks inherent in any physical activity program, including the use of equipment such as those provided for use at Love 4 Learning Preschool which may or may not be obvious and which may pose serious threats to any person if used improperly.</li>
 	<li>In the event my child become injured while participating in activities, I hereby consent to Love 4 Learning Preschool to provide First Aid as well as summing medical professionals to administer First Aid or emergency medical treatment form my child.</li>
 	<li>I agree to follow any instructions or rules established by Love 4 Learning Preschool with regard to my child’s activities, whether written or orally given by Love 4 Learning Preschool.</li>
 	<li>I understand that every child is in a unique developmental stage and that I am most familiar with my child’s capabilities and limitations. As such, I agree to discuss any concerns with Love 4 Learning Preschool that I have about my child which I think may affect my child’s ability to safely participate in any activities or to use any equipment.</li>
</ol>
(Please Check all boxes that apply)

<input name="Physical" type="radio" value="unaware" /> I am not aware of any physical or other condition which
may affect my child's ability to participate in any activity at Love 4 Learning Preschool

<input name="Physical" type="radio" value="aware" /> I am aware my child suffers from the following physical or other conditions which may affect their involvement at Love 4 Learning Preschool:
(List any physical impairments of any child who will be participating in Love 4 Learning Preschool classes.)
<input name="WaiverChildNameAware" type="text" value="<?php echo $var['WaiverChildNameAware']; ?>" />

<ol start="6">
 	<li>I agree not to hold Love 4 Learning Preschool as its entirety responsible for any injuries suffered by my child while involved in activities at preschool.</li>
 	<li>I agree to RELEASE, DISCHARGE, IDEMNIFY, PROMISE NOT TO SUE, AND TO SAVE AND HOLD HARMLESS Love 4 Learning Preschool as its entirety form liability, damage, or costs whatsoever arising out of or related to any loss, damage, or injury (including death) to me or my child arising out of or in any way connected with participation in the activities of Love 4 Learning Preschool for any reason or cause.</li>
 	<li>I understand and agree that this release and waiver of liability, assumption of risk, and hold harmless agreement is governed by the laws of the State of Utah, and is intended to be as broad and inclusive as is permitted by such law, and that, in the event of any portion of this agreement is determined to be invalid, illegal, or unenforceable, the validity, legality, and enforceability of the balance of the agreement shall not be affected or impaired in any way, and shall continue to full legal force and effect. This release and waiver of liability shall be enforced and interpreted only by binding arbitration in Cache County.</li>
</ol>
<h2>Parent/Guardian Authorization</h2>

Please list any restrictions to permission of the following:

<input name="FieldTrip" type="checkbox" /> My child may be taken on field trips or excursions by bus or private motor vehicle, as well as on neighborhood walking excursions under required supervision

<input name="Water" type="checkbox" /> My child may participate in swimming or other water activities under required supervision.

My child may be photographed for publicity or news purposes
<input name="PhotographOnSite" type="checkbox" /> on-site
<input name="PhotographOffSite" type="checkbox"  /> off-site

<input name="Medicine" type="checkbox" />My child may be given non-prescribed medication as indicated on the container. This may include sunscreen, children's pain reliever, antibacterial first aid cream, syrup or ipecac may be administered if deemed necessary by poison control operator. The child's parent or gaurdian will be contacted prior to administering non-prescribed pain relievers. Prescription medications must be current and a permission slip is required per each medication.

In an emergency, Love 4 Learning Preschool has my permission to call an ambulance, or take my child to any available physician or hospital at my expense to obtain medical treatment. In most emergencies, 911 is called and the child is transported to the nearest hospital and treated by the on-call physician. The Parent or gaurdian of the child is notified as soon as possible.

I HAVE READ THIS DOCUMENT AND AGREE TO ALL OF ITS TERMS. I UNDERSTAND IT IS A LEGALLY BINDING AGREEMENT AND WAIVES CERTAIN LEGAL RIGHTS OF MINE, INCLUDING, BUT NOT LIMITED TO A RELEASE, WAIVER, PROMISE NOT TO SUE, AND A HOLD HARMLESS FOR ALL CLAIMS. THIS AGREEMENT SHALL BE BINDING UPON MYSELF, MY CHILD, AND OUR ESTATE, SUCCESSORS AND ASSIGNS.

<input name="PottyTrained" type="checkbox" required/> I understand my child must be 3 by July 1st and is FULLY potty trained
<input name="Sign" type="checkbox" value="1" required/> By checking this box I agree that I have filled out this form to the best of my ability and agree with all that has been stated.
Parent/Gaurdian Printed Name:
<input name="PrintedName" type="text" value="<?php echo $var['PrintedName']; ?>" required/>

<input type="submit" value="Submit" />

</form>
