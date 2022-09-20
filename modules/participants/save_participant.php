
<?php if (isset($_POST['add'])) {

	include("../../db_connector/mysqli_conn.php");
	include("../../init.php");

	$surname = mysqli_real_escape_string($dbcon, $_POST['surname']);
	$firstname = mysqli_real_escape_string($dbcon, $_POST['firstname']);
	$othername = mysqli_real_escape_string($dbcon, $_POST['othername']);
	$gender = mysqli_real_escape_string($dbcon, $_POST['gender']);
	$age_group = mysqli_real_escape_string($dbcon, $_POST['age_group']);
	$district = mysqli_real_escape_string($dbcon, $_POST['district']);
	$postal_address = mysqli_real_escape_string($dbcon, $_POST['postal_address']);
	$contact = mysqli_real_escape_string($dbcon, $_POST['contact']);
	$telephone = mysqli_real_escape_string($dbcon, $_POST['telephone']);
	$email = mysqli_real_escape_string($dbcon, $_POST['email']);
	$institution = mysqli_real_escape_string($dbcon, $_POST['institution']);
	$position = mysqli_real_escape_string($dbcon, $_POST['position']);

	if (($_POST['ignore']) != 'ignore') {

		$count = mysqli_query($dbcon, " SELECT * from participants WHERE surname='$surname' AND firstname='$firstname'AND position='$position' AND othername='$othername'AND residence_district='$district' AND gender='$gender'");
		$list = mysqli_fetch_array($count);
		if (count($list) >= 1) {
			$msg = "This Person's Record Already Exists! Please Verify or add another name</font>";
			echo '<div class="alert alert-danger alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>' . $msg . '</strong>
					 <form action="" method="post">
					 <label class="btn btn-default">Click to Ignore Duplicate Record
					 <input type="checkbox" value="ignore" name="ignore"></label>
					 
              </div>';
		} else {
			if ($act = mysqli_query($dbcon, "INSERT INTO participants (`participant_id`, `surname`, `firstname`, `othername`, `gender`, `age_group`, `residence_district`, 
 `postal_address`, `contact1`, `contact2`, `email`,`institution`,`position`, `flag`) VALUES (NULL, '$surname','$firstname', '$othername', '$gender', '$age_group', '$district',
 '$postal_address', '$contact', '$telephone', '$email','$institution', '$position', '1')")) {

				echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>New Record Saved Successfully</strong>
				   
                   </div>';
			}
		}
	} //if ignore not set

	else if (($_POST['ignore']) == 'ignore') {

		if ($act = mysqli_query($dbcon, "INSERT INTO participants (`participant_id`, `surname`, `firstname`, `othername`, `gender`, `age_group`, `residence_district`, 
 `postal_address`, `contact1`, `contact2`, `email`, `institution`,`position`, `flag`) VALUES (NULL, '$surname','$firstname', '$othername', '$gender', '$age_group', '$district',
 '$postal_address', '$contact', '$telephone', '$email','$institution', '$position', '1')")) {

			echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Duplicate Ignored, Record Saved Successfully</strong>
				   
                   </div>';
		}
	}
}
?>     