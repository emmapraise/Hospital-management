<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
include("header.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM medicine WHERE medicineid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Medicine redcord deleted successfully..');</script>";
	}
}
?>
				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>View Medicine Record</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Medicine Name</th>
											<th>Medicine Cost</th>
											<th>Description</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										
          <?php
		$sql ="SELECT * FROM medicine";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>&nbsp;$rs[medicinename]</td>
          <td>&nbsp;$rs[medicinecost]</td>
          <td>&nbsp;$rs[description]</td>
			 <td>&nbsp;$rs[status]</td>
			 <td>&nbsp;
			  <a href='medicine.php?editid=$rs[medicineid]'>Edit</a> | <a href='viewmedicine.php?delid=$rs[medicineid]'>Delete</a> </td>
        </tr>";
		}
		?>
									</tbody>
									<tfoot>
										<tr>
											<th>Medicine Name</th>
											<th>Medicine Cost</th>
											<th>Description</th>
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