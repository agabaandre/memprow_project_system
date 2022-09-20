<div class="col-md-12">
  <?php
  include("db_connector/mysqli_conn.php");
  ?>
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">

      <li class=""><a href="dashboard.php?action=manage_locations">Manage Locations</a></li>
    </ul>
  </div>

  <div class="box-header with-border">
    <h5 class="box-title">Manage Locations</h5>
  </div>
  <button class=" btn btn-md btn-primary" data-toggle="modal" data-target="#add">Add Location</button>
  <div class="modal fade" id="add" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
          <h4 class="modal-title">
            <center><i class="fa fa-user fa-spin"></i>Add Location</center>
          </h4>
        </div>
        <div class="modal-body">

          <form action="" method="post" enctype="multipart/form-data">
            <label>District:</label>
            <input type="text" class="form-control" name="district" value="" placeholder="District Name" style="width:100%;">

            <button type="submit" name="add" class="btn btn-primary"><i class="add" style="margin-top:4px;"></i>Save</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <?php
  if (isset($_POST['delete'])) {

    $rs_id = $_POST['id'];



    if ($rs_id != "") {

      if ($act = mysqli_query($dbcon, "Delete from district where district_id=$rs_id")) {

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
    $value = mysqli_real_escape_string($dbcon, $_POST['name']);



    if ($rs_id != "") {

      if ($act = mysqli_query($dbcon, "UPDATE `district` SET `name`='$value' WHERE `district_id`=$rs_id")) {

        echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Update Successful</strong>
                   </div>';
      }
    }
  }
  ?>
  <?php if (isset($_POST['add'])) {

    $value = mysqli_real_escape_string($dbcon, $_POST['district']);
    $counts = mysqli_query($dbcon, "select * from  district where name='$value'");
    $row = mysqli_fetch_row($counts);

    if (count($row) == 1) {
      $msg = " Duplicate Entry! Please Verify</font>";
      echo '<div class="alert alert-danger alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>' . $msg . '</strong>
                   </div>';
    } else {

      if ($act = mysqli_query($dbcon, "INSERT INTO `district` (
`district_id` ,
`name`
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
          <th>NO</th>
          <th>Location /District</th>

          <th>Edit / Delete</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        $sql = "SELECT * FROM district";
        $result = mysqli_query($dbcon, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <td style="width:2%;"><?php echo $i++; ?></td>
            <td style="width:78%;"><?php echo $row['name']; ?></td>

            <td style="width:15%;">
              <?php if ($_SESSION['usertype'] == 'admin') { ?>
                <form action="" method="post" style="width:40px;">
                  <input type="hidden" name="id" value="<?php echo $row['district_id']; ?>" />
                  <input type="hidden" name="delete">
                  <button type="submit" name="delete" title="On click, this record will be destroyed!" class="btn btn-sm btn-danger" style="float:left;"><i class="delete"></i>Delete</button>
                </form>
                <button data-toggle="modal" data-target="#<?php echo $modalid = 'my' . $row['district_id']; ?>" title="Update activity" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>

              <?php }
              ?>
              <div class="modal fade" id="<?php echo $modalid; ?>" tabindex="-1" role="dialog" data-backdrop="static">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                      <h4 class="modal-title">
                        <center><i class="fa fa-user fa-spin"></i>Update District</center>
                      </h4>
                    </div>
                    <div class="modal-body">

                      <form action="" method="post" enctype="multipart/form-data">

                        <input class="form-control" name="id2" value="<?php echo $row['district_id']; ?>" placeholder="" type="hidden" />
                        <input class="form-control" name="update" value="" placeholder="" type="hidden">
                        <label>District:</label>
                        <input class="form-control" name="name" value="<?php echo $row['name']; ?>" placeholder="District" type="text" style="width:100%;">

                        <button type="submit" name="" class="btn btn-primary"><i class="edit" style="margin-top:6px;"></i>Update District</button>
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