<?php if(isset($_POST['update_participant'])){
include("../../db_connector/mysqli_conn.php");
include("../../init.php");
			
						// stop SQL INJECTION
$participant_id=mysqli_real_escape_string($dbcon,$_POST['participant_id']);
$surname= mysqli_real_escape_string($dbcon,$_POST['surname']);                                      
$firstname= mysqli_real_escape_string($dbcon,$_POST['firstname']);                                      
$othername= mysqli_real_escape_string($dbcon,$_POST['othername']);                                      
$gender= mysqli_real_escape_string($dbcon,$_POST['gender']);                                      
$age_group= mysqli_real_escape_string($dbcon,$_POST['age_group']);                                      
$district= mysqli_real_escape_string($dbcon,$_POST['district']);                                      
$postal_address= mysqli_real_escape_string($dbcon,$_POST['postal_address']);                                      
$contact= mysqli_real_escape_string($dbcon,$_POST['contact']);                                      
$telephone= mysqli_real_escape_string($dbcon,$_POST['telephone']);                                      
$email= mysqli_real_escape_string($dbcon,$_POST['email']);                                      
$institution= mysqli_real_escape_string($dbcon,$_POST['institution']);                                      
$position= mysqli_real_escape_string($dbcon,$_POST['position']); 	
			$sql=mysqli_query($dbcon,"UPDATE participants SET `surname`='$surname',`firstname`='$firstname',`othername`='$othername',`gender`='$gender',`age_group`='$age_group',
			`residence_district`='$district',`postal_address`='$postal_address',`contact1`='$contact',`contact2`='$telephone',`email`='$email',`institution`='$institution',`position`='$position' WHERE `participant_id`='$participant_id'");
				if($sql)
			{
             $msg="$surname $firstname Updated" ;
			 
			
                        }
			else{
			 $msg="$surname $firstname Update Failed" ;
			}
			echo'<div class="alert alert-info alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>'.$msg.'</strong>
                  </div>';
			
			}
			
							
		
						
		?> 