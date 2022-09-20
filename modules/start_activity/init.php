<div class="col-md-12">
<?php 
include("db_connector/mysqli_conn.php");
?>
          <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
				  <li class="active"><a href="dashboard.php?action=start_activity">Quick Start Activity</a></li>
                  
                 </ul>
				</div>
                               
                <div class="box-header with-border">
                  <h5 class="box-title">Start Activity</h5>
                </div>
			<?php
			

					if(isset($_POST['start_activity'])) {
					              
							$startdate=mysqli_real_escape_string($dbcon,$_POST['startdate']);
							$enddate=mysqli_real_escape_string($dbcon,$_POST['enddate']);
							$activity_id=mysqli_real_escape_string($dbcon,$_POST['activity_id']);
							$supervisor_id=mysqli_real_escape_string($dbcon,$_POST['supervisor']);
							$location=mysqli_real_escape_string($dbcon,$_POST['location']);
							$training_ground=mysqli_real_escape_string($dbcon,$_POST['training_ground']);
							$sqlactid = "SELECT * FROM activities WHERE `activity_id`=$activity_id";
	                                                 $resultactid = mysqli_query($dbcon,$sqlactid);
	                                                 while($rowactid = mysqli_fetch_array($resultactid))
	                                                  {
	                                                 $bt=$rowactid['activity'];
	                                                  }
	                                                  $sqlgid = "SELECT * FROM grounds WHERE ground_id=$training_ground";
	                                                 $resultgid = mysqli_query($dbcon,$sqlgid);
	                                                 while($rowgid = mysqli_fetch_array($resultgid)){
	                                                  $g=$rowgid['ground'];
	                                                  }
		
						 echo $train=$bt." ".$g." ".$startdate;
						     
						      $training=str_replace("'", '', $train);;
				                        $notes=($_POST['notes']);

 if ($act=mysqli_query($dbcon,"INSERT INTO `field_work` (`field_activity_id`, `training`, `start_date`, 
 `end_date`, `activity_id`, `supervisor_id`, `location`, 
 `training_ground`, `notes`, `flag`) VALUES (NULL, '$training', '$startdate', '$enddate', '$activity_id', '$supervisor_id', '$location',
 '$training_ground', '$notes', 0)")){
	
echo $msg='<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong><?php echo $training; ?>Saved Successfully</strong>
                   </div>';
     
     echo'<button  class="btn btn-primary"  onclick="newDoc()"  ><span class="glyphicon glyphicon-arrow-right"></span>Continue to Adding Participants</button>';
					
}
?>
<script>
function newDoc() {
    window.location.assign("dashboard.php?action=attach_participants&training=<?php echo $training;?>")
}
</script>
<?php 
							$sqlc = mysqli_query($dbcon,"SELECT field_work.field_activity_id,reports.training_id FROM field_work, reports WHERE reports.training_id=field_work.field_activity_id AND field_work.flag!=1");
		                  
							  while ($listc=mysqli_fetch_array($sqlc))
							  {
								$viewed_activity_id=$listc['field_activity_id'];  
                   $sqlup = mysqli_query($dbcon,"UPDATE `field_work` SET `flag` = '1' WHERE `field_activity_id` = '$viewed_activity_id'");
					}}
?>		
							
							
						
	
<div class="col-md-4">
                    
				<form  method="post" action="">
				
		       
                      <div id="">
                     	<div id="">
                      <label>Base Activity:  <span style="color:red"></span></label> 
                        <select class="form-control select2" name="activity_id" id="activity_id myselect" style="width:100%;">
                          <?php 
							$sql2 = mysqli_query($dbcon,"SELECT * FROM activities ORDER BY activity ASC");
		                      
							  while ($list2=mysqli_fetch_array($sql2))
							  {
							 ?>
							  <option value="<?php echo $list2['activity_id']; ?>"><?php  echo $list2['activity']; ?>
							  </option>
		               <?php } ?>
				      </select>
			
					</div>
                       
		     </div>
                    
					<div class="input-group date" data-provide="datepicker">
					<label>Start date:  <span style="color:red">*</span></label> 
                      <input name="startdate"  type="text" id="test1"   class="form-control" value="<?php echo $startdate;?>" required>
                      <div class="input-group-addon">
                      <span class="glyphicon glyphicon-th"></span>
                     </div>
			        </div>
					<div class="input-group date" data-provide="datepicker">
					<label>End date:  <span style="color:red">*</span></label> 
                      <input name="enddate"  type="text" id="test1"   class="form-control" value="<?php echo $enddate;?>" required>
                      <div class="input-group-addon">
                      <span class="glyphicon glyphicon-th"></span>
                     </div>
			        </div>
					
					
					<div id="">
                      <label>Activity Main Superisor:  <span style="color:red"></span></label> 
                        <select class="form-control select2" name="supervisor" id="supervisor myselect" style="width:100%;">
                          <?php 
							$sql2 = mysqli_query($dbcon,"SELECT * FROM supervisors WHERE flag=1 ORDER BY surname ASC");
		                  
							  while ($list2=mysqli_fetch_array($sql2))
							  {
							   ?>
							  <option value="<?php echo $list2['supervisor_id']; ?>"><?php  echo $list2['surname']." ".$list2['firstname']." ".$list2['othername']; ?>
							  </option>
		               <?php } ?>
				      </select>
					  <a href="?action=add_supervisors" target="blank">Add New Supervisor</a>
					</div>
</div>
<div class="col-md-4 offset-2">
					<div id="">
                      <label>Training Ground:  <span style="color:red"></span></label> 
					  
                        <select class="form-control select2" name="training_ground" id="training_ground myselect" style="width:100%;">
                          <?php 
							$sql2 = mysqli_query($dbcon,"SELECT * FROM grounds ORDER BY ground ASC");
		                
							  while ($list2=mysqli_fetch_array($sql2))
							  {
							  ?>
							  <option value="<?php echo $list2['ground_id']; ?>"><?php  echo $list2['ground']; ?>
							  </option>
		               <?php } ?>
				      </select>
					  <a href="?action=grounds" target="blank">Add New Training Ground</a>
					</div>
				   
			        <div id="">
                      <label>Location:  <span style="color:red"></span></label>
				      <select class="form-control select2" name="location" id="location myselect" style="width:100%;">
                          <?php 
							$sql1 = mysqli_query($dbcon,"SELECT * FROM district ORDER by name ASC");
		                     
							  while ($list1=mysqli_fetch_array($sql1))
							  {
							  ?>
							  <option value="<?php echo $list1['id']; ?>"><?php  echo $list1['name']; ?>
							  </option>
		               <?php } ?>
				      </select>
					   <a href="?action=manage_locations" target="blank">Add New Location / District</a>
			       </div>
			     
			        <div id="">
                      <label>Notes (Other Donors and Additional Information related to this activity:  <span style="color:red"></span></label>
				      <textarea class="form-control" name="notes" id="editor1" name="editor1" rows="10" cols="80" placeholder="Description"  style="background:#ebf8a4;"></textarea>
		            </div>
                 				
                 <input name="start_activity"  type="hidden" id=""   class="form-control" value="start_activity" >

			       <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" name="name" type="submit"  ><span class="glyphicon glyphicon-arrow-right"></span>Begin Activity</button>
					 <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button>
                     </form>
				   </div>	  
	
</div>
<div class="col-md-4">
</div>
</div>
         <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
    $(function(){
      // turn the element to select2 select style
      $('.select2').select2();
    });
  </script>
    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>
