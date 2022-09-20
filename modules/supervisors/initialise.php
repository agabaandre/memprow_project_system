<?php
include("db_connector/mysqli_conn.php");
?>

<div class="col-md-12" style=" background:white; border-radius: 5px;">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="dashboard.php?action=add_supervisors">Register New Supervisor</a></li>
			<li class=""><a href="dashboard.php?action=view_supervisors">Manage Supervisors</a></li>
		</ul>
	</div>

</div>
<div class="col-md-12">
	<?php if (isset($_POST['add'])) {
		$surname = mysqli_real_escape_string($dbcon, $_POST['surname']);
		$firstname = mysqli_real_escape_string($dbcon, $_POST['firstname']);
		$othername = mysqli_real_escape_string($dbcon, $_POST['othername']);
		$gender = mysqli_real_escape_string($dbcon, $_POST['gender']);
		$contact = mysqli_real_escape_string($dbcon, $_POST['contact']);
		$email = mysqli_real_escape_string($dbcon, $_POST['email']);

		$sql = mysqli_query($dbcon, "SELECT * from supervisors where urname='$surname' AND firstname='$firstname'AND othername='$othername' AND gender='$gender' AND contact='$contact'");
		$count = mysqli_fetch_row($sql);
		if (count($count) == 1) {
			$msg = "Supervisor's Record Already Exists! Please Verify</font>";
			echo '<div class="alert alert-danger alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>' . $msg . '</strong>
                   </div>';
		} else {
			if ($act = mysqli_query($dbcon, "INSERT INTO `supervisors` (`supervisor_id`, `surname`, `firstname`, `othername`, `gender`, 
 `contact`, `email`, `flag`) VALUES (NULL, '$surname','$firstname', '$othername', '$gender','$contact', '$email', '1')")) {

				echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Saved Succeefully</strong>
                   </div>';
			}
		}
	}
	?>
</div>
<div class="col-md-4">
	<h4 class="modal-title">
		<center><i class="fa fa-user fa-spin"></i>Register Supervisor</center>
	</h4>
	<form name="" id="data_form" method="post" action="">

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
		<label class="btn btn-sm btn-default">Male:
			<input name="gender" id="" value="Male" type="radio"></label>
		<label class="btn btn-sm btn-default">Female:
			<input name="gender" id="" value="Female" type="radio" checked></label>
		<label class="btn btn-sm btn-default">Others:
			<input name="gender" id="" value="Others" type="radio"></label>
		<div id="">
			<label>Mobile Contact: <span style="color:red">*</span></label>
			<input style="width:100%;" class="form-control" name="contact" id="Contact" value="<?php echo $contact; ?>" placeholder="Contact" type="tel" />
		</div>
		<div id="">
			<label>Email: <span style="color:red"></span></label>
			<input style="width:100%;" class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="Email" type="email" />
		</div>
		<div id="footer-buttons" style="margin:20px;">
			<button class="btn btn-primary" name="add" type="submit"><span class="glyphicon glyphicon-save"></span>Save</button>

	</form>
</div>
</div>



<div class="col-md-8">
</div>
</div>