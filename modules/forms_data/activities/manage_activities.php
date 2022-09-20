<div class="col-md-12">
	<?php
	include("db_connector/mysqli_conn.php");
	?>
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">

			<li class="active"><a href="dashboard.php?action=manage_activities">Manage Activities</a></li>
		</ul>
	</div>

	<div class="box-header with-border">
		<h3 class="box-title">Manage Activities</h3>
	</div>
	<button class=" btn btn-md btn-primary" data-toggle="modal" data-target="#add">Add Activity</button>
	<div class="modal fade" id="add" tabindex="-1" role="dialog" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
					<h4 class="modal-title">
						<center><i class="fa fa-user fa-spin"></i>Add Activity</center>
					</h4>
				</div>
				<div class="modal-body">

					<form action="" method="post" enctype="multipart/form-data">
						<label>Activity(From Objectives): <span style="color:red">*</span></label>
						<textarea class="form-control" name="activity" cols="3" style="width:100%;" placeholder="Activity Name" required></textarea>
						<label>Objective: <span style="color:red">*</span></label>
						<select class="form-control select2" name="objective_id" id="donor myselect" style="width:100%;" required>
							<?php
							$sql1 = mysqli_query($dbcon, "SELECT * FROM objectives");
							$i1 = 0;
							while ($list1 = mysqli_fetch_array($sql1)) {
								$i1++; ?>
								<option value="<?php echo $list1['objective_id']; ?>"><?php echo $list1['objective']; ?>
								</option>
							<?php } ?>
						</select>
						<label>Donor: <span style="color:red">*</span></label>
						<select class="form-control select2" name="donor" id="donor myselect" style="width:100%;" required>
							<?php
							$sql1 = mysqli_query($dbcon, "SELECT * FROM donors");
							$i1 = 0;
							while ($list1 = mysqli_fetch_array($sql1)) {
								$i1++; ?>
								<option value="<?php echo $list1['donor_id']; ?>"><?php echo $list1['donor']; ?>
								</option>
							<?php } ?>
						</select>
						<label>Start Date:</label>
						<div class="input-group date" data-provide="datepicker">
							<input name="date" type="text" maxlength="20" class="form-control" value="" />
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-th"></span>
							</div>
						</div>
						<label>Duration: Duration(days)</label>
						<input type="number" class="form-control" name="duration" value="" style="width:100%;">
						<input type="hidden" class="form-control" name="add" value="" style="width:100%;">
						<label>Description:</label>
						<textarea class="form-control" name="description" cols="3" style="width:100%;"></textarea>

						<button type="submit" class="btn btn-primary"><i class="fa-save" style="margin-top:6px;"></i>Save Activity</button>
					</form>

				</div>
			</div>
		</div>
	</div>
	<?php
	//flag changer
	if (isset($_POST['flag'])) {
		$flag = mysqli_real_escape_string($dbcon, $_POST['flag']);
		$activity_id = mysqli_real_escape_string($dbcon, $_POST['activity_id']);
		$msg = mysqli_real_escape_string($dbcon, $_POST['msg']);
		if ($sqla = mysqli_query($dbcon, "UPDATE `activities` SET `flag` = '$flag' WHERE `activity_id` = '$activity_id'")) {

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
	<?php
	if (isset($_POST['delete'])) {

		$rs_id = $_POST['id'];



		if ($rs_id != "") {

			if ($act = mysqli_query($dbcon, "Delete from activities where activity_id='$rs_id'")) {
				$activity = mysqli_real_escape_string($dbcon, $_POST['activity']);
				$action = $uploader . " Deleted " . $activity . " from activities";
				$sql = mysqli_query($dbcon, "INSERT INTO `user_system_log` (`id`, `uuid`, `time`, `actions`) VALUES (NULL, '$uuid', CURRENT_TIMESTAMP, '$action')");

				echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Deletion Successful</strong>
                   </div>';
			}
		}
	}
	?>
	<?php if (isset($_POST['update'])) {

		$rs_id = $_POST['id2'];

		$activity = mysqli_real_escape_string($dbcon, $_POST['activity']);
		$objective_id = mysqli_real_escape_string($dbcon, $_POST['objective_id']);
		$donor = mysqli_real_escape_string($dbcon, $_POST['donor']);
		$start_date = $_POST['date'];
		$duration = mysqli_real_escape_string($dbcon, $_POST['duration']);
		$description = mysqli_real_escape_string($dbcon, $_POST['description']);



		if ($rs_id != "") {

			if ($act = mysqli_query($dbcon, "UPDATE `activities` SET `activity` = '$activity',`objective_id` = '$objective_id',`donor` = '$donor',`start_date` = '$start_date',`duration` = '$duration',`description` = '$description' WHERE `activity_id` =$rs_id")) {

				echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Update Successful</strong>
                   </div>';
			}
		}
	}
	?>
	<?php if (isset($_POST['add'])) {

		$activity = mysqli_real_escape_string($dbcon, $_POST['activity']);
		$objective_id = mysqli_real_escape_string($dbcon, $_POST['objective_id']);
		$donor = mysqli_real_escape_string($dbcon, $_POST['donor']);
		$start_date = $_POST['date'];
		$duration = mysqli_real_escape_string($dbcon, $_POST['duration']);
		$description = mysqli_real_escape_string($dbcon, $_POST['description']);
		$counts = mysqli_query($dbcon, "select * from  activities where activity='$activity'");
		$count = mysqli_fetch_array($counts);
		if (count($count) == 1) {
			$msg = " Duplicate Entry! Please Verify</font>";
			echo '<div class="alert alert-danger alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>' . $msg . '</strong>
                   </div>';
		} else {

			if ($act = mysqli_query($dbcon, "INSERT INTO `activities` (
`activity_id`,
`objective_id`,
`activity`,
`donor`,
`start_date`,
`duration`,
`description`,
`flag`
)
VALUES (NULL,'$objective_id','$activity','$donor','$start_date','$duration','$description','0')")) {

				echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Saved Succeefully</strong>
                   </div>';
			}
		}
	}
	?>
	<div class="col-md-12">
		<hr style="border:1px solid rgb(140, 141, 137);" />
		<table id="mydata" class="table table-bordered table-responsive">
			<thead>
				<tr>

					<th style="width:2%;">No</th>
					<th style="width:30%;">Activity</th>
					<th style="width:30%;">Objective</th>
					<th style="width:10%;">Donor</th>
					<th style="width:5%;">Start Date</th>
					<th style="width:1%;">Duration(days)</th>
					<th style="width:10%;">Description</th>
					<th style="width:6%;">Status</th>
					<th style="width:6%;">Edit / Delete</th>

				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				$sql = "SELECT * FROM activities";
				$result = mysqli_query($dbcon, $sql);
				while ($row = mysqli_fetch_array($result)) {

				?>


					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['activity']; ?></td>
						<td><?php $id = $row['activity_id'];
							$obj_id = $row['objective_id'];
							$sqlobj = mysqli_query($dbcon, "SELECT * FROM objectives where objective_id=$obj_id");

							while ($listobj = mysqli_fetch_array($sqlobj)) {

								echo $return_obj = $listobj['objective'];
							} ?>
						</td>
						<td><?php
							$dn_id = $row['donor'];
							$sqldn = mysqli_query($dbcon, "SELECT * FROM donors where donor_id=$dn_id");

							while ($listdn = mysqli_fetch_array($sqldn)) {
								echo  $return_dn = $listdn['donor'];
							} ?></td>
						<td><?php echo $row['start_date']; ?></td>
						<td><?php echo $row['duration']; ?></td>
						<td><?php echo $row['description']; ?></td>
						<td>
							<?php
							//Flag Raiser
							$status = $row['flag'];
							$space = "----|";
							if ($status == 0) {
								echo "<form action='' method='post'>
						  <input type='hidden' value='1' name='flag'>
						  <input type='hidden' value='$id' name='activity_id'>
						  <input type='hidden' value='Activity Accomplished' name='msg'>
						 <button type='submit'  class='btn btn-sm btn-primary' name='status'><span class='glyphicon glyphicon-refresh'></span>Pending ..</button>
						        </form>";
							} else {
								echo "<form action='' method='post'>
						  <input type='hidden' value='0' name='flag'>
						  <input type='hidden' value='$id' name='activity_id'>
						  <input type='hidden' value='Status Changed to Pending' name='msg'>
						 <button type='submit' name='change_flag' class='btn btn-sm btn-success' name='status'><span class='glyphicon glyphicon-ok'></span>Acommplished</button>
						 </form>";
							}


							?>


						</td>
						<td>
							<?php if ($_SESSION['usertype'] == 'admin') { ?>
								<form action="" method="post" style="width:40px;">
									<input type="hidden" name="id" value="<?php echo $row['activity_id']; ?>" />
									<input type="hidden" name="activity" value="<?php echo $row['activity']; ?>" />
									<input type="hidden" name="delete">
									<button type="submit" name="delete" title="On click, this record will be deleted!" class="btn btn-sm btn-danger" style="float:left;"><i class="delete"></i>Delete</button>
								</form>
								<button data-toggle="modal" data-target="#<?php echo $modalid = 'my' . $row['activity_id']; ?>" title="Update activity" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>

							<?php }
							?>
							<div class="modal fade" id="<?php echo $modalid; ?>" tabindex="-1" role="dialog" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
											<h4 class="modal-title">
												<center><i class="fa fa-user fa-spin"></i>Update activities</center>
											</h4>
										</div>
										<div class="modal-body">

											<form action="" method="post" enctype="multipart/form-data">
												<label>Activity: <span style="color:red">*</span></label>
												<textarea class="form-control" name="activity" cols="3" style="width:100%;" required><?php echo $row['activity']; ?></textarea>
												<label>Objective: <span style="color:red">*</span></label>
												<select class="form-control select2" name="objective_id" id="objective_id myselect" style="width:100%;" required>
													<?php
													//active objective
													$active_op = $row['objective_id'];

													$sql1 = mysqli_query($dbcon, "SELECT * FROM objectives");
													$i1 = 0;
													while ($list1 = mysqli_fetch_array($sql1)) {
														$i1++; ?>
														<option value="<?php echo $select_op = $list1['objective_id']; ?>" <?php if ($select_op == $active_op) {
																																echo "selected";
																															} ?>><?php echo $list1['objective']; ?>
														</option>
													<?php } ?>
												</select>
												<label>Donor: <span style="color:red">*</span></label>
												<select class="form-control select2" name="donor" id="donor myselect" style="width:100%;" required>
													<?php
													$active_op = $row['donor_id'];
													$sql1 = mysqli_query($dbcon, "SELECT * FROM donors");
													$i1 = 0;
													while ($list1 = mysqli_fetch_array($sql1)) {
														$i1++; ?>
														<option value="<?php echo $select_op = $list1['donor_id']; ?>" <?php if ($select_op == $active_op) {
																															echo "selected";
																														} ?>><?php echo $list1['donor']; ?>
														</option>
													<?php } ?>
												</select>
												<label style="width:100%;">Start Date:</label>
												<div class="input-group date" data-provide="datepicker">
													<input name="date" type="text" id="" class="form-control" value="<?php if ($row['start_date'] != "0000-00-00") {
																															echo $row['start_date'];
																														} ?>">
													<div class="input-group-addon">
														<span class="glyphicon glyphicon-th"></span>
													</div>
												</div>
												<label style="width:100%;">Duration: Duration(days)</label>
												<input type="number" class="form-control" name="duration" value="<?php echo $row['duration']; ?>" style="width:100%;">
												<input type="hidden" class="form-control" name="update" value="" style="width:100%;">
												<input type="hidden" class="form-control" name="id2" value="<?php echo $row['activity_id']; ?>" style="width:100%;">
												<label>Description:</label>
												<textarea class="form-control" name="description" cols="3" style="width:100%;"><?php echo $row['description']; ?></textarea>
												<button type="submit" name="" class="btn btn-primary"><i class="edit" style="margin-top:4px;"></i>Update activity</button>
											</form>

										</div>
									</div>
								</div>
							</div>

						</td>

					</tr>
				<?php } ?>
			</tbody>
			<tfoot>
			</tfoot>
		</table>
	</div>