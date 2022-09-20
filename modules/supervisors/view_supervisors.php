<?php
include("db_connector/mysqli_conn.php");
?>

<div class="col-md-12" style=" background:white; border-radius: 5px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class=""><a href="dashboard.php?action=add_supervisors">Register New Supervisor</a></li>
			<li class="active"><a href="dashboard.php?action=view_supervisors">Manage Supervisors</a></li>
		</ul>
	</div>
	<?php if (!empty($statusMsg)) {
		echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
	}
	?>


	<div class="box-header with-border">
		<h5 class="box-title">Supervisor List</h5>
	</div>
	<?php
	if (isset($_GET['msg'])) {
		$print_msg = $_GET['msg'];


		echo '<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>' . $print_msg . '</strong>
                  </div>';
	}
	?>
	<?php if (isset($_POST['update_supervisor'])) {

		// stop SQL INJECTION
		$supervisor_id = mysqli_real_escape_string($dbcon, $_POST['supervisor_id']);
		$surname = mysqli_real_escape_string($dbcon, $_POST['surname']);
		$firstname = mysqli_real_escape_string($dbcon, $_POST['firstname']);
		$othername = mysqli_real_escape_string($dbcon, $_POST['othername']);
		$gender = mysqli_real_escape_string($dbcon, $_POST['gender']);
		$contact = mysqli_real_escape_string($dbcon, $_POST['contact']);
		$email = mysqli_real_escape_string($dbcon, $_POST['email']);

		$sql = mysqli_query($dbcon, "UPDATE `supervisors` SET `surname`='$surname',`othername`='$othername',`gender`='$gender',
			`contact`='$contact',`email`='$email' WHERE `supervisor_id`='$supervisor_id'");
		if ($sql) {
			$msg = "$Surname $Firstname Updated";
		} else {
			$msg = "$Surname $Firstname Update Failed";
		}
		echo '<div class="alert alert-info alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>' . $msg . '</strong>
                  </div>';
	}




	?>
	<?php
	//flag changer
	if (isset($_POST['flag'])) {
		$flag = mysqli_real_escape_string($dbcon, $_POST['flag']);
		$supervisor_id = mysqli_real_escape_string($dbcon, $_POST['supervisor_id']);
		$msg = mysqli_real_escape_string($dbcon, $_POST['msg']);
		if ($sqla = mysqli_query($dbcon, "UPDATE `supervisors` SET `flag` = '$flag' WHERE `supervisor_id` = $supervisor_id")) {

			echo '<div class="alert alert-success alert-dismissable">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>' . $msg . '</strong>
                    </div>';
		} else {
			echo '<div class="alert alert-success alert-dismissable">
                     <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>' . $msg . '</strong>
                     </div>';
		}
	}
	?>
	<div class="col-md-12 offset-2" style="width:100%; overflow:auto; margin:0 auto;">
		<hr style="border:1px solid rgb(140, 141, 137);">
		<table id="mydata" class="table table-bordered table-hover table-responsive">
			<thead>
				<tr>
					<th>Name</th>
					<th>Gender</th>
					<th>Mobile Contact</th>
					<th>Email </th>
					<th>Status</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>

				<?php
				$sql = "SELECT * FROM `supervisors`";
				$result = mysqli_query($dbcon, $sql);
				while ($row = mysqli_fetch_array($result)) {
					$id = $row['supervisor_id'];
				?>
					<tr>
						<td><?php echo $myname = $row['surname'] . " " . $row['firstname'] . " " . $row['othername']; ?></td>
						<td><?php echo  $row['gender']; ?></td>
						<td> <?php echo $department = $row['contact']; ?></td>
						<td> <?php echo $department = $row['email']; ?></td>


						<td>
							<?php
							//Flag Raiser
							$status = $row['flag'];
							$space = "----|";
							if ($status == 0) {
								echo "<form action='' method='post'>
						  <input type='hidden' value='1' name='flag'>
						  <input type='hidden' value='$id' name='supervisor_id'>
						  <input type='hidden' value='$myname Particiapnt Re-activated' name='msg'>
						 <button type='submit'  class='btn btn-sm btn-danger' title='Click to change status' name='status'><span class='glyphicon glyphicon-remove'></span>In-Active</button>
						        </form>";
							} else {
								echo "<form action='' method='post'>
						  <input type='hidden' value='0' name='flag'>
						  <input type='hidden' value='$id' name='supervisor_id'>
						  <input type='hidden' value='$myname Attendance Access De-activated' name='msg'>
						 <button type='submit' name='change_flag' class='btn btn-sm btn-success' title='Click to change status' name='status'><span class='glyphicon glyphicon-ok'></span>Active</button>
						 </form>";
							}


							?>


						</td>
						<td>
							<button data-toggle="modal" data-target="#<?php echo $modalid = $id; ?>" title="Update Employee Details" class="btn btn-sm btn-info"><span class='glyphicon glyphicon-edit'></span>Edit</button>
							<div class="modal fade" id="<?php echo $modalid; ?>" tabindex="-1" role="dialog" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
											<h4 class="modal-title" style="font-weight:bold; text-decoration:underline;">
												<center><i class="fa fa-user fa-spin"></i>Update Employee</center>
											</h4>
										</div>
										<div class="modal-body">

											<form name="" id="data_form" method="post" action="">

												<div id="">
													<label>Surname: <span style="color:red">*</span></label>
													<input style="width:100%;" class="form-control" name="surname" id="Surname" value="<?php echo  $row['surname']; ?>" placeholder="Surname" type="text" required>
												</div>
												<div id="">
													<label>First Name: <span style="color:red">*</span></label>
													<input style="width:100%;" class="form-control" name="firstname" id="Firstname" value="<?php echo  $row['firstname']; ?>" placeholder="First Name" type="text" required>
												</div>
												<div id="">
													<label>Other Name: </label>
													<input style="width:100%;" class="form-control" name="othername" id="othername" value="<?php echo  $row['othername']; ?>" placeholder="Other Name" type="text">
													<input style="width:100%;" class="form-control" name="add" id="add" value="" placeholder="" type="hidden">
												</div>
												<label style="width:100%;">Gender: </label>
												<?php $gender = $row['gender']; ?>
												<label class="btn btn-sm btn-default">Male:
													<input name="gender" id="" value="Male" type="radio" <?php if ($gender == 'Male') {
																												echo 'checked';
																											} ?>></label>
												<label class="btn btn-sm btn-default">Female:
													<input name="gender" id="" value="Female" type="radio" <?php if ($gender == 'Female') {
																												echo 'checked';
																											} ?>></label>
												<label class="btn btn-sm btn-default">Others:
													<input name="gender" id="" value="Others" type="radio" <?php if ($gender == 'Others') {
																												echo 'checked';
																											} ?>></label>


												<div id="">
													<label>Mobile Contact: <span style="color:red">*</span></label>
													<input style="width:100%;" class="form-control" name="contact" id="Contact" value="<?php echo $row['contact']; ?>" placeholder="Contact" type="tel" />
												</div>

												<label>Email: <span style="color:red"></span></label>
												<input style="width:100%;" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" placeholder="Email" type="email" />
										</div>


										<input style="width:100%;" class="form-control" name="supervisor_id" id="" value="<?php echo $row['supervisor_id']; ?>" placeholder="" type="hidden" />
										<input style="width:100%;" class="form-control" name="update_supervisor" id="" value="update_supervisor" placeholder="" type="hidden" />

										<div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
											<button class="btn btn-primary" name="update_supervisor" type="submit"><span class="glyphicon glyphicon-edit"></span>Update</button>

											</form>
										</div>



									</div>
								</div>
							</div>
	</div>

	</td>
<?php } ?>
</tr>
</tbody>
<tfoot>
</tfoot>
</table>
</div>

<div class="col-md-4">

</div>
<div class="col-md-4">
</div>
</div>