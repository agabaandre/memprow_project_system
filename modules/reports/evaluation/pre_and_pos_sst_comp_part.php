<?php 
include("db_connector/mysqli_conn.php");

?>
<div class="col-md-12" style=" background:white; border-radius: 5px;"> 
<div class="nav-tabs-custom"> 
    <ul class="nav nav-tabs">
				  <li class="btn btn-sm btn-default"><a href="dashboard.php?action=reports">Back</a></li>			  
               
				   </ul>
	</div>
<div class="col-md-12">
	<form action="" method="POST" style="width:30%;" class="form-inline">
  	<div id="">
                      <label>Select Field Work Activity for Graphing:  <span style="color:red"></span></label> 
                        <select class="form-control select2" name="field_activity_id" id="factivity_id myselect" style="width:100%;">
                          <?php 
							$sql2 = mysqli_query($dbcon,"SELECT DISTINCT field_activity_id, training FROM field_work");
		                      
							  while ($list2=mysqli_fetch_array($sql2))
							  {
							 ?>
							
							  <option value="<?php echo $list2['field_activity_id']; ?>"><?php  echo $list2['training']; ?>
							  </option>
		               <?php } ?>
					    <option value="" selected>All
							  </option>
				      </select>
					  <label>Select Participant  <span style="color:red"></span></label>
					      <select class="form-control select2" name="participant_id" id="participant_id myselect" style="width:100%;" required>
                          <?php 
							$sqlp = mysqli_query($dbcon,"SELECT field_work.field_activity_id,field_work.training AS train, field_participants.training,
field_participants.participant_id,participants.participant_id,participants.surname,participants.firstname,participants.othername,participants.gender,participants.postal_address,participants.position,participants.residence_district
FROM field_work, field_participants, participants WHERE field_participants.participant_id = participants.participant_id
AND field_work.field_activity_id = field_participants.training");
		                   
							  while ($listp=mysqli_fetch_array($sqlp))
							  {
							 ?>
							  <option value="<?php echo $participant_id=$listp['participant_id']; ?>" required><?php echo $listp['surname']." ".$listp['firstname']." ".$listp['othername']." , ".$listp['gender']." , ".$listp['residence_district']." , ".$listp['postal_address']." , ".$listp['position'];?>
							  </option>
							  
		               <?php } ?>
				      </select>
			
					</div>
					<p></p>
  <button   type="submit" class="btn btn btn-info" name="apply_limits"><span class="glyphicon glyphicon-ok"></span>Apply Limits and Graph Data</button>
<p></p>

</form>
</div>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
 <script src="js/highcharts/highcharts.js"></script>
<script src="js/highcharts/exporting.js"></script>
<div class="col-md-12">
<?php include("src/export.php");?>
<script>
 function printDiv(printableDiv){
   
                var printContents =document.getElementById(printableDiv).innerHTML;
				var originalContents= document.body.innerHTML;
				document.body.innerHTML = printContents;
				
				window.print();
				document.body.innerHTML = originalContents;
				}
</script>
	  <script>
    $(function(){
      // turn the element to select2 select style
      $('.select2').select2();
    });
  </script>
<button type="button"  class="btn btn-sm btn-default" onclick="printDiv('printableArea')">Web Print</button>
<hr style="border:1px solid rgb(140, 141, 137);"/>

<p style="font-weight:bold;"></p>


<div id="printableArea">                            
                <div class="box-header with-border">
                  <h5 class="box-title">Pre and Post SST Comparison by Participant</h5>
				  <p class="danger"></p>
                </div>
					<table id="mydata" class="table table-hover table-responsive table-bordered">
                    <thead>
                      <tr>
					   <th>No.</th>
					   <th>Participant</th>
					   <th>Occupation</th>
					   <th>Training</th>
					   <th>Start Date</th>
					   <th>View on Gender Equality Issues PRE SSST (Qn:2)</th>
					   <th>View Gender Equality Issues POST SSST (Qn:11</th>
					   
					   </tr>
      
                    </thead>
                    <tbody>
					<?php 
					
					$field_activity_id=$_POST['field_activity_id'];
					$participant_id=$_POST['participant_id'];
					 $i=1;
					$sql="SELECT participants.surname,participants.firstname,participants.othername,participants.position,field_work.start_date,field_work.training,field_work.field_activity_id, SUM(q21+q22+q23+q24+q25+q26+q27+q28+q29+q210) as Q2pressst, SUM(q121+q122+q123+q124+q125+q126+q127+q128+q129+q130) 
					as Q11postssst FROM me_f3,me_f4,participants,field_work where me_f3.training_id LIKE'%$field_activity_id' and me_f3.participant_id LIKE'%$participant_id' and me_f3.training_id=me_f4.training_id and me_f3.training_id=field_work.field_activity_id 
					and me_f4.training_id=field_work.field_activity_id and me_f3.participant_id=me_f4.participant_id and me_f3.participant_id=participants.participant_id
					and me_f4.participant_id=participants.participant_id GROUP BY me_f3.training_id " ;


					$result = mysqli_query($dbcon,$sql);
					while($row = mysqli_fetch_array($result))
					
					{ 
						
                    
					   
                    ?>
                   
					   <tr>
					   <td><?php echo $i++; ?></td>
					   <td><?php echo $myname=$row['surname']." ".$row['firstname']." ".$row['othername'];?></td>
					   <td><?php echo $row['position'];?></td>
					   <td><?php echo $mytrain=$row['training'];?></td>
					   <td><?php echo $row['start_date']; ?></td>
					   <td><?php echo $q5preshr=$row['Q2pressst'];?></td>
					   
					   <td>
						<?php echo $q2post=$row['Q11postssst'];
						?></td>
						
						    </tr>
					  
					<?php  } ?>
                    </tbody>
                    <tfoot>
					
					
                    </tfoot>
    </table>
   </div>
 <?php if (isset($_POST['apply_limits'])){?>
   <script type="text/javascript">
$(function () {
    $('#graph').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: '<?php echo $myname;  ?> SSST COMPARISON (PRE AND POST) Qn5 AND Qn2 '
        },
        xAxis: {
            categories:['Pre SSST SCORE','POST SSST SCORE']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Score'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series:[
        {
        name:'Total Score',
        color:'#0071de',
        data:[<?php echo $Q2pressst; ?>,<?php echo $Q11postssst; ?>]
  
        }
        

        ]
    });
});

                                

        </script>
		

<div class="col-md-12" id="graph" style="min-width:50%; max-width:95%; height:500px;">
</div>	
 <?php }?> 
</div>
</div>

