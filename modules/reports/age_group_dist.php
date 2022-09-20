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
				<select class="form-control select2" name="field_activity_id" id="factivity_id myselect" style="width:100%;">
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
		<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

		<script src="js/highcharts/highcharts.js"></script>
		<script src="js/highcharts/exporting.js"></script>

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
		<script>
			$(function() {
				// turn the element to select2 select style
				$('.select2').select2();
			});
		</script>
		<button type="button" class="btn btn-sm btn-default" onclick="printDiv('printableArea')">Web Print</button>
		<hr style="border:1px solid rgb(140, 141, 137);" />

		<p style="font-weight:bold;"></p>


		<div id="printableArea">
			<div class="box-header with-border">
				<h5 class="box-title">Age Distribution by Activity</h5>
				<p class="danger"></p>
			</div>
			<table id="mydata" class="table table-hover table-responsive table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>Training</th>
						<th>Start Date</th>
						<th>13-18 Years</th>
						<th> 19-24 Years</th>
						<th> 25-29 Years</th>
						<th> 31 Years and Above</th>
						<th>Total</th>
						<th></th>
					</tr>

				</thead>
				<tbody>
					<?php

					$field_activity_id = $_POST['field_activity_id'];
					$i = 1;
					$sql = "SELECT count(age_group) as ag1,field_work.field_activity_id,field_work.start_date,field_work.training AS train, field_participants.training,
field_participants.participant_id,participants.participant_id
FROM field_work, field_participants, participants WHERE field_participants.participant_id = participants.participant_id
AND field_work.field_activity_id = field_participants.training  AND field_participants.training='$field_activity_id' AND age_group='13-18 Years'";


					$result = mysqli_query($dbcon, $sql);
					while ($row = mysqli_fetch_array($result)) {



					?>

						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $mytrain = $row['train']; ?></td>
							<td><?php echo $row['start_date']; ?></td>
							<td><?php echo $ag1 = $row['ag1']; ?></td>

							<td><?php $sql2 = "SELECT count(age_group) as ag2,field_work.field_activity_id,field_work.start_date,field_work.training AS train, field_participants.training,
field_participants.participant_id,participants.participant_id
FROM field_work, field_participants, participants WHERE field_participants.participant_id = participants.participant_id
AND field_work.field_activity_id = field_participants.training  AND field_participants.training='$field_activity_id' AND age_group='19-24 Years'";
								$result2 = mysqli_query($dbcon, $sql2);
								while ($row2 = mysqli_fetch_array($result2)) {
									echo $ag2 = $row2['ag2'];
								}
								?></td>
							<td><?php $sql3 = "SELECT count(age_group) as ag3,field_work.field_activity_id,field_work.start_date,field_work.training AS train, field_participants.training,
field_participants.participant_id,participants.participant_id
FROM field_work, field_participants, participants WHERE field_participants.participant_id = participants.participant_id
AND field_work.field_activity_id = field_participants.training  AND field_participants.training='$field_activity_id' AND age_group='25-29 Years'";
								$result3 = mysqli_query($dbcon, $sql3);
								while ($row3 = mysqli_fetch_array($result3)) {
									echo $ag3 = $row3['ag3'];
								}
								?></td>
							<td><?php $sql4 = "SELECT count(age_group) as ag4,field_work.field_activity_id,field_work.start_date,field_work.training AS train, field_participants.training,
field_participants.participant_id,participants.participant_id
FROM field_work, field_participants, participants WHERE field_participants.participant_id = participants.participant_id
AND field_work.field_activity_id = field_participants.training  AND field_participants.training='$field_activity_id' AND age_group='30 Years and Above'";
								$result4 = mysqli_query($dbcon, $sql4);
								while ($row4 = mysqli_fetch_array($result4)) {
									echo $ag4 = $row4['ag4'];
								}
								?></td>
							<td><b><?php $total = $ag1 + $ag2 + $ag3 + $ag4;
									echo $total ?></b></td>
							<td><a href="?action=view_participants_list&fid=<?php echo $field_activity_id = $_POST['field_activity_id']; ?>&limit=age_group">See List</a></td>
						</tr>

					<?php  } ?>
				</tbody>
				<tfoot>


				</tfoot>
			</table>
			<script type="text/javascript">
				$(function() {
					$('#graph').highcharts({
						chart: {
							type: 'line'
						},
						title: {
							text: '<?php echo $mytrain; ?> Participant Age Distribution Graph'
						},
						xAxis: {
							categories: ['13-18 Years', '19-25 Years', '25-29 Years', '30 Years and Above']
						},
						yAxis: {
							min: 0,
							title: {
								text: 'Participants'
							}
						},
						legend: {
							reversed: true
						},
						plotOptions: {
							series: {
								stacking: 'normal'
							}
						},
						series: [{
								name: 'Age distribution',
								color: '#0071de',
								data: [<?php echo $ag1; ?>, <?php echo $ag2; ?>, <?php echo $ag3; ?>, <?php echo $ag4; ?>]

							}


						]
					});
				});


				//Absorbed 
				//Left
				//Not absorbed
				//Not eligible for absorption
				//Not yet submitted for absorption
				//Position not advertised/no vacancy
				//Submitted for absorption
			</script>

			<div class="col-md-12" id="graph" style="min-width:50%; max-width:95%; height:500px;">
			</div>
		</div>
	</div>