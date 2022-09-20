
 <script type="text/javascript">
$(function() {
    
    	$("#worker").autocomplete("attendance/employee_id.php", {
	    width: 300,
	
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
          <div class="nav-tabs-custom">
             <ul class="nav btn-lg nav-tabs">
				  <li class="active"><a href="dashboard.php?action=clockin">Check In</a></li>
                  <li class=""><a href="dashboard.php?action=clockout">Check Out</a></li>
                   
                 </ul>
				</div>
					<p style="font-weight:bold; font-size:1.3em;"><?php echo welcome();  ?><p>
                               
                <div class="box-header with-border">
                  <h3 class="box-title"> Check In</h3>
                </div>
<div class="col-md-6">
<?php			
			if((!empty($_POST['emp_id']))AND($_POST['clockin']='clockin')) {
					$emp_id=mysql_real_escape_string($_POST['emp_id']);
					$year=mysql_real_escape_string($_POST['year']);
					$month=mysql_real_escape_string($_POST['month']);
					$location=mysql_real_escape_string($_POST['location']);
					$shift=mysql_real_escape_string($_POST['shift']);
					$slash="/";
					$integrity_checker=$emp_id.$slash.date("d-m-Y");
					$count = $db->countOf("attendance_data", "integrity_checker='$integrity_checker'");
					if($count==1)
					{
                                            $msg=$surname.$space.$firstname.$space.$othername.' has already Checked in';
                          
					
                                      
							}
							else
							{				
				
if($db->query("INSERT INTO `attendance_tracking`.`attendance_data` (
`emp_id` ,
`date` ,
`month_name` ,
`year_name` ,
`time_in` ,
`time_out` ,
`present_status` ,
`shift` ,
`location` ,
`time_difference` ,
`value_location` ,
`integrity_checker` ,
`verification_flag`
)
VALUES (
'$emp_id', CURRENT_DATE( ) , '$month' , '$year' , CURRENT_TIME( ) , NULL , NULL , '$shift' , '$location' , NULL ,NULL, '$integrity_checker' , 0
)")){
			
                  $msg=$surname.$space.$firstname.$space.$othername.' Check in Succesful';
				 
}				
					else{
					$msg=$surname.$space.$firstname.$space.$othername.' has already checked in';
				
				  
					}
					
				   
					}
					echo $msg='<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>'.$msg.'</strong>
                   </div>';
				
					}
					
			
				
			
			
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
			<label>Choose Shift</label>
			<p></p>
		<label class="btn btn-warning">DAY
		<input type="radio"  name="shift" value="DAY"/></label>
        <label class="btn btn-info">EVENING	
		<input type="radio"  name="shift" value="EVENING"/></label>	
        <label class="btn btn-success">NIGHT	
		<input type="radio"  name="shift" value="NIGHT"/></label>		
         
            
					
					<div class="form-group" style="display:none;">
					
                      <label>Geolocation Status:</label> 
					  
					  
					  <?php 
					  $line = $db->queryUniqueObject("SELECT * FROM `settings` where Setting_name='geolocation_state'");
					   $flag=$line->flag;
					  if ($flag==1){
						  $msg=" <p style='color:green; height:10px;'> + <p/>";
						 
						 echo'<p class="location" style="color:green; height:10px;">
					      <input type="hidden" name="location" id="location" value="'.$user_ip.'">
					      <p>';
						 
					       }
					  else {
						  
						 echo' <p class="location" style="color:red; height:10px;">
					      <input type="hidden" name="location" id="location" value="OFF">
					      <p>';
						 $msg="<p style='color:red; height:10px;'> - </p>";
					  }
					  echo'<h3>'. $msg.'</h3>';
					  ?>
					
                    
					</div>
					<?php
				    $emp_ida=mysql_real_escape_string($_POST['emp_id']);
	                 ?>

					<div id="">
                      <label>IPPS NUMBER:  <span style="color:red">*</span></label> 
                      <input class="form-control" name="emp_id" id="worker" value="<?php echo $emp_ida;?>" type="tel"  style="height:70px; font-size:2em;" required>
					  
					</div>
					<div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
            <button  class="btn btn-lg btn-primary" name="clockin" type="submit" style="height:80px; font-size:1.2em; width:100%; margin:0 auto;"><span class="add" ></span>Check In</button>
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
					  <input type="hidden" name="clockin" id="position" value="clockin" class="noborder">
				       </td>
					   </tr>
					   <tr>
					 
			</table>';
 			   
}
		
 mysql_close();      	 
?>
 
</form>    
		    
 
				 
				   
</div>
</div>
                                                    
<script src=".../dist/js/jquery.js"></script>
 <script src="../lib/auto/js/jquery.autocomplete.js "></script> 