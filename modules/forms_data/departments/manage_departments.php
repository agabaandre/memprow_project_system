<div class="col-md-12">

  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">

      <li class=""><a href="dashboard.php?action=manage_departments">Manage Departments</a></li>
    </ul>
  </div>

  <div class="box-header with-border">
    <h5 class="box-title">Manage departments</h5>
  </div>
  <button class=" btn btn-md btn-primary" data-toggle="modal" data-target="#add">Add Department</button>
  <div class="modal fade" id="add" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
          <h4 class="modal-title">
            <center><i class="fa fa-user fa-spin"></i>Add Department</center>
          </h4>
        </div>
        <div class="modal-body">

          <form action="" method="post" enctype="multipart/form-data">
            <label>Department:</label>
            <input type="text" class="form-control" name="department" value="" style="width:100%;">

            <button type="submit" name="add" class="btn btn-primary"><i class="add" style="margin-top:4px;"></i>Add Department</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <?php
  if (isset($_POST['delete'])) {

    $rs_id = $_POST['id'];



    if ($rs_id != "") {

      if ($act = mysqli_query($dbcon, "Delete from departments where id='$rs_id'")) {

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
    $value = $_POST['department'];



    if ($rs_id != "") {

      if ($act = mysqli_query($bcon, "UPDATE `attendance_tracking`.`departments` SET `department` = '$value' WHERE `departments`.`id` ='$rs_id'")) {

        echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Update Successful</strong>
                   </div>';
      }
    }
  }
  ?>
  <?php if (isset($_POST['add'])) {

    $value = $_POST['department'];
    $counts = mysqli_query($dbcon, "select * from  departments where department='$value'");
    $row = mysqli_fetch_array($counts);

    if (count($row) == 1) {
      $msg = " Duplicate Entry! Please Verify</font>";
      echo '<div class="alert alert-danger alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>' . $msg . '</strong>
                   </div>';
    } else {

      if ($act = mysqli_query($query, " INSERT INTO `attendance_tracking`.`departments` (
`id` ,
`department`
)
VALUES (NULL, 'home')")) {

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
          <th>department</th>

          <th>Edit / Delete</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM departments";
        $result = mysqli_query($dbcon, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <td><?php echo $row['department']; ?></td>

            <td>
              <button data-toggle="modal" data-target="#<?php echo $modalid = 'my' . $row['id']; ?>" title="Update department Details" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>
              <form action="" method="post" style="width:40px;"><input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                <button type="submit" name="delete" title="On click, this record will be deleted!" class="btn btn-sm btn-danger" style="float:left;"><i class="delete"></i>Delete</button>
              </form>
              <div class="modal fade" id="<?php echo $modalid; ?>" tabindex="-1" role="dialog" data-backdrop="static">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                      <h4 class="modal-title">
                        <center><i class="fa fa-user fa-spin"></i>Update Department</center>
                      </h4>
                    </div>
                    <div class="modal-body">

                      <form action="" method="post" enctype="multipart/form-data">
                        <label>Department:</label>
                        <input type="text" class="form-control" name="department" value="<?php echo $row['department']; ?>" style="width:100%;">
                        <input class="form-control" name="id2" value="<?php echo $row['id']; ?>" placeholder="" type="hidden" />
                        <button type="submit" name="update" class="btn btn-primary"><i class="add" style="margin-top:4px;"></i>Update Department</button>
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