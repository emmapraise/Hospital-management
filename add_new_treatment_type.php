<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>

				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Add New Treatment Type</h3>
							</div>
							<div class="module-body">

									<form class="form-horizontal row-fluid">
										<div class="control-group">
											<label class="control-label" for="basicinput">Treatment Type</label>
											<div class="controls">
												<input type="text" id="basicinput" placeholder="Enter Treatment Type..." class="span8">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Treatment Cost</label>
											<div class="controls">
												<input type="text" id="basicinput" placeholder="Enter Treatment Cost..." class="span8">
												
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Note</label>
											<div class="controls">
												<textarea class="span8" rows="5"></textarea>
											</div>
										</div>
										
										
										<div class="control-group">
											<label class="control-label" for="basicinput">Status</label>
											<div class="controls">
												<div class="dropdown">
													<a class="dropdown-toggle btn" data-toggle="dropdown" href="#">Select Status<i class="icon-caret-down"></i></a>
													<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
														<li><a href="#">Active</a></li>
														<li><a href="#">Inactive</a></li>
													</ul>
												</div>
											</div>
										</div>
										
										<div class="control-group">
											<div class="controls">
												<button type="submit" class="btn btn-success">Submit</button>
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
</body>