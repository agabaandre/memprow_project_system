<?php 
include("db_connector/mysqli_conn.php");
?>
<div class="col-md-12">
<div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
				  
				  <li class="active"><a href="dashboard.php?action=change_pwd">Change Password</a></li>					  
                 </ul>
				</div>
				<div class="box-header with-border">
                  <h5 class="box-title">Change Password</h5>
</div>
	<?php
				if(isset($_POST['update_pwd']))

            {
			$current_password=$line->password;
			$uuid=mysqli_real_escape_string($dbcon,$_POST['uuid']);
			$old_password=mysqli_real_escape_string($dbcon,$_POST['old_password']);
			$new_password=mysqli_real_escape_string($dbcon,$_POST['new_password']);
			$password_final_old=sha1(md5($old_password));
			$new_password_final=sha1(md5($new_password));
			if ($current_password==$password_final_old){
			
			if($act=mysqli_query($dbcon, "UPDATE users  SET password='$new_password_final' where uuid=$uuid"))
                        {	
               $msg='Password Changed Succesfully';
			    echo '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>'.$msg.'</strong>
                   </div>';
						 
                        }
			else{
				 $msg='Password Change Failed';
			       echo '<div class="alert alert-danger alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>'.$msg.'</strong>
                   </div>';        
			}}
			else{
				$msg='Passwords Dont Match';
				 echo '<div class="alert alert-danger alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>'.$msg.'</strong>
                   </div>';
			}
			}?>
	

  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>



<div class="col-md-4">
</div>
<div class="col-md-4">
          <form action="" method="post">
                  <div id="">
					 
                      <input class="form-control" name="passwordr" style="width:100%;" id="" value="<?php echo $line->username;?>" placeholder="" type="hidden" >
				   </div>
                   <div id="">       
					 <label> Old Password: *</label> 
					<?php $current_password=$line->password;?>
                     <input class="form-control" name="old_password" id="" style="width:100%;" value="" placeholder="Old Password" type="password" required>
					 <input class="form-control" name="uuid"  value="<?php echo $line->uuid;?>" placeholder="" type="hidden">
				   </div>
				   <div id="">
                     		<div class="form-group">

			           <label>New Password:</label>
                       
			           <input type="password" id="password" name="new_password" placeholder="New Password" class="form-control" data-toggle="password" required>

		                </div>
				   </div>
				   
<script type="text/javascript">

	$("#password").password('toggle');

</script>
				   <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                   
				   <button type="submit" name="update_pwd" class="btn btn-primary"><i class="add" style="margin-top:4px;"></i>Change Password</button>
                  </div>
				  </form>
</div>
<div class="col-md-4">
</div>
</div>
