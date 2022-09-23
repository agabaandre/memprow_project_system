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
                <label>Select Field Work Activity for Graphing: <span style="color:red"></span></label>
                <select class="form-control select2" name="field_activity_id" id="factivity_id myselect" style="width:100%;">
                    <?php
                    $sql2 = mysqli_query($dbcon, "SELECT DISTINCT field_activity_id, training FROM field_work WHERE field_activity_id IN (select distinct training_id from me_f2) OR  field_activity_id IN (select distinct training_id from me_f1)");

                    while ($list2 = mysqli_fetch_array($sql2)) {
                    ?>

                        <option value="<?php echo $list2['field_activity_id']; ?>"><?php echo $list2['training']; ?>
                        </option>
                    <?php } ?>
                    <option value="" selected>All
                    </option>
                </select>

            </div>
            <p></p>
            <button type="submit" class="btn btn btn-info" name="apply_limits"><span class="glyphicon glyphicon-ok"></span>Apply Limits</button>
            <p></p>

        </form>
    </div>
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="js/highcharts/highcharts.js"></script>
    <script src="js/highcharts/exporting.js"></script>
    <div class="col-md-12">
        <?php include("src/export.php"); ?>
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
        <button type="button" class="btn btn-sm btn-default" onclick="printDiv('printableArea')">Web Print</button>
        <hr style="border:1px solid rgb(140, 141, 137);" />

        <p style="font-weight:bold;"></p>


        <div id="printableArea">
            <div class="box-header with-border">
                <h5 class="box-title">Pre and Post SRHR Comparison by Training</h5>
                <p class="danger"></p>
            </div>
            <table id="mydata" class="table table-hover table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Training</th>
                        <th>Start Date</th>
                        <th>View on Gender Equality Issues PRE SRHR (Qn:5)</th>
                        <th>View Gender Equality Issues POST SRHR (Qn:2</th>
                        <th>Level of Understanding Issues PRE SRHR (Qn:6)</th>
                        <th>Level of Understanding Issues POST SRHR (Qn:3)</th>

                    </tr>

                </thead>
                <tbody>
                    <?php

                    $field_activity_id = $_POST['field_activity_id'];
                    $i = 1;
                    $sql = "SELECT field_work.start_date,field_work.training,field_work.field_activity_id, SUM(q51+q52+q53+q53+q54+q55+q56) as
					Q5presrhr,SUM(q21+q22+q23+q24+q25+q26) as Q2postsrhr, SUM(q61+q62+q63+q64+q65+q66+q67) as Q6presrhr, SUM(q31+q32+q33+q34+q35+q36+q37) as 
					Q3postsrhr FROM me_f1, me_f2,field_work where me_f1.training_id LIKE'%$field_activity_id' and me_f1.training_id=me_f2.training_id and me_f1.training_id=field_work.field_activity_id 
					and me_f2.training_id=field_work.field_activity_id GROUP BY me_f1.training_id ";


                    $result = mysqli_query($dbcon, $sql);
                    while ($row = mysqli_fetch_array($result)) {



                    ?>

                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $mytrain = $row['training']; ?></td>
                            <td><?php echo $row['start_date']; ?></td>
                            <td><?php echo $q5preshr = $row['Q5presrhr']; ?></td>

                            <td>
                                <?php echo $q2post = $row['Q2postsrhr'];
                                ?></td>
                            <td><?php
                                echo $q6pre = $row['Q6presrhr'];
                                ?></td>
                            <td><?php
                                echo $q3post = $row['Q3postsrhr'];

                                ?></td>
                        </tr>

                    <?php  } ?>
                </tbody>
                <tfoot>


                </tfoot>
            </table>
        </div>
        <?php if (isset($_POST['apply_limits'])) { ?>
            <script type="text/javascript">
                $(function() {
                    $('#graph').highcharts({
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: '<?php  ?> SRHR COMPARISON (PRE AND POST) Qn5 AND Qn2 FOR ALL PARTICIPANTS'
                        },
                        xAxis: {
                            categories: ['Pre SRHR SCORE', 'POST SRHR SCORE']
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Total Score'
                            }
                        },
                        legend: {
                            reversed: true
                        },
                        plotOptions: {
                            series: {
                                stacking: 'normal'
                            }
                        },
                        series: [{
                                name: 'Total Score',
                                color: '#0071de',
                                data: [<?php echo $q5preshr + $q6pre; ?>, <?php echo $q2post + $q3post; ?>]

                            }


                        ]
                    });
                });
            </script>

            <div class="col-md-12" id="graph" style="min-width:50%; max-width:95%; height:500px;">
            </div>
        <?php } ?>
    </div>
</div>