<script>
	function myFunction() {
		// Declare variables
		var input, filter, table, tr, td, i;
		input = document.getElementById("myInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("mydata");
		tr = table.getElementsByTagName("tr");

		// Loop through all table rows, and hide those who don't match the search query
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[2];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}
</script>

<?php
include("db_connector/mysqli_conn.php");
?>

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
				<label>Select Field Work Activity: <span style="color:red"></span></label>
				<select class="form-control select2" name="fid" id="factivity_id myselect" style="width:100%;">
					<?php
					$sql2 = mysqli_query($dbcon, "SELECT DISTINCT (
field_activity_id
), field_work.training
FROM field_work, field_participants
WHERE field_participants.training = field_activity_id");

					while ($list2 = mysqli_fetch_array($sql2)) {
					?>
						<option value="<?php echo $list2['field_activity_id']; ?>"><?php echo $list2['training']; ?>
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
				<h5 class="box-title">Gender Distribution by Activity</h5>
				<p class="danger"></p>
			</div>
			<table id="mydata" class="table table-bordered table-hover table-responsive">
				<thead>
					<tr>
						<th>No</th>

						<th>Name</th>
						<th>Gender</th>
						<th>Designation</th>
						<th>Age Group</th>
						<th>Residence</th>
						<th>Postal Address</th>
						<th>Mobile Contact</th>
						<th>Telephone </th>
						<th>Email </th>


					</tr>
				</thead>
				<tbody id="myUL">
					<?php
					$field_activity_id = $_REQUEST['fid'];
					$value = $_REQUEST['limit'];
					$sql = "SELECT * FROM `participants`, `field_participants` WHERE participants.participant_id=field_participants.participant_id AND training='$field_activity_id' ORDER BY $value ASC";
					$result = mysqli_query($dbcon, $sql);
					$i = 1;
					while ($row = mysqli_fetch_array($result)) {
						$id = $row['participant_id'];

					?>

						<tr>
							<td><?php echo  $i++; ?></td>

							<td>
								<p <?php
									//selected participants identifier
									$sqli = "SELECT * FROM `field_participants` WHERE `training`='$field_activity_id'";
									$resulti = mysqli_query($dbcon, $sqli);
									while ($rowi = mysqli_fetch_array($resulti)) {
										$returned_part = $rowi['participant_id'];

										if ($returned_part == $id) {
											echo 'style="font-weight:bold; text-decoration:none;"';
										}
									}  ?>><?php echo $myname = $row['surname'] . " " . $row['firstname'] . " " . $row['othername']; ?></p>
							</td>
							<td><?php echo  $row['gender']; ?></td>
							<td> <?php echo $active_opp = $position = $row['position']; ?></td>
							<td><?php echo  $row['age_group']; ?></td>
							<td> <?php echo $active_op = $row['residence_district']; ?></td>
							<td> <?php echo $position = $row['postal_address']; ?></td>
							<td> <?php echo $department = $row['contact1']; ?></td>
							<td> <?php echo $department = $row['contact2']; ?></td>
							<td> <?php echo $department = $row['email']; ?></td>



						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
				</tfoot>

			</table>
			</form>


		</div>
	</div>


	<div class="col-md-4">

	</div>
	<div class="col-md-4">

	</div>
</div>