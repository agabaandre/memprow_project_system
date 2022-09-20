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
				  <li class="active"><a href="dashboard.php?action=finish&training=<?php echo $training;?>">Participants List</a></li>
				 			  
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
              echo'<button  class="btn btn-lg btn-default"  onclick="newBack()"  ><span class="glyphicon glyphicon-arrow-left"></span>Back </button>';
	echo "  ";echo'<button  class="btn btn-lg btn-deafult"  onclick="newDoc()"  ><span class="glyphicon glyphicon-arrow-right"></span>Finish</button>';

?>
<script>
function newDoc() {
    window.location.assign("dashboard.php?action=start_activity")
}
function newBack() {
    window.location.assign("dashboard.php?action=attach_participants&training=<?php echo $training;?>")
}
</script>


	
&nbsp;&nbsp;&nbsp;&nbsp;
<div class="input-group" style="margin-bottom:3px; width:30%; float:right;"> 
     <label>Advanced Searcher</label>
      <input type="text"  class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">                                 
</div>
<form   class="form-horizontal" action="universal_funcs/mdel.php" method="post">

<input type="hidden" name="table" value="field_participants">

<input type="hidden" name="return" value="dashboard.php?action=finish&training=<?php echo $training;?>">
<?php 
					$sql="SELECT * FROM `field_work` WHERE training='$training'";
					$result = mysqli_query($dbcon,$sql);
				
					while($row = mysqli_fetch_array($result)) 
                   {
					      $field_activity_id=$row['field_activity_id'];
				   }
                    ?>
 <input type="hidden" name="training" value="<?php echo $field_activity_id;?>">
  

<button name="delete"  type="submit" id="delete" class="btn btn-danger" style="margin-left:5px;" ><span class="glyphicon glyphicon-remove"></span> Remove Participant(s)</button>									

  	

               <?php $sql="SELECT COUNT(*) FROM `field_participants` WHERE training='$field_activity_id'";
					$result = mysqli_query($dbcon,$sql);
					
					while($row = mysqli_fetch_array($result)) 
                   
					      echo "<p class='btn btn-info' style='font-weight:bold;  font-size:15px; margin:20px;'>This Activity has ".$row[0]. " "."Participants</p>";
				   
                    ?>

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
					$sql="SELECT * FROM `participants`, `field_participants` WHERE participants.participant_id=field_participants.participant_id AND training='$field_activity_id'";
					$result = mysqli_query($dbcon,$sql);
					$i=1;
					while($row = mysqli_fetch_array($result)){ 
					      $id=$row['participant_id'];
					
                    ?>
					
				   <tr >
				        <td><?php echo  $i++; ?></td>
					  <td>
					
				   
					  <label class="btn btn-lg btn-link" style="width:100%;"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $id; ?>"></label>
					
					 </td>
					  <td><p <?php
					//selected participants identifier
					$sqli="SELECT * FROM `field_participants` WHERE `training`='$field_activity_id'";
					$resulti = mysqli_query($dbcon,$sqli);
					while($rowi = mysqli_fetch_array($resulti)){
					$returned_part=$rowi['participant_id'];
					
					if ($returned_part==$id){ echo 'style="color:blue; text-decoration:underline;"'; }}  ?>><?php echo $myname=$row['surname']." ".$row['firstname']." ".$row['othername'];?></p></td>   				  
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
					  