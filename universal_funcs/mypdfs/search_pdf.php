 <div class="row" id="printableDiv" style="line-height:0.3px; margin:0 auto;">
        <div class="col-xs-12">
          <center><h2 class="page-header">
		    
			
			<table>
			<tr>
			
			<td>
		<p><img src="../images/memprow_bannerxx.jpeg"style="width:100px; height:100px;"></p></td>
		
		<td width='200'></td><td></td>
			<h3><td>
            <p class='lead'>Activity</p>
            <p><small>Accessed on: <?php echo date('d-M-Y'); ?></small></p>
          </h3>
		  </center>
        </div>
        <!-- /.col -->
 
      <!-- info row -->
	 <?php         $field_activity_id=($_POST['mytraining']);
					$sql="SELECT * FROM field_work WHERE field_activity_id = '$field_activity_id' ORDER BY start_date DESC LIMIT 1000";
					$result = mysqli_query($dbcon,$sql);
					
					while($row = mysqli_fetch_array($result)){ 

					
                   ?>
	
      <div class="row">
	  
        <div class="col-md-4">
		<b class="lead">Memprow Field Activity Details</b>
		</td>
		</tr></table>
         
		 <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">Field Activity Name:<a></a></p>
          <p class="lead">
		 <?php echo $training=$row['training'];?><?php $id=$row['field_activity_id'];?>
          </p>
		  <div class="table-responsive">
            <table class="table">
              <tr>
		    <td>Start Date:</td>
		    <td><?php  echo $row['start_date'];?></td>
			</tr>
			<tr><td>End Date:</td>
            <td><?php  echo $row['end_date'];?></td></tr>
			<tr>
			<td>Supervisor:</td>
            <td><?php       $supervisor=$row['supervisor_id'];
							$sql2 = mysqli_query($dbcon,"SELECT * FROM supervisors WHERE  supervisor_id=$supervisor");
		                  
							  while ($list2=mysqli_fetch_array($sql2))
							  {
							  
							  echo $list2['surname']." ".$list2['firstname']." ".$list2['othername'];
							 
		                      }
							 ?>
			</td></tr>
			<tr>
			<td>Status:</td>
            <td><?php  $status=$row['flag'];
			            if ($status==0){
						  echo "<form action='' method=''>
						  <input type='hidden' value='2' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Activity Partially Acommplished' name='msg'>
						 <p style='color:blue'>Initialised<p>       
						 </form>";
					  }
					  else if ($status==2) {
						 echo "<form action='' method=''>
						  <input type='hidden' value='1' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Successfuly Acommplished' name='msg'>
						 <p style='color:orange'>Partially Accomplished<p> </form>";   
					  }
					  else if ($status==1){
						 echo "<form action='' method=''>
						  <input type='hidden' value='3' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Activity Cancelled' name='msg'>
						 <p style='color:green;'>Accomplised<p> </form>";  
}
					  else if ($status==3){
						 echo "<form action='' method=''>
						  <input type='hidden' value='0' name='flag'>
						  <input type='hidden' value='$id' name='field_activity_id'>
						  <input type='hidden' value='Activity Re-Opened' name='msg'>
						<p style='color:red;'>Cancelled<p>
						 </form>";  						 
					  }
					
					  
				     
					  ?>
			</td></tr>
			
			
        </div>
		</div>
		
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         <tr><td>Memprow Base Activity:</td>
          <td>
            <strong><?php $act_id=$row['activity_id']; 
					  
					             $sqla="SELECT *FROM `activities` WHERE `activity_id` ='$act_id'";
					             $resulta = mysqli_query($dbcon,$sqla);
					            
					             while($rowa = mysqli_fetch_array($resulta))
								 {
								  echo $rowa['activity'];
								 }
								 ?></strong><br>
		</td>
		</tr>
	    </table>
            
			<p></p>
         
        </div>
      
      <!-- /.row -->

      <!-- Table row -->
	  <b class="lead">Training Ground, Participants and Evaluations</b>
	 <p></p>
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-striped">
            <tbody>
            <tr>
              <td>Training Ground:</td><td width="200"><b><?php $ground_id=$row['training_ground']; 
					  
					             $sqla="SELECT *FROM `grounds` WHERE `ground_id` ='$ground_id'";
					             $resulta = mysqli_query($dbcon,$sqla);
					            
					             while($rowa = mysqli_fetch_array($resulta))
								 {
								  echo $rowa['ground'];
								 }
								 ?></b></td> 
              <td>Number of Participants:</td><td><?php $sqla="SELECT count(participant_id) as parts FROM field_participants WHERE training =$id";
					             $resulta = mysqli_query($dbcon,$sqla);
					            
					             while($rowa = mysqli_fetch_array($resulta))
								 
								  echo'<b>'. $rowa['parts'].'</b>';
								 
								 ?></td> 
              </tr> <tr><td>Number of Evaluations:</td></tr><tr><td><?php $sqla="SELECT count(participant_id) as me1 FROM me_f1 WHERE training_id=$id";
					             $resulta = mysqli_query($dbcon,$sqla);
					            
					             while($rowa = mysqli_fetch_array($resulta))
								 {
								  echo'<td><b>PRE SRHH: </td><td>'. $rowa['me1'].'</b></td>';
								 }
								 ?>
								 <?php $sqla="SELECT count(participant_id) as me2 FROM me_f2 WHERE training_id=$id";
					             $resulta = mysqli_query($dbcon,$sqla);
					            
					             while($rowa = mysqli_fetch_array($resulta))
								 {
								  echo'<td><b>POST SRHH: </td><td>'. $rowa['me2'].'</b></td>';
								 }
								 ?>
								 <?php $sqla="SELECT count(participant_id) as me3 FROM me_f3 WHERE training_id=$id";
					             $resulta = mysqli_query($dbcon,$sqla);
					            
					             while($rowa = mysqli_fetch_array($resulta))
								 {
								  echo'<td><b>PRE SSST: </td><td>'. $rowa['me3'].'</b></td>';
								 }
								 ?>
								 <?php $sqla="SELECT count(participant_id) as me4 FROM me_f4 WHERE training_id=$id";
					             $resulta = mysqli_query($dbcon,$sqla);
					            
					             while($rowa = mysqli_fetch_array($resulta))
								 {
								  echo'<td><b>POST SSST: </td><td>'. $rowa['me4'].'</b></td>';
								 }
								 ?>
								 <?php $sqla="SELECT count(participant_id) as me5 FROM me_f5 WHERE training_id=$id";
					             $resulta = mysqli_query($dbcon,$sqla);
					            
					             while($rowa = mysqli_fetch_array($resulta))
								 {
								  echo'<td><b>PRE TEACHERS: </td><td>'. $rowa['me5'].'</b></td>';
								 }
								 ?>
								 <?php $sqla="SELECT count(participant_id) as me6 FROM me_f6 WHERE training_id=$id";
					             $resulta = mysqli_query($dbcon,$sqla);
					            
					             while($rowa = mysqli_fetch_array($resulta))
								 {
								  echo'<td><b>POST TEACHERS: </td><td>'. $rowa['me6'].'</b></td>';
								 }
								 ?>
								 </td>
								
			  
			 
              
              
            </tr>
            
            </tbody>
            
          </table>
        </div>
        <!-- /.col -->
      </div>
  
        <div class="col-md-12">
          <h3 class="lead">Activity Report and Other Notes</h3>
           
		  <table class="table">
          <tr><td><b>Activity Report:</b></td></a></tr>
            <tr>
		    <td><a href="modules/start_activity/view_pdf.php?id=<?php echo $id;?>" title="View Report" target="_blank">
			<?php $sqla="SELECT name FROM reports WHERE training_id=$id";
					             $resulta = mysqli_query($dbcon,$sqla);
					            
					             while($rowa = mysqli_fetch_array($resulta))
								 
								  echo $rowa['name'];
								 
								 ?></a></td>
			</tr>
              <tr>
		    <td><b> Training Notes:</b></td>
			</tr>
			<tr>
		    <td><?php  echo $row['notes'];?></td>
			</tr>
		 </table>
        </div>


        <!-- /.col -->
    
       
 
				  
      <!-- /.row -->

      <!-- this row will not appear when printing -->

<script type="text/javascript">
$(document).ready(function(){
	var maxLength = 100;
	$(".show-read-more").each(function(){
		var myStr = $(this).text();
		if($.trim(myStr).length > maxLength){
			var newStr = myStr.substring(0, maxLength);
			var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
			$(this).empty().html(newStr);
			$(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
			$(this).append('<span class="more-text">' + removedStr + '</span>');
		}
	});
	$(".read-more").click(function(){
		$(this).siblings(".more-text").contents().unwrap();
		$(this).remove();
	});
});
</script>
<style type="text/css">
    .show-read-more .more-text{
        display: none;
    }
</style>

</div>
</div>
 <?php }?>
</div>