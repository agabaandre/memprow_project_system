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
                  <h5 class="box-title">Accomplished Objectives</h5>
				  <p class="danger"></p>
                </div>
					<table id="mydata" class="table table-hover table-responsive table-bordered">
                    <thead>
                      <tr>
					   <th>No.</th>
					   <th>Objective</th>
					   <th>Date of Accomplishment</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
					
					
					 $i=1;
					$sql="SELECT * FROM `objectives` where flag=1";
					$result = mysqli_query($dbcon,$sql);
					while($row = mysqli_fetch_array($result)){ 
						
                    
					   
                    ?>
                    <tr>
					   <td><?php echo $i++; ?></td>
					   <td width><?php echo $row['objective']; ?></td>
					   <td><?php $flag_date=$row['flag_change_date']; $flag_date=strtotime($flag_date); echo date("j F Y", $flag_date);?></td>
					   
					  
					   
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