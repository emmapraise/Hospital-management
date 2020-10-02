<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
include("header.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE doctor SET doctorname='$_POST[doctorname]',mobileno='$_POST[mobilenumber]',departmentid='$_POST[select3]',loginid='$_POST[loginid]',password='$_POST[password]',status='$_POST[select]',education='$_POST[education]',experience='$_POST[experience]',consultancy_charge='$_POST[consultancy_charge]' WHERE doctorid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('doctor record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO doctor(doctorname,mobileno,departmentid,loginid,password,status,education,experience,consultancy_charge) values('$_POST[doctorname]','$_POST[mobilenumber]','$_POST[select3]','$_POST[loginid]','$_POST[password]','Active','$_POST[education]','$_POST[experience]','$_POST[consultancy_charge]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('Doctor record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM doctor WHERE doctorid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}

?>

				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Add New Doctor</h3>
							</div>
							<div class="module-body">

									<form class="form-horizontal row-fluid" method="post" action="" name="frmdoct" onsubmit="return validateform()">
										<div class="control-group">
											<label class="control-label" for="basicinput">Doctor Name</label>
											<div class="controls">
												<input type="text" id="basicinput" placeholder="Enter Doctor Name..." class="span8" name="doctorname" value="<?php echo $rsedit[doctorname]; ?>">
												
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
											<label class="control-label" for="basicinput">Consultancy Charge</label>
											<div class="controls">
												<div class="input-prepend">
													<span class="add-on"><span class="icon-money"></span></span><input class="span8" type="text" placeholder="Consultancy Chrge" name="consultancy_charge" value="<?php echo $rsedit[consultancy_charge]; ?>">       
												</div>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Department</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." class="span8" name="select3">
													<option value="">Select here..</option>
			<?php
		  	$sqldepartment= "SELECT * FROM department WHERE status='Active'";
			$qsqldepartment = mysqli_query($con,$sqldepartment);
			while($rsdepartment=mysqli_fetch_array($qsqldepartment))
			{
				if($rsdepartment[departmentid] == $rsedit[departmentid])
				{
	echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
				}
				else
				{
  echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
				}
				
			}
		  ?>
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Doctor Login ID</label>
											<div class="controls">
												<input type="text" id="basicinput" placeholder="Enter Patient Login ID..." class="span8" name="loginid" value="<?php echo $rsedit[loginid]; ?>">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Password</label>
											<div class="controls">
												<input type="password" id="basicinput" placeholder="Enter password..." class="span8" name="password" value="<?php echo $rsedit[password]; ?>">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Confrim Password</label>
											<div class="controls">
												<input type="password" id="basicinput" placeholder="Enter password..." class="span8" name="cnfirmpassowrd" value="<?php echo $rsedit[password]; ?>">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Doctor Education</label>
											<div class="controls">
												<input type="text" id="basicinput" placeholder="Enter Education..." class="span8" name="education" value="<?php echo $rsedit[education]; ?>">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Doctor Experience</label>
											<div class="controls">
												<input type="text" id="basicinput" placeholder="Enter Experience..." class="span8" name="experience" value="<?php echo $rsedit[experience]; ?>">
												
											</div>
										</div>


										<div class="control-group">
											<label class="control-label" for="basicinput">Status</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." class="span8" name="select">
													<option value="">Select here..</option>
			<?php
		  $arr= array("Active","Inactive");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[status])
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
	if(document.frmdoct.doctorname.value == "")
	{
		alert("Doctor name should not be empty..");
		document.frmdoct.doctorname.focus();
		return false;
	}
	else if(!document.frmdoct.doctorname.value.match(alphaspaceExp))
	{
		alert("Doctor name not valid..");
		document.frmdoct.doctorname.focus();
		return false;
	}
	else if(document.frmdoct.mobilenumber.value == "")
	{
		alert("Mobile number should not be empty..");
		document.frmdoct.mobilenumber.focus();
		return false;
	}
	else if(!document.frmdoct.mobilenumber.value.match(numericExpression))
	{
		alert("Mobile number not valid..");
		document.frmdoct.mobilenumber.focus();
		return false;
	}
	else if(document.frmdoct.select3.value == "")
	{
		alert("Department ID should not be empty..");
		document.frmdoct.select3.focus();
		return false;
	}
	else if(document.frmdoct.loginid.value == "")
	{
		alert("loginid should not be empty..");
		document.frmdoct.loginid.focus();
		return false;
	}
	else if(!document.frmdoct.loginid.value.match(alphanumericExp))
	{
		alert("loginid not valid..");
		document.frmdoct.loginid.focus();
		return false;
	}
	else if(document.frmdoct.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.password.value != document.frmdoct.cnfirmpassword.value )
	{
		alert("Password and confirm password should be equal..");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.education.value == "")
	{
		alert("Education should not be empty..");
		document.frmdoct.education.focus();
		return false;
	}
	else if(!document.frmdoct.education.value.match(alphaExp))
	{
		alert("Education not valid..");
		document.frmdoct.education.focus();
		return false;
	}
	else if(document.frmdoct.experience.value == "")
	{
		alert("Experience should not be empty..");
		document.frmdoct.experience.focus();
		return false;
	}
	else if(!document.frmdoct.experience.value.match(numericExpression))
	{
		alert("Experience not valid..");
		document.frmdoct.experience.focus();
		return false;
	}
	else if(document.frmdoct.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmdoct.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
</body>