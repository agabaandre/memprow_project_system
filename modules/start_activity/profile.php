			
<?php 
include("db_connector/mysqli_conn.php");

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
			  <li class="active"><a href="#profiling" data-toggle="tab"> PROFLING TOOL</a></li>
           </ul>
         </div>
<div class="tab-content">


<?php
			
//Profile
					if(isset($_POST['profiling'])) {
					              
							$training=($_POST['training']);
							$participant_id=mysqli_real_escape_string($dbcon,$_POST['participant_id']);
							$homedistrict=mysqli_real_escape_string($dbcon,$_POST['homedistrict']);
							$entry_id="$training"."$participant_id";
							$knowledge_b4=mysqli_real_escape_string($dbcon,$_POST['knowledge_b4']);
							$when_joined=mysqli_real_escape_string($dbcon,$_POST['when_joined']);
							$change_exp=mysqli_real_escape_string($dbcon,$_POST['change_exp']);
							$involved_leader=mysqli_real_escape_string($dbcon,$_POST['involved_leader']);
							$engagement=mysqli_real_escape_string($dbcon,$_POST['engagement']);
							$use_of_knowledge=mysqli_real_escape_string($dbcon,$_POST['use_of_knowledge']);
							$reason_why_no=mysqli_real_escape_string($dbcon,$_POST['reason_why_no']);
							$advice=mysqli_real_escape_string($dbcon,$_POST['advice']);
							$recommend_any=mysqli_real_escape_string($dbcon,$_POST['recommend_any']);
							$story=($_POST['story']);
							$story_bio=mysqli_real_escape_string($dbcon,$_POST['story_bio']);
							$use_story=mysqli_real_escape_string($dbcon,$_POST['use_story']);
							$consent_to=mysqli_real_escape_string($dbcon,$_POST['consent_to']);
							$video=mysqli_real_escape_string($dbcon,$_POST['video']);
							
							
							
	

 if ($act=mysqli_query($dbcon,"INSERT INTO me_profiling (`participant_id`, `entry_id`, `homedistrict`,`training_id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `sc`, `d1`, `d2`, `d3`, `d4`)
	 VALUES ('$participant_id', '$entry_id', '$homedistrict','$training', '$knowledge_b4', '$when_joined', '$change_exp', '$involved_leader', '$engagement',
 '$use_of_knowledge', '$reason_why_no', '$advice', '$recommend_any', '$story', '$story_bio', '$use_story', '$consent_to', '$video')")){
echo $msg='<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Participant profile on' .$training_name. ' saved Successfully</strong>
                   </div>';
     					
					}
					else{
						echo $msg='<div class="alert alert-warning alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Participant Profile on ' .$training_name. '  saving Failed</strong>
                   </div>';
					}
					
					}
?>

<div class="col-md-12 tab-pane active" id="profiling">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW PROFILING TEMPLATE</h5>
				 <h5 class="box-title" style="text-align:centre;"></h5>

<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women’s Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 tab-pane" id="">

<form action="" method="post">
<div id="">
                      
                           <label>Select Training<span style="color:red"></span></label> 
                        <select class="form-control select2" name="training" id="training_id myselect" style="width:100%;" required>
						<option value="0">None</option>
                          <?php 
							$sqlp = mysqli_query($dbcon,"SELECT field_activity_id, training from field_work");
		                   
							  while ($listp=mysqli_fetch_array($sqlp))
							  {
							 ?>
							  <option value="<?php echo $training=$listp['field_activity_id']; ?>" required><?php echo $myname=$listp['training'];?>
							  </option>
							  
		               <?php } ?>
				      </select>           
		           <label>Select Participant to Profile<span style="color:red"></span></label> 
                        <select class="form-control select2" name="participant_id" id="participant_id myselect" style="width:100%;" required>
                          <?php 
							$sqlp = mysqli_query($dbcon,"SELECT participants.participant_id,participants.surname,participants.firstname,participants.othername,participants.gender,participants.postal_address,participants.position,participants.residence_district
FROM participants");
		                   
							  while ($listp=mysqli_fetch_array($sqlp))
							  {
							 ?>
							  <option value="<?php echo $participant_id=$listp['participant_id']; ?>" required><?php echo $myname=$listp['surname']." ".$listp['firstname']." ".$listp['othername']." , ".$listp['gender']." , ".$listp['residence_district']." , ".$listp['postal_address']." , ".$listp['position'];?>
							  </option>
							  
		               <?php } ?>
				      </select>
					
					

	</div>           <p style="font-weight:bold;margin-top:10px;"> SECTION A</P>
	               <label>Home District:  <span style="color:red">*</span></label>
                    <select style="width:100%;" name="homedistrict" class="form-control select2" id="">
                            <?php 
							$sel_district= mysqli_real_escape_string($dbcon,$_POST['district']); 
							$sql = mysql_query("SELECT * FROM district");
		                      $i=0;
							  while ($list=mysql_fetch_array($sql))
							  {
							  $i++; ?>
							  <option value="<?php echo $myp=$list['name']; ?>"<?php if($sel_district==$myp){ echo "selected"; } ?>><?php  echo $list['name']; ?>
							  </option>
		               <?php } ?>
		           </select>
				    <div id="">
                      <label>Section A content is already under participant details. Just select the participant from form field above.<span style="color:red"></span></label>
				       </div>
				   <p style="font-weight:bold;margin-top:10px;"> SECTION B </P>
				   <div id="">
                      <label>1.	Please describe your life in terms of knowledge and skills before you joined MEMPROW? <span style="color:red"></span></label>
				      <textarea class="form-control" name="knowledge_b4" placeholder=""></textarea>
			       </div>
				   	<div id="">
                      <label>2.	When and how did you join MEMPROW? (If MEMPROW met you at a school/university please mention the school and year.<span style="color:red"></span></label>
				      <textarea class="form-control" name="when_joined"  placeholder=""></textarea>
			       </div>
				   	<div id="">
                      <label>3.What change have you experienced after becoming a member of the MEMPROW girl’s Network?<span style="color:red"></span></label>
				      <textarea class="form-control" name="change_exp"  placeholder=""></textarea>
			       </div>
				   	<div id="">
                      <label>4.	Are you involved in any form of leadership? If Yes, share the experience and how MEMPROW has contributed to this.<span style="color:red"></span></label>
				      <textarea class="form-control" name="involved_leader" id="Contact" placeholder=""></textarea>
			       </div>
				   <div id="">
					  <label>5. Do you still engage in MEMPROW activities? :  <span style="color:red">*</span></label>
					 <p></p><p></p>
				    <label class="btn btn-sm btn-default" >Yes:
					 <input  name="engagement" id="" value="YES" type="radio"></label>
					 <label class="btn btn-sm btn-default" >NO:
					 <input  name="engagement" id="" value="NO" type="radio" ></label>
                </div>
				   	<div id="">
                      <label>6.	If Yes, how are you using the knowledge/skills that you acquired from MEMPROW? Self/Personal development:.<span style="color:red"></span></label>
				      <textarea class="form-control" name="use_of_knowledge" id="Contact" placeholder="Personal Level/ Development...................Family Level........Community Level"></textarea>
			       </div>
				   	<div id="">
                      <label>7.	If No; Please explain why you are no longer able to participate in MEMPROW Programme activities.<span style="color:red"></span></label>
				      <textarea class="form-control" name="reason_why_no" id="Contact" placeholder="What mechanisms and/or structures does the school have to promote girls safety [from sexual and other violence]?"></textarea>
			       </div>	
				   <div id="">
                      <label>8.	Suggest ways that MEMPROW can adopt to keep young women actively involved in her Programme activities.<span style="color:red"></span></label>
				      <textarea class="form-control" name="advice" id="Contact" placeholder="What mechanisms and/or structures does the school have to promote girls safety [from sexual and other violence]?"></textarea>
			       </div>
				   <div id="">
                      <label>9.	Would you recommend anyone to join MEMPROW PROGRAMME activities?<span style="color:red"></span></label>
				      <textarea class="form-control" name="recommend_any" id="Contact" placeholder="What mechanisms and/or structures does the school have to promote girls safety [from sexual and other violence]?"></textarea>
			       </div>
				   <p style="font-weight:bold;margin-top:10px;">SECTION C</p>
				   <div id="">
                      <label>PLEASE TELL A STORY ABOUT THE MOST SIGNIFICANT CHANGE THAT HAPPENED TO YOU AS A RESULT OF MEMPROW’S 
					  INTERVENTION.(PROBES TO USE: How was your situation before?why the change happened? what is it like now?)<span style="color:red"></span></label>
				      <textarea class="form-control" name="story" rows="20" id="editor1" placeholder=""></textarea>
			       </div>
				   <p style="font-weight:bold; margin-top:10px;">SECTION D: CONSENT</p>
                    <div id="">
                      <label>Consent: We may like to use your stories for reporting to our funders, or sharing with 
					  other people in other organizations. <span style="color:red"></span></label>
					   <div id="">
					  <label>1. Want to have your biography on the story.:  <span style="color:red">*</span></label>
					 <p></p><p></p>
				    <label class="btn btn-sm btn-default" >Yes:
					 <input  name="story_bio" id="" value="YES" type="radio" ></label>
					 <label class="btn btn-sm btn-default" >NO:
					 <input  name="story_bio" id="" value="NO" type="radio" ></label>
                </div>
				 <div id="">
					  <label>Consent to us using your story for publication. :  <span style="color:red">*</span></label>
					 <p></p><p></p>
				    <label class="btn btn-sm btn-default" >Yes:
					 <input  name="use_story" id="" value="YES" type="radio"  ></label>
					 <label class="btn btn-sm btn-default" >NO:
					 <input  name="use_story" id="" value="NO" type="radio"  ></label>
                </div>
				 <div id="">
					  <label>Consent to have your photograph taken and possibly used in publication. <span style="color:red">*</span></label>
					 <p></p><p></p>
				    <label class="btn btn-sm btn-default" >Yes:
					 <input  name="consent_to" id="" value="YES" type="radio"  ></label>
					 <label class="btn btn-sm btn-default" >NO:
					 <input  name="consent_to" id="" value="NO" type="radio"  ></label>
                </div> <div id="">
			    <label>Consent to have your story profiled on video<span style="color:red">*</span></label>
					 <p></p><p></p>
				    <label class="btn btn-sm btn-default" >Yes:
					 <input  name="video" id="" value="YES" type="radio"  ></label>
					 <label class="btn btn-sm btn-default" >NO:
					 <input  name="video" id="" value="NO" type="radio"  ></label>
					 <p></p><p></p>
                </div>
					    
            </div>	
           <input type="hidden" name="tab-active"	value="profiling"> 			
	      <button  class="btn btn-primary" name="profiling" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-sm btn-default"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
	</form>			
</div>
<?php //profiling Tool/?>
</form>
</div>
</form>
</div>
</div>

          

  
         
              
         <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
    $(function(){
      // turn the element to select2 select style
      $('.select2').select2();
    });
  </script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>   
    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
