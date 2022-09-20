<?php 
include("../db_connector/mysqli_conn.php");
if (isset($_POST['print_profile'])){
$participant_id=($_POST['participant_id']);
$name=($_POST['myname']);
$name=str_replace("/ ","_",$name);
ob_start();
$html=include('mypdfs/profilepdf.php');
$html=ob_get_clean();


//==============================================================
//==============================================================
include("mpdf-master/mpdf.php");

$mpdf=new mPDF('c','A4','','',32,25,27,25,16,13); 

$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);

$mpdf->jSWord = 0;	// Proportion (/1) of space (when justifying margins) to allocate to Word vs. Character
$mpdf->jSmaxChar = 0;	// Maximum spacing to allocate to character spacing. (0 = no maximum)
// Back to default settings
$mpdf->jSWord = 0.4;
$mpdf->jSmaxChar = 2;



$mpdf->Output($name ,'D');
exit;
}
?>