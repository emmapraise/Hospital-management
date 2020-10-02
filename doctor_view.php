<!DOCTYPE html>
<html lang="en">
<?php
include("header.php");
error_reporting(0);
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM doctor WHERE doctorid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('doctor record deleted successfully..');</script>";
	}
}
?>
				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>View Doctor Record</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="">
									<thead>
										<tr>
											<th>Doctor Name</th>
											<th>Mobile Number</th>
											<th>Department</th>
											<th>Login ID</th>
											<th>Consultancy Charge</th>
											<th>Education</th>
											<th>Experience</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
		$sql ="SELECT * FROM doctor";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			
			$sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]'";
			$qsqldept = mysqli_query($con,$sqldept);
			$rsdept = mysqli_fetch_array($qsqldept);
        echo "<tr>
          <td>&nbsp;$rs[doctorname]</td>
          <td>&nbsp;$rs[mobileno]</td>
		   <td>&nbsp;$rsdept[departmentname]</td>
			<td>&nbsp;$rs[loginid]</td>
			<td>&nbsp;$rs[consultancy_charge]</td>
			 <td>&nbsp;$rs[education]</td>
			<td>&nbsp;$rs[experience]</td>
          <td>$rs[status]</td>
           <td>&nbsp;
		   <a href='add_new_doctor.php?editid=$rs[doctorid]'>Edit</a> | <a href='doctor_view.php?delid=$rs[doctorid]'>Delete</a> </td>
        </tr>";
		}
		?>      
									</tbody>
									<tfoot>
										<tr><th>Doctor Name</th>
											<th>Mobile Number</th>
											<th>Department</th>
											<th>Login ID</th>
											<th>Consultancy Charge</th>
											<th>Education</th>
											<th>Experience</th>
											<th>Status</th>
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