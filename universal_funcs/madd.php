<?php
include("../init.php"); 
include("../db_connector/mysqli_conn.php");
 
     if ((isset($_POST['add_part']))&&(($_POST['training'])!="")){
		 
         $add_id=$_REQUEST['checkbox'];
         $field_activity_id=$_POST['training'];
         $return=$_POST['return'];
		 if (count($add_id)>0){
        for($i=0;$i<count($add_id);$i++)
		   {
			   
		$count = $db->countOf("field_participants", "training=$field_activity_id AND participant_id=$add_id[$i]");
	    if($count==1)
		
			{?>
		<script>
	     window.location.href = ("../<?php echo $return; ?>&msg=<?php echo $count; ?> of the selected Participant(s) is already part of this Activity!");
	     </script>
			<?php }
			
			else{
		  
			  
            $sql = "INSERT INTO `field_participants` (`id`, `training`, `participant_id`) VALUES (NULL, '$field_activity_id', '$add_id[$i]')";
            $result = mysqli_query($dbcon,$sql);
			?>
			<script>
	     window.location.href = ("../<?php echo $return; ?>&msg=Participant(s) Successfully Added");
	     </script>
 
         <?php  }
	 }}
	 else {
?>
			<script>
	     window.location.href = ("../<?php echo $return; ?>&msg=Select Participant(s) to Add");
	     </script>
 
         <?php  }
	 }
		
?>