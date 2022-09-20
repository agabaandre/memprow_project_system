<?php
include("db_connector/mysqli_conn.php");

?>
<div class="col-md-12" style=" background:white; border-radius: 5px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="btn btn-sm btn-default"><a href="dashboard.php?action=reports">Back</a></li>

		</ul>
	</div>
	<div class="col-md-12">
		<div class="col-md-3">
			<form action="" method="POST" class="form-inline">

				<label>Activity: <span style="color:red">*</span></label>
				<select class="form-control select2" name="activity_id" id="objective_id myselect" style="width:100%;">
					<option value="">All
					</option>
					<?php
					//active objective
					$act_op = $_POST['activity_id'];

					$sql1 = mysqli_query($dbcon, "SELECT * FROM activities");
					$i1 = 0;
					while ($list1 = mysqli_fetch_array($sql1)) {
						$i1++; ?>
						<option value="<?php echo $sel_op = $list1['activity_id']; ?>" <?php if ($sel_op == $act_op) {
																							echo "selected";
																						} ?>><?php echo $list1['activity']; ?>
						</option>
					<?php } ?>

				</select>

		</div>
		<div class="col-md-3">
			<label>Objective: <span style="color:red">*</span></label>
			<select class="form-control select2" name="objective_id" id="objective_id myselect" style="width:100%;">
				<option value="">All
				</option>
				<?php
				//active objective
				$active_op = $_POST['objective_id'];

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

		</div>
		<div class="col-md-3">
			<label>Training Ground: <span style="color:red">*</span></label>
			<select class="form-control select2" name="ground" id="objective_id myselect" style="width:100%;">
				<option value="">All
				</option>
				<?php
				//active objective
				$acts = $_POST['ground'];

				$sql3 = mysqli_query($dbcon, "SELECT * FROM grounds");
				$i1 = 0;
				while ($list1 = mysqli_fetch_array($sql3)) {
					$i1++; ?>
					<option value="<?php echo $select_op = $list1['ground_id']; ?>" <?php if ($select_op == $acts) {
																						echo "selected";
																					} ?>><?php echo $list1['ground']; ?>
					</option>
				<?php } ?>

			</select>
			<p></p>
			<button type="submit" class="btn btn btn-info" name="apply_limits"><span class="glyphicon glyphicon-ok"></span>Apply Limits</button>

		</div>



		</form>
	</div>
	<p></p>
	<div class="col-md-12">
		<?php include("src/export.php"); ?>
		<script>
			function printDiv(printableDiv) {

				var printContents = document.getElementById(printableDiv).innerHTML;
				var originalContents = document.body.innerHTML;
				document.body.innerHTML = printContents;

				window.print();
				document.body.innerHTML = originalContents;
			}
		</script>
		<button type="button" class="btn btn-sm btn-default" onclick="printDiv('printableArea')">Web Print</button>
		<hr style="border:1px solid rgb(140, 141, 137);" />

		<p style="font-weight:bold;"></p>


		<div id="printableArea">
			<div class="box-header with-border">
				<h5 class="box-title">Field Activities and their Status</h5>
				<p class="danger"></p>
			</div>
			<table id="mydata" class="table table-hover table-responsive table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>Training/ Field Activity</th>
						<th>Start Date</th>
						<th>Training Ground</th>
						<th>Notes</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$activity_id = $_POST['activity_id'];
					$objective_id = $_POST['objective_id'];
					$training_ground = $_POST['ground'];
					$i = 1;
					$sql = "SELECT field_work.training,field_work.start_date,field_work.training_ground,field_work.notes,field_work.flag FROM field_work,activities,objectives WHERE field_work.activity_id=activities.activity_id AND activities.objective_id=objectives.objective_id AND activities.objective_id LIKE'%$objective_id' AND field_work.activity_id LIKE'%$activity_id'AND field_work.training_ground LIKE'%$training_ground' ORDER BY field_work.start_date DESC LIMIT 1000";
					$result = mysqli_query($dbcon, $sql);
					while ($row = mysqli_fetch_array($result)) {



					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td width><?php echo $row['training']; ?></td>
							<td><?php echo $row['start_date']; ?></td>
							<td><?php $gid = $row['training_ground'];
								$sqlg = "SELECT *FROM `grounds` WHERE `ground_id` ='$gid'";
								$resultg = mysqli_query($dbcon, $sqlg);

								while ($rowg = mysqli_fetch_array($resultg)) {
									echo $rowg['ground'];
								}; ?></td>
							<td><?php echo $row['notes']; ?></td>
							<td><?php $status = $row['flag'];

								$space = "----|";
								if ($status == 0) {
									echo "<form action='' method=''>
						  <input type='hidden' value='2' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Activity Partially Acommplished' name='msg'>
						 <p style='color:blue'>Initialised<p>       
						 </form>";
								} else if ($status == 2) {
									echo "<form action='' method=''>
						  <input type='hidden' value='1' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Successfuly Acommplished' name='msg'>
						 <p style='color:orange'>Partially Accomplished<p> </form>";
								} else if ($status == 1) {
									echo "<form action='' method=''>
						  <input type='hidden' value='3' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Activity Cancelled' name='msg'>
						 <p style='color:green;'>Accomplised<p> </form>";
								} else if ($status == 3) {
									echo "<form action='' method=''>
						  <input type='hidden' value='0' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Activity Re-Opened' name='msg'>
						<p style='color:red;'>Cancelled<p>
						 </form>";
								}



								?>


							</td>



						</tr>
					<?php  } ?>
				</tbody>
				<tfoot>
					<th>

				</tfoot>
			</table>
		</div>
	</div>
</div>
</div>
</div>