<div class="col-md-12" style=" background:white; border-radius: 5px;">
<?php 
include("db_connector/mysqli_conn.php");
?>
          <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
			      <li class=""><a href="dashboard.php?action=users">Manage Users</a></li>
			      <li class="active"><a href="dashboard.php?action=user_logs">User Logs</a></li>
                              <li class=""><a href="modules/universal_funcs/data_remapper.php">Remap Data</a></li>
				  
                 </ul>
				</div>
                               
                <div class="box-header with-border">
                  <h5 class="box-title">Manage Logs</h5>
                </div>
				

</div>


<div class="col-md-12"> 
<div id="CollapsiblePanel1" class="CollapsiblePanel" style="margin:0 auto; overflow-x:hidden; overflow-y:auto;">
  <div class="CollapsiblePanelTab" tabindex="0"><p>View System Logs</p></div>
<div class="CollapsiblePanelContent"> 
      <table id="mydata" class="table table-bordered table-responsive">
                    <thead>
                      <tr>
					    <th style="width:2%;">UUID</th>
					   <th style="width:78%;">Actions</th>
                        <th style="width:20%;">Time and Date</th>
						
                      </tr>
                    </thead>
<tbody>       
 <?php	$i=1;
	$sql_sel=mysqli_query($dbcon,"SELECT * FROM `user_system_log` WHERE uuid!=2 ORDER BY time DESC LIMIT 1000");
    while($row=mysqli_fetch_array($sql_sel)){
    ?>
      <tr> 
            <td><?php echo $row['uuid'];?></td>
			<td><?php echo $row['actions'];?></td>
			<td><?php echo $row['time'];?></td>
	  </tr>
    <?php }
	?>
	
	 </tbody>
        <tfoot>
      </tfoot>
    </table>
	</div>
</div>
</div>

	