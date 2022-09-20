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
<button type="button"  class="btn btn-sm btn-default" onclick="printDiv('printableArea')">Web Print</button>
<hr style="border:1px solid rgb(140, 141, 137);"/>

<p style="font-weight:bold;"></p>


<div id="printableArea">                            
                <div class="box-header with-border">
                  <h5 class="box-title">Activities with their Objective</h5>
				  <p class="danger"></p>
                </div>
					<table id="mydata" class="table table-hover table-responsive table-bordered">
                    <thead>
                      <tr>
					   <th>No.</th>
					   <th>Activity</th>
					   <th>Objectives</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
					
					
					 $i=1;
					$sql="SELECT * FROM objectives, activities where activities.objective_id=objectives.objective_id";
					$result = mysqli_query($dbcon,$sql);
					while($row = mysqli_fetch_array($result)){ 
						
                    
					   
                    ?>
                    <tr>
					   <td><?php echo $i++; ?></td>
					   <td><?php echo $row['activity']; ?></td>
					   <td width><?php echo $row['objective']; ?></td>
					  
					   
                    </tr>
					<?php  } ?>
                    </tbody>
                    <tfoot>
					<th>
					
                    </tfoot>
    </table>
   </div>
</div>
</div>
</div>
</div>