<div class="col-md-12">
    <?php
    include("db_connector/mysqli_conn.php");
    ?>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">

            <li class="active"><a href="dashboard.php?action=manage_grounds">Manage Training Grounds</a></li>
        </ul>
    </div>

    <div class="box-header with-border">
        <h3 class="box-title">Manage Training Grounds</h3>
    </div>
    <button class=" btn btn-md btn-primary" data-toggle="modal" data-target="#add">Add Training Grounds</button>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title">
                        <center><i class="fa fa-user fa-spin"></i>Add Training Ground</center>
                    </h4>
                </div>
                <div class="modal-body">

                    <form action="" method="post" enctype="multipart/form-data">

                        <label>Training Ground: <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="ground" placeholder="ground" style="width:100%;">

                        <input type="hidden" class="form-control" name="add" value="" style="width:100%;">


                        <button type="submit" class="btn btn-primary"><i class="fa-save" style="margin-top:4px;"></i>Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['delete'])) {

        $rs_id = $_POST['id'];



        if ($rs_id != "") {

            if ($act = mysqli_query($dbcon, "Delete from grounds where ground_id=$rs_id")) {

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
        $ground = mysqli_real_escape_string($dbcon, $_POST['ground']);



        if ($rs_id != "") {

            if ($act = mysqli_query($dbcon, "UPDATE `grounds` SET `ground`='$ground' WHERE `ground_id`=$rs_id")) {

                echo $msg = '<div class="alert alert-success alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Update Successful</strong>
                   </div>';
            }
        }
    }
    ?>
    <?php if (isset($_POST['add'])) {

        $ground = mysqli_real_escape_string($dbcon, $_POST['ground']);
        $counts = mysqli_query($dbcon, "select * from  grounds where ground='$ground'");
        $row = mysqli_fetch_array($counts);

        if (count($row) == 1) {
            $msg = " Duplicate Entry! Please Verify</font>";
            echo '<div class="alert alert-danger alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>' . $msg . '</strong>
                   </div>';
        } else {

            if ($act = mysqli_query($dbcon, "INSERT INTO grounds (
`ground_id` ,
`ground`
)
VALUES (NULL, '$ground')")) {

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
                    <th style="width:3%;">No</th>
                    <th style="width:80%;">Training Ground</th>

                    <th style="width:17%;">Edit / Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $sql = "SELECT * FROM grounds";
                $result = mysqli_query($dbcon, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <?php $id = $row['ground_id']; ?>
                    <tr>
                        <td><?php echo $i++; ?> </td>
                        <td><?php echo $row['ground']; ?></td>


                        <td>
                            <?php if ($_SESSION['usertype'] == 'admin') { ?>
                                <form action="" method="post" style="width:40px;">
                                    <input type="hidden" name="id" value="<?php echo $row['ground_id']; ?>" />
                                    <input type="hidden" name="delete">
                                    <button type="submit" name="delete" title="On click, this record will be deleted!" class="btn btn-sm btn-danger" style="float:left;"><i class="delete"></i>Delete</button>
                                </form>
                                <button data-toggle="modal" data-target="#<?php echo $modalid = 'my' . $row['ground_id']; ?>" title="Update activity" class="btn btn-sm btn-info"><i class="edit"></i>Edit</button>

                            <?php }
                            ?>
                            <div class="modal fade" id="<?php echo $modalid; ?>" tabindex="-1" role="dialog" data-backdrop="static">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                                            <h4 class="modal-title">
                                                <center><i class="fa fa-user fa-spin"></i>Update ground</center>
                                            </h4>
                                        </div>
                                        <div class="modal-body">

                                            <form action="" method="post" enctype="multipart/form-data">

                                                <input class="form-control" name="id2" value="<?php echo $row['ground_id']; ?>" placeholder="" type="hidden" />
                                                <input class="form-control" name="update" value="" placeholder="" type="hidden">
                                                <label>ground:</label>
                                                <input class="form-control" name="ground" value="<?php echo $row['ground']; ?>" placeholder="ground" type="text" style="width:100%;">

                                                <button type="submit" name="" class="btn btn-primary"><i class="edit" style="margin-top:6px;"></i>Update ground</button>
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