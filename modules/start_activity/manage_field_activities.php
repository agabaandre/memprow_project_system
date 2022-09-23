 <?php
	include("db_connector/mysqli_conn.php");

	$training = mysqli_real_escape_string($dbcon, $_GET['training']);
	?>

 <div class="col-md-12" style=" background:white; border-radius: 5px;">
 	<div class="nav-tabs-custom">
 		<ul class="nav nav-tabs">
 			<li class="active"><a href="dashboard.php?action=manage_field_activities">Field Activities List</a></li>

 		</ul>
 	</div>

 	<?php
		if (isset($_POST['update_activity'])) {

			$startdate = mysqli_real_escape_string($dbcon, $_POST['startdate']);
			$field_activity_id = mysqli_real_escape_string($dbcon, $_POST['upfield_activity_id']);
			$enddate = mysqli_real_escape_string($dbcon, $_POST['enddate']);
			$activity_id = mysqli_real_escape_string($dbcon, $_POST['activity_id']);
			$supervisor_id = mysqli_real_escape_string($dbcon, $_POST['supervisor']);
			$location = mysqli_real_escape_string($dbcon, $_POST['location']);
			$training_ground = mysqli_real_escape_string($dbcon, $_POST['training_ground']);

			$sqlactid = "SELECT * FROM activities WHERE `activity_id`=$activity_id";
			$resultactid = mysqli_query($dbcon, $sqlactid);
			while ($rowactid = mysqli_fetch_array($resultactid)) {
				$bt = $rowactid['activity'];
			}
			$sqlgid = "SELECT * FROM grounds WHERE ground_id=$training_ground";
			$resultgid = mysqli_query($dbcon, $sqlgid);
			while ($rowgid = mysqli_fetch_array($resultgid)) {
				$g = $rowgid['ground'];
			}

			$train = $bt . " " . $g . " " . $startdate;

			$training = str_replace("'", '', $train);;
			$notes = ($_POST['notes']);

			if ($act = mysqli_query($dbcon, "UPDATE field_work SET training='$training', start_date='$startdate', end_date='$enddate',activity_id='$activity_id'
 ,supervisor_id='$supervisor_id',location='$location',training_ground='$training_ground',notes='$notes' WHERE field_activity_id='$field_activity_id'")) {

				echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong><?php echo $training; ?>Training Updated Successfully</strong>
                   </div>';
			}
		}

		?>
 	<?php

		//upload pdf here


		if (isset($_POST['id'])) {


			//posted info
			$uploader = ($_POST['uploader']);
			$training = ($_POST['id']);

			$action = $uploader . " modified " . $training_name . " Report";
			$training_name = ($_POST['training_name']);
			$new_name = $training_name . "_" . "Report.pdf";	//name to give the pdf file

			$new_pdf = str_replace("/", "_", $new_name); //remove slashes in name

			// Checking the file was submitted
			$maxsize = 500000000; //set to approx 3m MB

			$type = ($_FILES['userfile']['type']);

			if ($type == "application/pdf") {

				$target_dir = "reports/";

				$target_file = $target_dir . basename($_FILES["userfile"]["name"]); //get path to file

				$docFileType = pathinfo($target_file, PATHINFO_EXTENSION); //get extension

				if (file_exists($target_file)) {

					//delete it and conitnue file

					unlink('reports/' . $target_file);

					$uploadOk = 1;
				} //file exists



				//start upload process

				// Check file size
				if ($_FILES["userfile"]["size"] > $maxsize) {


					echo $msg = '<div class="alert alert-danger alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>The Image Exceeds the Allowed Size Limit</strong>
                  </div>
<div>Maximum File limit is ' . $maxsize . ' bytes</div>
<div>File ' . $_FILES['userfile']['name'] . ' is ' . $_FILES['userfile']['size'] .
						' bytes</div><hr />';


					$uploadOk = 0; //deny upload
				} //check size


				if ($uploadOk = 1) {
					if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) //if file moved to folder then insert details to db
					{

						$pdf_file = $_FILES['userfile']['name']; //original filename

						rename($target_dir . $pdf_file, $target_dir . $new_pdf);


						$sql = mysqli_query($dbcon, "DELETE FROM reports WHERE training_id='$training'");

						$sql = "INSERT INTO reports (`training_id`, `document`, `name`, `size`,`up_date`,`uploader`) VALUES  ('$training','$docFileType','$new_pdf','{$_FILES['userfile']['size']}',CURRENT_DATE(),'$uploader');";

						//$sql=mysqli_query($dbcon,"INSERT INTO `user_system_log` (`id`, `uuid`, `time`, `actions`) VALUES (NULL, '$uuid', CURRENT_TIMESTAMP, '$action')");

						$savedb = mysqli_query($dbcon, $sql);

						if ($savedb) //upload succeeded
						{

							echo $msg = '<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Upload Successful</strong>
                  </div>';
						} else { //upload failed

							echo $msg = '<div class="alert alert-danger alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>The Image Exceeds the Allowed Size Limit</strong>
         </div>';
						}
					} //move upload

				} //upload ok

			} // end upload process--type check--file is a pdf

			else { //not a pdf

				echo $msg = '<div class="alert alert-danger alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>The Uploaded File is not in pdf format, Upload denied!</strong>
         </div>';
			}
		}

		// Function to return error message based on error code

		?>
 	<?php
		if (isset($_GET['del_id'])) {

			$rs_id = $_GET['del_id'];



			if ($rs_id != "") {

				if ($act = mysqli_query($dbcon, "Delete from field_work where field_activity_id='$rs_id'")) {
					$sql = mysqli_query($dbcon, "DELETE FROM field_participants WHERE training='$rs_id'");
					$sql = mysqli_query($dbcon, "DELETE FROM reports WHERE training_id='$rs_id'");
					$sql = mysqli_query($dbcon, "DELETE FROM me_f1 WHERE training_id='$rs_id'");
					$sql = mysqli_query($dbcon, "DELETE FROM me_f2 WHERE training_id='$rs_id'");
					$sql = mysqli_query($dbcon, "DELETE FROM me_f3 WHERE training_id='$rs_id'");
					$sql = mysqli_query($dbcon, "DELETE FROM me_f4 WHERE training_id='$rs_id'");
					$sql = mysqli_query($dbcon, "DELETE FROM me_f5 WHERE training_id='$rs_id'");
					$sql = mysqli_query($dbcon, "DELETE FROM me_f6 WHERE training_id='$rs_id'");
					$sql = mysqli_query($dbcon, "DELETE FROM me_profiling WHERE training_id='$rs_id'");

					$training_name = ($_POST['training_name']);
					$action = $uploader . " Deleted " . $training_name . " from field activities";
					$sql = mysql_query("INSERT INTO `user_system_log` (`id`, `uuid`, `time`, `actions`) VALUES (NULL, '$uuid', CURRENT_TIMESTAMP, '$action')");


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
			$field_activity_id = mysqli_real_escape_string($dbcon, $_POST['field_activity_id']);
			$msg = mysqli_real_escape_string($dbcon, $_POST['msg']);
			if ($sqla = mysqli_query($dbcon, "UPDATE `field_work` SET `flag` = '$flag' WHERE `field_activity_id` = '$field_activity_id'")) {

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
 	<?php if (!empty($statusMsg)) {
			echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
		}
		?>


 	<?php
		if (isset($_GET['msg'])) {
			$print_msg = $_GET['msg'];


			echo '<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>' . $print_msg . '</strong>
                  </div>';
		}
		?>
 	<form action="" method="POST" style="width:" class="form-horizontal">
 		<div class="col-md-12">
 			<div class="col-md-3">
 				<label>Exact Date/ District/ Base Activity Name: <span style="color:red"></span></label>
 				<input type="text" class="form-control" name="mytraining" value="<?php if (($_POST['mytraining']) != "") {
																						echo $activity = $_POST['mytraining'];
																					} ?>">
 			</div>

 			<div class="col-md-3">
 				<label>Start date (From): <span style="color:red">*</span></label>
 				<div class="input-group date" data-provide="datepicker">

 					<input name="start" placeholder="From" type="text" id="test1" class="form-control" value="<?php if (($_POST['start']) != "") {
																													echo $start = date("Y/m/d", strtotime($_POST['start']));
																												} ?>" />

 					<span class="input-group-addon">
 						<i class="glyphicon glyphicon-th"></i>

 					</span>
 				</div>
 			</div>
 			<div class="col-md-3">
 				<label>Start date (To): <span style="color:red">*</span></label>
 				<div class="input-group date" data-provide="datepicker">

 					<input name="end" type="text" id="test1" placeholder="To" class="form-control" value="<?php if (($_POST['end']) != "") {
																												echo $start = date("Y/m/d", strtotime($_POST['end']));
																											} ?>" />
 					<span class="input-group-addon">
 						<i class="glyphicon glyphicon-th"></i>

 					</span>
 				</div>
 			</div>

 			<div class="col-md-3">
 				<div class="control-group">
 					<input type="submit" name="search" class="btn btn-primary" value="Apply Limits" style="margin-top:1.2em;" />

 				</div>
 			</div>

 		</div>
 	</form>
 	<div class="col-md-12 offset-2" style="width:100%; overflow:auto; margin:0 auto">
 		<hr style="border:1px solid rgb(140, 141, 137);" />

 		&nbsp;&nbsp;&nbsp;&nbsp;
 		<table class="table table-bordered table-striped table-hover participants table-responsive">
 			<thead>
 				<tr <b style="font-size: 13px;">
 					<th style="width:50px;">#</th>

 					<th>Training</th>
 					<th>Base Activity</th>
 					<th>Supervisor</th>
 					<th>Start Date</th>
 					<th>End Date</th>
 					<th>Training Area</th>
 					<th>Participants Actions</th>
 					<th>Evaluation|Report<b style="font-size:9px;"> PDF 4.5 MBS</b></th>
 					<th>Delete / Edit</th>
 					<th>Status</th>



 				</tr>
 			</thead>
 			<tbody>
 				<?php
					// start count paging
					include("modules/universal_funcs/paging_class.php");
					if (isset($_GET["page"]))
						$page = (int)$_GET["page"];
					else
						$page = 1;

					$setLimit = 25;
					$pageLimit = ($page * $setLimit) - $setLimit;


				 ?>

 				<?php


					if (isset($_POST['mytraining'])) {
						$activity = $_POST['mytraining'];

						$start = date("Y-m-d", strtotime($_POST['start']));

						$end = date("Y-m-d", strtotime($_POST['end']));

						$sql = "SELECT * FROM field_work WHERE  (start_date >='$start' AND start_date <='$end' ) AND training LIKE '%$activity%'";
					} else {

						//default

						$sql = "SELECT * FROM field_work  LIMIT $pageLimit , $setLimit";
					}


					$result = mysqli_query($dbcon, $sql);
					$i = 1;

					while ($row = mysqli_fetch_array($result)) {



					?>

 					<tr>


 						<td><?php echo $i++; ?></td>
 						<td><?php echo $training = $row['training']; ?><?php $id = $row['field_activity_id']; ?></td>
 						<td><?php $act_id = $row['activity_id'];

								$sqla = "SELECT *FROM `activities` WHERE `activity_id` ='$act_id'";
								$resulta = mysqli_query($dbcon, $sqla);

								while ($rowa = mysqli_fetch_array($resulta)) {
									echo $rowa['activity'];
								}
								?>

 						</td>
 						<td><?php $sp_id = $row['supervisor_id'];
								$sqls = "SELECT *FROM `supervisors` WHERE `supervisor_id` ='$sp_id'";
								$results = mysqli_query($dbcon, $sqls);

								while ($rows = mysqli_fetch_array($results)) {
									echo $rows['surname'] . " " . $rows['firstname'] . " " . $rows['othername'];
								} ?>
 						</td>
 						<td><?php echo  $start_date = $row['start_date']; ?></td>
 						<td><?php echo  $end_date = $row['end_date']; ?></td>
 						<td><?php $gid = $row['training_ground']; ?><?php $sqlg = "SELECT *FROM `grounds` WHERE `ground_id` ='$gid'";
																		$resultg = mysqli_query($dbcon, $sqlg);

																		while ($rowg = mysqli_fetch_array($resultg)) {
																			echo $rowg['ground'];
																		};
																		//get district
																		$did = $row['location']; ?><?php $sqld = "SELECT *FROM `district` WHERE `district_id` ='$did'";
																									$resultd = mysqli_query($dbcon, $sqld);

																									while ($rowd = mysqli_fetch_array($resultd)) {


																										echo $rowd['name'];
																									} ?></td>
 						<td><a href="dashboard.php?action=attach_participants&training=<?php echo $training; ?>">Add Participants(s)</a> |
 							<a href="dashboard.php?action=finish&training=<?php echo $training; ?>">View / Remove Participants(s)</a>
 						</td>

 						<td>

 							<!--button  class="btn btn-sm btn-info"><i class="glyphicon glyphicon-upload"></i>Evaluate</button-->




 							<div class="btn-group">
 								<button type="button" class="btn btn-default btn-link">Action</button>
 								<button type="button" class="btn btn-link btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
 									<span class="caret"></span>
 									<span class="sr-only">Toggle Dropdown</span>
 								</button>
 								<ul class="dropdown-menu" role="menu">
 									<li><a href="" data-toggle="modal" data-target="#eva<?php echo $id; ?>" title="Upload Report"><i class="glyphicon glyphicon-list"></i>Evaluate</a></li>
 									<li><a href="" data-toggle="modal" data-target="#upload<?php echo $id; ?>" title="Upload Report"><i class="glyphicon glyphicon-upload"></i>Upload Report</a></li>
 									<li><a href="modules/start_activity/view_pdf.php?id=<?php echo $id; ?>" title="View Report" target="_blank"><i class="glyphicon glyphicon-eye-open"></i>View Report</a></li>
 								</ul>
 							</div>






 							<div class="modal fade" id="eva<?php echo $id; ?>" tabindex="-1" role="dialog" data-backdrop="static">
 								<div class="modal-dialog modal-sm" style="margin-top:10%;"">
                                      <div class=" modal-content">
 									<div class="modal-header">
 										<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
 										<h4 class="modal-title">
 											<center><i class=""></i>Select Tools to use</center>
 										</h4>
 									</div>
 									<div class="modal-body">

 										<form method="post" action="modules/start_activity/tool_select.php">

 											<div id="">
 												<table>
 													<tr>
 														<td> <label class="btn btn-sm btn-default">PRE SRHR:
 																<input name="m1" id="" value="1" type="checkbox"></label>
 															<p>
 																<p />
 														<td>
 															<label class="btn btn-sm btn-default">POST SRHR:
 																<input name="m2" id="" value="1" type="checkbox"></label>
 															<p></p>
 														</td>
 													</tr>
 													<tr>
 														<td>
 															<label class="btn btn-sm btn-default">PRE SSST:
 																<input name="m3" id="" value="1" type="checkbox"></label>
 															<p></p>
 														</td>
 														<td>
 															<label class="btn btn-sm btn-default">POST SSST:
 																<input name="m4" id="" value="1" type="checkbox"></label>
 															<p></p>
 														</td>

 													</tr>
 													<tr>
 														<td>
 															<label class="btn btn-sm btn-default">PRE TEACH:
 																<input name="m5" id="" value="1" type="checkbox"></label>
 															<p></p>
 														</td>
 														<td>
 															<label class="btn btn-sm btn-default">POST TEACH:
 																<input name="m6" id="" value="1" type="checkbox"></label>
 															<p></p>
 															<input name="training" id="" value="<?php echo $id; ?>" type="hidden"></label>
 														</td>
 													</tr>
 												</table>
 											</div>
 											<div class="modal-footer">
 												<input type="submit" class="btn btn-primary" name="upload" value="Continue">
 											</div>
 										</form>
 									</div>
 								</div>
 							</div>
 	</div>




 	<div class="modal fade" id="upload<?php echo $id; ?>" tabindex="-1" role="dialog" data-backdrop="static">
 		<div class="modal-dialog">
 			<div class="modal-content">
 				<div class="modal-header">
 					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
 					<h4 class="modal-title">
 						<center><i class=""></i>Upload / Update Activity Report</center>
 					</h4>
 				</div>
 				<div class="modal-body">

 					<form method="post" id="uploadform" enctype="multipart/form-data">


 						<div id="">

 							<span id='progress-bar' style="height:50px; color:green;"></span>

 							<label>Activity Report: <span style="color:red">*</span></label>
 							<input type="hidden" name="id" value="<?php echo $id; ?>" style="width:100%;">
 							<input type="hidden" name="training_name" value="<?php echo $training; ?>" style="width:100%;">
 							<input name="userfile" type="file" class="" required>
 							<!--for ajax--><input name="uploader" type="hidden" class="form-control" value="<?php echo $uploader; ?>" required>
 							<p></p>
 							<input type="submit" class="btn btn-primary" name="upload" value="Upload Report(PDF)">
 						</div>
 					</form>
 				</div>
 			</div>
 		</div>
 	</div>

 	</td>
 	<td>
 		<form action="" method="post" style="width:40px;">
 			<input type="hidden" name="id" value="<?php echo $row['field_activity_id']; ?>" />
 			<input type="hidden" name="delete">
 			<?php if ($usertype == 'admin') {
							echo '<input type="hidden" name="training_name" value="<?php echo $training;?>" style="width:100%;">
				  <button  type="button" data-toggle="modal" data-target="#delete' . $row['field_activity_id'] . '" <?php echo" name="delete" title="On click, this record will be deleted!" class="btn btn-sm btn-link" style="float:left;"><i class="glyphicon glyphicon-remove"></i>Delete</button>';
						} ?>


 			<div class="modal fade" tabindex="-1" id="delete<?php echo $row['field_activity_id']; ?>" role="dialog">
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
 							<a href="dashboard.php?action=manage_field_activities&del_id=<?php echo $row['field_activity_id']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</a>
 						</div>
 					</div>
 				</div>

 			</div>



 		</form>
 		<?php if ($usertype == 'admin') { ?>
 			<button data-toggle="modal" data-target="#<?php echo $modalid = 'my' . $row['field_activity_id']; ?>" title="Update activity" class="btn btn-sm btn-link"><i class="glyphicon glyphicon-edit"></i>Edit</button>
 		<?php } ?>
 		<div class="modal fade" id="<?php echo $modalid; ?>" tabindex="-1" role="dialog" data-backdrop="static">
 			<div class="modal-dialog">
 				<div class="modal-content">
 					<div class="modal-header">
 						<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
 						<h4 class="modal-title">
 							<center><i class=""></i>Update activities</center>
 						</h4>
 					</div>
 					<div class="modal-body">

 						<form name="" id="data_form" method="post" action="">
 							<div id="">
 								<label>Current Training Name(Automatically Updates): <span style="color:red">*</span></label>
 								<textarea class="form-control" name="" id="training" cols="2" placeholder="Activity Name" style="width:100%;" readonly><?php echo $training; ?></textarea>
 							</div>



 							<div class="input-group date" data-provide="datepicker">
 								<label>Start date: <span style="color:red">*</span></label>
 								<input name="startdate" type="text" id="test1" class="form-control" value="<?php if ($row['start_date'] != "0000-00-00") {
																												echo $row['start_date'];
																											} ?>" required>
 								<div class="input-group-addon">
 									<span class="glyphicon glyphicon-th"></span>
 								</div>
 							</div>
 							<div class="input-group date" data-provide="datepicker">
 								<label>End date: <span style="color:red">*</span></label>
 								<input name="enddate" type="text" id="test1" class="form-control" value="<?php if ($row['end_date'] != "0000-00-00") {
																												echo $row['end_date'];
																											} ?>" required>
 								<div class="input-group-addon">
 									<span class="glyphicon glyphicon-th"></span>
 								</div>
 							</div>

 							<div id="">
 								<label>Base Activity: <span style="color:red"></span></label>
 								<select class="form-control select2" name="activity_id" id="activity_id myselect" style="width:100%;">
 									<?php
										$sql2 = mysqli_query($dbcon, "SELECT * FROM activities");
										$i2 = 0;
										while ($list2 = mysqli_fetch_array($sql2)) {
											$i2++; ?>
 										<option value="<?php echo $select_op = $list2['activity_id']; ?>" <?php if ($select_op == $act_id) {
																												echo "selected";
																											} ?>><?php echo $list2['activity']; ?>
 										</option>
 									<?php } ?>
 								</select>

 							</div>
 							<div id="">
 								<label>Activity Main Superisor: <span style="color:red"></span></label>
 								<select class="form-control select2" name="supervisor" id="activity_id myselect" style="width:100%;">
 									<?php
										$sql2 = mysqli_query($dbcon, "SELECT * FROM supervisors");
										$i2 = 0;
										while ($list2 = mysqli_fetch_array($sql2)) {
											$i2++; ?>
 										<option value="<?php echo $select_op = $list2['supervisor_id']; ?>" <?php if ($select_op == $sp_id) {
																													echo "selected";
																												} ?>><?php echo $list2['surname'] . " " . $list2['firstname'] . " " . $list2['othername']; ?>
 										</option>
 									<?php } ?>
 								</select>
 							</div>
 							<div id="">
 								<label>Training Ground: <span style="color:red"></span></label>
 								<select class="form-control select2" name="training_ground" id="training_ground myselect" style="width:100%;">
 									<?php
										$sql2 = mysqli_query($dbcon, "SELECT * FROM grounds");
										$i2 = 0;
										while ($list2 = mysqli_fetch_array($sql2)) {
											$i2++; ?>
 										<option value="<?php echo $select_op = $list2['ground_id']; ?>" <?php if ($select_op == $gid) {
																												echo "selected";
																											} ?>><?php echo $list2['ground']; ?>
 										</option>
 									<?php } ?>
 								</select>
 							</div>

 							<div id="">
 								<label>Location: <span style="color:red"></span></label>
 								<select class="form-control select2" name="location" id="location myselect" style="width:100%;">
 									<?php
										$sql1 = mysqli_query($dbcon, "SELECT * FROM district");
										$i1 = 0;
										while ($list1 = mysqli_fetch_array($sql1)) {
											$i1++; ?>
 										<option value="<?php echo $select_op = $list1['district_id']; ?>" <?php if ($select_op == $did) {
																												echo "selected";
																											} ?>><?php echo $list1['name']; ?>
 										</option>
 									<?php } ?>
 								</select>
 							</div>

 							<div id="">
 								<label>Notes: <span style="color:red"></span></label>
 								<textarea class="form-control" name="decription" id="decription" cols="8" rows="8" placeholder="Description" style="background:#ebf8a4; width:100%;"><?php echo $training = $row['notes']; ?></textarea>
 							</div>
 							<input type="hidden" value="<?php echo $row['field_activity_id']; ?>" name="upfield_activity_id">

 							<div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
 								<button class="btn btn-primary" name="update_activity" type="submit"><span class="glyphicon glyphicon-arrow-right"></span>Update Activity</button>
 								<button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-repeat"></span> Reset Form</button>
 						</form>

 					</div>
 				</div>
 			</div>
 		</div>
 	</td>
 	<td>

 		<?php
						//Flag Raiser
						$status = $row['flag'];
						$space = "----|";
						if ($status == 0) {
							echo "<form action='' method='post'>
						  <input type='hidden' value='2' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Activity Partially Acommplished' name='msg'>
						 <button type='submit'  class='btn btn-sm btn-link' name='status'><span class='glyphicon glyphicon-refresh'></span>Initialised ..</button>
						        </form>";
						} else if ($status == 2) {
							echo "<form action='' method='post'>
						  <input type='hidden' value='1' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Successfuly Acommplished' name='msg'>
						 <button type='submit' name='change_flag' class='btn btn-sm btn-link' name='status'><span class='glyphicon glyphicon-arrow-right'></span>Partial Acc..</button>
						 </form>";
						} else if ($status == 1) {
							echo "<form action='' method='post'>
						  <input type='hidden' value='3' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Activity Cancelled' name='msg'>
						 <button type='submit' name='change_flag' class='btn btn-sm btn-link' name='status'><span class='glyphicon glyphicon-ok'></span>Acommplished</button>
						 </form>";
						} else if ($status == 3) {
							echo "<form action='' method='post'>
						  <input type='hidden' value='0' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Activity Re-Opened' name='msg'>
						 <button type='submit' name='change_flag' class='btn btn-sm btn-link' name='status'><span class='glyphicon glyphicon-cancel'></span>Cancelled</button>
						 </form>";
						}



			?>


 	</td>



 	</tr>
 <?php } ?>
 </tbody>
 <tfoot>

 </tfoot>

 </table>


 </div>

 <div class="col-md-6" style="overflow:auto;">
 	<?php
		// Call the Pagination

		echo displayPaginationBelow($setLimit, $page);
		?>
 </div>
 <div class="col-md-6">
 </div>
 </div>

 <script>
 	/*

$('#uploadform').submit(function(e){

	e.preventDefault();

	var data=new FormData(this);

$.ajax({
	url:'modules/start_activity/upload_pdf.php',
	method:'post',
	target:'#progress-bar',
	contentType:false,
	processData:false,
	data:data,
	success:function (res){
                        //$('#progress-bar').hide();

						console.log(res);
                    }
});//ajax

});

/*
	beforeSubmit: function() {
                        $("#progress-bar").width('0%');
                    },
	uploadProgress: function (event, position, total, percentComplete){
						$("#progress-bar").show();
                        $("#progress-bar").width(percentComplete + '%');
                        $("#progress-bar").html('<div id="progress-bar-status">' + percentComplete +' %</div>');


                    },*/
 </script>

 <style type="text/css">
 	.navi {
 		width: 500px;
 		margin: 5px;
 		padding: 2px 5px;
 		border: 1px solid #eee;
 	}

 	.show {
 		color: blue;
 		margin: 5px 0;
 		padding: 3px 5px;
 		cursor: pointer;
 		font: 15px/19px Arial, Helvetica, sans-serif;
 	}

 	.show a {
 		text-decoration: none;
 	}

 	.show:hover {
 		text-decoration: underline;
 	}


 	ul.setPaginate li.setPage {
 		padding: 15px 10px;
 		font-size: 14px;
 	}

 	ul.setPaginate {
 		margin: 0px;
 		padding: 0px;
 		height: 100%;
 		overflow: hidden;
 		font: 12px 'Tahoma';
 		list-style-type: none;
 	}

 	ul.setPaginate li.dot {
 		padding: 3px 0;
 	}

 	ul.setPaginate li {
 		float: left;
 		margin: 0px;
 		padding: 0px;
 		margin-left: 5px;
 	}



 	ul.setPaginate li a {
 		background: none repeat scroll 0 0 #ffffff;
 		border: 1px solid #cccccc;
 		color: #999999;
 		display: inline-block;
 		font: 15px/25px Arial, Helvetica, sans-serif;
 		margin: 5px 3px 0 0;
 		padding: 0 5px;
 		text-align: center;
 		text-decoration: none;
 	}

 	ul.setPaginate li a:hover,
 	ul.setPaginate li a.current_page {
 		background: none repeat scroll 0 0 #0d92e1;
 		border: 1px solid #000000;
 		color: #ffffff;
 		text-decoration: none;
 	}

 	ul.setPaginate li a {
 		color: black;
 		display: block;
 		text-decoration: none;
 		padding: 5px 8px;
 		text-decoration: none;
 	}
 </style>