<?php
$var = $_GET;
?>
<h1>Student Registration Form</h1>

<form action="/registration_action.php" method="Get">
<h2>Student Information</h2>
First name:
<input name="fname" type="text" value="<?php echo $var['fname']; ?>" />

Last name:
<input name="lname" type="text" value="<?php echo $var['lname']; ?>" />

Name that student goes by:
<input name="nickName" type="text" value="<?php echo $var['nickName']; ?>" />

School Year:
<input name="schoolYear" type="text" value="<?php echo $var['schoolYear']; ?>" />

Two Day Session
<input name="SessionType" type="radio" value="2Day" <?php echo $var['2Day']; ?>/>

Three Day Session
<input name="SessionType" type="radio" value="3Day" <?php echo $var['3Day']; ?>/>

Date of Birth:
<input name="DateOfBirth" type="text" value="<?php echo $var['DateOfBirth']; ?>" />

Age of Child:
<input name="Age" type="text" value="<?php echo $var['Age']; ?>" />

Age of Child after first day of Preschool:
<input name="AgeFirstDay" type="text" value="<?php echo $var['AgeFirstDay']; ?>" />

Boy
<input name="Gender" type="radio" value="Boy" <?php echo $var['Boy']; ?>/>

Girl
<input name="Gender" type="radio" value="Girl" <?php echo $var['Girl']; ?>/>

Right Handed
<input name="DominantHand" type="radio" value="RightHand" <?php echo $var['RightHand']; ?>/>

Left Handed
<input name="DominantHand" type="radio" value="LeftHand" <?php echo $var['LeftHand']; ?>/>

Additional Information about the child (i.e. food allergies, health issues, etc.):
<input name="AdditionalInfo" type="text" value="<?php echo $var['AdditionalInfo']; ?>" />

How many years would you like your child to attend Love 4 Learning Preschool?

One Year
<input name="LengthInSchool" type="radio" value="OneYear" <?php echo $var['OneYear']; ?>/>

Two Years
<input name="LengthInSchool" type="radio" value="TwoYears" <?php echo $var['TwoYears']; ?>/>
<h2>Parent Information</h2>
Parent #1:
First Name<input name="ParentFirstName1" type="text" value="<?php echo $var['ParentFirstName1']; ?>" />

Last Name<input name="ParentLastName1" type="text" value="<?php echo $var['ParentLastName1']; ?>" />

Parent #2: (Optional)
First Name<input name="ParentFirstName2" type="text" value="<?php echo $var['ParentFirstName2']; ?>" />

Last Name<input name="ParentLastName2" type="text" value="<?php echo $var['ParentLastName2']; ?>" />

Phone (home):
<input name="Phone" type="text" value="<?php echo $var['Phone']; ?>" />
(work)
<input name="WorkPhone" type="text" value="<?php echo $var['WorkPhone']; ?>" />
(cell)
<input name="CellPhone" type="text" value="<?php echo $var['CellPhone']; ?>" />


E-Mail:
<input name="Email" type="text" value="<?php echo $var['Email']; ?>" />

Do you check email?
<input name="CheckEmail" type="checkbox" value="CheckEmail" />>

Address:
<input name="Address" type="text" value="<?php echo $var['Address']; ?>" />

City:
<input name="City" type="text" value="<?php echo $var['City']; ?>" />

State:
<input name="State" type="text" value="<?php echo $var['State']; ?>" />

Zip Code:
<input name="Zip" type="text" value="<?php echo $var['Zip']; ?>" />

Hobbies or professions you would be willing to share with the class (i.e. dentist, policeman, foreign country, etc.):
<input name="Hobbies" type="text" value="<?php echo $var['Hobbies']; ?>" />
<h2>Emergency Contact</h2>
First Name:
<input name="EmergencyFirstName" type="text" value="<?php echo $var['EmergencyFirstName']; ?>" />

Last Name:
<input name="EmergencyLastName" type="text" value="<?php echo $var['EmergencyLastName']; ?>" />

Phone:
<input name="EmergencyPhone" type="text" value="<?php echo $var['EmergencyPhone']; ?>" />

Address:
<input name="EmergencyAddress" type="text" value="<?php echo $var['EmergencyAddress']; ?>" />

City:
<input name="EmergencyCity" type="text" value="<?php echo $var['EmergencyCity']; ?>" />

State:
<input name="EmergencyState" type="text" value="<?php echo $var['EmergencyState']; ?>" />

Zip Code:
<input name="EmergencyZip" type="text" value="<?php echo $var['EmergencyZip']; ?>" />
<h2>I Understand (Please check box)</h2>
My child must be 3 by July 1st and is FULLY potty trained
<input name="PottyTrained" type="checkbox" value="PottyTrained" <?php echo $var['PottyTrained']; ?>/>



I, <input name="WavierName" type="text" value="<?php echo $var['WaiverName']; ?>" />
(name parent or legal gaurding), for myself and for my child,
agree to all of the following.
<ol>
 	<li>I wish to enroll my child in Love 4 Learning Preschool</li>
 	<li>I wish to enroll my child in Love 4 Learning Preschool</li>
 	<li>I wish to enroll my child in Love 4 Learning Preschool</li>
 	<li>I wish to enroll my child in Love 4 Learning Preschool</li>
 	<li>I wish to enroll my child in Love 4 Learning Preschool</li>
</ol>
(Please Check all boxes that apply)


<input name="PhysicalUnaware" type="checkbox" value="PhysicalUnaware" <?php echo $var['PhysicalUnaware']; ?>/>
I am not aware of any physical or other condition which
may affect my child
<input name="WaiverChildNameUnware" type="text" value="WaiverChildNameUnware"<?php echo $var['WaiverChildNameUnware']; ?> />
ability to participate in any activity at Love 4 Learning Preschool


<input name="PhysicalAware" type="checkbox" value="PhysicalAware"<?php echo $var['PhysicalAware']; ?> />
I am aware my child's
<input name="WaiverChildNameAware" type="text" value="<?php echo $var['WaiverChildNameAware']; ?>" />
suffers from the following physical or other conditions
which may affect their involvement at Love 4 Learning Preschool:
(List any physical impairments of any child who will be
participating in Love 4 Learning Preschool classes.)
<ol start="6">
 	<li>I agree not to hold Love 4 Learning Preschool, INC as it's entirety
responsible for any injuries suffered by my child while involved
in activities at preschool.</li>
 	<li>I agree not to hold Love 4 Learning Preschool, INC as it's entirety
responsible for any injuries suffered by my child while involved
in activities at preschool.</li>
 	<li>I agree not to hold Love 4 Learning Preschool, INC as it's entirety
responsible for any injuries suffered by my child while involved
in activities at preschool.</li>
</ol>
Parent/Guardian Authorization


Please list any restrictions to permission of the following:


<input name="Bus" type="checkbox" <?php echo $var['Bus']; ?>/>
My child may be taken on field trips or excursions by bus or
private motor vehicle, as well as on neighborhood walking
excursions under required supervision


<input name="Water" type="checkbox" <?php echo $var['Water']; ?>/>
My child may participate in swimming or other water
activities under required supervision.


<input name="Photgraph" type="checkbox" <?php echo $var['Photograph']; ?>/>
My child may be photographed for publicity or news purposes
<input name="vehicle" type="checkbox" value="Bike" /> on-site
<input name="vehicle" type="checkbox" value="Bike" /> off-site


<input name="Medicine" type="checkbox" <?php echo $var['Medicine']; ?>/>
My child may be given non-prescribed medication as indicated
on the container. This may include sunscreen, children's pain
reliever, antibacterial first aid cream, syrup or ipecac may
be administered if deemed necessary by poison control operator.
The child's parent or gaurdian will be contacted prior to
administering non-prescribed pain relievers. Prescription
medications must be current and a permission slip is required
per each medication.


In an emergency, Love 4 Learning Preschool has my permission
to call an ambulance, or take my child to any available physician
or hospital at my expense to obtain medical treatment. In most
emergencies, 911 is called and the child is transported to the
nearest hospital and treated by the on-call physician. The
Parent or gaurdian of the child is notified as soon as possible.


I HAVE READ THIS DOCUMENT AND AGREE TO ALL OF ITS TERMS. I
UNDERSTAND IT IS A LEGALLY BINDING AGREEMENT AND WAIVES CERTAIN
LEGAL RIGHTS OF MINE, INCLUDING, BUT NOT LIMITED TO A RELEASE,
WAIVER, PROMISE NOT TO SUE, AND A HOLD HARMLESS FOR ALL CLAIMS.
THIS AGREEMENT SHALL BE BINDING UPON MYSELF, MY CHILD, AND
OUR ESTATE, SUCCESSORS AND ASSIGNS.


<input name="Sign" type="checkbox" /> By checking this box I agree that I have filled out this form to the best of my ability and agree with all that has been stated.
Parent/Gaurdian Printed Name:
<input name="PrintedName" type="text" value="<?php echo $var['PrintedName']; ?>" />


Date:
<input name="Date" type="text" value="<?php echo $var['Date']; ?>" />


<input type="submit" value="Submit" />

</form>
