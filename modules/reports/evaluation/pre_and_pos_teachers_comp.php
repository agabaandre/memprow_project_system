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
			
					</div>
					<p></p>
  <button   type="submit" class="btn btn btn-info" name="apply_limits"><span class="glyphicon glyphicon-ok"></span>Apply Limits</button>
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
                  <h5 class="box-title">Pre and Post TEACHERS Comparison by Training</h5>
				  <p class="danger"></p>
                </div>
					<table id="mydata" class="table table-hover table-responsive table-bordered">
                    <thead>
                      <tr>
					   <th>No.</th>
					   <th>Training</th>
					   <th>Start Date</th>
					   <th>View on Gender Equality Issues PRE Teachers (Qn:4)</th>
					   <th>View Gender Equality Issues POST Teachers(Qn:4)</th>
					  
					   </tr>
      
                    </thead>
                    <tbody>
					<?php 
					
					$field_activity_id=$_POST['field_activity_id'];
					 $i=1;
					$sql="SELECT field_work.start_date,field_work.training,field_work.field_activity_id, SUM(q41+q42+q43+q44+q45+q46+q47+q48+q49) as Q4preteachers, SUM(q41t+q42t+q43t+q44t+q45t+q46t+q47t+q48t+q49t)
					as Q4postteachers FROM me_f5, me_f6,field_work where me_f6.training_id LIKE'%$field_activity_id' and me_f5.training_id=me_f6.training_id and me_f5.training_id=field_work.field_activity_id 
					and me_f5.training_id=field_work.field_activity_id GROUP BY me_f5.training_id " ;


					$result = mysqli_query($dbcon,$sql);
					while($row = mysqli_fetch_array($result))
					
					{ 
						
                    
					   
                    ?>
                   
					   <tr>
					   <td><?php echo $i++; ?></td>
					   <td><?php echo $mytrain=$row['training'];?></td>
					   <td><?php echo $row['start_date']; ?></td>
					   <td><?php echo $Q4preteachers=$row['Q4preteachers'];?></td>
					   
					   <td>
						<?php echo $Q4postteachers=$row['Q4postteachers'];
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
            text: '<?php  ?> TEACHERS COMPARISON (PRE AND POST) Qn2 AND Qn11 FROM ALL TEACHERS'
        },
        xAxis: {
            categories:['PRE TEACHERS SCORE','POST TEACHERS SCORE']
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
        name:'Total Scores for PRE and POST Teachers',
        color:'#0071da',
        data:[<?php echo $Q4preteachers; ?>,<?php echo $Q4postteachers ?>]
  
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

