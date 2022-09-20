<?php
include_once("../../init.php");

$line = $db->queryUniqueObject("SELECT * FROM employee_details  WHERE emp_id='".$_POST['emp_id']."'");
$national_id=$line->national_id;
$Surname=$line->Surname;
$Firstname=$line->Firstname;
$Othername=$line->Othername;
$conatct=$line->conatct;
$Position=$line->Position;
$Department=$line->Department;
$district=$line->district;
$facility=$line->facility;

if($line!=NULL)
{

$arr = array ("$national_id"=>"national_id","$Surname"=>"Surname","$Firstname"=>"Firstname","$Othername"=>"Othername","$conatct"=>"conatct","$Position"=>"Position","$Department"=>"Department", "$district"=>"district","$facility"=>"facility");
echo json_encode($arr);

}
else
{
$arr1 = array ("no"=>"no");
echo json_encode($arr1);

}
?>