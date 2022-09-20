
 <script type="text/javascript">
$(function() {
    
    	$("#worker").autocomplete("attendance/employee_id.php", {
	    width: 300,
		autoFill: true,
		mustMatch: true,
		selectFirst: true
	});


		var hauteur=0;
		$('.code').each(function(){
			if($(this).height()>hauteur) hauteur = $(this).height();
		});

		$('.code').each(function(){ $(this).height(hauteur); });
	});
function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=27 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
    }
    }
$.fn.datepicker.defaults.format = "yyyy/mm/dd";
$('.datepicker').datepicker({
});
</script> 
<?php
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP(); 
?>                   						
<div class="col-md-12">
          <div class="nav-tabs-custom" >
             <ul class="nav btn-lg nav-tabs">
				  <li class=""><a href="dashboard.php?action=clockin">Check In</a></li>
                  <li class="active"><a href="dashboard.php?action=clockout">Check Out</a></li>
                   
                 </ul>
				</div>
                 <p style="font-weight:bold; font-size:1.3em;"><?php echo welcome();  ?><p>             
                <div class="box-header with-border">
                  <h3 class="box-title"> Check Out</h3>
                </div>
<div class="col-md-6">
 <?php

		if((!empty($_POST['emp_id']))&& ($_POST['clockout']='clockout')) {
					$emp_id=mysql_real_escape_string($_POST['emp_id']);
					$year=mysql_real_escape_string($_POST['year']);
					$month=mysql_real_escape_string($_POST['month']);
					$location=mysql_real_escape_string($_POST['location']);
					$slash="/";
					$integrity_checker=$emp_id.$slash.date("d-m-Y");
					$sql_counter=mysql_query("select count(time_out), integrity_checker FROM `attendance_data` where integrity_checker='$integrity_checker'"); 
					while ($row_count=mysql_fetch_array($sql_counter))
					{ 
				   $count_time_out=$row_count[0];
				   $checker_value=$row_count['integrity_checker'];
				    }
					if(($count_time_out==0) AND ($checker_value==$integrity_checker))
					{
                                           
if($db->query("UPDATE `attendance_tracking`.`attendance_data` SET `time_out` = CURRENT_TIME( ) WHERE `attendance_data`.`integrity_checker` = '$integrity_checker'"))
{              
                echo $msg='<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Check out Successful '.$surname.$space.$firstname.$space.$othername.'</strong>
                  </div>';
}				
				else{
				
				echo $msg='<div class="alert alert-danger alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Check out failed '.$surname.$space.$firstname.$space.$othername.'</strong>
                  </div>';

				
					}}
					else{
			    $msg=$surname.$space.$firstname.$space.$othername. ', You already Check Out or have not checked in';
                echo $msg='<div class="alert alert-danger alert-dismissable" style="">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Check out failed '.$msg.'</strong>
                  </div>';  
							}
						
		
			
					
					//night_shifts		
			   if(($_POST['night_shift'])=='NIGHT') {
					$yesterday=date("d-m-Y", mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));
					$slash="/";
					$integrity_checker_night=$emp_id.$slash.$yesterday;
					$this_day=date("Y-m-d");
					
					$sql_counternight=mysql_query("select count(time_out), Shift, integrity_checker FROM `attendance_data` where `integrity_checker`='$integrity_checker_night'"); 
					while ($row_countnight=mysql_fetch_array($sql_counternight))
					{
                 						
				     $count_time_night=$row_countnight[0];
				     $checker_value=$row_countnight['integrity_checker'];
				     $shift=$row_countnight['Shift'];
				
				    }
				  
				   
					if(($count_time_night==0) AND ($shift=='NIGHT') AND ($checker_value==$integrity_checker_night))
					{
                                           
if($db->query("UPDATE `attendance_tracking`.`attendance_data` SET `time_out` = CURRENT_TIME( ) where integrity_checker='$integrity_checker_night'"))
{              
                echo $msg='<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong> Night Duty Check out Successful '.$surname.$space.$firstname.$space.$othername.'</strong>
                  </div>';
}				
				else{
				
				echo $msg='<div class="alert alert-danger alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Check out failed '.$surname.$space.$firstname.$space.$othername.'</strong>
                  </div>';

				
					}}
					else{
					$msg=$surname.$space.$firstname.$space.$othername. ', You already Check Out or have not checked In or not on Night Duty';
                echo $msg='<div class="alert alert-danger alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Check out failed '.$msg.'</strong>
                  </div>'; 
					}
						
		}}
		
						
?>  
    <form name="form1" method="post" id="form1" action="">    
         
		
				    <div id="">
                      <label>Time:</label> 
                      <h2><div id="txt" ></div> </h2>
					</div>
					<div id="">
                      <label>Date:</label>
					
                    <h2> <?php echo $today_mysql;?></h2>					  
                      <input class="form-control" name="date" id="" value="<?php echo $today_mysql;?>" type="hidden"  >
					  <input class="form-control" name="year" id="" value="<?php echo date("Y"); ?>" type="hidden"  >
					  <input class="form-control" name="month" id="" value="<?php echo date("m"); ?>" type="hidden"  >
					</div>
					 
					 <input class="form-control btn btn-default" name="night_shift" id="" value="OTHER" type="radio"  checked style="display:none;">
					 <label class="btn btn-success" >Night shift only:
					 <input  name="night_shift" id="" value="NIGHT" type="radio"  ></label> 
					  
					<div class="form-group" style="display:none;">
					
					  
					
                      <label>Geolocation Status:</label> 
					  
					  
					  <?php 
					  $line = $db->queryUniqueObject("SELECT * FROM `settings` where Setting_name='geolocation_state'");
					   $flag=$line->flag;
					  if ($flag==1){
						  $msg=" <span style='color:green'> + <span/>";
						 
						 echo'<span class="location">
					      <input type="hidden" name="location" id="location" value="'.$user_ip.'">
					      <span>';
						 
					       }
					  else {
						  
						 echo' <span class="location">
					      <input type="hidden" name="location" id="location" value="OFF">
					      <span>';
						 $msg="<span style='color:red'> - </span>";
					  }
					  echo'<h3>'. $msg.'</h3>';
					  ?>
					
                    
					</div>
					<?php
				    $emp_ida=mysql_real_escape_string($_POST['emp_id']);
	                 ?>

					<div id="">
                      <label>IPPS NUMBER  <span style="color:red">*</span></label> 
                      <input class="form-control" name="emp_id" id="worker" value="<?php echo $emp_ida;?>" type="tel"  style="height:70px; font-size:2em;" required>
					  
					</div>
<div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
            <button  class="btn btn-lg btn-primary" name="clockout" type="submit" style="height:80px; font-size:1.2em; width:100%; margin:0 auto;"><span class="add" ></span>Check Out</button>
</div>  
					
</div>

<div class="col-md-6" id="user_details">
         
					    <?php 	
		  // Start by confirming results
if($_POST['emp_id']){
	               $emp_id=mysql_real_escape_string($_POST['emp_id']);
	               $sql="SELECT national_id,Surname,Firstname,Othername,facility,Position FROM `employee_details` WHERE `emp_id`='$emp_id'";
				   $result = mysql_query($sql);
				   while($row = mysql_fetch_array($result))
				   {
					    $national_id=$row['national_id'];
					    $surname=$row['Surname'];
					    $firstname=$row['Firstname'];
					    $othername=$row['Othername'];
					    $facility=$row['facility'];
					    $position=$row['Position'];
				   }
				   $space=" ";
	     echo'	<table class="table">
					     <tr>
					  <th>National ID Number: </th> 
					  <td>
                      <input type="text" id="national_id" value="'.$national_id.'" class="noborder">
					  </td>
					   </tr>
                      <tr>
					  <th>Employee Name: </th> 
					  <td>
                      <input type="text" id="surname" value="'.$surname.$space.$firstname.$space.$othername.'" class="noborder">
					   
					  </td>
					   </tr>
					   <tr>
					  <th>Position: </th> 
					  <td>
                      <input type="text" id="contact" value="'.$position.'" class="noborder">
				       </td>
					   </tr>
					   <tr>
					  <th>Facility: </th> 
					  <td>
                      <input type="text" id="position" value="'.$facility.'" class="noborder">
					  <input type="hidden" name="clockout" id="position" value="clockout" class="noborder">
				       </td>
					   </tr>
					   <tr>
					
			</table>';
			
 			   
}
		
 mysql_close();	      	 
?>


<script src="../dist/js/jquery.js"></script>
                                                 
  
</form> 				 
				   
</div>
</div>
                                                    
              
<script src="../lib/auto/js/jquery.autocomplete.js "></script> 