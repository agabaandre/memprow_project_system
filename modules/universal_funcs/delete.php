<?php
// Use session variable on this page. This function must put on the top of page.
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') { // if session variable "username" does not exist.
	header("location:../index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
} else {

	error_reporting(E_ALL ^ E_NOTICE);
	if (isset($_REQUEST['id']) && isset($_REQUEST['table'])) {
		echo $id = $_REQUEST['id'];
		$tablename = $_REQUEST['table'];
		$tablename1 = $_REQUEST['table1'];
		$tablename2 = $_REQUEST['table2'];
		$return = $_REQUEST['return'];
		$id = $_REQUEST['id'];

		mysqli_query($dcon, "DELETE FROM $tablename WHERE id=$id");
		mysqli_query($dcon, "DELETE FROM $tablename1 WHERE id=$id");
		mysqli_query($dcon, "DELETE FROM $tablename2 WHERE id=$id");

		header("location:$return?msg=Record Deleted Successfully!&id=$id");
	}
	if (isset($_REQUEST['table']) && isset($_REQUEST['checklist'])) {
		$data = $_REQUEST['checklist'];
		$tablename = $_POST['table'];
		$return = $_REQUEST['return'];
		for ($i = 0; $i < count($data); $i++) {
			mysqli_query($dcon, "DELETE FROM $tablename WHERE id=$data[$i]");
			mysqli_query($dcon, "DELETE FROM $tablename1 WHERE id=$data[$i]");
			mysqli_query($dcon, "DELETE FROM $tablename2 WHERE id=$data[$i]");
		}
		header("location:?msg=Record Deleted Successfully!");
	}
	echo $_REQUEST['return'];
	if (isset($_REQUEST['return'])) {
		header("location:$return");
	}
}
