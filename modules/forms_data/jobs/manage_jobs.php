<div class="col-md-12">
  <?php
  include("db_connector/mysqli_conn.php");
  ?>
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">

      <li class="active"><a href="dashboard.php?action=manage_jobs">Manage Designations</a></li>
    </ul>
  </div>

  <div class="box-header with-border">
    <h5 class="box-title">Manage Designations</h5>
  </div>
  <button class=" btn btn-md btn-primary" data-toggle="modal" data-target="#add">Add New Designation</button>
  <div class="modal fade" id="add" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
          <h4 class="modal-title">
            <center><i class="fa fa-user fa-spin"></i>Add Designation</center>
          </h4>
        </div>
        <div class="modal-body">

          <form action="" method="post" enctype="multipart/form-data">
            <label>Occupation:</label>
            <input type="text" class="form-control" name="position" value="" style="width:100%;">

            <button type="submit" name="add" class="btn btn-primary"><i class="add" style="margin-top:4px;"></i>Save Designation</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <?php
  if (isset($_POST['delete'])) {

    $rs_id = $_POST['id'];



    if ($rs_id != "") {

      if ($act = mysqli_query($dbcon, "delete from position where position_id='$rs_id'")) {

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
    $value = mysqli_real_escape_string($dbcon, $_POST['position']);



    if ($rs_id != "") {

      if ($act = mysqli_query($dbcon, "UPDATE `position` SET `position` = '$value' WHERE `position`.`position_id` ='$rs_id'")) {

        echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Update Successful</strong>
                   </div>';
      }
    }
  }
  ?>
  <?php if (isset($_POST['add'])) {

    $value = mysqli_real_escape_string($dbcon, $_POST['position']);
    $counts = mysqli_query($dbcon, "select * from  position where position='$value'");
    $row = mysqli_fetch_array($counts);

    if (count($row) == 1) {
      $msg = " Duplicate Entry! Please Verify</font>";
      echo '<div class="alert alert-danger alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>' . $msg . '</strong>
                   </div>';
    } else {

      if ($act = mysqli_query($dbcon, " INSERT INTO `position` (
`position_id` ,
`position`
)
VALUES (NULL, '$value')")) {

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
          <th style="width:2%;">NO</th>
          <th style="width:78%;">Designation</th>

          <th style="width:20%;">Edit / Delete</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        $sql = "SELECT * FROM position";
        $result = mysqli_query($dbcon, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['position']; ?></td>

            <td>
              <form action="" method="post" style="width:40px;"><input type="hidden" name="id" value="<?php echo $row['position_id']; ?>" />
                <button type="submit" name="delete" title="On click, this record will be deleted!" class="btn btn-sm btn-danger" style="float:left;"><i class="delete"></i>Delete</button>
              </form>
              <button data-toggle="modal" data-target="#<?php echo $modalid = 'my' . $row['position_id']; ?>" title="Update Occupation Details" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>

              <div class="modal fade" id="<?php echo $modalid; ?>" tabindex="-1" role="dialog" data-backdrop="static">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                      <h4 class="modal-title">
                        <center><i class="fa fa-user fa-spin"></i>Update Occupation</center>
                      </h4>
                    </div>
                    <div class="modal-body">

                      <form action="" method="post" enctype="multipart/form-data">
                        <label>Job:</label>
                        <input type="text" class="form-control" name="position" value="<?php echo $row['position']; ?>" style="width:100%;">
                        <input class="form-control" name="id2" value="<?php echo $row['position_id']; ?>" placeholder="" type="hidden" />
                        <button type="submit" name="update" class="btn btn-primary"><i class="add" style="margin-top:4px;"></i>Update Occupation</button>
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