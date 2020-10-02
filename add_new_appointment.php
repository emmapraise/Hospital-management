<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("header.php");
error_reporting(0);
include("dbconnection.php");
if(isset($_POST[submit]))
{
		if(isset($_GET[editid]))
		{
			$sql ="UPDATE appointment SET patientid='$_POST[select4]',departmentid='$_POST[select5]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]',doctorid='$_POST[select6]',status='$_POST[select]' WHERE appointmentid='$_GET[editid]'";
			if($qsql = mysqli_query($con,$sql))
			{
				echo "<script>alert('appointment record updated successfully...');</script>";
			}
			else
			{
				echo mysqli_error($con);
			}	
		}
		else
		{
			$sql ="UPDATE patient SET status='Active' WHERE patientid='$_POST[select4]'";
			$qsql=mysqli_query($con,$sql);
			
			$sql ="INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason) values('$_POST[select4]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]','$_POST[appreason]')";
			if($qsql = mysqli_query($con,$sql))
			{
				
				include("insertbillingrecord.php");	
				echo "<script>alert('Appointment record inserted successfully...');</script>";
				echo "<script>window.location='patientreport.php?patientid=$_POST[select4]';</script>";
			}
			else
			{
				echo mysqli_error($con);
			}
		}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
 ?>

				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Add New Appointment</h3>
							</div>
							<div class="module-body">

									<form class="form-horizontal row-fluid" method="post" name="frmappnt" onsubmit="return validateform()">
<!-- <input type="hidden" name="select2" value="Offline"> -->
										<div class="control-group">
											<label class="control-label" for="basicinput">Patient</label>
											<div class="controls">
<?php
		  if(isset($_GET[patid]))
			{
				$sqlpatient= "SELECT * FROM patient WHERE patientid='$_GET[patid]'";
				$qsqlpatient = mysqli_query($con,$sqlpatient);
				$rspatient=mysqli_fetch_array($qsqlpatient);
				echo $rspatient[patientname] . " (Patient ID - $rspatient[patientid])";
				echo "<input type='hidden' name='select4' value='$rspatient[patientid]'>";
			}
			else
			{
		  ?>
												<select tabindex="1" data-placeholder="Select here.." class="span8" name="select4">
													<option value="">Select here..</option>
			<?php
                    $sqlpatient= "SELECT * FROM patient WHERE status='Active'";
                    $qsqlpatient = mysqli_query($con,$sqlpatient);
                    while($rspatient=mysqli_fetch_array($qsqlpatient))
                    {
                        if($rspatient[patientid] == $rsedit[patientid])
                        {
                        echo "<option value='$rspatient[patientid]' selected>$rspatient[patientid] - $rspatient[patientname]</option>";
                        }
                        else
                        {
                            echo "<option value='$rspatient[patientid]'>$rspatient[patientid] - $rspatient[patientname]</option>";
                        }
                        
                    }
                  ?>
												</select>
<?php
}
?>
											</div>
										</div>


										<div class="control-group">
											<label class="control-label" for="basicinput">Department</label>
											<div class="controls">
	<select tabindex="1" data-placeholder="Select here.." class="span8" name="select5">
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
											<label class="control-label" for="basicinput">Apointment Date</label>
											<div class="controls">
												<input type="date" id="basicinput" placeholder="" class="span8" name="appointmentdate" value="<?php echo $rsedit[appointmentdate]; ?>">
												
											</div>
										</div>


										<div class="control-group">
											<label class="control-label" for="basicinput">Apointment Time</label>
											<div class="controls">
												<input type="time" id="basicinput" placeholder="" class="span8" name="time" value="<?php echo $rsedit[appointmenttime]; ?>">
												
											</div>
										</div>

<?php
		if(isset($_SESSION[doctorid]))
		{
			echo "<input type='hidden' name='select6' value='$_SESSION[doctorid]' >";
		}
		else
		{
		?>
										
										<div class="control-group">
											<label class="control-label" for="basicinput">Doctor</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." class="span8" name="select6">
													<option value="">Select here..</option>
			<?php
          	$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
			$qsqldoctor = mysqli_query($con,$sqldoctor);
			while($rsdoctor = mysqli_fetch_array($qsqldoctor))
			{
				if($rsdoctor[doctorid] == $rsedit[doctorid])
				{
				echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[departmentname] ) </option>";
				}
				else
				{
				echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";				
				}
			}
		  ?>
												</select>
											</div>
										</div>

										<?php } ?>

										<div class="control-group">
											<label class="control-label" for="basicinput">Status</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Select here.." class="span8" name="select">
													<option value="">Select here..</option>
			<?php
		  $arr = array("Active","Inactive");
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
											<label class="control-label" for="basicinput">Reason</label>
											<div class="controls">
												<textarea class="span8" rows="5" name="appreason"><?php echo $rsedit[app_reason]; ?></textarea>
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

function validateform()
{
	if(document.frmappnt.select4.value == "")
	{
		alert("Patient name should not be empty..");
		document.frmappnt.select4.focus();
		return false;
	}
	
	else if(document.frmappnt.select3.value == "")
	{
		alert("Room type should not be empty..");
		document.frmappnt.select3.focus();
		return false;
	}
	else if(document.frmappnt.select5.value == "")
	{
		alert("Department name should not be empty..");
		document.frmappnt.select5.focus();
		return false;
	}
	else if(document.frmappnt.appointmentdate.value == "")
	{
		alert("Appointment date should not be empty..");
		document.frmappnt.appointmentdate.focus();
		return false;
	}
	else if(document.frmappnt.time.value == "")
	{
		alert("Appointment time should not be empty..");
		document.frmappnt.time.focus();
		return false;
	}
	else if(document.frmappnt.select6.value == "")
	{
		alert("Doctor name should not be empty..");
		document.frmappnt.select6.focus();
		return false;
	}
	else if(document.frmappnt.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmappnt.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
</body>