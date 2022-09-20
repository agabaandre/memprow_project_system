<div class="col-md-12">
  <?php
  include("db_connector/mysqli_conn.php");
  ?>
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">

      <li class="active"><a href="dashboard.php?action=manage_donors">Manage Donors</a></li>
    </ul>
  </div>

  <div class="box-header with-border">
    <h3 class="box-title">Manage Donors</h3>
  </div>
  <button class=" btn btn-md btn-primary" data-toggle="modal" data-target="#add">Add Donors</button>
  <div class="modal fade" id="add" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
          <h4 class="modal-title">
            <center><i class="fa fa-user fa-spin"></i>Add Donor</center>
          </h4>
        </div>
        <div class="modal-body">

          <form action="" method="post" enctype="multipart/form-data">

            <label>Donor: <span style="color:red">*</span></label>
            <input type="text" class="form-control" name="donor" placeholder="Donor" style="width:100%;">

            <input type="hidden" class="form-control" name="add" value="" style="width:100%;">


            <button type="submit" class="btn btn-primary"><i class="fa-save" style="margin-top:4px;"></i>Save Donor</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <?php
  //flag changer
  if (isset($_POST['flag'])) {
    $flag = mysqli_real_escape_string($dbcon, $_POST['flag']);
    $donor_id = mysqli_real_escape_string($dbcon, $_POST['donor_id']);
    $msg = mysqli_real_escape_string($dbcon, $_POST['msg']);
    if ($sqla = mysqli_query($dbcon, "UPDATE `donors` SET `flag` = '$flag' WHERE `donor_id`=$donor_id")) {

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

      if ($act = mysqli_query($dbcon, "Delete from donors where donor_id='$rs_id'")) {

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
    $donor = mysqli_real_escape_string($dbcon, $_POST['donor']);



    if ($rs_id != "") {

      if ($act = mysqli_query($dbcon, "UPDATE `donors` SET `donor` = '$donor' WHERE `donor_id`=$rs_id")) {

        echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Update Successful</strong>
                   </div>';
      }
    }
  }
  ?>
  <?php if (isset($_POST['add'])) {

    $donor = mysqli_real_escape_string($dbcon, $_POST['donor']);

    $counts = mysqli_query($dbcon, "select * from  donors where donor='$donor'");
    $row = mysqli_fetch_array($counts);

    if (count($row) == 1) {
      $msg = " Duplicate Entry! Please Verify</font>";
      echo '<div class="alert alert-danger alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>' . $msg . '</strong>
                   </div>';
    } else {

      if ($act = mysqli_query($dbcon, "INSERT INTO `donors` (
`donor_id` ,
`donor`,
`flag`
)
VALUES (NULL, '$donor',1)")) {

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
          <th style="width:70%;">Donor</th>

          <th style="width:15%;">Status</th>
          <th style="width:15%;">Edit / Delete</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM donors";
        $result = mysqli_query($dbcon, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <?php $id = $row['donor_id']; ?>
          <tr>
            <td><?php echo $row['donor']; ?></td>

            <td>
              <?php
              //Flag Raiser
              $status = $row['flag'];
              $space = "----|";
              if ($status == 0) {
                echo "<form action='' method='post'>
						  <input type='hidden' value='1' name='flag'>
						  <input type='hidden' value='$id' name='donor_id'>
						  <input type='hidden' value='Activated' name='msg'>
						 <button type='submit'  class='btn btn-sm btn-danger' name='status'><span class='glyphicon glyphicon-circle-remove'></span>Not Active</button>
						        </form>";
              } else {
                echo "<form action='' method='post'>
						  <input type='hidden' value='0' name='flag'>
						  <input type='hidden' value='$id' name='donor_id'>
						  <input type='hidden' value='De-activated' name='msg'>
						 <button type='submit' name='change_flag' class='btn btn-sm btn-success' name='status'><span class='glyphicon glyphicon-ok'></span>Active</button>
						 </form>";
              }


              ?>


            </td>
            <td>
              <?php if ($_SESSION['usertype'] == 'admin') { ?>
                <form action="" method="post" style="width:40px;">
                  <input type="hidden" name="id" value="<?php echo $row['donor_id']; ?>" />
                  <input type="hidden" name="delete">
                  <button type="submit" name="delete" title="On click, this record will be deleted!" class="btn btn-sm btn-danger" style="float:left;"><i class="delete"></i>Delete</button>
                </form>
                <button data-toggle="modal" data-target="#<?php echo $modalid = 'my' . $row['donor_id']; ?>" title="Update activity" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>

              <?php }
              ?>
              <div class="modal fade" id="<?php echo $modalid; ?>" tabindex="-1" role="dialog" data-backdrop="static">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                      <h4 class="modal-title">
                        <center><i class="fa fa-user fa-spin"></i>Update donor</center>
                      </h4>
                    </div>
                    <div class="modal-body">

                      <form action="" method="post" enctype="multipart/form-data">

                        <input class="form-control" name="id2" value="<?php echo $row['donor_id']; ?>" placeholder="" type="hidden" />
                        <input class="form-control" name="update" value="" placeholder="" type="hidden">
                        <label>Donor:</label>
                        <input class="form-control" name="donor" value="<?php echo $row['donor']; ?>" placeholder="Donor" type="text" style="width:100%;">

                        <button type="submit" name="" class="btn btn-primary"><i class="edit" style="margin-top:6px;"></i>Update Donor</button>
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