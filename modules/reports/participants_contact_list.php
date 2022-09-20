<?php
include("db_connector/mysqli_conn.php");

?>
<div class="col-md-12" style=" background:white; border-radius: 5px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="btn btn-sm btn-default"><a href="dashboard.php?action=reports">Back</a></li>

		</ul>
	</div>
	<div class="col-md-6">
		<form action="" method="POST" style="width:50%;" class="form-horizontal">
			<div id="">
				<label>Surname : <span style="color:red"></span></label>
				<input type="text" class="form-control" name="sname" placeholder="Surname">
				<label>First Name : <span style="color:red"></span></label>
				<input type="text" class="form-control" name="fname" placeholder="First Name">
				<label>Other Name : <span style="color:red"></span></label>
				<input type="text" class="form-control" name="oname" placeholder="Other Name">


			</div>


			<p></p>
	</div>
	<div class="col-md-6">
		<label>Age Group : <span style="color:red"></span></label>
		<input type="text" class="form-control" name="age_group" placeholder="Age Group" style="width:50%;">
		<label>Location: <span style="color:red"></span></label>
		<input type="text" class="form-control" name="location" placeholder="Sub County, District etc" style="width:50%;">

		<label>Activity: <span style="color:red">*</span></label>
		<select class="form-control select2" name="training" id="objective_id myselect" style="width:100%;">
			<option value="">All
			</option>
			<?php
			//active objective
			$act_op = $_POST['training'];

			$sql1 = mysqli_query($dbcon, "SELECT field_activity_id,training FROM field_work");
			$i1 = 0;
			while ($list1 = mysqli_fetch_array($sql1)) {
				$i1++; ?>
				<option value="<?php echo $sel_op = $list1['field_activity_id']; ?>" <?php if ($sel_op == $act_op) {
																							echo "selected";
																						} ?>><?php echo $list1['training']; ?>
				</option>
			<?php } ?>

		</select>
		<p></p>
		<button type="submit" class="btn btn btn-info" name="apply_limits"><span class="glyphicon glyphicon-ok"></span>Apply Limits</button>
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
				<p class="danger"></p>
			</div>
			<table id="mydata" class="table table-hover table-responsive table-bordered">
				<thead>
					<tr>
						<td colspan=7>
							<h4>Participants Contact List for <?php $act_op = $_POST['training'];
																$sqlname = mysqli_query($dbcon, "SELECT training from field_work WHERE field_activity_id='$act_op'");
																$resultname = mysqli_fetch_assoc($sqlname);
																echo $resultname['training'];
																?></h4>
						</td>
					</tr>
					<tr>
						<th>No.</th>
						<th>Participant</th>
						<th>Gender</th>
						<th>Age Group</th>
						<th>Designation</th>
						<th>Address</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php


					echo $sname = mysqli_real_escape_string($dbcon, $_POST['sname']);
					$fname = mysqli_real_escape_string($dbcon, $_POST['fname']);
					$oname = mysqli_real_escape_string($dbcon, $_POST['oname']);
					$age_group = mysqli_real_escape_string($dbcon, $_POST['age_group']);
					$location = mysqli_real_escape_string($dbcon, $_POST['location']);
					$training = mysqli_real_escape_string($dbcon, $_POST['training']);
					$i = 1;
					$sql = "SELECT surname,firstname,othername,gender,age_group,residence_district,postal_address,contact1,contact2,email,position,flag,training
					from participants,field_participants WHERE surname LIKE'%$sname%' AND firstname LIKE'%$fname%' AND othername LIKE'%$oname%' AND age_group LIKE'%$age_group%'AND 
					residence_district LIKE'%$location%'AND postal_address LIKE'%$location%' AND participants.participant_id=field_participants.participant_id
					AND training LIKE'%$training%' LIMIT 1000";
					$result = mysqli_query($dbcon, $sql);
					while ($row = mysqli_fetch_array($result)) {



					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td width><?php echo $row['surname'] . " " . $row['firstname'] . " " . $row['othername']; ?></td>
							<td width><?php echo $row['gender']; ?></td>
							<td width><?php echo $row['age_group']; ?></td>
							<td width><?php echo $row['position']; ?></td>
							<td><?php echo $row['residence_district']; ?>, <?php echo $row['postal_address']; ?>, <a href="mailto:<?php echo $row['email'] . " "; ?>"><?php echo $row['email']; ?></a>, <a href="tel:<?php echo $row['contact1']; ?>"><?php echo $row['contact1'] . " "; ?>, <a href="tel:<?php echo $row['contact2']; ?>"><?php echo $row['contact2']; ?></a></td>


							<td><?php $status = $row['flag'];
								if ($flag = 1) {
									echo '<i style="color:green;">Active</i>';
								} else {
									echo '<i style="color:red;">Not Active</i>';
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