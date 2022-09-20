<div class="col-md-12" style=" background:white; border-radius: 5px;">
    <div id="sys_reports">
        <div class="box-header with-border">
            <h5 class="box-title">Reports</h5>
        </div>
        <div class="col-md-6">
            <div class="box-header with-border">
                <p class="box-title"><strong>Objectives Reports</strong></p>
            </div>
            <ol>
                <li><a href="dashboard.php?action=objective_activity">Activity per Objective</a>
                    <p class="my_desc"> - Shows all the Memprow Objectives and the main activities under them </p>
                </li>
                <li><a href="dashboard.php?action=summation_activities">Number of activities per Objective</a>
                    <p class="my_desc"> - Summation of of the number of general activities per objective</p>
                </li>
                <li><a href="dashboard.php?action=accomplished_obj">Accomplished Objectives</a>
                    <p class="my_desc"> - Shows the Objectives which have been marked as achieved and their details</p>
                </li>
                <li><a href="dashboard.php?action=pending_obj">Running /Active Objectives</a>
                    <p class="my_desc"> - Shows the objectives which are still active</p>
                </li>
                <div class="box-header with-border">
                    <p class="box-title"><strong>Activity Reports</strong></p>
                </div>
                <li><a href="dashboard.php?action=gender_dist">Gender Distribution</a>
                    <p class="my_desc"> Gender Distribution of Participants Per Actvity</p>
                </li>
                <li><a href="dashboard.php?action=age_dist">Age Group Distribution</a>
                    <p class="my_desc"> Age group Distribution by Actvity and Gender</p>
                </li>

                <li><a href="dashboard.php?action=field_activities_count_per_objective">Field Activities Count by Activity and Objective</a>
                    <p class="my_desc"> Shows the trainings conducted under each activity</p>
                </li>
                <li><a href="dashboard.php?action=count_field_participants">Field Trainings attended per Particiants</a>
                    <p class="my_desc"> Shows the number of trainings attended per participant</p>
                </li>
                <?php //<li><a href="dashboard.php?action=count_field_activities_tg"  >Number of Trainings by Training ground</a><p class="my_desc"> Shows the number of training conducted in each training ground</p></li>	
                ?>
                <li><a href="dashboard.php?action=field_activities_status">Field Activity Status Report</a>
                    <p class="my_desc"> Shows all activities and and their details</p>
                </li>

                <li><a href="dashboard.php?action=supervisor_contact_list">Supervisor Contact List</a>
                    <p class="my_desc">Shows Supervisors' name and conatct Information</p>
                </li>
                <li><a href="dashboard.php?action=participants_list">Participants Contact List</a>
                    <p class="my_desc">Phone Book and emailing list of all participants</p>
                </li>
                <li><a href="dashboard.php?action=profiled_participants">Profiled Particpants</a>
                    <p class="my_desc">Shows all participants who have been profiled. Allows you to load the person's profile by clicking on the person</p>
                </li>
            </ol>
        </div>
        <div class="col-md-6">
            <div class="box-header with-border">
                <p class="box-title"><strong>Evaluation reports</strong></p>
            </div>
            <ol>
                <div class="box-header with-border">
                    <p class="box-title"><strong>SRHR Reports</strong></p>
                </div>
                <li><a href="dashboard.php?action=srhr_comp">PRE SRHR and POST SRHR Comparison by Training</a> A comparison between Pre SRHR and Post SRHR evaluation</li>
                <li><a href="dashboard.php?action=srhr_comp_part">PRE SRHR and POST SRHR Comparison by Particiant</a> A comparison between Pre SRHR and Post SRHR evaluation</li>
                <li><a href="dashboard.php?action=#">PRE SRHR Training Analysis by Question</a> A comparison between Pre SRHR and Post SRHR evaluation</li>(Requirement-under- development)
                <li><a href="dashboard.php?action=#">POST SRHR Training Analysis by Question</a> A comparison between Pre SRHR and Post SRHR evaluation</li>(Requirement-under- development)

                <div class="box-header with-border">
                    <p class="box-title"><strong>SSST Reports</strong></p>
                </div>
                <li><a href="dashboard.php?action=ssst_comp">PRE SST and POST SST Comparison by Training</a> A comparison between Pre SST and Post SST evaluation by training</li>
                <li><a href="dashboard.php?action=ssst_comp_part">PRE SST and POST SST Comparison by Particiant</a> A comparison between Pre SST and Post SST evaluation by participant</li>
                <li><a href="dashboard.php?action=#">PRE SST Training Analysis by Question</a> A comparison between Pre SRHR and Post SRHR evaluation</li>(Requirement-under- development)
                <li><a href="dashboard.php?action=#">POST SST Training Analysis by Question</a> A comparison between Pre SRHR and Post SRHR evaluation</li>(Requirement-under- development)

                <div class="box-header with-border">
                    <p class="box-title"><strong>TEACHERS Reports</strong></p>
                </div>
                <li><a href="dashboard.php?action=teachers_comp">PRE Teachers and POST Teachers Comparison by Training</a>
                    <p class="my_desc"> A comparison between Pre Teachers and Post Teachers evaluation BY training</p>
                </li>
                <li><a href="dashboard.php?action=teachers_comp_part">PRE Teachers AND POST Teachers Comparison by Particiant</a>
                    <p class="my_desc"> A comparison between Pre Teachers and Post Teachers evaluation by participant</p>
                </li>
                <li><a href="dashboard.php?action=#">PRE Teachers Training Analysis by Question</a> A comparison between Pre SRHR and Post SRHR evaluation</li> (Requirement-under-development)
                <li><a href="dashboard.php?action=#">POST Teachers Training Analysis by Question</a> A comparison between Pre SRHR and Post SRHR evaluation</li> (Requirement-under-development)

                <div class="box-header with-border">
                    <p class="box-title"><strong>Other Reports</strong></p>
                </div>
                <li><a href="dashboard.php?action=person_profile">Person Profile</a>
                    <p class="my_desc">Takes you to the Information Capture using the profiling tool of a selected individual</p>
                </li>

            </ol>
        </div>
    </div>
</div>