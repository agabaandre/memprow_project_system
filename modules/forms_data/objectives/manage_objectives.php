<div class="col-md-12">
  <?php
  include("db_connector/mysqli_conn.php");
  ?>
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">

      <li class="active"><a href="dashboard.php?action=manage_objectives">Manage Objectives</a></li>
    </ul>
  </div>

  <div class="box-header with-border">
    <h3 class="box-title">Manage Objectives</h3>
  </div>
  <button class=" btn btn-md btn-primary" data-toggle="modal" data-target="#add">Add Objective</button>
  <div class="modal fade" id="add" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
          <h4 class="modal-title">
            <center><i class="fa fa-user fa-spin"></i>Add Objective</center>
          </h4>
        </div>
        <div class="modal-body">

          <form action="" method="post" enctype="multipart/form-data">
            <label>Objective: <span style="color:red">*</span></label>
            <input type="hidden" class="form-control" name="objective_id" value="<?php echo $activity_id; ?>" style="width:100%;">
            <textarea class="form-control" name="objective" cols="3" style="width:100%;" required></textarea>
            <div class="input-group date" data-provide="datepicker" style="width:100%;">

              <label>Set Date:</label>
              <input type="text" class="form-control" name="date" value="" style="width:100%;">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
            <input type="hidden" class="form-control" name="add" value="" style="width:100%;">
            <label>Description:</label>
            <textarea class="form-control" name="description" cols="3" style="width:100%;"></textarea>

            <button type="submit" class="btn btn-primary"><i class="" style="margin-top:4px;"></i>Add Objective</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <?php
  //flag changer
  if (isset($_POST['flag'])) {
    $flag = mysqli_real_escape_string($dbcon, $_POST['flag']);
    $objective_id = mysqli_real_escape_string($dbcon, $_POST['objective_id']);
    $msg = mysqli_real_escape_string($dbcon, $_POST['msg']);
    if ($sqla = mysqli_query($dbcon, "UPDATE objectives SET flag='$flag' WHERE objective_id=$objective_id")) {
      $sqla = mysqli_query($dbcon, "UPDATE activities SET flag=$flag WHERE objective_id=$objective_id");
      echo '<div class="alert alert-success alert-dismissable">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>' . $msg . '</strong>
                    </div>';
    } else {
      echo '<div class="alert alert-success alert-dismissable">
                     <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>' . $msg . '</strong>
                     </div>';
    }
  }
  ?>
  <?php
  if (isset($_POST['delete'])) {

    $rs_id = $_POST['id'];



    if ($rs_id != "") {

      if ($act = mysqli_query($dbcon, "Delete from objectives where objective_id=$rs_id")) {

        echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Deletion Successful</strong>
                   </div>';
      }
    }
  }
  ?>
  <?php if (isset($_POST['update'])) {

    $rs_id = $_POST['id2'];
    $date = $_POST['date'];
    $objective = mysqli_real_escape_string($dbcon, $_POST['objective']);
    $description = mysqli_real_escape_string($dbcon, $_POST['description']);



    if ($rs_id != "") {

      if ($act = mysqli_query($dbcon, "UPDATE `objectives` SET `objective` = '$objective', `set_date`='$date', `description` = '$description' WHERE `objective_id` =$rs_id")) {

        echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Update Successful</strong>
                   </div>';
      }
    }
  }
  ?>
  <?php if (isset($_POST['add'])) {

    $objective = mysqli_real_escape_string($dbcon, $_POST['objective']);
    $description = mysqli_real_escape_string($dbcon, $_POST['description']);
    $counts = mysqli_query($dbcon, "select * from  objectives where obejctive='$objective'");
    $row = mysqli_fetch_array($counts);

    if (count($row) == 1) {
      $msg = " Duplicate Entry! Please Verify</font>";
      echo '<div class="alert alert-danger alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>' . $msg . '</strong>
                   </div>';
    } else {

      if ($act = mysqli_query($dbcon, " INSERT INTO objectives (
`objective_id` ,
`set_date`,
`objective`,
`description`,
`flag`
)
VALUES (NULL, '$date', '$objective','$description',0)")) {

        echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Saved Succeefully</strong>
                   </div>';
      }
    }
  }
  ?>
  <div class="col-md-12">
    <hr style="border:1px solid rgb(140, 141, 137);" />
    <table id="mydata" class="table table-bordered table-responsive">
      <thead>
        <tr>
          <th style="width:40%;">Objective</th>
          <th style="width:10%;">Setting Date</th>
          <th style="width:30%;">Description</th>
          <th>Status</th>
          <th>Edit / Delete</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM objectives";
        $result = mysqli_query($dbcon, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <?php $id = $row['objective_id']; ?>
          <tr>
            <td><?php echo $row['objective']; ?></td>
            <td><?php echo $row['set_date']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
              <?php
              //Flag Raiser
              $status = $row['flag'];
              $space = "----|";
              if ($status == 0) {
                echo "<form action='' method='post'>
						  <input type='hidden' value='1' name='flag'>
						  <input type='hidden' value='$id' name='objective_id'>
						  <input type='hidden' value='Objective and its actives are marked as accomplished' name='msg'>
						 <button type='submit'  class='btn btn-sm btn-primary' name='status'><span class='glyphicon glyphicon-refresh'></span>Pending ..</button>
						        </form>";
              } else {
                echo "<form action='' method='post'>
						  <input type='hidden' value='0' name='flag'>
						  <input type='hidden' value='$id' name='objective_id'>
						  <input type='hidden' value='Status Changed to Pending for the objective and its activities' name='msg'>
						 <button type='submit' name='change_flag' class='btn btn-sm btn-success' name='status'><span class='glyphicon glyphicon-ok'></span>Acommplished</button>
						 </form>";
              }



              ?>


            </td>
            <td>
              <?php if ($_SESSION['usertype'] == 'admin') { ?>
                <form action="" method="post" style="width:40px;">
                  <input type="hidden" name="id" value="<?php echo $row['objective_id']; ?>" />
                  <input type="hidden" name="delete">
                  <button type="submit" name="delete" title="On click, this record will be deleted!" class="btn btn-sm btn-danger" style="float:left;"><i class="delete"></i>Delete</button>
                </form>
                <button data-toggle="modal" data-target="#<?php echo $modalid = 'my' . $row['objective_id']; ?>" title="Update Objective" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>

              <?php }
              ?>
              <div class="modal fade" id="<?php echo $modalid; ?>" tabindex="-1" role="dialog" data-backdrop="static">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                      <h4 class="modal-title">
                        <center><i class="fa fa-user fa-spin"></i>Update Objectives</center>
                      </h4>
                    </div>
                    <div class="modal-body">

                      <form action="" method="post" enctype="multipart/form-data">
                        <label>Objective:</label>
                        <textarea class="form-control" name="objective" cols="3" style="width:100%;"><?php echo $row['objective']; ?></textarea>
                        <input class="form-control" name="id2" value="<?php echo $row['objective_id']; ?>" placeholder="" type="hidden" />
                        <input class="form-control" name="update" value="" placeholder="" type="hidden">
                        <div class="input-group date" data-provide="datepicker" style="width:100%;">
                          <label>Date:</label>

                          <input class="form-control" name="date" value="<?php if ($row['set_date'] != "0000-00-00") {
                                                                            echo $row['set_date'];
                                                                          } ?>" placeholder="" type="text" style="width:100%;">
                          <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                          </div>
                        </div>

                        <label>Description:</label>
                        <textarea class="form-control" name="description" cols="3" style="width:100%;"><?php echo $row['description']; ?></textarea>
                        <button type="submit" name="update" class="btn btn-primary"><i class="edit" style="margin-top:4px;"></i>Update Objective</button>
                      </form>

                    </div>
                  </div>
                </div>
              </div>

            </td>

          </tr>
        <?php } ?>
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </div>