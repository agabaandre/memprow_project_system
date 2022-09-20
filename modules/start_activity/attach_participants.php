<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("mydata");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
  
<?php 
include("db_connector/mysqli_conn.php");
$training=mysqli_real_escape_string($dbcon,$_GET['training']);
$training=urldecode($training);
?>

<div class="col-md-12" style=" background:white; border-radius: 5px;">
          <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
				  <li class="active"><a href="dashboard.php?action=attach_participants&training=<?php echo $training;?>">Add Participants</a></li>
				 			  
                 </ul>
				</div>
    <?php if(!empty($statusMsg)){
        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
    } 
	?>

	
	
                <div class="box-header with-border">
                  <h6 class="box-title">Add Participants to: <b style="color:#000024;">(<?php echo $training;?>)</b></h6>
                </div>
<div class="col-md-12 offset-2" style="width:100%; overflow:auto; margin:0 auto">
<hr style="border:1px solid rgb(140, 141, 137);"/> 

<?php
if(isset($_GET['msg'])){
$print_msg=$_GET['msg'];


echo'<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>'.$print_msg.'</strong>
                  </div>';
	
}
echo'<button  class="btn btn btn-default"  onclick="newDoc()"  ><span class="glyphicon glyphicon-eye-open"></span>View Added Participants</button>';
	
?>
<script>
function newDoc() {
    window.location.assign("dashboard.php?action=finish&training=<?php echo $training;?>")
}
</script>


	<button data-toggle="modal" data-target="#add_new" title="Add New Participants" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i>Create New Participant(s)</button>

&nbsp;&nbsp;&nbsp;&nbsp;
<div class="input-group" style="margin-bottom:3px; width:30%; float:right;"> 
     <label>Advanced Searcher</label>
      <input type="text"  class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">                                 
</div>
<form   id="multiple_add" class="form-horizontal" action="universal_funcs/madd.php" method="post">

<input type="hidden" name="table" value="field_participants">

<input type="hidden" name="return" value="dashboard.php?action=attach_participants&training=<?php echo $training;?>">
<?php 
					$sql="SELECT * FROM `field_work` WHERE training='$training'";
					$result = mysqli_query($dbcon,$sql);
				
					while($row = mysqli_fetch_array($result)) 
                   {
					      $field_activity_id=$row['field_activity_id'];
				   }
                    ?>
<input type="hidden" name="training" value="<?php echo $field_activity_id;?>">
  

	<button name="add_part" id="add_part" type="submit" class="btn btn-primary"  style="margin-left:5px;"><span class="glyphicon glyphicon-ok-circle"></span> Add Selected Participant(s)</button>				
  
  	

               <?php $sql="SELECT COUNT(*) FROM `field_participants` WHERE training='$field_activity_id'";
					$result = mysqli_query($dbcon,$sql);
					
					while($row = mysqli_fetch_array($result)) 
                   
					      echo "<p class='btn btn-info' style='font-weight:bold;  font-size:15px; margin:20px;'>This Activity has ".$row[0]. " "."Participants</p>";
				   
                    ?>
 <script>
      $(function() {
        $('#mydata').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
		  "responsive": true,
		  "iDisplayLength": 20,
    	  "aLengthMenu": [[10, 20, 30, 50, 100, -1], [10, 20, 30, 50, 100, "All"]]
        });
      });
    </script>
	 <table id="mydata" class="table table-bordered table-hover table-responsive">
                    <thead>
                      <tr>
                        <th>No</th>					  
                        <th>Select</th>					  
						<th>Name</th>
						<th>Gender</th>
						<th>Designation</th>
						<th>Age Group</th>
						<th>Residence</th>
						<th>Postal Address</th>
						<th>Mobile Contact</th>
						<th>Telephone </th>
						<th>Email </th>
						
						
                      </tr>
                    </thead>
                    <tbody id="myUL">
				
					<?php 
					$sql="SELECT * FROM `participants` WHERE flag=1";
					$result = mysqli_query($dbcon,$sql);
					$i=1;
					while($row = mysqli_fetch_array($result)) 
                   {
					      $id=$row['participant_id'];
                    ?>
					
				   <tr >
				        <td><?php echo  $i++; ?></td>
					  <td>
					
				   
					 <label class="btn btn-lg btn-link" style="width:100%;"> <input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $id; ?>"></label>
					
					 </td>
					  <td><p <?php
					//selected participants identifier
					$sqli="SELECT * FROM `field_participants` WHERE `training`='$field_activity_id'";
					$resulti = mysqli_query($dbcon,$sqli);
					while($rowi = mysqli_fetch_array($resulti)){
					$returned_part=$rowi['participant_id'];
					
					if ($returned_part==$id){ echo 'style="color:; text-decoration:underline;"'; }}  ?>><?php echo $myname=$row['surname']." ".$row['firstname']." ".$row['othername'];?></p></td>   				  
					  <td><?php echo  $row['gender']; ?></td>
					  <td> <?php  echo $active_opp=$position=$row['position'];?></td>
					  <td><?php   echo  $row['age_group']; ?></td>
                      <td> <?php echo $active_op=$row['residence_district'];?></td>
                      <td> <?php echo $position=$row['postal_address'];?></td>
					  <td> <?php  echo $department=$row['contact1'];?></td>
					  <td> <?php  echo $department=$row['contact2'];?></td>
					  <td> <?php  echo $department=$row['email'];?></td>
					 
	
				   
				   </tr >
				   
				   <?php }?>
                    </tbody>
                    <tfoot>
                    </tfoot>
					
    </table>
	</form>	
</div>
   

			
<div class="col-md-4">			 

</div>
<div class="col-md-4">

</div>
					  <div class="modal fade" id="add_new" tabindex="-1" role="dialog" data-backdrop="static">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                                              <h4 class="modal-title"><center><i class=""></i>Add New Participant to this Activity</center></h4>
                                          </div>
                                          <div class="modal-body">
										  <div class="col-md-12">
										  <form id="mydata_form" method="post" action="modules/start_activity/action_attach.php">
				
										  					   <div class="msg">

                  </div>
				  </div>
          
				<div class="row">
            <div class="col-md-6">
				<div id="">
					  <label>Surname:  <span style="color:red">*</span></label>
                      <input style="width:100%;" class="form-control" name="field_activity_id"  value="<?php echo $field_activity_id; ?>"  type="hidden" required>
                      <input style="width:100%;" class="form-control" name="surname"  value="<?php echo $surname; ?>" placeholder="Surname" type="text" required>
				   </div>
                   <div id="">
					 <label>First Name:  <span style="color:red">*</span></label> 
                      <input style="width:100%;" class="form-control" name="firstname" id="Firstname" value="<?php echo $firstname; ?>" placeholder="First Name" type="text" required>
					</div>
					<div id="">
					  <label>Other Name: </label>
                      <input style="width:100%;" class="form-control" name="othername" id="othername" value="<?php echo $Othername; ?>" placeholder="Other Name" type="text">
                      <input style="width:100%;" class="form-control" name="add" id="add" value="" placeholder="" type="hidden">
				   </div>
				   <label style="width:100%;">Gender: </label>
				    <?php $sel_gender= mysqli_real_escape_string($dbcon,$_POST['gender']); ?>
				    <label class="btn btn-sm btn-default" >Male:
					 <input  name="gender" id="" value="Male" type="radio"  <?php if($sel_gender=='Male'){ echo "checked"; } ?>></label>
					 <label class="btn btn-sm btn-default" >Female:
					 <input  name="gender" id="" value="Female" type="radio"  <?php if($sel_gender=='Female'){ echo "checked"; } ?>></label>
					  <label class="btn btn-sm btn-default" >Others:
					 <input  name="gender" id="" value="Others" type="radio" <?php if($sel_gender=='Others'){ echo "checked"; } ?>></label>
					 <label style="width:100%;">Age Group: </label>
					<?php $sel_group= mysqli_real_escape_string($dbcon,$_POST['age_group']); ?>
				     <label class="btn btn-sm btn-default" >(13-18 Years):
					 <input  name="age_group" id="" value="13-18 Years" type="radio"  <?php if($sel_group=='13-18 Years'){ echo "checked"; } ?>></label>
					 <label class="btn btn-sm btn-default" > (19-24 Years):
					 <input  name="age_group" id="" value="19-24 Years" type="radio"  <?php if($sel_group=='19-24 Years'){ echo "checked"; } ?>></label>
					 <label class="btn btn-sm btn-default" >(25-29 Years):
					 <input  name="age_group" id="" value="25-29 Years" type="radio"  <?php if($sel_group=='25-29 Years'){ echo "checked"; } ?>></label>
					 <label class="btn btn-sm btn-default" >(Above 30 Years):
					 <input  name="age_group" id="" value="Above 30 Years" type="radio" <?php if($sel_group=='Above 30 Years'){ echo "checked"; } ?>></label>
					 <div id="">
                      <label>Location:  <span style="color:red"></span></label>
                    <select style="width:100%;" name="district" class="form-control" id="">
                            <?php 
							$sql = mysql_query("SELECT * FROM district");
		                      $i=0;
							  while ($list=mysql_fetch_array($sql))
							  {
							  $i++; ?>
							  <option value="<?php echo $list['name']; ?>"><?php  echo $list['name']; ?>
							  </option>
		               <?php } ?>
		           </select>
				    <a href="?action=manage_locations" target="blank">Add New Location</a>
			       </div>
			</div>
			<div class="col-md-6" >
				   <div id="">
					  <label>Sub County: </label>
                      <textarea style="width:100%;" class="form-control" name="postal_address" id=""  placeholder="Sub County"><?php echo $postal_address;?></textarea>
				   </div>
				    <div id="">
                      <label>Mobile Contact:  <span style="color:red"></span></label>
				      <input  style="width:100%;" class="form-control" name="contact" id="Contact" value="<?php echo $contact;?>" placeholder="Contact" type="tel"/>
			       </div>	
					  

				    

                 		 
    <div id="">
                      <label>Telephone:  <span style="color:red"></span></label>
				      <input  style="width:100%;" class="form-control" name="telephone" id="Contact2" value="<?php echo $telphone;?>" placeholder="Telephone" type="tel"/>
			       </div>	
				    <div id="">
                      <label>Email:  <span style="color:red"></span></label>
				      <input  style="width:100%;" class="form-control" name="email" id="email" value="<?php echo $email;?>" placeholder="Email" type="email"/>
			       </div>	
             
                     <div id="">
                      <label>Institution:  <span style="color:red"></span></label>
				      <input  style="width:100%;" class="form-control" name="institution" id="institution" value="<?php echo $institution;?>" placeholder="Institution" type="text"/>
			       </div>	
					<div id="">
                      <label>Designation:  <span style="color:red"></span></label>
                    <select style="width:100%;" name="position" class="form-control" id="">
                            <?php 
							$sql = mysql_query("SELECT * FROM position");
		                      $i=0;
							  while ($list=mysql_fetch_array($sql))
							  {
							  $i++; ?>
							  <option value="<?php echo $list['position']; ?>"><?php  echo $list['position']; ?>
							  </option>
		               <?php } ?>
		           </select>
				   <a href="?action=jobs" target="blank">Add New Designation /Occupation</a>
			       </div>
	
			       <div id="footer-buttons" style="clear:both; margin-top:20px; margin-bottom:4px;">
                     <button  class="btn btn-primary" name="add" type="submit" ><span class="glyphicon glyphicon-save"></span>Save</button>
                     <button  class="btn btn-warning" name="add" type="reset" ><span class="glyphicon glyphicon-refresh"></span>Reset</button>
					  <button data-dismiss="modal" class="btn btn-info"><i class="fa fa-times"></i> Close</button>
			</div>
            
			  
	</div>
  </div>
  </form>  
</div>
</div>
</div>
</div>
<script>
$('#mydata_form').submit(function(e){
	e.preventDefault();

	var method =$(this).attr('method');
	var path =$(this).attr('action');
	
	var form_data=$(this).serialize();
	
	console.log(form_data);
	
	
		
	$('.msg').html("<center><font color='green'><b>Adding Participant to Activity Please Wait...</b></font></center>");
	
	
	//var form_data=new Formdata($(this[0]));

	
	
$.ajax({
method:method,
data:form_data,
url:path,
success:function(res){
	//do something with returned msg or data
	
	console.log(res);
	
	
	setTimeout(function(){
	
	
	$('.msg').html(res);
	
	//$('.msg').hide(15000);
	
	// $('#modal_id').modal('show'); //shows modal
	
	//setTimeout(function(){
	// $('#modal_id').modal('hide'); //shows modal 
	//},2000);
	
		
	},1000);
	
}


});//close $.ajax amd the param array




});//close submit and its function


</script>




   
    