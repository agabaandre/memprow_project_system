			
<?php 
include("db_connector/mysqli_conn.php");
$training=($_GET['training']);
$training=urldecode($training);
?>		
 
<!-- date picker ----------------------------------------------------->

<script>
$.fn.datepicker.defaults.format = "yyyy/mm/dd";
$('.datepicker').datepicker({
});

</script>	


<div class="col-md-12">
                      

          <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
			 <?php if($_GET['m1']==1){?>
			  <li class="<?php if ($_POST['tab-active']=="shrtooladd") { echo ""; } ?>"><a href="#srhrtool" data-toggle="tab"> PRE SRHR</a></li>
			  <?php } ?>
			  <?php if($_GET['m2']==1){?>
			  <li class="<?php if ($_POST['tab-active']=="shrtooladd2") { echo ""; } ?>"><a href="#shrtool1" data-toggle="tab">POST SRHR</a></li>
			   <?php } ?>
			  <?php if($_GET['m3']==1){?>
			  <li class="<?php if ($_POST['tab-active']=="shrtooladd4") { echo ""; } ?>"><a href="#tool3" data-toggle="tab">PRE SSST</a></li>
			   <?php } ?>
			  <?php if($_GET['m4']==1){?>
              <li class="<?php if ($_POST['tab-active']=="shrtooladd3") { echo ""; } ?>"><a href="#tool2" data-toggle="tab">POST SSST</a></li>
			   <?php } ?>
			  <?php if($_GET['m5']==1){?>
              <li class="<?php if ($_POST['tab-active']=="shrtooladd5") { echo ""; } ?>"><a href="#teachers" data-toggle="tab">TEACHERS</a></li>
			   <?php } ?>
			  <?php if($_GET['m6']==1){?>
              <li class="<?php if ($_POST['tab-active']=="shrtooladd6") { echo ""; } ?>"><a href="#post_teachers" data-toggle="tab">POST TEACHERS</a></li>
			   <?php } ?>
           </ul>
         </div>
		 
<div class="col-md-12 notification">
 <?php 
					$sql="select training from field_work where field_activity_id=$training";
					$result = mysqli_query($dbcon,$sql);
					while($row = mysqli_fetch_array($result)) 
                   {
					      $training_name=$row['training'];
				   }
                    ?>
<?php
			
//TOOL1
					if(isset($_POST['shrtooladd'])) {
					              
							$training;
							$participant_id=mysqli_real_escape_string($dbcon,$_POST['participant_id']);
							$entry_id=$training.$participant_id;
							$f1entry_id=$training.$participant_id;
							$q1=mysqli_real_escape_string($dbcon,$_POST['q1']);
							$q2=mysqli_real_escape_string($dbcon,$_POST['q2']);
							$q3=mysqli_real_escape_string($dbcon,$_POST['q3']);
							$q4=mysqli_real_escape_string($dbcon,$_POST['q4']);
							$q51=mysqli_real_escape_string($dbcon,$_POST['q51']);
							$q52=mysqli_real_escape_string($dbcon,$_POST['q52']);
							$q53=mysqli_real_escape_string($dbcon,$_POST['q53']);
							$q54=mysqli_real_escape_string($dbcon,$_POST['q54']);
							$q55=mysqli_real_escape_string($dbcon,$_POST['q55']);
							$q56=mysqli_real_escape_string($dbcon,$_POST['q56']);
							$q61=mysqli_real_escape_string($dbcon,$_POST['q61']);
							$q62=mysqli_real_escape_string($dbcon,$_POST['q62']);
							$q63=mysqli_real_escape_string($dbcon,$_POST['q63']);
							$q64=mysqli_real_escape_string($dbcon,$_POST['q64']);
							$q65=mysqli_real_escape_string($dbcon,$_POST['q65']);
							$q66=mysqli_real_escape_string($dbcon,$_POST['q66']);
							$q67=mysqli_real_escape_string($dbcon,$_POST['q67']);
							
							
	

 if ($act=mysqli_query($dbcon,"INSERT INTO me_f1 VALUES ('$participant_id', '$entry_id', '$training','$q1', '$q2', '$q3', '$q4', '$q51',
 '$q52', '$q53','$q54','$q55', '$q56','$q61','$q62', '$q63','$q64','$q65', '$q66','$q67')")){
echo $msg='<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>PRE SRHR Evaluation on ' .$training_name. ' Saved Successfully</strong>
                   </div>';
     					
					}
					else{
						echo $msg='<div class="alert alert-warning alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>PRE SRHR Evaluation on ' .$training_name. ' is Already Added for this Person</strong>
                   </div>';
					}
					
					}
?>

<?php
			
//TOOL2
					if(isset($_POST['shrtooladd2'])) {
					              
							$training;
							$participant_id=mysqli_real_escape_string($dbcon,$_POST['participant_id']);
							$entry_id=$training.$participant_id;
							$f2entry_id=$training.$participant_id;
							$advances=mysqli_real_escape_string($dbcon,$_POST['advances']);
							$gleaders=mysqli_real_escape_string($dbcon,$_POST['gleaders']);
							$gnleaders=mysqli_real_escape_string($dbcon,$_POST['gnleaders']);
							$ztolerance=mysqli_real_escape_string($dbcon,$_POST['ztolerance']);
							$notomen=mysqli_real_escape_string($dbcon,$_POST['notomen']);
							$rape=mysqli_real_escape_string($dbcon,$_POST['rape']);
							$harrased_dresscode=mysqli_real_escape_string($dbcon,$_POST['harrased_dresscode']);
							$gender_issues=mysqli_real_escape_string($dbcon,$_POST['gender_issues']);
							$rights=mysqli_real_escape_string($dbcon,$_POST['rights']);
							$education=mysqli_real_escape_string($dbcon,$_POST['education']);
							$violence=mysqli_real_escape_string($dbcon,$_POST['violence']);
							$gbv=mysqli_real_escape_string($dbcon,$_POST['gbv']);
							$srpr=mysqli_real_escape_string($dbcon,$_POST['srpr']);
							$pas=mysqli_real_escape_string($dbcon,$_POST['pas']);
					
							
							
	

 if ($act=mysqli_query($dbcon,"INSERT INTO `me_f2` 
 (`participant_id`, `entry_id`, `training_id`, `q1`, `q21`, `q22`, `q23`, `q24`, `q25`, `q26`, `q31`, `q32`, `q33`, `q34`, `q35`, `q36`, `q37`) VALUES
 ('$participant_id', '$entry_id', '$training', '$advances', '$gleaders', '$gnleaders', '$ztolerance', '$notomen', '$rape', '$harrased_dresscode', '$gender_issues','$rights', '$education', 
 '$violence', '$gbv', '$srpr', '$pas')")){
echo $msg='<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>POST SRHR Evaluation on' .$training_name. ' Saved Successfully</strong>
                   </div>';
     					
					}
					else{
					echo $msg='<div class="alert alert-warning alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>POST SRHR Evaluation on ' .$training_name. ' is Already Added for this Person</strong>
                   </div>';
					}
					
					
					
					}
?>
<?php				if(isset($_POST['shrtooladd3'])) {
					              
							$training;
							$participant_id=mysqli_real_escape_string($dbcon,$_POST['participant_id']);
							$entry_id=$training.$participant_id;
							$f3entry_id=$training.$participant_id;
							$advances=mysqli_real_escape_string($dbcon,$_POST['advances']);
							
							$gleaders=mysqli_real_escape_string($dbcon,$_POST['gleaders']);
							$gnleaders=mysqli_real_escape_string($dbcon,$_POST['gnleaders']);
							$goodformarriage=mysqli_real_escape_string($dbcon,$_POST['goodformarriage']);
							$righttoeduaction=mysqli_real_escape_string($dbcon,$_POST['righttoeduaction']);
							$ztolerance=mysqli_real_escape_string($dbcon,$_POST['ztolerance']);
							$notomen=mysqli_real_escape_string($dbcon,$_POST['notomen']);
							$rape=mysqli_real_escape_string($dbcon,$_POST['rape']);
							$harrased_dresscode=mysqli_real_escape_string($dbcon,$_POST['harrased_dresscode']);
							$teachers_treat=mysqli_real_escape_string($dbcon,$_POST['teachers_treat']);
							$university_view=mysqli_real_escape_string($dbcon,$_POST['university_view']);
							
		
					
							
							
	

 if ($act=mysqli_query($dbcon,"INSERT INTO me_f3 (`participant_id`, `entry_id`, `training_id`, `q1`, `q21`, `q22`, `q23`, `q24`, `q25`, `q26`, `q27`, `q28`, `q29`, `q210`) VALUES
 ('$participant_id', '$entry_id', '$training', '$advances', '$gleaders', '$gnleaders', '$goodformarriage','$righttoeduaction', '$ztolerance', '$notomen', '$rape', '$harrased_dresscode','$teachers_treat', '$university_view')")){
echo $msg='<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>POST SSST Evaluation on ' .$training_name. 'Saved Successfully</strong>
                   </div>';
     					
					}
					else{
					echo $msg='<div class="alert alert-warning alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>POST SSST Evaluation on ' .$training_name. ' is Already Added for this Person</strong>
                   </div>';
					}
					
					
					}
?>
<?php				if(isset($_POST['shrtooladd4'])) {
					              
							$training;
							$participant_id=mysqli_real_escape_string($dbcon,$_POST['participant_id']);
							$entry_id=$training.$participant_id;
							$f4entry_id=$training.$participant_id;
							$leadership=mysqli_real_escape_string($dbcon,$_POST['leadership']);
							$responsibilty=mysqli_real_escape_string($dbcon,$_POST['responsibilty']);
							$leadership_not_just=mysqli_real_escape_string($dbcon,$_POST['leadership_not_just']);
							$co_curicular_view=mysqli_real_escape_string($dbcon,$_POST['co-curicular_view']);
							$co_curicular=mysqli_real_escape_string($dbcon,$_POST['co-curicular']);
							$other_acts=mysqli_real_escape_string($dbcon,$_POST['other_acts']);
							$why_not_coc=mysqli_real_escape_string($dbcon,$_POST['why_not_coc']);
							$university=mysqli_real_escape_string($dbcon,$_POST['university']);
							$why_univeristy=mysqli_real_escape_string($dbcon,$_POST['why_university']);
							$why_not_univeristy=mysqli_real_escape_string($dbcon,$_POST['why_not_university']);
							$advances=mysqli_real_escape_string($dbcon,$_POST['advances']);
							
							$gleaders=mysqli_real_escape_string($dbcon,$_POST['gleaders']);
							$gnleaders=mysqli_real_escape_string($dbcon,$_POST['gnleaders']);
							$goodformarriage=mysqli_real_escape_string($dbcon,$_POST['goodformarriage']);
							$righttoeduaction=mysqli_real_escape_string($dbcon,$_POST['righttoeduaction']);
							$ztolerance=mysqli_real_escape_string($dbcon,$_POST['ztolerance']);
							$notomen=mysqli_real_escape_string($dbcon,$_POST['notomen']);
							$rape=mysqli_real_escape_string($dbcon,$_POST['rape']);
							$harrased_dresscode=mysqli_real_escape_string($dbcon,$_POST['harrased_dresscode']);
							$teachers_treat=mysqli_real_escape_string($dbcon,$_POST['teachers_treat']);
							$university_view=mysqli_real_escape_string($dbcon,$_POST['university_view']);
							
		
					
							
							
	

 if ($act=mysqli_query($dbcon,"INSERT INTO `me_f4` (`participant_id`, `entry_id`, `training_id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q5why`, `q6`, `q7`, `q8`, `q9`, `q10`,`q121`, `q122`, `q123`, `q124`, `q125`, `q126`, `q127`, `q128`, `q129`, `q130`) VALUES 
 ('$participant_id', '$entry_id', '$training', '$leadership', '$responsibilty', '$leadership_not_just',
 '$co_curicular_view', '$co_curicular', '$other_acts', '$why_not_coc' , '$university', '$why_univeristy','$why_not_univeristy', 
 '$advances', '$gleaders', '$gnleaders', '$goodformarriage', '$righttoeduaction', '$ztolerance', '$notomen', '$rape',
 '$harrased_dresscode', '$teachers_treat', '$university_view')")){
echo $msg='<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong><?php echo "PRE SSST Evaluation on". $training; ?>Saved Successfully</strong>
                   </div>';
     					
					}
					else{
					echo $msg='<div class="alert alert-warning alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>PRE SSST Evaluation on ' .$training_name. ' is Already Added for this Person</strong>
                   </div>';
					}
					
					}
?>
<?php				if(isset($_POST['shrtooladd5'])) {
					              
							$training;
							$participant_id=mysqli_real_escape_string($dbcon,$_POST['participant_id']);
							$entry_id=$training.$participant_id;
							$f5entry_id=$training.$participant_id;
							$mechanisms=mysqli_real_escape_string($dbcon,$_POST['mechanisms']);
							$strategies=mysqli_real_escape_string($dbcon,$_POST['strategies']);
							$promote_gals=mysqli_real_escape_string($dbcon,$_POST['promote_gals']);
						
							
							$gleaders=mysqli_real_escape_string($dbcon,$_POST['gleaders']);
							$gnleaders=mysqli_real_escape_string($dbcon,$_POST['gnleaders']);
							$goodformarriage=mysqli_real_escape_string($dbcon,$_POST['goodformarriage']);
							$righttoeduaction=mysqli_real_escape_string($dbcon,$_POST['righttoeduaction']);
							$ztolerance=mysqli_real_escape_string($dbcon,$_POST['ztolerance']);
							$notomen=mysqli_real_escape_string($dbcon,$_POST['notomen']);
							$rape=mysqli_real_escape_string($dbcon,$_POST['rape']);
							$harrased_dresscode=mysqli_real_escape_string($dbcon,$_POST['harrased_dresscode']);
							$teachers_treat=mysqli_real_escape_string($dbcon,$_POST['teachers_treat']);
							
							$q61=mysqli_real_escape_string($dbcon,$_POST['q61']);
							$q62=mysqli_real_escape_string($dbcon,$_POST['q62']);
							$q63=mysqli_real_escape_string($dbcon,$_POST['q63']);
							$q64=mysqli_real_escape_string($dbcon,$_POST['q64']);
							$q65=mysqli_real_escape_string($dbcon,$_POST['q65']);
							$q66=mysqli_real_escape_string($dbcon,$_POST['q66']);
							
					      
							
							
	

 if ($act=mysqli_query($dbcon,"INSERT INTO `me_f5` (`participant_id`, `entry_id`, `training_id`, `q1`, `q2`, `q3`, `q41`, `q42`, `q43`, `q44`, `q45`, `q46`, `q47`, `q48`, `q49`, 
 `q61`, `q62`, `q63`, `q64`, `q65`, `q66`) VALUES 
 ('$participant_id', '$entry_id', '$training', '$mechanisms', '$strategies', '$promote_gals','$gleaders', '$gnleaders', '$goodformarriage', '$righttoeduaction', '$ztolerance', '$notomen', '$rape',
 '$harrased_dresscode', '$teachers_treat','$q61','$q62', '$q63','$q64','$q65', '$q66')")){
echo $msg='<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>PRE TEACHERS Evaluation on ' .$training_name. 'Saved Successfully</strong>
                   </div>';
     					
					}
					else{
					echo $msg='<div class="alert alert-warning alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>PRE TEACHERS Evaluation on ' .$training_name. ' is Already Added for this Person</strong>
                   </div>';
					}
					
					}
?>
<?php				if(isset($_POST['shrtooladd6'])) {
					              
							$training;
							$participant_id=mysqli_real_escape_string($dbcon,$_POST['participant_id']);
							$entry_id=$training.$participant_id;
							$f6entry_id=$training.$participant_id;
							
							
							$gleaders=mysqli_real_escape_string($dbcon,$_POST['gleaders']);
							$gnleaders=mysqli_real_escape_string($dbcon,$_POST['gnleaders']);
							$goodformarriage=mysqli_real_escape_string($dbcon,$_POST['goodformarriage']);
							$righttoeduaction=mysqli_real_escape_string($dbcon,$_POST['righttoeduaction']);
							$ztolerance=mysqli_real_escape_string($dbcon,$_POST['ztolerance']);
							$notomen=mysqli_real_escape_string($dbcon,$_POST['notomen']);
							$rape=mysqli_real_escape_string($dbcon,$_POST['rape']);
							$harrased_dresscode=mysqli_real_escape_string($dbcon,$_POST['harrased_dresscode']);
							$teachers_treat=mysqli_real_escape_string($dbcon,$_POST['teachers_treat']);
							
							$q61=mysqli_real_escape_string($dbcon,$_POST['q61']);
							$q62=mysqli_real_escape_string($dbcon,$_POST['q62']);
							$q63=mysqli_real_escape_string($dbcon,$_POST['q63']);
							$q64=mysqli_real_escape_string($dbcon,$_POST['q64']);
							$q65=mysqli_real_escape_string($dbcon,$_POST['q65']);
							$q66=mysqli_real_escape_string($dbcon,$_POST['q66']);
							
							
		
					
							
							
	

 if ($act=mysqli_query($dbcon,"INSERT INTO `me_f6` (`participant_id`, `entry_id`, `training_id`,`q41t`, `q42t`, `q43t`, `q44t`, `q45t`, `q46t`, `q47t`, `q48t`, `q49t`,
 `q61`, `q62`, `q63`, `q64`, `q65`, `q66`) VALUES 
 ('$participant_id', '$entry_id', '$training','$gleaders', '$gnleaders', '$goodformarriage', '$righttoeduaction', '$ztolerance', '$notomen', '$rape',
 '$harrased_dresscode', '$teachers_treat','$q61','$q62', '$q63','$q64','$q65', '$q66')")){
echo $msg='<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>POST TEACHERS Evaluation on ' .$training_name. 'Saved Successfully</strong>
                   </div>';
     					
					}
					else{
					echo $msg='<div class="alert alert-warning alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>PRE TEACHERS Evaluation on ' .$training_name. ' is Already Added for this Person</strong>
                   </div>';
					}
					
					}
?>
</div>
<div class="tab-content">

<?php //Begin form tool1/?>
<div class="col-md-12 tab-pane" id="srhrtool">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW's Questionnaire for Girls/Young Women in University</h5>
<h5 class="box-title" style="text-align:centre;">SRHR TOOL</h5>
<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women's Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 tab-pane" id="">
 
<form action="" method="post">
	<div id="">
                      
                               
		           <label>Select Participant to Evaluate<span style="color:red"></span></label> 
                        <select class="form-control select2" name="participant_id" id="participant_id myselect" style="width:100%;" required>
                          <?php 
							$sqlp = mysqli_query($dbcon,"SELECT field_work.field_activity_id,field_work.training AS train, field_participants.training,
field_participants.participant_id,participants.participant_id,participants.surname,participants.firstname,participants.othername,participants.gender,participants.postal_address,participants.position,participants.residence_district
FROM field_work, field_participants, participants WHERE field_participants.participant_id = participants.participant_id
AND field_work.field_activity_id = field_participants.training AND field_participants.training =$training");
		                   
							  while ($listp=mysqli_fetch_array($sqlp))
							  {
							 ?>
							  <option value="<?php echo $participant_id=$listp['participant_id']; ?>" required><?php echo $myname=$listp['surname']." ".$listp['firstname']." ".$listp['othername']." , ".$listp['gender']." , ".$listp['residence_district']." , ".$listp['postal_address']." , ".$listp['position'];?>
							  </option>
							  
		               <?php } ?>
				      </select>
					
					  <?php 
					$sql="select training from field_work where field_activity_id=$training";
					$result = mysqli_query($dbcon,$sql);
					while($row = mysqli_fetch_array($result)) 
                   {
					      echo '<b style="margin-top:6px;color: #dc0303;"> Training Name:'.$row['training'].'</b>';
				   }
                    ?>
	</div>
				<div id="">
					  <label>1. Are you involved in any leadership role in your University? :  <span style="color:red">*</span></label>
					 
				    <label class="btn btn-sm btn-default" >Yes:
					 <input  name="q1" id="" value="1" type="radio"></label>
					 <label class="btn btn-sm btn-default" >NO:
					 <input  name="q1" id="" value="0" type="radio"></label>
                </div>
                   <div id="">
					 <label>2. If YES, please indicate which leadership role you are responsible for.:  <span style="color:red"></span></label> 
                      <input class="form-control" name="q2" id="" value="<?php echo $responsibilty;?>" placeholder="Responsibilty Held"type="text">
					</div>
					<div id="">
					  <label>3.	If, NO, please give the reasons why you are not involved in leadership: </label>
                      <input class="form-control" name="q3" id="leadership_not_just" value="<?php echo $oname;?>" placeholder="Reasons why you are not involved in leadership" type="text">
				   </div>
				    <div id="">
                      <label>4.	Please describe what you would do if you received unwanted sexual advances while at the University :  <span style="color:red"></span></label>
				      <textarea class="form-control" name="q4" id="" placeholder="What would you do if you received unwanted sexual advances?"></textarea>
			       </div>
                    <div id="">
                      <label>5.	What is your view of the following: :  <span style="color:red"></span></label>
					  <table id="" class="table table-bordered table-hover table-responsive">
                    <thead>
                         <tr>							
						<th>Gender equality issue</th>
						<th>Strongly agree (5)</th>
						<th>Agree (4)</th>
						<th>Undecided (3)</th>
						<th>Disagree(2)</th>
						<th>Strongly disagree(1)</th>
						
                       </tr>
                    </thead>
                    <tbody>
				
                    <tr>
					   <td>1. Girls make good leaders</td>
					  <td><input  name="q51" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q51" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q51" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q51" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q51" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls should not go into leadership.</td>
					  <td><input  name="q52" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q52" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q52" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q52" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q52" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. There is zero tolerance for sexual harassment in our University. </td>
					  <td><input  name="q53" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q53" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q53" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q53" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q53" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Girls often say 'no' to SEX when they mean 'yes'.</td>
					  <td><input  name="q54" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q54" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q54" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q54" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q54" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Well-behaved girls do not get raped.</td>
					  <td><input  name="q55" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q55" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q55" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q55" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q55" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="q56" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q56" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q56" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q56" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q56" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
				      
			       </div>	
               <div id="">
                      <label>6.	What is your level of understanding of the following?  <span style="color:red"></span></label>
					  <table id="" class="table table-bordered table-hover table-responsive">
                    <thead>
                         <tr>							
						<th></th>
						<th>High (3)</th>
						<th>Medium (2)</th>
						<th>Low (1)</th>
						<th>None (0)</th>
						
						
                       </tr>
                    </thead>
                    <tbody>
				
                    <tr>
					   <td>1. Gender issues</td>
					  <td><input  name="q61" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					     </tr>
                     <tr>					 
					  <td>2. Girls / women's rights.</td>
					  <td><input  name="q62" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					    </tr>
					   <tr>					 
					  <td>3. Girls rigts to eduaction. </td>
					  <td><input  name="q63" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Violence against girls.</td>
					  <td><input  name="q64" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					   </tr>
					   <tr>					 
					  <td>5. Sexual ad gender based Violence.</td>
					  <td><input  name="q65" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Sexual and reproductive health and rights</td>
					  <td><input  name="q66" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>7. Patriarchy and Sexuality</td>
					  <td><input  name="q67" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q67" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q67" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q67" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					   </tr>
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
            </div>		
<input type="hidden" name="tab-active"	value="shrtooladd"> 			
	      <button  class="btn btn-primary" name="shrtooladd" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-sm btn-default"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
		</form>			
</div>
<?php //end form tool1/?>


</div>

<div class="col-md-12 tab-pane" id="shrtool1">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW's Questionnaire for Girls/Young Women in University</h5>
               <h5 class="box-title" style="text-align:centre;">SRHR POST TRAINING TOOL</h5>
<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women's Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 tab-pane" id="">

<form name="" id="data_form" method="post" action="">
<div id="">
                      
                               
		           <label>Select Participant to Evaluate<span style="color:red"></span></label> 
                        <select class="form-control select2" name="participant_id" id="participant_id myselect" style="width:100%;" required>
                          <?php 
							$sqlp = mysqli_query($dbcon,"SELECT field_work.field_activity_id,field_work.training AS train, field_participants.training,
field_participants.participant_id,participants.participant_id,participants.surname,participants.firstname,participants.othername,participants.gender,participants.postal_address,participants.position,participants.residence_district
FROM field_work, field_participants, participants WHERE field_participants.participant_id = participants.participant_id
AND field_work.field_activity_id = field_participants.training AND field_participants.training =$training");
		                   
							  while ($listp=mysqli_fetch_array($sqlp))
							  {
							 ?>
							  <option value="<?php echo $participant_id=$listp['participant_id']; ?>" required><?php echo $myname=$listp['surname']." ".$listp['firstname']." ".$listp['othername']." , ".$listp['gender']." , ".$listp['residence_district']." , ".$listp['postal_address']." , ".$listp['position'];?>
							  </option>
							  
		               <?php } ?>
				      </select>
					
					  <?php 
					$sql="select training from field_work where field_activity_id=$training";
					$result = mysqli_query($dbcon,$sql);
					while($row = mysqli_fetch_array($result)) 
                   {
					     echo '<b style="margin-top:6px;color: #dc0303;"> Training Name:'.$row['training'].'</b>';
						 }
                    ?>
	</div>
				
				    <div id="">
                      <label>1.	Please describe what you would do if you received unwanted sexual advances while at the University :  <span style="color:red"></span></label>
				      <textarea class="form-control" name="advances" id="Contact" placeholder="What would you do if you received unwanted sexual advances?"></textarea>
			       </div>
                    <div id="">
                      <label>2.	What is your view of the following: :  <span style="color:red"></span></label>
					  <table id="" class="table table-bordered table-hover table-responsive">
                    <thead>
                         <tr>							
						<th>Gender equality issue</th>
						<th>Strongly agree (5)</th>
						<th>Agree (4)</th>
						<th>Undecided (3)</th>
						<th>Disagree(2)</th>
						<th>Strongly disagree(1)</th>
						
                       </tr>
                    </thead>
                    <tbody>
				
                    <tr>
					   <td>a. Girls make good leaders</td>
					  <td><input  name="gleaders" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>b. Girls should not go into leadership.</td>
					  <td><input  name="gnleaders" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>c. There is zero tolerance for sexual harassment in our University. </td>
					  <td><input  name="ztolerance" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>d. Girls often say 'no' to SEX when they mean 'yes'.</td>
					  <td><input  name="notomen" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>e. Well-behaved girls do not get raped.</td>
					  <td><input  name="rape" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>f. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="harrased_dresscode" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
				      
			       </div>	
               <div id="">
                      <label>3.	What is your level of understanding of the following?  <span style="color:red"></span></label>
					  <table id="" class="table table-bordered table-hover table-responsive">
                    <thead>
                         <tr>
                        <th></th>						 
						<th>High (3)</th>
						<th>Medium (2)</th>
						<th>Low (1)</th>
						<th>None (0)</th>
						
                       </tr>
                    </thead>
                    <tbody>
				
                    <tr>
					   <td>a. Gender issues</td>
					  <td><input  name="gender_issues" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					</tr>
                     <tr>					 
					  <td>b. Girls / women's rights.</td>
					  <td><input  name="rights" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rights" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rights" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rights" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					 </tr>
					   <tr>					 
					  <td>c. Girls rigts to education. </td>
					  <td><input  name="education" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="education" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="education" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="education" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>d. Violence against girls.</td>
					  <td><input  name="violence" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="violence" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="violence" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="violence" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  
					  </tr>
					   <tr>					 
					  <td>e. Sexual and gender based Violence.</td>
					  <td><input  name="gbv" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gbv" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gbv" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gbv" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					   </tr>
					  <tr>					 
					  <td>f. Sexual and reproductive health and rights</td>
					  <td><input  name="srpr" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="srpr" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="srpr" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="srpr" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					 
					  </tr>
					   <tr>					 
					  <td>g. Patriarchy and Sexuality</td>
					  <td><input  name="pas" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="pas" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="pas" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="pas" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					
					  </tr>
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
            </div>	
<input type="hidden" name="tab-active"	value="shrtooladd2"> 			
	      <button  class="btn btn-primary" name="shrtooladd2" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-sm btn-default"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
		</form>			
</div>
<?php //end form tool2/?>
</div>

<?php //Begin form tool3/?>
<div class="col-md-12 tab-pane" id="tool2">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW's Questionnaire for Girls/Young Women in University</h5>
                <h5 class="box-title" style="text-align:centre;">GIRLS IN SCHOOL</h5>

<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women's Rights in Education and Leadership Project</p>

</div>

<div class="col-md-8 tab-pane" action="">
                <form method="post" action="">
				<div id="">
                      
                               
		           <label>Select Participant to Evaluate<span style="color:red"></span></label> 
                        <select class="form-control select2" name="participant_id" id="participant_id myselect" style="width:100%;" required>
                          <?php 
							$sqlp = mysqli_query($dbcon,"SELECT field_work.field_activity_id,field_work.training AS train, field_participants.training,
field_participants.participant_id,participants.participant_id,participants.surname,participants.firstname,participants.othername,participants.gender,participants.postal_address,participants.position,participants.residence_district
FROM field_work, field_participants, participants WHERE field_participants.participant_id = participants.participant_id
AND field_work.field_activity_id = field_participants.training AND field_participants.training =$training");
		                   
							  while ($listp=mysqli_fetch_array($sqlp))
							  {
							 ?>
							  <option value="<?php echo $participant_id=$listp['participant_id']; ?>" required><?php echo $myname=$listp['surname']." ".$listp['firstname']." ".$listp['othername']." , ".$listp['gender']." , ".$listp['residence_district']." , ".$listp['postal_address']." , ".$listp['position'];?>
							  </option>
							  
		               <?php } ?>
				      </select>
					
					  <?php 
					$sql="select training from field_work where field_activity_id=$training";
					$result = mysqli_query($dbcon,$sql);
					while($row = mysqli_fetch_array($result)) 
                   {
					      echo '<b style="margin-top:6px;color: #dc0303;"> Training Name:'.$row['training'].'</b>';
						  }
                    ?>
	</div>
				 <div id="">
                      <label>1.	Please describe what you would do if you received unwanted sexual advances while at the University :  <span style="color:red"></span></label>
				      <textarea class="form-control" name="advances" id="" placeholder="What would you do if you received unwanted sexual advances?"></textarea>
			       </div>
                    <div id="">
                      <label>2.	What is your view of the following: :  <span style="color:red"></span></label>
					  <table id="" class="table table-bordered table-hover table-responsive">
                    <thead>
                         <tr>							
						<th>Gender equality issue</th>
						<th>Strongly agree (4)</th>
						<th>Agree (3)</th>
						<th>Undecided (2)</th>
						<th>Disagree(1)</th>
						<th>Strongly disagree(0)</th>
						
                       </tr>
                    </thead>
                    <tbody>
				
                    <tr>
					   <td>1. Girls make good leaders</td>
					  <td><input  name="gleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls should not go into leadership.</td>
					  <td><input  name="gnleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gnleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gnleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gnleaders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gnleaders" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>	
                        <tr>					 
					  <td>3. Girls should not be sent to school because they are only good for marriage. </td>
					  <td><input  name="goodformarriage" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>	
                      <tr>					 
					  <td>4. Girls have a right to eduaction </td>
					  <td><input  name="righttoeduaction" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>					  
					  <td>5. There is zero tolerance for sexual harassment in our University. </td>
					  <td><input  name="ztolerance" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>6. Girls often say 'no' to SEX when they mean 'yes'.</td>
					  <td><input  name="notomen" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>7. Well-behaved girls do not get raped.</td>
					  <td><input  name="rape" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>8. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="harrased_dresscode" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>9.Our teachers treat both female and male students equally</td>
					  <td><input  name="teachers_treat" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>10.I will study and I will go to the university</td>
					  <td><input  name="university_view" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="university_view" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input name="university_view" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="university_view" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input name="university_view" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
				      
			       </div>	
            		<input type="hidden" name="tab-active"	value="shrtooladd3">  
	      <button  class="btn btn-primary" name="shrtooladd3" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-sm btn-default"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>
     		 
		</div>
</form>		
</div>
<?php //end form tool/3?>



<?php //Begin form tool4/?>
<div class="col-md-12 tab-pane" id="tool3">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW's Questionnaire for Girls/Young Women in University</h5>
				 <h5 class="box-title" style="text-align:centre;">GIRLS IN SCHOOL POST</h5>

<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women's Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 tab-pane" id="">
<form action="" method="post">
<div id="">
                      
                               
		           <label>Select Participant to Evaluate<span style="color:red"></span></label> 
                        <select class="form-control select2" name="participant_id" id="participant_id myselect" style="width:100%;" required>
                          <?php 
							$sqlp = mysqli_query($dbcon,"SELECT field_work.field_activity_id,field_work.training AS train, field_participants.training,
field_participants.participant_id,participants.participant_id,participants.surname,participants.firstname,participants.othername,participants.gender,participants.postal_address,participants.position,participants.residence_district
FROM field_work, field_participants, participants WHERE field_participants.participant_id = participants.participant_id
AND field_work.field_activity_id = field_participants.training AND field_participants.training =$training");
		                   
							  while ($listp=mysqli_fetch_array($sqlp))
							  {
							 ?>
							  <option value="<?php echo $participant_id=$listp['participant_id']; ?>" required><?php echo $myname=$listp['surname']." ".$listp['firstname']." ".$listp['othername']." , ".$listp['gender']." , ".$listp['residence_district']." , ".$listp['postal_address']." , ".$listp['position'];?>
							  </option>
							  
		               <?php } ?>
				      </select>
					
					  <?php 
					$sql="select training from field_work where field_activity_id=$training";
					$result = mysqli_query($dbcon,$sql);
					while($row = mysqli_fetch_array($result)) 
                   {
					      echo '<b style="margin-top:6px;color: #dc0303;"> Training Name:'.$row['training'].'</b>';
						  }
                    ?>
	</div>

				<div id="">
					  <label>1. Are you involved in any leadership role in your University? :  <span style="color:red">*</span></label>
					 
				    <label class="btn btn-sm btn-default" >Yes:
					 <input  name="leadership" id="" value="1" type="radio" ></label>
					 <label class="btn btn-sm btn-default" >NO:
					 <input  name="leadership" id="" value="1" type="radio" ></label>
                </div>
                   <div id="">
					 <label>2. If YES, please indicate which leadership role you are responsible for.:  <span style="color:red"></span></label> 
                      <input class="form-control" name="responsibilty" id="" value="" placeholder="Responsibilty Held"type="text">
					</div>
					<div id="">
					  <label>3.	If, NO, please give the reasons why you are not involved in leadership: </label>
                      <textarea class="form-control" name="leadership_not_just" id="leadership_not_just" placeholder="Reasons why you are not involved in leadership"><?php echo $leadership_not_just;?></textarea>
				   </div>
				   <div id="">
					  <label>4. Are you involved in any co-curicular activities at school?  <span style="color:red">*</span></label>
					 
				    <label class="btn btn-sm btn-default" >Yes:
					 <input  name="co-curicular_view" id="" value="1" type="radio"></label>
					 <label class="btn btn-sm btn-default" >NO:
					 <input  name="co-curicular_view" id="" value="1" type="radio"></label>
                </div>
				<p></p><p></p>
				<div id="">
					  <label>5.	If, Yes, Which co-curicular activities are you involved in?: </label>
					   <label class="btn btn-sm btn-default" >Football:
					 <input  name="co-curicular" id="" value="Football" type="radio"  ></label>
					 <label class="btn btn-sm btn-default" >Athletics:
					 <input  name="co-curicular" id="" value="Athletics" type="radio"></label>
					  <label class="btn btn-sm btn-default" >Net Ball:
					   <input  name="co-curicular" id="" value="Netball" type="radio" ></label>
					  <label class="btn btn-sm btn-default" >Volley Ball:
					 <input  name="co-curicular" id="" value="Volleyball" type="radio" ></label>
					 <label class="btn btn-sm btn-default" >Music Dance and Drama:
					 <input  name="co-curicular" id="" value="Music Dance and Drama" type="radio"></label>
					 <label>Others (Please Specify): </label>
					 <p></p>
					 <p></p>
                      <textarea class="form-control" name="other_acts" id="Other_acts" value="" placeholder="co-curicular activities"></textarea>
				   
                   </div>
				   	<div id="">
					  <label>6.	If, NO, please give the reasons why you are not co-curicular activities: </label>
                      <textarea class="form-control" name="why_not_coc" id="leadership_not_just" value="" placeholder=""></textarea>
				   </div>
				     <div id="">
					  <label> 7. Do you aspire to join a higher instution of line such as the Univerity? <span style="color:red">*</span></label>
					 <p></p><p></p>
				    <label class="btn btn-sm btn-default" >Yes:
					 <input  name="university" id="" value="1" type="radio"  ></label>
					 <label class="btn btn-sm btn-default" >NO:
					 <input  name="university" id="" value="1" type="radio" ></label>
                </div>
				 	<div id="">
					  <label>8.	If, Yes, why would like to join a higher institution of learning : </label>
                      <textarea class="form-control" name="why_univeristy" id="" value="" placeholder=""></textarea>
				   </div>
				
				 	<div id="">
					  <label>9.	If, NO, please give the reason why would not like to join a higher institution of learning : </label>
                      <textarea class="form-control" name="why_not_university" id="" value="" placeholder=""></textarea>
				   </div>
				
                    <div id="">
                      <label>10. Please describe what you would do if you received unwanted sexual advances while at school:  <span style="color:red"></span></label>
					 <textarea class="form-control" name="advances" id="" value="" placeholder=""></textarea>
				   </div>
					 <label>11.	What is your view of the following: :  <span style="color:red"></span></label>
					  <table id="" class="table table-bordered table-hover table-responsive">
                    <thead>
                         <tr>							
						<th>Gender equality issue</th>
						<th>Strongly agree (4)</th>
						<th>Agree (3)</th>
						<th>Undecided (2)</th>
						<th>Disagree(1)</th>
						<th>Strongly disagree(0)</th>
						
                       </tr>
                    </thead>
                    <tbody>
				
                    <tr>
					   <td>1. Girls make good leaders</td>
					  <td><input  name="gleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls should not go into leadership.</td>
					  <td><input  name="gnleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnlaeders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>	
                        <tr>					 
					  <td>3. Girls should not be sent to school because they are only good for marriage. </td>
					  <td><input  name="goodformarriage" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>	
                      <tr>					 
					  <td>4. Girls have a right to eduaction </td>
					  <td><input  name="righttoeduaction" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>					  
					  <td>5. There is zero tolerance for sexual harassment in our University. </td>
					  <td><input  name="ztolerance" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>6. Girls often say no to SEX when they mean yes.</td>
					  <td><input  name="notomen" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>7. Well-behaved girls do not get raped.</td>
					  <td><input  name="rape" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>8. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="harrased_dresscode" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrrased_dresscode" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>9.Our teachers treat both female and male students equally</td>
					  <td><input  name="teachers_treat" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>10.I will study and I will go to the university</td>
					  <td><input  name="university_view" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="university_view" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input name="university_view" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="university_view" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input name="university_view" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
				      
			 <input type="hidden" name="tab-active"	value="shrtooladd4">   	
            			  
	      <button  class="btn btn-primary" name="shrtooladd4" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-sm btn-default"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
	</form>  
   </div>	
   </div>
<?php //end form tool4/?>
<?php //Begin form tool5/?>
<div class="col-md-12 tab-pane" id="teachers">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW's Questionnaire for Girls/Young Women in School</h5>
				 <h5 class="box-title" style="text-align:centre;">TEACHERS</h5>

<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women's Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 tab-pane" id="">

<form action="" method="post">
<div id="">
                      
                               
		           <label>Select Participant to Evaluate<span style="color:red"></span></label> 
                        <select class="form-control select2" name="participant_id" id="participant_id myselect" style="width:100%;" required>
                          <?php 
							$sqlp = mysqli_query($dbcon,"SELECT field_work.field_activity_id,field_work.training AS train, field_participants.training,
field_participants.participant_id,participants.participant_id,participants.surname,participants.firstname,participants.othername,participants.gender,participants.postal_address,participants.position,participants.residence_district
FROM field_work, field_participants, participants WHERE field_participants.participant_id = participants.participant_id
AND field_work.field_activity_id = field_participants.training AND field_participants.training =$training");
		                   
							  while ($listp=mysqli_fetch_array($sqlp))
							  {
							 ?>
							  <option value="<?php echo $participant_id=$listp['participant_id']; ?>" required><?php echo $myname=$listp['surname']." ".$listp['firstname']." ".$listp['othername']." , ".$listp['gender']." , ".$listp['residence_district']." , ".$listp['postal_address']." , ".$listp['position'];?>
							  </option>
							  
		               <?php } ?>
				      </select>
					
					  <?php 
					$sql="select training from field_work where field_activity_id=$training";
					$result = mysqli_query($dbcon,$sql);
					while($row = mysqli_fetch_array($result)) 
                   {
					      echo '<b style="margin-top:6px;color: #dc0303;"> Training Name:'.$row['training'].'</b>';
				   }
                    ?>
	</div>
				    <div id="">
                      <label>1.	What mechanisms and/or structures does the school have to promote girls safety [from sexual and other violence]? <span style="color:red"></span></label>
				      <textarea class="form-control" name="mechanisms" id="" placeholder="What mechanisms and/or structures does the school have to promote girls safety [from sexual and other violence]?"></textarea>
			       </div>
				   <div id="">
                      <label>2.	What strategies does the school have in place to address violence against girls, including sexual abuse? <span style="color:red"></span></label>
				      <textarea class="form-control" name="strategies" id="Contact" placeholder="What mechanisms and/or structures does the school have to promote girls safety [from sexual and other violence]?"></textarea>
			       </div>
				   	<div id="">
                      <label>3.	What strategies do you use to promote girls' participation in the classroom? <span style="color:red"></span></label>
				      <textarea class="form-control" name="promote_gals" id="Contact" placeholder="What mechanisms and/or structures does the school have to promote girls safety [from sexual and other violence]?"></textarea>
			       </div>
                    <div id="">
                      <label>4.	What is your view of the following: <span style="color:red"></span></label>
					    <table id="" class="table table-bordered table-hover table-responsive">
                    <thead>
                         <tr>							
						<th>Gender equality issue</th>
						<th>Strongly agree (4)</th>
						<th>Agree (3)</th>
						<th>Undecided (2)</th>
						<th>Disagree(1)</th>
						<th>Strongly disagree(0)</th>
						
                       </tr>
                    </thead>
                    <tbody>
				
                    <tr>
					   <td>5. Girls make good leaders</td>
					  <td><input  name="gleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls should not go into leadership.</td>
					  <td><input  name="gnleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnlaeders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>	
                        <tr>					 
					  <td>3. Girls should not be sent to school because they are only good for marriage. </td>
					  <td><input  name="goodformarriage" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>	
                      <tr>					 
					  <td>4. Girls have a right to eduaction </td>
					  <td><input  name="righttoeduaction" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>					  
					  <td>5. There is zero tolerance for sexual harassment in our school. </td>
					  <td><input  name="ztolerance" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>6. Girls often say 'no' to SEX when they mean 'yes'.</td>
					  <td><input  name="notomen" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>7. Well-behaved girls do not get raped.</td>
					  <td><input  name="rape" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>8. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="harrased_dresscode" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>9. Teachers treat both female and male students equally</td>
					  <td><input  name="teachers_treat" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
            </div>	
			<div id="">
                      <label>5.	What is your level of understanding of the following?  <span style="color:red"></span></label>
					  <table id="" class="table table-bordered table-hover table-responsive">
                    <thead>
                         <tr>							
						<th></th>
						<th>High (3)</th>
						<th>Medium (2)</th>
						<th>Low (1)</th>
						<th>None (0)</th>
						
						
                       </tr>
                    </thead>
                    <tbody>
				
                    <tr>
					   <td>1. Gender issues</td>
					  <td><input  name="q61" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					     </tr>
                     <tr>					 
					  <td>2. Girls rights.</td>
					  <td><input  name="q62" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					    </tr>
					   <tr>					 
					  <td>3. Girls rigts to eduaction. </td>
					  <td><input  name="q63" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Violence against girls.</td>
					  <td><input  name="q64" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					   </tr>
					   <tr>					 
					  <td>5. Sexual ad gender based Violence.</td>
					  <td><input  name="q65" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Sexual and reproductive health and rights</td>
					  <td><input  name="q66" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
            </div>		
           <input type="hidden" name="tab-active"	value="shrtooladd5"> 			
	      <button  class="btn btn-primary" name="shrtooladd5" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-sm btn-default"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
	</form>			
</div>
<?php //end form tool5/?>
</form>
</div>
<?php //Begin form tool5/?>
<div class="col-md-12 tab-pane" id="post_teachers">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW's Questionnaire for Girls/Young Women in University</h5>
				 <h5 class="box-title" style="text-align:centre;">POST TEACHERS</h5>

<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women's Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 tab-pane" id="">

<form action="" method="post">
<div id="">
                      
                               
		           <label>Select Participant to Evaluate<span style="color:red"></span></label> 
                        <select class="form-control select2" name="participant_id" id="participant_id myselect" style="width:100%;" required>
                          <?php 
							$sqlp = mysqli_query($dbcon,"SELECT field_work.field_activity_id,field_work.training AS train, field_participants.training,
field_participants.participant_id,participants.participant_id,participants.surname,participants.firstname,participants.othername,participants.gender,participants.postal_address,participants.position,participants.residence_district
FROM field_work, field_participants, participants WHERE field_participants.participant_id = participants.participant_id
AND field_work.field_activity_id = field_participants.training AND field_participants.training =$training");
		                   
							  while ($listp=mysqli_fetch_array($sqlp))
							  {
							 ?>
							  <option value="<?php echo $participant_id=$listp['participant_id']; ?>" required><?php echo $myname=$listp['surname']." ".$listp['firstname']." ".$listp['othername']." , ".$listp['gender']." , ".$listp['residence_district']." , ".$listp['postal_address']." , ".$listp['position'];?>
							  </option>
							  
		               <?php } ?>
				      </select>
					
					  <?php 
					$sql="select training from field_work where field_activity_id=$training";
					$result = mysqli_query($dbcon,$sql);
					while($row = mysqli_fetch_array($result)) 
                   {
					    echo '<b style="margin-top:6px;color: #dc0303;"> Training Name:'.$row['training'].'</b>';
				   }
                    ?>
	</div>
				   
                    <div id="">
                      <label>1.	What is your view of the following: :  <span style="color:red"></span></label>
					    <table id="" class="table table-bordered table-hover table-responsive">
                    <thead>
                         <tr>							
						<th>Gender equality issue</th>
						<th>Strongly agree (4)</th>
						<th>Agree (3)</th>
						<th>Undecided (2)</th>
						<th>Disagree(1)</th>
						<th>Strongly disagree(0)</th>
						
                       </tr>
                    </thead>
                    <tbody>
				
                    <tr>
					   <td>2. Girls make good leaders</td>
					  <td><input  name="gleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls should not go into leadership.</td>
					  <td><input  name="gnleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnlaeders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>	
                        <tr>					 
					  <td>3. Girls should not be sent to school because they are only good for marriage. </td>
					  <td><input  name="goodformarriage" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="goodformarriage" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>	
                      <tr>					 
					  <td>4. Girls have a right to eduaction </td>
					  <td><input  name="righttoeduaction" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="righttoeduaction" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>					  
					  <td>5. There is zero tolerance for sexual harassment in our school. </td>
					  <td><input  name="ztolerance" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>6. Girls often say 'no' to SEX when they mean 'yes'.</td>
					  <td><input  name="notomen" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>7. Well-behaved girls do not get raped.</td>
					  <td><input  name="rape" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>8. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="harrased_dresscode" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>9. Teachers treat both female and male students equally</td>
					  <td><input  name="teachers_treat" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="teachers_treat" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
            </div>	
			<div id="">
                      <label>2.	What is your level of understanding of the following?  <span style="color:red"></span></label>
					  <table id="" class="table table-bordered table-hover table-responsive">
                    <thead>
                         <tr>							
						<th></th>
						<th>High (3)</th>
						<th>Medium (2)</th>
						<th>Low (1)</th>
						<th>None (0)</th>
						
						
                       </tr>
                    </thead>
                    <tbody>
				
                    <tr>
					   <td>1. Gender issues</td>
					  <td><input  name="q61" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					     </tr>
                     <tr>					 
					  <td>2. Girls / women's rights.</td>
					  <td><input  name="q62" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					    </tr>
					   <tr>					 
					  <td>3. Girls rigts to eduaction. </td>
					  <td><input  name="q63" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Violence against girls.</td>
					  <td><input  name="q64" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					   </tr>
					   <tr>					 
					  <td>5. Sexual ad gender based Violence.</td>
					  <td><input  name="q65" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Sexual and reproductive health and rights</td>
					  <td><input  name="q66" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
            </div>		
           <input type="hidden" name="tab-active"	value="shrtooladd6"> 			
	      <button  class="btn btn-primary" name="shrtooladd6" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-sm btn-default"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
	</form>			
</div>
<?php //end form tool5/?>
</form>
</div>
</div>
</div>


                     
                     

