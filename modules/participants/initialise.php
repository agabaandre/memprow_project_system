<?php
include("db_connector/mysqli_conn.php");
?>

<div class="col-md-12" style=" background:white; border-radius: 5px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="dashboard.php?action=add_participants">Register New Participant</a></li>
			<li class=""><a href="dashboard.php?action=view_participants">Manage Participants</a></li>
		</ul>
	</div>



	<h4 class="modal-title">
		<center><i class=""></i>Register Participant</center>
	</h4>
</div>

<form name="" id="data_form" method="post" action="modules/participants/save_participant.php">
	<div class="col-md-12" style="min-width:100%;">
		<div class="msg">

		</div>
	</div>
	<div class="col-md-4">



		<div id="">
			<label>Surname: <span style="color:red">*</span></label>
			<input style="width:100%;" class="form-control" name="surname" id="Surname" value="<?php echo $surname; ?>" placeholder="Surname" type="text" required>
		</div>
		<div id="">
			<label>First Name: <span style="color:red">*</span></label>
			<input style="width:100%;" class="form-control" name="firstname" id="Firstname" value="<?php echo $firstname; ?>" placeholder="First Name" type="text" required>
		</div>
		<div id="">
			<label>Other Name: </label>
			<input style="width:100%;" class="form-control" name="othername" id="othername" value="<?php echo $Othername; ?>" placeholder="Other Name" type="text">
			<input style="width:100%;" class="form-control" name="add" id="add" value="" placeholder="" type="hidden">
		</div>
		<label style="width:100%;">Gender: </label>
		<?php $sel_gender = mysqli_real_escape_string($dbcon, $_POST['gender']); ?>
		<label class="btn btn-sm btn-default">Male:
			<input name="gender" id="" value="Male" type="radio" <?php if ($sel_gender == 'Male') {
																		echo "checked";
																	} ?>></label>
		<label class="btn btn-sm btn-default">Female:
			<input name="gender" id="" value="Female" type="radio" <?php if ($sel_gender == 'Female') {
																		echo "checked";
																	} ?>></label>
		<label class="btn btn-sm btn-default">Others:
			<input name="gender" id="" value="Others" type="radio" <?php if ($sel_gender == 'Others') {
																		echo "checked";
																	} ?>></label>
		<label style="width:100%;">Age Group: </label>
		<?php $sel_group = mysqli_real_escape_string($dbcon, $_POST['age_group']); ?>
		<label class="btn btn-sm btn-default">(13-18 Years):
			<input name="age_group" id="" value="13-18 Years" type="radio" <?php if ($sel_group == '13-18 Years') {
																				echo "checked";
																			} ?>></label>
		<label class="btn btn-sm btn-default"> (19-24 Years):
			<input name="age_group" id="" value="19-24 Years" type="radio" <?php if ($sel_group == '19-24 Years') {
																				echo "checked";
																			} ?>></label>
		<label class="btn btn-sm btn-default">(25-29 Years):
			<input name="age_group" id="" value="25-29 Years" type="radio" <?php if ($sel_group == '25-29 Years') {
																				echo "checked";
																			} ?>></label>
		<label class="btn btn-sm btn-default">(Above 30 Years):
			<input name="age_group" id="" value="Above 30 Years" type="radio" <?php if ($sel_group == 'Above 30 Years') {
																					echo "checked";
																				} ?>></label>
		<div id="">
			<label>Location: <span style="color:red">*</span></label>
			<select style="width:100%;" name="district" class="form-control select2" id="">
				<?php
				$sel_district = mysqli_real_escape_string($dbcon, $_POST['district']);
				$sql = mysqli_query($dbcon, "SELECT * FROM district");
				$i = 0;
				while ($list = mysqli_fetch_array($sql)) {
					$i++; ?>
					<option value="<?php echo $myp = $list['name']; ?>" <?php if ($sel_district == $myp) {
																			echo "selected";
																		} ?>><?php echo $list['name']; ?>
					</option>
				<?php } ?>
			</select>
			<a href="?action=manage_locations" target="blank">Add New Location</a>
		</div>
		<div id="">
			<label>Sub County: </label>
			<textarea style="width:100%;" class="form-control" name="postal_address" id="" placeholder="Sub County"><?php echo $postal_address; ?></textarea>
		</div>
		<div id="">
			<label>Mobile Contact: <span style="color:red"></span></label>
			<input style="width:100%;" class="form-control" name="contact" id="Contact" value="<?php echo $contact; ?>" placeholder="Contact" type="tel" />
		</div>




	</div>


	<div class="col-md-4">
		<div id="">
			<label>Telephone: <span style="color:red"></span></label>
			<input style="width:100%;" class="form-control" name="telephone" id="Contact2" value="<?php echo $telphone; ?>" placeholder="Telephone" type="tel" />
		</div>
		<div id="">
			<label>Email: <span style="color:red"></span></label>
			<input style="width:100%;" class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="Email" type="email" />
		</div>

		<div id="">
			<label>Institution: <span style="color:red"></span></label>
			<input style="width:100%;" class="form-control" name="institution" id="institution" value="<?php echo $institution; ?>" placeholder="Institution" type="text" />
		</div>
		<div id="">
			<label>Designation: <span style="color:red"></span></label>
			<select style="width:100%;" name="position" class="form-control select2" id="">
				<?php
				$active_pos = mysqli_real_escape_string($dbcon, $_POST['position']);
				$sql = mysqli_query($dbcon, "SELECT * FROM position");
				$i = 0;
				while ($list = mysqli_fetch_array($sql)) {
					$i++; ?>
					<option value="<?php echo $myp = $list['position']; ?>" <?php if ($active_pos == $myp) {
																				echo "selected";
																			} ?>><?php echo $list['position']; ?>
					</option>
				<?php } ?>
			</select>
			<a href="?action=jobs" target="blank">Add New Designation /Occupation</a>
		</div>

		<div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
			<button class="btn btn-primary" name="add" type="submit"><span class="glyphicon glyphicon-save"></span>Save</button>

</form>


</div>
</div>
<div class="col-md-4">
</div>

<script>
	$('#data_form').submit(function(e) {
		e.preventDefault();

		var method = $(this).attr('method');
		var path = $(this).attr('action');

		var form_data = $(this).serialize();

		console.log(form_data);



		$('.msg').html("<center><font color='green'><b>Attempting to save...</b></font></center>");


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