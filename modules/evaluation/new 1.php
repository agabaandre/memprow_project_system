<?php 
include("db_connector/mysqli_conn.php");
$training=mysqli_real_escape_string($dbcon,$_GET['training']);
?>		

 
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
							$sql2 = mysqli_query($dbcon,"SELECT * FROM field_participants WHERE training='$training'");
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
			      
			    <form name="" id="data_form" method="post" action="">
			 
				
			<?php
					//Gump is libarary for Validatoin
					
					if(isset($_POST['name'])){
					$_POST = $gump->sanitize($_POST);
					$gump->validation_rules(array(
					
						'Surname'=>'required|max_len,60|min_len,1',
						'Firstname' =>'required|max_len,50|min_len,3',
						'Contact'     =>'max_len,15|min_len,0'
					));
				
					$gump->filter_rules(array(
						'Surname'    	  => 'trim|sanitize_string|mysql_escape',
						'Firstname'     => 'trim|sanitize_string|mysql_escape',
						'Contact'    => 'trim|sanitize_string|mysql_escape'
						
						
					));
				
					$validated_data = $gump->run($_POST);
					$Surname 		    = " ";
					$Firstname 	        = " ";
					$Contact	        = " ";
											
										

					if($validated_data === false) {
							echo $gump->get_readable_errors(true);
					} else {
						//t stop SQL INJECTION
							$emp_id=mysql_real_escape_string($_POST['emp_id']);
							$nin=mysql_real_escape_string($_POST['nin']);
							$Surname=mysql_real_escape_string($_POST['Surname']);
							$Firstname=mysql_real_escape_string($_POST['Firstname']);
							$oname=mysql_real_escape_string($_POST['oname']);
							$Contact=mysql_real_escape_string($_POST['Contact']);
							$position=mysql_real_escape_string($_POST['position']);
							$department=mysql_real_escape_string($_POST['department']);
							$district=mysql_real_escape_string($_POST['district']);
							$facility=mysql_real_escape_string($_POST['facility']);
							$ihris_id=mysql_real_escape_string($_POST['ihris_id']);
							$ihris_id_final=$ihris_id;
							
				
						?>
	
                     <?php
                             
				
			if($db->query("insert into employee_details values('$emp_id',NULL,'$ihris_id_final','$nin','$Surname','$Firstname','$oname','$Contact','$position','$department','$district','$facility', '1')"))
			{
             $msg="$Surname $Firstname has been Successfully Added" ;
			
                        }
			else{
			 $msg="$Surname $Firstname has Adding Failed" ;
			 
			
			}
			echo'<div class="alert alert-success alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>'.$msg.'</strong>
                  </div>';
			
			}
			
							
							}
						
		?>
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
                      <label>4.	Please describe what you would do if you received unwanted sexual advances while at the University :  <span style="color:red"></span></label>
				      <textarea class="form-control" name="Contact" id="Contact" placeholder="What would you do if you received unwanted sexual advances?"></textarea>
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
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls should not go into leadership.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. There is zero tolerance for sexual harassment in our University. </td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Girls often say ‘no’ to SEX when they mean ‘yes’.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Well-behaved girls do not get raped.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
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
					   <td>1. Gender issues</td>
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls / women's rights.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. Girls rigts to eduaction. </td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Violence against girls.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Sexual ad gender based Violence.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Sexual and reproductive health and rights</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>7. Patriarchy and Sexuality</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
            </div>			  
	      <button  class="btn btn-primary" name="name" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
		<form/>			
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
                      <label>4.	Please describe what you would do if you received unwanted sexual advances while at the University :  <span style="color:red"></span></label>
				      <textarea class="form-control" name="Contact" id="Contact" placeholder="What would you do if you received unwanted sexual advances?"></textarea>
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
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls should not go into leadership.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. There is zero tolerance for sexual harassment in our University. </td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Girls often say ‘no’ to SEX when they mean ‘yes’.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Well-behaved girls do not get raped.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
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
					   <td>1. Gender issues</td>
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls / women's rights.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. Girls rigts to eduaction. </td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Violence against girls.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Sexual ad gender based Violence.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Sexual and reproductive health and rights</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>7. Patriarchy and Sexuality</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
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
	
<div class="col-md-8 active tab-pane" id="">
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
                      <label>4.	Please describe what you would do if you received unwanted sexual advances while at the University :  <span style="color:red"></span></label>
				      <textarea class="form-control" name="Contact" id="Contact" placeholder="What would you do if you received unwanted sexual advances?"></textarea>
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
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls should not go into leadership.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. There is zero tolerance for sexual harassment in our University. </td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Girls often say ‘no’ to SEX when they mean ‘yes’.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Well-behaved girls do not get raped.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
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
					   <td>1. Gender issues</td>
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls / women's rights.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. Girls rigts to eduaction. </td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Violence against girls.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Sexual ad gender based Violence.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Sexual and reproductive health and rights</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>7. Patriarchy and Sexuality</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
            </div>			  
	      <button  class="btn btn-primary" name="name" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
					
</div>
<?php //end form tool/3?>
</div>


<?php //Begin form tool4/?>
<div class="col-md-12 active tab-pane" id="tool3">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW’s Questionnaire for Girls/Young Women in University</h5>
				 <h5 class="box-title" style="text-align:centre;">GIRLS IN SCHOOL POST</h5>

<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women’s Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 active tab-pane" id="">
				
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
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls should not go into leadership.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. There is zero tolerance for sexual harassment in our University. </td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Girls often say ‘no’ to SEX when they mean ‘yes’.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Well-behaved girls do not get raped.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
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
					   <td>1. Gender issues</td>
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls / women's rights.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. Girls rigts to eduaction. </td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Violence against girls.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Sexual ad gender based Violence.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Sexual and reproductive health and rights</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>7. Patriarchy and Sexuality</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
				
                    </tbody>
                    <tfoot>
                    </tfoot>
              </table>
            </div>			  
	      <button  class="btn btn-primary" name="name" type="submit" ><span class="glyphicon glyphicon-plus"></span>Submit Form</button></li>
         <button class="btn btn-danger"  type="reset" ><span class="glyphicon glyphicon-repeat"></span> Reset Form</button></li>		     
					
</div>
<?php //end form tool4/?>
</div>
<?php //Begin form tool5/?>
<div class="col-md-12 active tab-pane" id="teachers">	
<div class="box-header with-border">
<br/>
                <h5 class="box-title" style="text-align:centre;">MEMPROW’s Questionnaire for Girls/Young Women in University</h5>
				 <h5 class="box-title" style="text-align:centre;">GIRLS IN SCHOOL POST</h5>

<p style="text-align:centre;">Capacity Building for Protection of Girls and Young Women’s Rights in Education and Leadership Project</p>

</div>
	
<div class="col-md-8 active tab-pane" id="">
				
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
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls should not go into leadership.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. There is zero tolerance for sexual harassment in our University. </td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Girls often say ‘no’ to SEX when they mean ‘yes’.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Well-behaved girls do not get raped.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Girls who are sexually harassed are to blame [i.e. because of their behaviour or the way they dress]</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
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
					   <td>1. Gender issues</td>
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>   				  
					  <td><input  name="gender_issues_understanding" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
                     </tr>
                     <tr>					 
					  <td>2. Girls / women's rights.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>3. Girls rigts to eduaction. </td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>4. Violence against girls.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>5. Sexual ad gender based Violence.</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					  <tr>					 
					  <td>6. Sexual and reproductive health and rights</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  </tr>
					   <tr>					 
					  <td>7. Patriarchy and Sexuality</td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
					  <td><input  name="gender" id="" value="Male" type="radio"  <?php if ($gender=='Male'){ echo 'checked';}?>></td>
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
</div>

</div>
                   
</form>  
</div>

                     
                     

