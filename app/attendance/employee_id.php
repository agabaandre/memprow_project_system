<?php
include_once("../../init.php");
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT emp_id FROM employee_details WHERE flag=1");
  while ($line = $db->fetchNextObject()) {
  
  	if (strpos(strtolower($line->emp_id ), $q) !== false) {
		echo "$line->emp_id \n";
	
 }
 }

?>