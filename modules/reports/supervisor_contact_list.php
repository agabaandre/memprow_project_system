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
		<form action="" method="POST" class="form-inline">
			<div id="">
				<label>Surname : <span style="color:red"></span></label>
				<input type="text" class="form-control" name="sname" placeholder="Surname">
				<label>First Name : <span style="color:red"></span></label>
				<input type="text" class="form-control" name="fname" placeholder="First Name">
				<label>Other Name : <span style="color:red"></span></label>
				<input type="text" class="form-control" name="oname" placeholder="Other Name">

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
				<h5 class="box-title">Supervisor Contact List</h5>
				<p class="danger"></p>
			</div>
			<table id="mydata" class="table table-hover table-responsive table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>Supervisor</th>
						<th>Contacts</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php


					echo $sname = mysqli_real_escape_string($dbcon, $_POST['sname']);
					$fname = mysqli_real_escape_string($dbcon, $_POST['fname']);
					$oname = mysqli_real_escape_string($dbcon, $_POST['oname']);
					$i = 1;
					$sql = "SELECT * from supervisors WHERE surname LIKE'%$sname%' AND firstname LIKE'%$fname%' AND othername LIKE'%$oname%' LIMIT 1000";
					$result = mysqli_query($dbcon, $sql);
					while ($row = mysqli_fetch_array($result)) {



					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td width><?php echo $row['surname'] . " " . $row['firstname'] . " " . $row['othername']; ?></td>
							<td>Email: <a href="mailto:<?php echo $row['email'] . " "; ?>"><?php echo $row['email']; ?></a> Telephone: <a href="tel:<?php echo $row['contact']; ?>"><?php echo $row['contact']; ?></a></td>
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