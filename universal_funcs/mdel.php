<?php 
include("../db_connector/mysqli_conn.php");


     if ((isset($_POST['delete']))&&(($_POST['training'])!="")){
          $return=$_POST['return'];
         $add_id=$_REQUEST['checkbox'];
         $field_activity_id=$_POST['training'];
        for($i=0;$i<count($add_id);$i++)
		   {
			   
			  
            $sql = "DELETE FROM field_participants WHERE participant_id=$add_id[$i]";
            $result = mysqli_query($dbcon,$sql);
			?>
          
	   <script>
	     window.location.href = ("../<?php echo $return; ?>&msg=Participant(s) Removed");
	     </script>
     
      <?php     
		}}
		
?>