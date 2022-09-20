<?php

require_once('../db_connector/mysqli_conn.php');

$current_date=date('m');

$y_date=date('Y');

$data=array();
$months=array();

for($i=0;$i<4;$i++)
{

/*
$query=mysqli_query($dbcon,"select * from field_work where (DATEDIFF(start_date,CURRENT_DATE())>=90<=120)");
*/

$m=$current_date-$i; //decrement month


$dt=$y_date.'-0'.$m; //join year and month

$query=mysqli_query($dbcon,"SELECT * FROM field_work WHERE start_date LIKE '$dt%'");

$result=mysqli_num_rows($query);

$month=date('Y-m',strtotime($dt)); //convert date to wordy format

$data['month'.($i+1)]=$result;
$months[$i]=$dt;

}

$data['months']=$months;

echo json_encode($data);








?>