<?php
error_reporting(0);
include("../../db_connector/mysqli_conn.php");
/**
 * @author Andrew
 * @copyright 2016
 */
 $id=$_GET['id'];
$query = "SELECT * FROM reports WHERE training_id=$id";
					$result = mysqli_query($dbcon,$query);
					($row = mysqli_fetch_array($result));
					if (count($row)>0){
					$pdf_file=$row['name'];

					header("location:../../reports/".$pdf_file);
	               //exit();{
                    }
                    else{
                                header("location:../../reports/no_report.pdf");
                    }

?>
