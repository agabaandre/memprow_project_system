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

        <label>Select Participant <span style="color:red"></span></label>
        <select class="form-control select2" name="participant_id" id="participant_id myselect" style="width:100%;" required>
          <?php
          $sqlp = mysqli_query($dbcon, "SELECT DISTINCT participants.participant_id,participants.surname,participants.firstname,participants.othername,participants.gender,participants.postal_address,participants.position,participants.residence_district
          FROM participants where participants.participant_id in (select distinct participant_id from me_profiling)");

          while ($listp = mysqli_fetch_array($sqlp)) {
          ?>
            <option value="<?php echo $participant_id = $listp['participant_id']; ?>" required><?php echo $listp['surname'] . " " . $listp['firstname'] . " " . $listp['othername'] . " , " . $listp['gender'] . " , " . $listp['residence_district'] . " , " . $listp['postal_address'] . " , " . $listp['position']; ?>
            </option>

          <?php } ?>
        </select>

      </div>
      <p></p>
      <button type="submit" class="btn btn btn-info" name="apply_limits"><span class="glyphicon glyphicon-ok"></span>Generate Profile</button>
      <p></p>

    </form>
  </div>
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="js/highcharts/highcharts.js"></script>
  <script src="js/highcharts/exporting.js"></script>
  <div class="col-md-12">
    <a href="" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print PDF</a>
    <script>
      function printDiv(printableDiv) {

        var printContents = document.getElementById(printableDiv).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;

        window.print();
        document.body.innerHTML = originalContents;
      }
    </script>
    <script>
      $(function() {
        // turn the element to select2 select style
        $('.select2').select2();
      });
    </script>
    <button type="button" class="btn btn-sm btn-default" onclick="printDiv('printableDiv')">Web Print</button>
    <hr style="border:1px solid rgb(140, 141, 137);" />

    <p style="font-weight:bold;"></p>

    <!-- title row -->
    <div id="mydata">
      <div class="row" id="printableDiv">
        <div class="col-xs-12">
          <center>
            <h2 class="page-header">
              <p><img src="images/memprow_bannerxx.jpeg" style="width:100px; height:100px;"></p>
              <p>Profile</p>
              <p><small><?php echo $da; ?></small></p>
            </h2>
          </center>
        </div>
        <!-- /.col -->

        <!-- info row -->
        <?php
        if ($_POST['participant_id']) {
          $participant_id = $_POST['participant_id'];
        } else {
          $participant_id = $_GET['pid'];
        }
        $sql = "SELECT surname,firstname,othername,gender,position,age_group,residence_district,postal_address,contact1,contact2,email,me_profiling.training_id,q1,q2,q3,q4,
q5,q6,q7,q8,q9,sc,d1,d2,d3,d4 FROM me_profiling,participants WHERE me_profiling.participant_id=participants.participant_id and  participants.participant_id LIKE'$participant_id'";
        $result = mysqli_query($dbcon, $sql);
        while ($row = mysqli_fetch_array($result)) { ?>

          <div class="row">

            <div class="col-sm-4">
              <b class="lead">SECTION A</b>
              <p> Name:</p>
              <p>

                <strong><?php echo $myname = $row['surname'] . " " . $row['firstname'] . " " . $row['othername']; ?></strong><br>
                <?php echo  $row['gender']; ?><br>
                <?php echo  $row['age_group']; ?><br>
                <?php echo $active_opp = $position = $row['position']; ?><br>
                <?php echo $active_op = $row['residence_district']; ?>
              </p>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <p> Contact Information</p>
              <address>
                <strong><?php echo $position = $row['postal_address']; ?></strong><br>
                <?php echo $department = $row['contact1']; ?><br>
                <?php echo $department = $row['contact2']; ?><br>
                <?php echo $department = $row['email']; ?><br>
              </address>
            </div>
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <b class="lead">SECTION B</b>
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Questions</th>
                    <th>Answers</th>



                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1. Please describe your life in terms of knowledge and skills before you joined MEMPROW? </td>
                    <td><?php echo $row['q1']; ?></td>
                  </tr>
                  <tr>
                    <td>2. When and how did you join MEMPROW? (If MEMPROW met you at a school/university please mention the school and year.</td>
                    <td><?php echo $row['q2']; ?></td>
                  </tr>
                  <tr>
                    <td>3.What change have you experienced after becoming a member of the MEMPROW girl’s Network?</td>
                    <td><?php echo $row['q3']; ?></td>
                  </tr>
                  <tr>
                    <td>4. Are you involved in any form of leadership? If Yes, share the experience and how MEMPROW has contributed to this.</td>
                    <td><?php echo $row['q4']; ?></td>
                  </tr>
                  <tr>
                    <td>5. Do you still engage in MEMPROW activities?</td>
                    <td><?php echo $row['q5']; ?></td>
                  </tr>
                  <tr>
                    <td>6. If Yes, how are you using the knowledge/skills that you acquired from MEMPROW? Self/Personal development:.</td>
                    <td><?php echo $row['q6']; ?></td>
                  </tr>
                  <tr>
                    <td>7. If No; Please explain why you are no longer able to participate in MEMPROW Programme activities.</td>
                    <td><?php echo $row['q7']; ?></td>
                  </tr>
                  <tr>
                    <td>8.Suggest ways that MEMPROW can adopt to keep young women actively involved in her Programme activities.</td>
                    <td><?php echo $row['q8']; ?></td>
                  </tr>
                  <tr>
                    <td>9. Would you recommend anyone to join MEMPROW PROGRAMME activities?</td>
                    <td><?php echo $row['q9']; ?></td>
                  </tr>


                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-12">
              <b class="lead">SECTION C</b>

              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                PLEASE TELL A STORY ABOUT THE MOST SIGNIFICANT CHANGE THAT HAPPENED TO YOU AS A RESULT OF MEMPROW’S INTERVENTION.
                (PROBES TO USE: How was your situation before?why the change happened? what is it like now?)
              </p>
              <p class="show-read-more"><?php echo $row['sc']; ?>

            </div>
            <!-- /.col -->
            <div class="col-xs-6">
              <b clas="lead">SECTION D: CONSENT
              </b>
              <p>Consent: We may like to use your stories for reporting to our funders, or sharing with other people in other organizations.</p>



              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">1. Want to have your biography on the story</th>
                    <td><?php echo $row['d1']; ?></td>
                  </tr>
                  <tr>
                    <th>2. Consent to us using your story for publication</th>
                    <td><?php echo $row['d2']; ?></td>
                  </tr>
                  <tr>
                    <th>3. Consent to have your photograph taken and possibly used in publication</th>
                    <td><?php echo $row['d3']; ?></td>
                  </tr>
                  <tr>
                    <th>4. Consent to have your story profiled on video</th>
                    <td><?php echo $row['d4']; ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>

          <!-- /.row -->

          <!-- this row will not appear when printing -->

          <script type="text/javascript">
            $(document).ready(function() {
              var maxLength = 100;
              $(".show-read-more").each(function() {
                var myStr = $(this).text();
                if ($.trim(myStr).length > maxLength) {
                  var newStr = myStr.substring(0, maxLength);
                  var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                  $(this).empty().html(newStr);
                  $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
                  $(this).append('<span class="more-text">' + removedStr + '</span>');
                }
              });
              $(".read-more").click(function() {
                $(this).siblings(".more-text").contents().unwrap();
                $(this).remove();
              });
            });
          </script>
          <style type="text/css">
            .show-read-more .more-text {
              display: none;
            }
          </style>

      </div>
    </div>
  <?php } ?>
  </div>