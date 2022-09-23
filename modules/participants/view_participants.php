<?php
include("db_connector/mysqli_conn.php");
?>

<div class="col-md-12" style=" background:white; border-radius: 5px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class=""><a href="dashboard.php?action=add_participants">Register New Participant</a></li>
			<li class="active"><a href="dashboard.php?action=view_participants">Manage Participants</a></li>
		</ul>
	</div>
	<?php if (!empty($statusMsg)) {
		echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
	}
	?>


	<div class="box-header with-border">
		<h5 class="box-title">Participant List</h5>
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
	<?php
	if (isset($_GET['del_id'])) {

		$rs_id = $_GET['del_id'];



		if ($rs_id != "") {

			if ($act = mysqli_query($dbcon, "Delete from participants where participant_id='$rs_id'")) {
				$sql = mysqli_query($dbcon, "DELETE FROM field_participants WHERE participant_id='$rs_id'");
				$sql = mysqli_query($dbcon, "ALTER TABLE participants AUTO_INCREMENT = 1");

				echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Deletion Successful</strong>
                   </div>';
			}
		}
	}
	?>

	<?php
	//flag changer
	if (isset($_POST['flag'])) {
		$flag = mysqli_real_escape_string($dbcon, $_POST['flag']);
		$participant_id = mysqli_real_escape_string($dbcon, $_POST['participant_id']);
		$msg = mysqli_real_escape_string($dbcon, $_POST['msg']);
		if ($sqla = mysqli_query($dbcon, "UPDATE `participants` SET `flag` = '$flag' WHERE `participant_id` = '$participant_id'")) {

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
	<form action="" method="POST" class="form-horizontal">
		<div class="col-md-4">
			<label>Surname : <span style="color:red"></span></label>
			<input type="text" class="form-control" name="sname" placeholder="Surname">


		</div>

		<div class="col-md-4">
			<label>Select Field Work Activity : <span style="color:red"></span></label>
			<select class="form-control select2" name="field_activity_id" id="factivity_id myselect" style="width:100%;">
				<option value="%" selected>All
				</option>
				<?php
				$active = $_POST['field_activity_id'];
				$sql2 = mysqli_query($dbcon, "SELECT DISTINCT field_activity_id, training FROM field_work");

				while ($list2 = mysqli_fetch_array($sql2)) {
				?>

					<option value="<?php echo $sel = $list2['field_activity_id']; ?>" <?php if ($sel == $active) {
																							echo "selected";
																						} ?>><?php echo $list2['training']; ?>
					</option>
				<?php } ?>

			</select>
			<input type="hidden" name="mylimits" value="on">
			<p></p>
			<button type="submit" class="btn btn btn-info" name="apply_limits"><span class="glyphicon glyphicon-ok"></span>Apply Limits</button>

		</div>


		<div class="col-md-4">
		</div>
	</form>
</div>

<div class="col-md-12 offset-2" style="width:100%; overflow:auto; margin:0 auto;">
	<hr style="border:1px solid rgb(140, 141, 137);" />
	<table id="mydata" class="table table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Gender</th>
				<th>Occupation</th>
				<th>Age Group</th>
				<th>Location</th>
				<th>Sub County</th>
				<th>Mobile Contact</th>
				<th>Institution </th>
				<th>Email </th>
				<th>Status</th>
				<th>Delete / Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// start count paging
			include("modules/universal_funcs/paging_class.php");
			if (isset($_GET["page"])) {
				$page = (int)$_GET["page"];
			} else {
				$page = 1;

				$setLimit = 25;
				$pageLimit = ($page * $setLimit) - $setLimit;
			}

			if (($_POST['mylimits']) != 'on') {
				//	$sql="SELECT participant_id,firstname,surname,othername,gender,age_group,residence_district,postal_address,contact1,contact2,email,institution,position,
				//	flag FROM `participants`";

				$surname = mysqli_real_escape_string($dbcon, $_POST['surname']);



				$field_activity_id = mysqli_real_escape_string($dbcon, $_POST['field_activity_id']);
				$sql = "SELECT DISTINCT participants.participant_id,firstname,surname,othername,gender,age_group,residence_district,postal_address,contact1,contact2,email,training,institution,
				position,flag FROM participants,field_participants where field_participants.participant_id=participants.participant_id AND training LIKE'%$field_activity_id' AND surname LIKE'$surname%' LIMIT $pageLimit , $setLimit";
			} else {
				//default function
				$sql = "SELECT DISTINCT participants.participant_id,firstname,surname,othername,gender,age_group,residence_district,postal_address,contact1,contact2,email,training,institution,
				position,flag FROM participants,field_participants where field_participants.participant_id=participants.participant_id ORDER BY participants.participant_id DESC, surname ASC LIMIT $pageLimit , $setLimit";
			}



			$result = mysqli_query($dbcon, $sql);
			$no = 1;
			while ($row = mysqli_fetch_array($result)) {
				$id = $row['participant_id'];
			?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $myname = $row['surname'] . " " . $row['firstname'] . " " . $row['othername']; ?></td>
					<td><?php echo  $row['gender']; ?></td>
					<td> <?php echo $active_opp = $position = $row['position']; ?></td>
					<td><?php echo  $row['age_group']; ?></td>
					<td> <?php echo $active_op = $row['residence_district']; ?></td>
					<td> <?php echo $position = $row['postal_address']; ?></td>
					<td> <?php echo $contact1 = $row['contact1']; ?></td>
					<td> <?php echo $institution = $row['institution']; ?></td>
					<td> <?php echo $email = $row['email']; ?></td>


					<td>
						<?php
						//Flag Raiser
						$status = $row['flag'];
						$space = "----|";
						if ($status == 0) {
							echo "<form action='' method='post'>
						  <input type='hidden' value='1' name='flag'>
						  <input type='hidden' value='$id' name='participant_id'>
						  <input type='hidden' value='$myname Particiapnt Re-activated' name='msg'>
						 <button type='submit'  class='btn btn-sm btn-link' title='Click to change status' name='status'><span class='glyphicon glyphicon-remove'></span>In-Active</button>
						        </form>";
						} else {
							echo "<form action='' method='post'>
						  <input type='hidden' value='0' name='flag'>
						  <input type='hidden' value='$id' name='participant_id'>
						  <input type='hidden' value='$myname Attendance Access De-activated' name='msg'>
						 <button type='submit' name='change_flag' class='btn btn-sm btn-link' title='Click to change status' name='status'><span class='glyphicon glyphicon-ok'></span>Active</button>
						 </form>";
						}


						?>


					</td>
					<td>
						<form action="" method="post" style="width:40px;">
							<input type="hidden" name="id" value="<?php echo $row['participant_id']; ?>" />
							<input type="hidden" name="delete">
							<?php if ($_SESSION['usertype'] == 'admin') {
								echo '<input type="hidden" name="training_name" value="<?php echo $training;?>" style="width:100%;">
				  <button  type="button" data-toggle="modal" data-target="#delete' . $row['participant_id'] . '" <?php echo" name="delete" title="On click, this record will be deleted!" class="btn btn-sm btn-link" style="float:left;"><i class="glyphicon glyphicon-remove"></i>Delete</button>';
							} ?>


							<div class="modal fade" tabindex="-1" id="delete<?php echo $row['participant_id']; ?>" role="dialog">
								<div class="modal-dialog modal-sm" style="margin-top:10%;">

									<div class="modal-content">
										<div class="modal-header">
											<h4>Confirm Deletion</h4>

										</div>
										<div class="modal-body">

											<p><i class="fa fa-warning" style="font-size:x-large; color:red;"></i> Are you sure you want to Delete this?</p>

										</div>
										<div class="modal-footer">
											<button data-dismiss="modal" class="btn btn-info"><i class="fa fa-times"></i> Cancel</button>
											<a href="dashboard.php?action=view_participants&del_id=<?php echo $row['participant_id']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>
										</div>
									</div>
								</div>

							</div>
						</form>


						<button data-toggle="modal" data-target="#<?php echo $modalid = $id; ?>" title="Update Employee Details" class="btn btn-sm btn-link"><span class='glyphicon glyphicon-edit'></span>Edit</button>

						<div class="modal fade" id="<?php echo $modalid; ?>" tabindex="-1" role="dialog" data-backdrop="static">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
										<h4 class="modal-title" style="font-weight:bold; text-decoration:underline;">
											<center><i class=""></i>Update Employee</center>
										</h4>
									</div>
									<div class="modal-body">
										<div class="msg">

										</div>
										<div class="row">

											<div class="col-md-6">
												<form class="data_form" method="post" action="modules/participants/update_participant.php">

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
													<label style="width:100%;">Age Group: </label>
													<?php $age_group = $row['age_group']; ?>

													<label class="btn btn-sm btn-default">(13-18 Years):
														<input name="age_group" id="" value="13-18 Years" type="radio" <?php if ($age_group == '13-18 Years') {
																															echo 'checked';
																														} ?>></label>
													<label class="btn btn-sm btn-default"> (19-24 Years):
														<input name="age_group" id="" value="19-24 Years" type="radio" <?php if ($age_group == '19-24 Years') {
																															echo 'checked';
																														} ?>></label>
													<label class="btn btn-sm btn-default">(25-30 Years):
														<input name="age_group" id="" value="25-30 Years" type="radio" <?php if ($age_group == '25-30 Years') {
																															echo 'checked';
																														} ?>></label>
													<label class="btn btn-sm btn-default">(Above 31 Years):
														<input name="age_group" id="" value="Above 31 Years" type="radio" <?php if ($age_group == 'Above 31 Years') {
																																echo 'checked';
																															} ?>></label>
													<div id="">
														<label>Location: <span style="color:red">*</span></label>
														<select style="width:100%;" name="district" class="form-control select2" id="">
															<?php

															$sql = mysqli_query($dbcon, "SELECT * FROM district");
															$i = 0;
															while ($list1 = mysqli_fetch_array($sql)) {
																$i++; ?>
																<option value="<?php echo $select_op = $list1['name']; ?>" <?php if ($select_op == $active_op) {
																																echo "selected";
																															} ?>><?php echo $list1['name']; ?>
																</option>
															<?php } ?>
														</select>
													</div>
											</div>
											<div class="col-md-6">
												<div id="">
													<label>Postal Address: </label>
													<textarea style="width:100%;" class="form-control" name="postal_address" id="" placeholder="Postal Address"><?php echo $row['postal_address']; ?></textarea>
												</div>
												<div id="">
													<label>Mobile Contact: <span style="color:red">*</span></label>
													<input style="width:100%;" class="form-control" name="contact" id="Contact" value="<?php echo $row['contact1']; ?>" placeholder="Contact" type="tel" />
												</div>

												<div id="">
													<label>Telephone: <span style="color:red"></span></label>
													<input style="width:100%;" class="form-control" name="telephone" id="Contact2" value="<?php echo $row['contact2']; ?>" placeholder="Telephone" type="tel" />
												</div>
												<div id="">
													<label>Email: <span style="color:red"></span></label>
													<input style="width:100%;" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" placeholder="Email" type="email" />
												</div>
												<div id="">
													<label>Institution: <span style="color:red"></span></label>
													<input style="width:100%;" class="form-control" name="institution" id="institution" value="<?php echo $row['institution']; ?>" placeholder="Institution" type="text" />
												</div>

												<div id="">
													<label>Occupation: <span style="color:red">*</span></label>
													<select style="width:100%;" name="position" class="form-control select2" id="">
														<?php
														$sql = mysqli_query($dbcon, "SELECT * FROM position");
														$i = 0;
														while ($list = mysqli_fetch_array($sql)) {
															$i++; ?>
															<option value="<?php echo $select_op = $list['position']; ?>" <?php if ($select_op == $active_opp) {
																																echo "selected";
																															} ?>><?php echo $list['position']; ?>
															</option>
														<?php } ?>
													</select>
												</div>
												<input style="width:100%;" class="form-control" name="participant_id" id="" value="<?php echo $row['participant_id']; ?>" placeholder="" type="hidden" />
												<input style="width:100%;" class="form-control" name="update_participant" id="" value="update_participant" placeholder="" type="hidden" />


												<div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
													<button class="btn btn-primary" name="update_participant" type="submit"><span class="glyphicon glyphicon-edit"></span>Update</button>
													<button data-dismiss="modal" class="btn btn-info"><i class="fa fa-times"></i> Close</button>
													</form>
												</div>
											</div>
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

			<?php
			// Call the Pagination
			$url = "dashboard.php?action=view_participants";
			$counts = mysqli_query($dbcon, "SELECT count (id) as parts from field_participants");
			$counter = mysqli_fetch_array($counts);
			$count = $counter['parts'];



			echo displayPaginationBelow($setLimit, $page, $count, $url);
			?>

		</tfoot>
	</table>
</div>

<div class="col-md-4">

</div>
<div class="col-md-4">
</div>
</div>
<script>
	$('.data_form').submit(function(e) {
		e.preventDefault();

		var method = $(this).attr('method');
		var path = $(this).attr('action');

		var form_data = $(this).serialize();

		console.log(form_data);



		$('.msg').html("<center><font color='green'><b>Updating Data...</b></font></center>");


		//var form_data=new Formdata($(this[0]));



		$.ajax({
			method: method,
			data: form_data,
			url: path,
			success: function(res) {
				//do something with returned msg or data

				console.log(res);


				setTimeout(function() {


					$('.msg').html(res);

					//$('.msg').hide(15000);

					// $('#modal_id').modal('show'); //shows modal

					//setTimeout(function(){
					// $('#modal_id').modal('hide'); //shows modal
					//},2000);


				}, 1000);

			}


		}); //close $.ajax amd the param array




	}); //close submit and its function
</script>