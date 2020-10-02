<!DOCTYPE html>
<html lang="en">
<?php
include 'header.php';
error_reporting(0);
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM patient WHERE patientid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('patient record deleted successfully..');</script>";
	}
}
 ?>
				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>View Patient Record</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Patient Name</th>
											<th>Admission Details</th>
											<th>Address</th>
											<th>Patient Profile</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
		$sql ="SELECT * FROM patient";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>$rs[patientname]<br>
		  <strong>Login ID :</strong> $rs[loginid] </td>
          <td>
		  <strong>Date</strong>: &nbsp;$rs[admissiondate]<br>
		 <strong>Time</strong>: &nbsp;$rs[admissiontime]</td>
		   <td>$rs[address]<br>$rs[city] -  &nbsp;$rs[pincode]<br>
Mob No. - $rs[mobileno]</td>
			    <td><strong>Blood group</strong> - $rs[bloodgroup]<br>
<strong>Gender</strong> - &nbsp;$rs[gender]<br>
<strong>DOB</strong> - &nbsp;$rs[dob]</td>
          <td align='center'>Status - $rs[status] <br>";
if(isset($_SESSION[adminid]))
{
		  echo "<a href='patient.php?editid=$rs[patientid]'>Edit</a> | <a href='viewpatient.php?delid=$rs[patientid]'>Delete</a> <hr>
<a href='patientreport.php?patientid=$rs[patientid]'>View Report</a>";
}
		  echo "</td></tr>";
		}
		?>
									</tbody>
									<tfoot>
										<tr><th>Patient Name</th>
											<th>Admission Details</th>
											<th>Address</th>
											<th>Patient Profile</th>
											<th>Action</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div><!--/.module-->

					<br />
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->
<?php include 'footer.php'; ?>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>