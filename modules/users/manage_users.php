<div class="col-md-12" style=" background:white; border-radius: 5px;">
<?php 
include("db_connector/mysqli_conn.php");
?>
          <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
			      <li class="active"><a href="dashboard.php?action=users">Manage Users</a></li>
			      <li class=""><a href="dashboard.php?action=user_logs">User Logs</a></li>
				  
                 </ul>
				</div>
                               
                <div class="box-header with-border">
                  <h5 class="box-title">Manage Users</h5>
                </div>
				<?php
if(isset($_GET['msg'])){
$print_msg=$_GET['msg'];


echo'<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>'.$print_msg.'</strong>
                  </div>';
}
?>
 <?php 
					  //flag changer
					  if(isset($_POST['flag'])){
					  $flag=mysqli_real_escape_string($dbcon,$_POST['flag']);
					  $uuid=mysqli_real_escape_string($dbcon,$_POST['user_id']);
					  $msg=mysqli_real_escape_string($dbcon,$_POST['msg']);
					  if($sqla = mysql_query("UPDATE `users` SET `flag` = '$flag' WHERE  uuid=$uuid"))
					  {
                  
					  echo'<div class="alert alert-success alert-dismissable">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>'.$msg.'</strong>
                    </div>';
					  }
                      else{
                       echo'<div class="alert alert-success alert-dismissable">
                     <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>'.$msg.'</strong>
                     </div>';
					  }
					  }
 ?>	
<?php
					//Gump is libarary for Validatoin
					
					if(isset($_POST['add_user'])){
					     	$fname=mysqli_real_escape_string($dbcon,$_POST['fname']);
							$lname=mysqli_real_escape_string($dbcon,$_POST['lname']);
							$username=mysqli_real_escape_string($dbcon,$_POST['username']);
							$password=mysqli_real_escape_string($dbcon,$_POST['password']);
							$usertype=mysqli_real_escape_string($dbcon,$_POST['usertype']);
							$password_final=sha1(md5($password));
						
						$count = $db->countOf("users", "username='$username'");
		if($count==1)
			{
	                                     $msg='User Name Already taken! Choose another User Name';
										 echo'<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>'.$msg.'</strong>
                  </div>';
                                      
			}
			else
			{
				
			if($act=mysqli_query($dbcon,"insert into users (uuid,username,password,usertype,fname,lname,flag)values(NULL,'$username','$password_final','$usertype','$fname','$lname','1')"))
			{
				$action=$uploader." Created an account with username ". $username." for ".$lname." ".$fname." with ".$usertype. " previleges"  ;
	           $sql=mysql_query("INSERT INTO `user_system_log` (`id`, `uuid`, `time`, `actions`) VALUES (NULL, '$suid', CURRENT_TIMESTAMP, '$action')");

             
            $msg="$lname $fname account created" ;
			echo'<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>'.$msg.'</strong>
                  </div>';
                        }
			else
			echo "<br><font color=red size=+1 >Problem in Adding !</font>" ;
			
			}
			
			}
				?>
				<?php
				if(isset($_POST['update_user']))

            {
			$uuid=mysqli_real_escape_string($dbcon,$_POST['uuid']);
			$fname=mysqli_real_escape_string($dbcon,$_POST['fname']);
			$lname=mysqli_real_escape_string($dbcon,$_POST['lname']);
			$username=mysqli_real_escape_string($dbcon,$_POST['username']);
			$plain_password=mysqli_real_escape_string($dbcon,$_POST['password']);
			$password_final=sha1(md5($plain_password));
			$usertype=mysqli_real_escape_string($dbcon,$_POST['usertype']);
			if($plain_password!="")
			{
				if ($act=mysqli_query($dbcon,"UPDATE users SET password= '$password_final' WHERE  uuid=$uuid")){
	
                   echo $msg='<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Password Changed</strong>
				</div>';
				}
				else{
				echo $msg='<div class="alert alert-warning alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Password Not Changed !</strong>
				</div>';
              }
			}
			
			if($query=mysqli_query($dbcon,"UPDATE users  SET fname ='$fname',username='$username',usertype='$usertype',lname='$lname' where uuid=$uuid"))
                        {	
                         $msg='User Details Succesfully Updated';
						$action=$uploader." Updated ".$lname." ".$fname." login details" ;
	           $sql=mysql_query("INSERT INTO `user_system_log` (`id`, `uuid`, `time`, `actions`) VALUES (NULL, '$suid', CURRENT_TIMESTAMP, '$action')");

                     echo'<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>'.$msg.'</strong>
                  </div>';
                        }
			else{
				echo $msg='OOps, Update Failed!';
			              echo'<div class="alert alert-danger alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>'.$msg.'</strong>
                  </div>';

			}}
?>	

</div>
 <hr style="border:1px solid rgb(140, 141, 137);"/>
  <div class="col-md-4">
  					
      <p>Add Users</p>
	          <form method="post" action="">
	  	             <div id="">
					<label>Username: *</label>
                      <input class="form-control" name="username" id="title" value="" placeholder="Username" type="text" required>
				   </div>
                   <div id="">
					 <label>Password: *</label> 
                      <input class="form-control" name="password" id="" value="" placeholder="Password" type="password" required>
					</div>
					<div id="">
					  <label>User Type: *</label>
                      <select class="form-control" name="usertype" id="type" style="width:100%;">
					  <?php
                      $users = array("Administrator"=>"admin", "Supervisor"=>"hr", "Data Manager"=>"data", "No Access Granted"=>"access_0");

                      foreach($users as $key => $value) {
                     echo"<option value='$value'>".$key."</option>";
                            }
                       ?> 
					  
					  
					  </select>
				   </div>
				   <div id="">
					  <label>Surname: *</label>
                      <input type="text" class="form-control" name="lname" id="" value="" placeholder="Surname" type="text"/ required>
				   </div>
				   <div id="">
					  <label>First Name:</label>
                      <input class="form-control" name="fname" id="" value="" placeholder="Firstname" type="text" required>
				   </div>
				     <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" name="add_user" type="submit" ><span class="add"></span>Add User</button>
                     </form>
				   </div>
   </div>

<div class="col-md-8"> 
<div id="CollapsiblePanel1" class="CollapsiblePanel" style="margin:0 auto; overflow-x:hidden; overflow-y:auto;">
  <div class="CollapsiblePanelTab" tabindex="0"><p>View System Users</p></div>
<div class="CollapsiblePanelContent"> 
      <table id="mydata" class="table table-bordered table-responsive">
                    <thead>
                      <tr>
					    <th style="width:2%;">No</th>
					   <th style="width:22%;">Username</th>
                        <th style="width:20%;">User Type</th>
						<th style="width:20%;">Name</th>							
						<th style="width:10%;">status</th>							
						<th style="width:10%;">Edit</th>
                      </tr>
                    </thead>
<tbody>       
 <?php	$i=1;
	$sql_sel=mysqli_query($dbcon,"SELECT * FROM users WHERE username!='admin'");
    while($row=mysqli_fetch_array($sql_sel)){
    ?>
      <tr>  <td><?php echo $i++;?></td>
            <td><?php $uuid=$row['uuid'];?><?php echo $row['username'];?></td>
			<td><?php echo  $active_op=$row['usertype'];?></td>
			<td><?php echo $row['lname']." ".$row['fname'];?></td>
    
	    <td>
	<?php
                       //Flag Raiser
					  $status=$row['flag'];
				   $space="----|";
					  if ($status==0){
						  echo "<form action='' method='post'>
						  <input type='hidden' value='1' name='flag'>
						  <input type='hidden' value='$uuid' name='user_id'>
						  <input type='hidden' value='Activated' name='msg'>
						 <button type='submit'  class='btn btn-sm btn-danger' name='status'><span class='glyphicon glyphicon-circle-remove'></span>Not Active</button>
						        </form>";
					  }
					  else {
						 echo "<form action='' method='post'>
						  <input type='hidden' value='0' name='flag'>
						  <input type='hidden' value='$uuid' name='user_id'>
						  <input type='hidden' value='De-activated' name='msg'>
						 <button type='submit' name='change_flag' class='btn btn-sm btn-success' name='status'><span class='glyphicon glyphicon-ok'></span>Active</button>
						 </form>";   
					  }
					  
				     
					  ?>
		</td>
	<td>
	
    <button data-toggle="modal" data-target="#<?php echo $modalid='my'.$uuid;?>" title="Update User" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>
     
	
	<div class="modal fade" id="<?php echo $modalid;?>" tabindex="-1" role="dialog" data-backdrop="static">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                                              <h4 class="modal-title"><center><i class="fa fa-user fa-spin"></i>Update User</center></h4>
                                          </div>
                                          <div class="modal-body">
	            <form method="post" action="">
	  	           <div id="">
					<label>Username: *</label>
                      <input class="form-control" name="username" id="title" value="<?php echo $row['username'];?>" placeholder="Surname" type="text" style="width:100%;" readonly>
				  </div>
                  <div id="">
					 <label> NB: Leave blank to keep the previous password<br/>
				     New Password: *</label> 
                     <input class="form-control" name="password" id="" style="width:100%;" value="" placeholder="" type="password">
					 <input class="form-control" name="uuid"  value="<?php echo $uuid;?>" placeholder="" type="hidden">
				   </div>
				 
				   <div id="">
					  <label>User Type: *</label>
                      <select class="form-control" name="usertype" id="type" style="width:100%;">
					  <?php
			
                      $users = array("Administrator"=>"admin", "Supervisor"=>"hr", "Data Manager"=>"data", "No Access Granted"=>"access_0");

                      foreach($users as $key => $value) {
						  $selected="selected";?>
                    <option value="<?php echo $select_op=$value; ?>"<?php if ($select_op==$active_op){echo "selected";}?>><?php  echo $key; ?>
                        <?php   }
                       ?> 
					  
					  
					  </select>
				   </div>
				    <div id="">
					  <label>Surname:</label>
                      <input class="form-control" style="width:100%;" name="lname" id="" value="<?php echo $row['lname']?>" placeholder="" type="text">
				   </div>
				   <div id="">
					  <label>First Name: *</label>
                      <input type="text" style="width:100%;" class="form-control" name="fname" id="" value="<?php echo $row['fname']?>" placeholder="">
                      <input type="hidden" style="width:100%;" class="form-control" name="update_user" id="" value="" placeholder="" type="hidden">
				   </div>
				  
				     <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" name="" type="submit" ><span class="add"></span>Update User</button>
                   </form>
				   
                                         </div>
                                      </div>
                                    </div>
             </div>
			 </td>
			 </tr>
    <?php	
    }
	
    ?>
	 </tbody>
        <tfoot>
      </tfoot>
    </table>
	</div>
</div>
</div>
</div>
	