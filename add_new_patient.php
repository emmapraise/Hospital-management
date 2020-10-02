<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
include("dbconnection.php");
include 'header.php';
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE patient SET patientname='$_POST[patientname]',admissiondate='$_POST[admissiondate]',admissiontime='$_POST[admissiontme]',address='$_POST[address]',mobileno='$_POST[mobilenumber]',city='$_POST[city]',pincode='$_POST[pincode]',loginid='$_POST[loginid]',password='$_POST[password]',bloodgroup='$_POST[select2]',gender='$_POST[select3]',dob='$_POST[dateofbirth]',status='$_POST[select]' WHERE patientid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('patient record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO patient(patientname,admissiondate,admissiontime,address,mobileno,city,pincode,loginid,password,bloodgroup,gender,dob,status) values('$_POST[patientname]','$dt','$tim','$_POST[address]','$_POST[mobilenumber]','$_POST[city]','$_POST[pincode]','$_POST[loginid]','$_POST[password]','$_POST[select2]','$_POST[select3]','$_POST[dateofbirth]','Active')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('patients record inserted successfully...');</script>";
		$insid= mysqli_insert_id($con);
		if(isset($_SESSION[adminid]))
		{
		echo "<script>window.location='appointment.php?patid=$insid';</script>";	
		}
		else
		{
		echo "<script>window.location='patientlogin.php';</script>";	
		}		
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM patient WHERE patientid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}

 ?>

				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Add New Patient</h3>
							</div>
							<div class="module-body">

									<form class="form-horizontal row-fluid" name="frmpatient" method="post" onsubmit="return validateform()">
										<div class="control-group">
						<label class="control-label" for="basicinput">Patient Name</label>
											<div class="controls">
			<input type="text" id="basicinput" name = "patientname" placeholder="Enter Patient Name..." value="<?php echo $rsedit[patientname]; ?>"  class="span8">
												
											</div>
										</div>

<?php 
if (isset($_GET[editid])) {
?>
									<div class="control-group">
											<label class="control-label" for="basicinput">Addmission Date</label>
											<div class="controls">
												<input type="date" id="basicinput" placeholder="" class="span8" name="admissiondate" value="<?php echo $rsedit[admissiondate]; ?>" readonly>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Addmission Time</label>
											<div class="controls">
												<input type="time" id="basicinput" placeholder="" class="span8" name="admissiontme" value="<?php echo $rsedit[admissiontime]; ?>" readonly>
											</div>
										</div>

		

<?php 
}
?>

										<div class="control-group">
											<label class="control-label" for="basicinput">Gender</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." class="span8" name="select3">
													<option value="">Select here..</option>
			<?php
		  $arr = array("MALE","FEMALE");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[gender])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
				  echo "<option value='$val'>$val</option>";			  
			  }
		  }
		  ?>
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Phone Number</label>
											<div class="controls">
												<div class="input-prepend">
													<span class="add-on">+234</span><input class="span8" type="text" placeholder="Phone Number" name="mobilenumber" value="<?php echo $rsedit[mobileno]; ?>">       
												</div>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Date Of Birth</label>
											<div class="controls">
												<input type="date" id="basicinput" placeholder="" class="span8" name="dateofbirth" value="<?php echo $rsedit[dob]; ?>" max="<?php echo date("Y-m-d"); ?>">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Blood Group</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." class="span8" name="select2">
													<option value="">Select here..</option>
													<?php
		  $arr = array("A+","A-","B+","B-","O+","O-","AB+","AB-");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[bloodgroup])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
				  echo "<option value='$val'>$val</option>";			  
			  }
		  }
		  ?>
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Patient City</label>
											<div class="controls">
												<input type="text" id="basicinput" placeholder="Enter Patient city..." class="span8" name="city" value="<?php echo $rsedit[city]; ?>">
												
											</div>
										</div>

										

										<div class="control-group">
											<label class="control-label" for="basicinput">PIN Code</label>
											<div class="controls">
												<input type="text" id="basicinput" placeholder="Enter Patient PIN Code..." class="span8" name="pincode" value="<?php echo $rsedit[pincode]; ?>">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Patient Login ID</label>
											<div class="controls">
												<input type="text" id="basicinput" placeholder="Enter Patient Login ID..." class="span8" name="loginid" value="<?php echo $rsedit[loginid]; ?>">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Patient password</label>
											<div class="controls">
												<input type="password" id="basicinput" placeholder="Enter Patient password..." class="span8" name="password" value="<?php echo $rsedit[password]; ?>">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Confrim Patient Password</label>
											<div class="controls">
												<input type="password" id="basicinput" placeholder="Enter Patient password..." class="span8" name="confirmpassword" value="<?php echo $rsedit[confirmpassword]; ?>">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Address</label>
											<div class="controls">
												<textarea class="span8" rows="5" name="address"><?php echo $rsedit[address]; ?></textarea>
											</div>
										</div>
										

										<div class="control-group">
											<div class="controls">
												<button type="submit" class="btn btn-success" name="submit">Submit</button>
											</div>
										</div>
									</form>
							</div>
						</div>

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	<?php include 'footer.php'; ?>
	<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmpatient.patientname.value == "")
	{
		alert("Patient name should not be empty..");
		document.frmpatient.patientname.focus();
		return false;
	}
else if(!document.frmpatient.patientname.value.match(alphaspaceExp))
	{
		alert("Patient name not valid..");
		document.frmpatient.patientname.focus();
		return false;
	}
	else if(document.frmpatient.admissiondate.value == "")
	{
		alert("Admission date should not be empty..");
		document.frmpatient.admissiondate.focus();
		return false;
	}
	else if(document.frmpatient.admissiontme.value == "")
	{
		alert("Admission time should not be empty..");
		document.frmpatient.admissiontme.focus();
		return false;
	}
	else if(document.frmpatient.address.value == "")
	{
		alert("Address should not be empty..");
		document.frmpatient.address.focus();
		return false;
	}
	else if(document.frmpatient.mobilenumber.value == "")
	{
		alert("Mobile number should not be empty..");
		document.frmpatient.mobilenumber.focus();
		return false;
	}
	else if(!document.frmpatient.mobilenumber.value.match(numericExpression))
	{
		alert("Mobile number not valid..");
		document.frmpatient.mobilenumber.focus();
		return false;
	}
	else if(document.frmpatient.city.value == "")
	{
		alert("City should not be empty..");
		document.frmpatient.city.focus();
		return false;
	}
	else if(!document.frmpatient.city.value.match(alphaspaceExp))
	{
		alert("City not valid..");
		document.frmpatient.city.focus();
		return false;
	}
	else if(document.frmpatient.pincode.value == "")
	{
		alert("Pincode should not be empty..");
		document.frmpatient.pincode.focus();
		return false;
	}
	else if(!document.frmpatient.pincode.value.match(numericExpression))
	{
		alert("Pincode not valid..");
		document.frmpatient.pincode.focus();
		return false;
	}
	else if(document.frmpatient.loginid.value == "")
	{
		alert("Login ID should not be empty..");
		document.frmpatient.loginid.focus();
		return false;
	}
	else if(!document.frmpatient.loginid.value.match(alphanumericExp))
	{
		alert("Login ID not valid..");
		document.frmpatient.loginid.focus();
		return false;
	}
	else if(document.frmpatient.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmpatient.password.focus();
		return false;
	}
	else if(document.frmpatient.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmpatient.password.focus();
		return false;
	}
	else if(document.frmpatient.password.value != document.frmpatient.confirmpassword.value )
	{
		alert("Password and confirm password should be equal..");
		document.frmpatient.confirmpassword.focus();
		return false;
	}
	else if(document.frmpatient.select2.value == "")
	{
		alert("Blood Group should not be empty..");
		document.frmpatient.select2.focus();
		return false;
	}
	else if(document.frmpatient.select3.value == "")
	{
		alert("Gender should not be empty..");
		document.frmpatient.select3.focus();
		return false;
	}
	else if(document.frmpatient.dateofbirth.value == "")
	{
		alert("Date Of Birth should not be empty..");
		document.frmpatient.dateofbirth.focus();
		return false;
	}
	else if(document.frmpatient.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmpatient.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
</body>