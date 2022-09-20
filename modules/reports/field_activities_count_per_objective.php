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
		<form action="" method="POST" style="width:30%;" class="form-inline">
			<div id="">
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
			<div id="">
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
			<p></p>
			<button type="submit" class="btn btn btn-info" name="apply_limits"><span class="glyphicon glyphicon-ok"></span>Apply Limits</button>
			<p></p>

		</form>
	</div>
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
				<h5 class="box-title">Field Activities Count by Activity and Objective</h5>
				<p class="danger"></p>
			</div>
			<table id="mydata" class="table table-hover table-responsive table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>Objective</th>

						<th>Trainings/Field Actities</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$activity_id = $_POST['activity_id'];
					$objective_id = $_POST['objective_id'];
					$i = 1;
					$sql = "SELECT objective,activity,training, count(field_activity_id) AS numbers FROM field_work, objectives,activities WHERE activities.objective_id = objectives.objective_id AND field_work.activity_id = activities.activity_id AND activities.objective_id LIKE'%$objective_id' AND field_work.activity_id LIKE'%$activity_id'";
					$result = mysqli_query($dbcon, $sql);
					while ($row = mysqli_fetch_array($result)) {



					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td width><?php echo $row['objective']; ?></td>
							<td><?php echo $row['numbers']; ?></td>



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