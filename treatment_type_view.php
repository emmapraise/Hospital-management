<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
include("header.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM treatment WHERE treatmentid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('treatment deleted successfully..');</script>";
	}
}
 ?>
				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>View Treatment Type Record</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Treatment Type Name</th>
											<th>Treatment Cost </th>
											<th>Note</th>
											<th>Status</th>
											    <?php
		  		if(isset($_SESSION[adminid]))
		{
		?>
											<th>Action</th>
											    <?php
		}
		?>
										</tr>
									</thead>
									<tbody>
										    <?php
		$sql ="SELECT * FROM treatment";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>&nbsp;$rs[treatmenttype]</td>
		  <td>&nbsp;Rs. $rs[treatment_cost]</td>
          <td>&nbsp;$rs[note]</td>
			 <td>&nbsp;$rs[status]</td>";
		if(isset($_SESSION[adminid]))
		{
		echo "<td>&nbsp;
			  <a href='treatment.php?editid=$rs[treatmentid]'>Edit</a> | <a href='viewtreatment.php?delid=$rs[treatmentid]'>Delete</a> </td>";
			}
        echo "</tr>";
		}
		?>
									</tbody>
									<tfoot>
										<tr><th>Treatment Type Name</th>
											<th>Treatment Cost </th>
											<th>Note</th>
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