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
				<h5 class="box-title">Profiled Participants</h5>
				<p class="danger"></p>
			</div>
			<table id="mydata" class="table table-hover table-responsive table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>Participant</th>
						<th>Gender</th>
						<th>Age Group</th>
						<th>Designation</th>
						<th>District</th>
						<th>Sub County</th>
					</tr>
				</thead>
				<tbody>
					<?php


					echo $sname = mysqli_real_escape_string($dbcon, $_POST['sname']);
					$fname = mysqli_real_escape_string($dbcon, $_POST['fname']);
					$oname = mysqli_real_escape_string($dbcon, $_POST['oname']);
					$age_group = mysqli_real_escape_string($dbcon, $_POST['age_group']);
					$location = mysqli_real_escape_string($dbcon, $_POST['location']);
					$i = 1;
					$sql = "SELECT * from participants, me_profiling WHERE participants.participant_id=me_profiling.participant_id AND surname LIKE'%$sname%' AND firstname LIKE'%$fname%' AND othername LIKE'%$oname%' 
					AND age_group LIKE'%$age_group%'AND residence_district LIKE'%$location%'AND postal_address LIKE'%$location%' LIMIT 1000";
					$result = mysqli_query($dbcon, $sql);
					while ($row = mysqli_fetch_array($result)) {



					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td width><a href="dashboard.php?action=person_profile&pid=<?php echo $row['participant_id']; ?>" target="_blank"><?php echo $row['surname'] . " " . $row['firstname'] . " " . $row['othername']; ?></a></td>
							<td width><?php echo $row['gender']; ?></td>
							<td width><?php echo $row['age_group']; ?></td>
							<td width><?php echo $row['position']; ?></td>
							<td><?php echo $row['residence_district']; ?></td>
							<td> <?php echo $row['postal_address']; ?></td>




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