<div class="col-md-12" style=" background:white; border-radius: 5px;">
               <div class="nav-tabs-custom">          
				</div>
                               
                <div class="box-header with-border">
                  <h5 class="box-title">Employee Daily Attendance Approval</h5>
                </div>
<div class="col-md-12">
<hr style="border:1px solid rgb(140, 141, 137);"/>
	 <table id="mydata" class="table table-bordered table-hover table-responsive">
                    <thead>
                      <tr>
					  <th>Date</th>
					  <th>Time In</th>
					  <th>Time Out</th>
					  <th>Time Diff</th>
					  <th>Shift</th>
					  <th>Emloyee ID</th>
					  <th>Image</th>
					  <th>Name</th>
					  <th>Position</th>
					  <th>Department</th>
					  <th>Approve / Disapprove</th>
					  
					
                      </tr>
                    </thead>
                    <tbody>
				
					<?php 
					$sql="SELECT * FROM  `attendance_data` WHERE verification_flag=0";
					$result = mysql_query($sql);
					while($row = mysql_fetch_array($result)) 
                   {
                    ?>
                    <tr>
					
					<td><?php $reg_date=$row['date']; $display_date=strtotime($reg_date); echo date("j F Y", $display_date); ?></</td>
					<td><?php echo $ti=$row['time_in']; ?></td>
					<td><?php echo $to=$row['time_out']; ?></td>
					<?php $shift=$row['Shift']; ?>
					<td><?php if ($shift=='NIGHT'){
					echo $time_diff=($ti-$to); echo'hours';} else{echo $time_diff=($to-$ti); echo'hours';}?></td>
					<?php
					// generate present status
					if ($time_diff>=8){
						$present_status==1;
					}
					else if($time_diff>=6){
						$present_status==1;
					}
					else{
						$present_status==0;
					}
					
					?>
					<td><?php echo $row['Shift']; ?></td>
					 <td><?php echo $id=$row['emp_id']; ?></td>
			          <?php
					  $find="SELECT Passport_photo FROM `passports` where emp_id='$id'";
					   $found = mysql_query($find);
					   ($cells = mysql_num_rows($found));
					   if ($cells>0){?>
                        <td><img src="modules/employee_details/getImage.php?id=<?php echo $row["emp_id"];?>" class="img img-thumbnail" style="width:60px; height:60px;"/></td>
                       <?php }
                        else{
					  echo'<td><img src="images/no_pic.png" href="dashboard.php?action=passport" class="img img-thumbnail" style="width:60px; height:60px;"/></td>';
                       }?>
					 <?php  $sql_att="SELECT * FROM  `employee_details` where emp_id='$id'";
					  $result_att = mysql_query($sql_att);
					  while($row_att = mysql_fetch_array($result_att)) 
                      {?>
                      <td> <?php echo $row_att['Surname']." ".$row_att['Firstname']." ".$row_att['Othername'];?></td>
                      <td> <?php echo $position=$row_att['Position'];?></td>
					   <td> <?php  echo $department=$row_att['Department']; }?></td>
					  <td>
					  <?php
                       //Flag Raiser
					  $status=$row['flag'];
					  if ($status==0){?>
						  <form action='' method='post'>
						  <input type='hidden' value='1' name='flag'>
						  <input type='hidden' value='<?php $time_diff ?>' name='time_diff'>
						  <input type='hidden' value='<?php $present_status ?>' name='present_status'>
						  <input type='hidden' value='<?php $id ?>' name='emp_id'>
						 <button type='submit' class='btn btn-sm btn-primary' name='approve'>Approve<?php $space ?></button>
						  </form>
						
					      <form action='' method='post'>
						  <input type='hidden' value='-1' name='flag'>
						  <input type='hidden' value='<?php $time_diff ?>' name='time_diff'>
						  <input type='hidden' value='0' name='present_statusd'>
						  <input type='hidden' value='<?php $id ?>' name='emp_id'>
						  
						 <button type='submit' class='btn btn-sm btn-danger' name='disapprove' style='margin-top:2px;'>Disapprove</button>
						        </form>
					 <?php }
					  
					  
					  ?>
					 </td>
					  <?php 
                     } ?>
					  					
                    </tr>
					
                    </tbody>
                    <tfoot>
                    </tfoot>
    </table>
					  <?php 
					   //flag reader
					  if(isset($_POST['approve'])){
					  $flag=mysql_real_escape_string($_POST['flag']);
					  $time_diffu=mysql_real_escape_string($_POST['time_diff']);
					  $present_statusu=mysql_real_escape_string($_POST['present_status']);
					  $sqlup_att = mysql_query("UPDATE `attendance_data` SET `time_difference`='$time_diffu', `present_status`='$present_statusu' ,`verification_flag` = '$flag' WHERE `emp_id` = '$id'");
					  
                      $msg="<p> Status Successfully Updated </p>";
					   header("location:dashboard.php?action=verify");
					  }
                      else{
                      $msg="<p>Cannot Verify Status, Contact the Sys Admin</p>";
					  }
					  ?>
					  					  <?php 
					   //flag reader
					  if(isset($_POST['disapprove'])){
					  $flag=mysql_real_escape_string($_POST['flag']);
					  $time_diffu=mysql_real_escape_string($_POST['time_diff']);
					  $present_statusd=mysql_real_escape_string($_POST['present_statusd']);
					  $sqlup_att = mysql_query("UPDATE `attendance_data` SET `time_difference`='$time_diffu', `present_status`='$present_statusd' ,`verification_flag` = '$flag' WHERE `emp_id` = '$id'");
					  
                      $msg="<p> Status Successfully Updated </p>";
					   header("location:dashboard.php?action=verify");
					  }
                      else{
                      $msg="<p>Cannot Verify Status, Contact the Sys Admin</p>";
					  }
					  ?>

</div>
</div>
