			

 
<!-- date picker ----------------------------------------------------->

<script>
$.fn.datepicker.defaults.format = "yyyy/mm/dd";
$('.datepicker').datepicker({
});

</script>	


<div class="col-md-12">
	<div id="">
                      <label>Select Participant:  <span style="color:red"></span></label> 
                        <select class="form-control select2" name="activity_id" id="activity_id myselect" style="width:100%;" required>
                          <?php 
							$sql2 = mysqli_query($dbcon,"SELECT DISTINCT(*) FROM field_work,field_participants,participants WHERE field_participants.participant_id=participants.participant_id");
		                      $i2=0;
							  while ($list2=mysqli_fetch_array($sql2))
							  {
							  $i2++; ?>
							  <option value="<?php echo $list2['training']; ?>"><?php  echo $list2['training_name']; ?>
							  </option>
		               <?php } ?>
				      </select>
	</div>
          <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
			  <li class="active"><a href="#srhrtool" data-toggle="tab">SRHR TOOL</a></li>
			  <li><a href="#shrtool1" data-toggle="tab">SRHR TOOL POST TRAINING</a></li>
			  <li><a href="#tool2" data-toggle="tab">TOOL 1-GIRLS</a></li>
              <li><a href="#tool3" data-toggle="tab">TOOL 2-GIRLS</a></li>
              <li><a href="#teachers" data-toggle="tab">TEACHERS</a></li>
           </ul>
         </div>
<div class="tab-content">
<?php //Begin form tool1/?>
<div class="col-md-12 active tab-pane" id="srhrtool">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW’s Questionnaire for Girls/Young Women in University</h5>
<h5 class="box-title" style="text-align:centre;">SRHR TOOL</h5>
<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women’s Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 active tab-pane" id="">
<?php
			
//TOOL1
					if(isset($_POST['shrtool'])) {
					              
							$training=mysqli_real_escape_string($dbcon,$_POST['training']);
							$participant_id=mysqli_real_escape_string($dbcon,$_POST['participant_id']);
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
							
							
	

 if ($act=mysqli_query($dbcon,"INSERT INTO mef1 VALUES ($participant_id, NULL, '$training','$q1', '$q2', '$q3', '$q4', '$q51',
 '$q52', '$q53','$q51','$q52', '$q53''$q54','$q55', '$q56','$q61','$q62', '$q63','$q64','$q65', '$q66','$q67')")){
echo $msg='<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong><?php echo "Evaluation on". $training; ?>Saved Successfully</strong>
                   </div>';
     					
					}}
?>
<form action="" method="post">
				<div id="">
					  <label>1. Are you involved in any leadership role in your University? :  <span style="color:red">*</span></label>
					 
				    <label class="btn btn-success" >Yes:
					 <input  name="q1" id="" value="1" type="radio"  ></label>
					 <label class="btn btn-danger" >NO:
					 <input  name="q1" id="" value="0" type="radio"  checked></label>
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
						<th>Strongly agree</th>
						<th>Agree</th>
						<th>Undecided</th>
						<th>Disagree</th>
						<th>Strongly disagree</th>
						
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
					  <td>4. Girls often say ‘no’ to SEX when they mean ‘yes’.</td>
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
						<th>Gender equality issue</th>
						<th>Strongly agree 5</th>
						<th>Agree 4</th>
						<th>Undecided 3</th>
						<th>Disagree 2</th>
						<th>Strongly disagree 1</th>
						
                       </tr>
                    </thead>
                    <tbody>
				
                    <tr>
					   <td>1. Gender issues</td>
					  <td><input  name="q61" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="q61" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls / women's rights.</td>
					  <td><input  name="q62" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q62" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. Girls rigts to eduaction. </td>
					  <td><input  name="q63" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q63" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Violence against girls.</td>
					  <td><input  name="q64" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q64" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Sexual ad gender based Violence.</td>
					  <td><input  name="q65" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q65" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Sexual and reproductive health and rights</td>
					  <td><input  name="q66" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q66" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>7. Patriarchy and Sexuality</td>
					  <td><input  name="q67" id="" value="5" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q67" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q67" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q67" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="q67" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
            </div>			  
	      <button  class="btn btn-primary" name="shrtool" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
		</form>			
</div>
<?php //end form tool1/?>


</div>
<?php //Begin form tool2/?>
<div class="col-md-12 active tab-pane" id="shrtool1">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW’s Questionnaire for Girls/Young Women in University</h5>
               <h5 class="box-title" style="text-align:centre;">SRHR POST TRAINING TOOL</h5>
<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women’s Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 active tab-pane" id="">
<form name="" id="data_form" method="post" action="">
				
				    <div id="">
                      <label>1.	Please describe what you would do if you received unwanted sexual advances while at the University :  <span style="color:red"></span></label>
				      <textarea class="form-control" name="Contact" id="Contact" placeholder="What would you do if you received unwanted sexual advances?"></textarea>
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
					   <td>a. Girls make good leaders</td>
					  <td><input  name="gleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gleaders" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>b. Girls should not go into leadership.</td>
					  <td><input  name="gnleaders" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnlaeders" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="gnleaders" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>c. There is zero tolerance for sexual harassment in our University. </td>
					  <td><input  name="ztolerance" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>d. Girls often say ‘no’ to SEX when they mean ‘yes’.</td>
					  <td><input  name="notomen" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="notomen" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>e. Well-behaved girls do not get raped.</td>
					  <td><input  name="rape" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="rape" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>f. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="harrased_dresscode" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrrased_dresscode" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
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
						<th>High</th>
						<th>Medium</th>
						<th>Low</th>
						<th>None</th>
						
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
					  <td>c. Girls rigts to eduaction. </td>
					  <td><input  name="eduaction" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="eduaction" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="eduaction" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="eduaction" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
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
	      <button  class="btn btn-primary" name="name" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
		</form>			
</div>
<?php //end form tool2/?>
</div>

<?php //Begin form tool3/?>
<div class="col-md-12 active tab-pane" id="tool2">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW’s Questionnaire for Girls/Young Women in University</h5>
                <h5 class="box-title" style="text-align:centre;">GIRLS IN SCHOOL</h5>

<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women’s Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 active tab-pane" action="">
                <form method="post" action="">
				 <div id="">
                      <label>1.	Please describe what you would do if you received unwanted sexual advances while at the University :  <span style="color:red"></span></label>
				      <textarea class="form-control" name="Contact" id="Contact" placeholder="What would you do if you received unwanted sexual advances?"></textarea>
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
					  <td>6. Girls often say ‘no’ to SEX when they mean ‘yes’.</td>
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
					  <td><input  name="harrased_dresscode" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrrased_dresscode" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
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
            			  
	      <button  class="btn btn-primary" name="name" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>
     </form>		 
		</div>			
</div>
<?php //end form tool/3?>



<?php //Begin form tool4/?>
<div class="col-md-12 active tab-pane" id="tool3">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW’s Questionnaire for Girls/Young Women in University</h5>
				 <h5 class="box-title" style="text-align:centre;">GIRLS IN SCHOOL POST</h5>

<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women’s Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 active tab-pane" id="">
<form action="" method="post">
				<div id="">
					  <label>1. Are you involved in any leadership role in your University? :  <span style="color:red">*</span></label>
					 
				    <label class="btn btn-success" >Yes:
					 <input  name="leadership" id="" value="1" type="radio"  ></label>
					 <label class="btn btn-danger" >NO:
					 <input  name="leadership" id="" value="1" type="radio"  checked></label>
                </div>
                   <div id="">
					 <label>2. If YES, please indicate which leadership role you are responsible for.:  <span style="color:red"></span></label> 
                      <input class="form-control" name="responsibilty" id="" value="<?php echo $responsibilty;?>" placeholder="Responsibilty Held"type="text">
					</div>
					<div id="">
					  <label>3.	If, NO, please give the reasons why you are not involved in leadership: </label>
                      <input class="form-control" name="leadership_not_just" id="leadership_not_just" value="<?php echo $oname;?>" placeholder="Reasons why you are not involved in leadership" type="text">
				   </div>
				   <div id="">
					  <label>4. Are you involved in any co-curicular activities at school?  <span style="color:red">*</span></label>
					 
				    <label class="btn btn-success" >Yes:
					 <input  name="co-curicular" id="" value="1" type="radio"  ></label>
					 <label class="btn btn-danger" >NO:
					 <input  name="co-curicular" id="" value="1" type="radio"  checked></label>
                </div>
				<div id="">
					  <label>5.	If, Yes, Which co-curicular activities are you involved in?: </label>
					   <label class="btn btn-success" >Football:
					 <input  name="co-curicular" id="" value="football" type="radio"  ></label>
					 <label class="btn btn-danger" >Athletics:
					 <input  name="co-curicular" id="" value="athletics" type="radio"  checked></label>
					  <label class="btn btn-success" >Net Ball:
					   <input  name="co-curicular" id="" value="netball" type="radio"  checked></label>
					  <label class="btn btn-success" >Volley Ball:
					 <input  name="co-curicular" id="" value="volleyball" type="radio"  ></label>
					 <label class="btn btn-danger" >Music Dance and Drama:
					 <input  name="co-curicular" id="" value="mdd" type="radio"  checked></label>
					 <label>Others (Please Specify): </label>
                      <input class="form-control" name="leadership_not_just" id="leadership_not_just" value="<?php echo $oname;?>" placeholder="Reasons why you are not involved in leadership" type="text">
				   
                   </div>
				   	<div id="">
					  <label>5.	If, NO, please give the reasons why you are not co-curicular activities: </label>
                      <input class="form-control" name="leadership_not_just" id="leadership_not_just" value="<?php echo $oname;?>" placeholder="" type="text">
				   </div>
				    <div id="">
                      <label>6.	Please describe what you would do if you received unwanted sexual advances while at the University :  <span style="color:red"></span></label>
				      <textarea class="form-control" name="Contact" id="Contact" placeholder="What would you do if you received unwanted sexual advances?"></textarea>
			       </div>
				     <div id="">
					  <label> 7. Do you aspire to join a higher instution of line such as the Univerity? <span style="color:red">*</span></label>
					 
				    <label class="btn btn-success" >Yes:
					 <input  name="co-curicular" id="" value="1" type="radio"  ></label>
					 <label class="btn btn-danger" >NO:
					 <input  name="co-curicular" id="" value="1" type="radio"  checked></label>
                </div>
				 	<div id="">
					  <label>8.	If, Yes, why would like to join a higher institution of learning : </label>
                      <input class="form-control" name="leadership_not_just" id="leadership_not_just" value="<?php echo $oname;?>" placeholder="" type="text">
				   </div>
				   </div>
				 	<div id="">
					  <label>9.	If, NO, please give the reason why would not like to join a higher institution of learning : </label>
                      <input class="form-control" name="leadership_not_just" id="leadership_not_just" value="<?php echo $oname;?>" placeholder="" type="text">
				   </div>
				   <div id="">
					  <label>10. If, NO, please give the reason why would not like to join a higher institution of learning : </label>
                      <input class="form-control" name="leadership_not_just" id="leadership_not_just" value="<?php echo $oname;?>" placeholder="" type="text">
				   </div>
				
                    <div id="">
                      <label>11. Please describe what you would do if you received unwanted sexual advances while at school:  <span style="color:red"></span></label>
					 <input class="form-control" name="leadership_not_just" id="leadership_not_just" value="<?php echo $oname;?>" placeholder="" type="text">
				   </div>
					 <label>12.	What is your view of the following: :  <span style="color:red"></span></label>
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
					  <td>6. Girls often say ‘no’ to SEX when they mean ‘yes’.</td>
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
					  <td><input  name="harrased_dresscode" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrrased_dresscode" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
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
				      
			    	
            			  
	      <button  class="btn btn-primary" name="name" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
	</form>  
    		
   </div>
<?php //end form tool4/?>
<?php //Begin form tool5/?>
<div class="col-md-12 active tab-pane" id="teachers">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW’s Questionnaire for Girls/Young Women in University</h5>
				 <h5 class="box-title" style="text-align:centre;">TEACHERS</h5>

<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women’s Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 active tab-pane" id="">
<form action="" method="post">
				    <div id="">
                      <label>1.	What mechanisms and/or structures does the school have to promote girls safety [from sexual and other violence]? <span style="color:red"></span></label>
				      <textarea class="form-control" name="Contact" id="Contact" placeholder="What mechanisms and/or structures does the school have to promote girls safety [from sexual and other violence]?"></textarea>
			       </div>
				   <div id="">
                      <label>2.	What strategies does the school have in place to address violence against girls, including sexual abuse? <span style="color:red"></span></label>
				      <textarea class="form-control" name="Contact" id="Contact" placeholder="What mechanisms and/or structures does the school have to promote girls safety [from sexual and other violence]?"></textarea>
			       </div>
				   	<div id="">
                      <label>3.	What strategies do you use to promote girls’ participation in the classroom? <span style="color:red"></span></label>
				      <textarea class="form-control" name="Contact" id="Contact" placeholder="What mechanisms and/or structures does the school have to promote girls safety [from sexual and other violence]?"></textarea>
			       </div>
                    <div id="">
                      <label>5.	What is your view of the following: :  <span style="color:red"></span></label>
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
					  <td>5. There is zero tolerance for sexual harassment in our school. </td>
					  <td><input  name="ztolerance" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="ztolerance" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>6. Girls often say ‘no’ to SEX when they mean ‘yes’.</td>
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
					  <td>9. Teachers treat both female and male students equally</td>
					  <td><input  name="harrased_dresscode" id="" value="4" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="3" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="2" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrased_dresscode" id="" value="1" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  <td><input  name="harrrased_dresscode" id="" value="0" type="radio"  <?php if ($value=='value'){ echo 'checked';}?>></td>
					  </tr>
					
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
            </div>			  
	      <button  class="btn btn-primary" name="name" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
					
</div>
<?php //end form tool5/?>
</form>
</div>
</div>
</div>


                     
                     

