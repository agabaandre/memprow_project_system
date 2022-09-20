
<?php



if (isset($_POST['id'])) {


	include("../../db_connector/mysqli_conn.php");

	//posted info
	$uploader = ($_POST['uploader']);
	$training = ($_POST['id']);
	$training_name = ($_POST['training_name']);
	$action = $uploader . " modified " . $training_name . " Report";

	$new_name = $training_name . "_" . "Report.pdf";	//name to give the pdf file

	$new_pdf = str_replace("/", "_", $new_name); //remove slashes in name

	// Checking the file was submitted
	$maxsize = 500000000; //set to approx 3m MB

	$type = ($_FILES['userfile']['type']);

	if ($type == "application/pdf") {

		$target_dir = "../../reports/";

		$target_file = $target_dir . basename($_FILES["userfile"]["name"]); //get path to file

		$docFileType = pathinfo($target_file, PATHINFO_EXTENSION); //get extension

		if (file_exists($target_file)) {
			//delete it and conitnue file
			unlink('reports/' . $target_file);

			$uploadOk = 1;
		} //file exists



		//start upload process

		// Check file size
		if ($_FILES["userfile"]["size"] > $maxsize) {


			echo $msg = '<div class="alert alert-danger alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>The Image Exceeds the Allowed Size Limit</strong>
                  </div>
<div>Maximum File limit is ' . $maxsize . ' bytes</div>
<div>File ' . $_FILES['userfile']['name'] . ' is ' . $_FILES['userfile']['size'] .
				' bytes</div><hr />';


			$uploadOk = 0; //deny upload
		} //check size


		if ($uploadOk = 1) {
			if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) //if file moved to folder then insert details to db
			{

				$pdf_file = $_FILES['userfile']['name']; //original filename

				rename($target_dir . $pdf_file, $target_dir . $new_pdf);


				$sql = mysqli_query($dbcon, "DELETE FROM reports WHERE training_id='$training'");

				$sql = "INSERT INTO reports (`training_id`, `document`, `name`, `size`,`up_date`,`uploader`) VALUES  ('$training','$docFileType','$new_pdf','{$_FILES['userfile']['size']}',CURRENT_DATE(),'$uploader');";

				//$sql=mysqli_query($dbcon,"INSERT INTO `user_system_log` (`id`, `uuid`, `time`, `actions`) VALUES (NULL, '$uuid', CURRENT_TIMESTAMP, '$action')");

				$savedb = mysqli_query($dbcon, $sql);

				if ($savedb) //upload succeeded
				{

					echo $msg = '<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Upload Successful</strong>
                  </div>';
				} else { //upload failed

					echo $msg = '<div class="alert alert-danger alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>The Image Exceeds the Allowed Size Limit</strong>
         </div>';
				}
			} //move upload

		} //upload ok

	} // end upload process--type check--file is a pdf

	else { //not a pdf

		echo $msg = '<div class="alert alert-danger alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>The Uploaded File is not in pdf format, Upload denied!</strong>
         </div>';
	}
}

?>


