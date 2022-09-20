<?php
session_start();
ini_set("date.timezone", "Africa/Kampala");

if (!isset($_SESSION['id']) && ($_SESSION['usertype'] != 'admin' || $_SESSION['usertype'] != 'hr' || $_SESSION['usertype'] != 'data')) { // if session variable "username" does not exist.
	header("location:index.php?msg=Please%20login%20to%20access%20the%20dashboard%20error!%20!"); // Re-direct to index.php
}

$action = "";
$msg = "";
if (isset($_GET['action']))
	if (isset($_GET['action']))
		$action = $_GET['action'];
include_once("init.php");
?>
<?php $u = $sis['username'];
$line = $db->queryUniqueObject("SELECT * FROM users WHERE `username`='$u'"); ?>
<!DOCTYPE html>
<html>
<?php
include_once("engine/header.php");
?>

<body class="fixed hold-transition skin-red sidebar-fixed sidebar-min " id="index" onload="startTime()">
	<div class="wrapper">

		<header class="main-header static-top">
			<!-- Logo -->
			<a href="" class="logo" style="background:url(images/header_title.png) 0 0 repeat-x; color:white; background-color:#8c1414;">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b><img src="images/logo.jpg" class="img img-circle" width="70" height="50" /></b></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation" style="background:url(images/header_bg.png) 0 0; color:white;">
				<!-- Sidebar toggle button-->
				<a href="#" class="" data-toggle="offcanvas">
					<span class="" style="background: url(images/scale.png) no-repeat; width:40px; height:40px; float:left; margin-left:2px; margin-top:7px;"></span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background:#000024;">
								<img src="dist/img/login.png" class="user-image" alt="">
								<span class="hidden-xs"><?php echo "Sign Out ";
														echo $fu = $line->lname;
														echo " ";
														echo $fu = $line->fname; ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<p>
										<?php
										$date = date('d/m/Y H:i:s');
										$q = 10;
										$s = 86400;
										$r = $q * $s;
										$timestamp = time('H:i:s'); //current timestamp
										$tm = $timestamp; // Will add 2 days to the $timestamp*/
										$da = date("d/m/Y", $timestamp);
										$today_mysql = date("Y/m/d", $timestamp);
										$thisyear = date("Y", $timestamp);

										?>
										<small><?php echo $da; ?></small>
										<span id="txt1"></span>

										</br></br>
										<?php echo $fu = $line->lname;
										echo " ";
										echo $fu = $line->fname;
										$uploader = $line->lname . " " . $line->fname;
										$uuid = $suid = $line->uuid;

										?>
									</p>
								</li>
								<!-- Menu Body -->
								<li class="user-body">
									<div class="col-xs-4 text-center">
										<form class="form-inline" action="" method="post">
											<select class="form-control" name="language" onchange='this.form.submit()'>
												<option>Select Language</option>
												<option value="en_us.php" selected>English</option>

											</select>
										</form>
									</div>
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="?action=change_pwd" class="btn btn-default">Change Password</a>
									</div>
									<div class="pull-right">
										<a href="logout.php" class="btn btn-default">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
						<!-- Control Sidebar Toggle Button -->
						<li>
							<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel" style="font-size:0.9em; font-weight:bold; color:#FFFFFF; z-index:2;">
					<p class="pull-left image">MEMPROW MIS </p>
				</div>
				<ul class="sidebar-menu" style="">
					<?php if ($action == "home" or $action == "") {
						echo '<li class="active treeview">';
					} else {
						echo '<li class="treeview">';
					} ?>
					<a href="?action=home">
						<i class="glyphicon glyphicon-dashboard" style="color:lightblue;"></i><span>Dashboard</span>
					</a>
					</li>
					<?php if ($action == "search") {
						echo '<li class="active treeview">';
					} else {
						echo '<li class="treeview">';
					} ?>
					<a href="?action=search">
						<i class="glyphicon glyphicon-search" style="color:lightblue;"></i>
						<span>Search Activities</span>
						<span class="label label-primary pull-right"></span>
					</a>
					</li>
					<?php if ($action == "start_activity" or $action == "manage_field_activities") {
						echo '<li class="active treeview">';
					} else {
						echo '<li class="treeview">';
					} ?>
					<?php if ($_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'hr') {
						echo '<a href="?action=start_activity">
                <i class="glyphicon glyphicon-refresh" style="color:lightblue;"></i>
               <span>Field Activities</span><i class="fa fa-angle-left pull-right"></i>
                <span class="label label-primary"></span>
              </a>
			  <ul class="treeview-menu">
                <li class=""><a href="?action=start_activity"><i class="fa fa-circle-o"></i>Start New Activity</a></li>
				<li class=""><a href="dashboard.php?action=manage_field_activities"><i class="fa fa-circle-o"></i>Manage Field Activities</a></li>
			  </ul>
            </li>';
					}
					?>
					<?php if ($action == "view_participants" or $action == "add_participants" or $action == "add_supervisor" or $action == "add_supervisor") {
						echo '<li class="active treeview">';
					} else {
						echo '<li class="treeview">';
					} ?>
					<a href="?action=add_participants">
						<i class="glyphicon glyphicon-user" style="color:lightblue;"></i>
						<span>Manage People</span>
						<i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<li class=""><a href="dashboard.php?action=add_participants"><i class="fa fa-circle-o"></i>Register New Participant</a></li>
						<li class=""><a href="dashboard.php?action=view_participants"><i class="fa fa-circle-o"></i>Manage Participants</a></li>
						<li class=""><a href="dashboard.php?action=add_supervisors"><i class="fa fa-circle-o"></i>Register New Supervisor</a></li>
						<li class=""><a href="dashboard.php?action=view_supervisors"><i class="fa fa-circle-o"></i>Manage Supervisors</a></li>
					</ul>
					</li>
					<?php if ($action == "profile") {
						echo '<li class="active treeview">';
					} else {
						echo '<li class="treeview">';
					} ?>
					<a href="?action=profile">
						<i class="fa fa-child" style="color:lightblue;"></i>
						<span>Profile</span>
						<span class="label label-primary pull-right"></span>
					</a>
					</li>

					<?php if ($action == "import") {
						echo '<li class="active treeview">';
					} else {
						echo '<li class="treeview">';
					} ?>
					<?php
					// access control
					if ($_SESSION['usertype'] == 'super_admin') {
						echo '<a href="?action=import">
                <i class="glyphicon glyphicon-upload" style="color:lightblue;"></i>
               <span>Upload Participants</span>
                <span class="label label-primary pull-right"></span>
              </a>
             </li>';
					}
					//end acces-control
					?>

					<?php if ($action == "reports") {
						echo '<li class="active treeview">';
					} else {
						echo '<li class="treeview">';
					} ?>
					<a href="?action=reports">
						<i class="glyphicon glyphicon-book" style="color:lightblue;"></i>
						<span>Reports</span>
						<span class="label label-primary pull-right"></span>
					</a>
					</li>

					<?php if ($action == "users" or $action == "jobs" or $action == "user_logs" or $action == "manage_objectives" or $action == "manage_activities" or $action == "manage_donors" or $action == "grounds" or $action == "manage_locations") {
						echo '<li class="active treeview">';
					} else {
						echo '<li class="treeview">';
					} ?>
					<a href="?action=grounds">
						<i class="glyphicon glyphicon-cog" style="color:lightblue;"></i>
						<span class="">System Settings</span><i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<?php if ($_SESSION['usertype'] == 'admin') {
							echo '
			    <li><a href="?action=users"><i class="fa fa-circle-o"></i>Manage Users</a></li>
		        <li><a href="?action=jobs"><i class="fa fa-circle-o"></i>Manage Designations</a></li>
                <li><a href="?action=manage_objectives"><i class="fa fa-circle-o"></i>Manage Objectives</a></li>
				<li><a href="?action=manage_activities"><i class="fa fa-circle-o"></i>Manage Activities</a></li>
				<li><a href="?action=manage_donors"><i class="fa fa-circle-o"></i>Manage Donors</a></li>
                <li><a href="?action=grounds"><i class="fa fa-circle-o"></i>Manage Training Grounds</a></li>
				<li><a href="?action=manage_locations"><i class="fa fa-circle-o"></i>Manage Locations</a></li>';
						} else {
							echo '
				<li><a href="?action=jobs"><i class="fa fa-circle-o"></i>Manage Occupations</a></li>
				<li><a href="?action=manage_objectives"><i class="fa fa-circle-o"></i>Manage Objectives</a></li>
                <li><a href="?action=manage_districts"><i class="fa fa-circle-o"></i>Manage Activities</a></li>
                <li><a href="?action=grounds"><i class="fa fa-circle-o"></i>Manage Training Grounds</a></li>
				<li><a href="?action=manage_districts"><i class="fa fa-circle-o"></i>Manage Locations</a></li>';
						}
						?>

					</ul>
					</li>

					<?php if ($action == "change_pwd") {
						echo '<li class="active treeview">';
					} else {
						echo '<li class="treeview">';
					} ?>
					<a href="?action=change_pwd">
						<i class="glyphicon glyphicon-lock" style="color:lightblue;"></i>
						<span>Change Password</span>
						<span class="label label-primary pull-right"></span>
					</a>
					</li>
				</ul>
			</section>
			<!-- End of side .sidebar menu -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			</section>
			<!-- Main content -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


			<link rel="stylesheet" type="text/css" href="css/tables/normalize.css" />


			<section class="content">
				<style>
					.content {
						min-height: 640px;
						background: #FEFFFF;
						width: 98%;
						overflow: auto;
					}

					.noborder {
						border: hidden;
						font: 1.5em;

					}

					@media print {
						a:after {
							content: '';
						}

						a[href]:after {
							content: none !important;
						}

						@page {
							margin: 1.5;
						}
					}
				</style>


				<?php
				if ($action == "home" or $action == "")
					include("modules/home.php");
				elseif ($action == "start_activity")
					include_once("modules/start_activity/init.php");
				elseif ($action == "attach_participants")
					include_once("modules/start_activity/attach_participants.php");
				elseif ($action == "finish")
					include_once("modules/start_activity/finish_set.php");
				elseif ($action == "evaluate")
					include_once("modules/start_activity/evaluation.php");
				elseif ($action == "manage_field_activities")
					include_once("modules/start_activity/manage_field_activities.php");
				elseif ($action == "profile")
					include_once("modules/start_activity/profile.php");
				elseif ($action == "search")
					include_once("modules/start_activity/search_activitiesa.php");
				//dependencies for Participants
				elseif ($action == "add_participants")
					include_once("modules/participants/initialise.php");
				elseif ($action == "view_participants")
					include_once("modules/participants/view_participants.php");

				//dependencies for Participants
				elseif ($action == "add_supervisors")
					include_once("modules/supervisors/initialise.php");
				elseif ($action == "view_supervisors")
					include_once("modules/supervisors/view_supervisors.php");
				elseif ($action == "import")
					include_once("modules/import/import.php");
				//dependencies for the reports module
				elseif ($action == "reports")
					include_once("modules/reports/home_reports.php");
				elseif ($action == "objective_activity")
					include_once("modules/reports/activities_per_objective.php");
				elseif ($action == "summation_activities")
					include_once("modules/reports/activities_count_per_objective.php");
				elseif ($action == "count_field_activities")
					include_once("modules/reports/field_activities_activity.php");
				elseif ($action == "accomplished_obj")
					include_once("modules/reports/accomplished_obj.php");
				elseif ($action == "pending_obj")
					include_once("modules/reports/pending_objectives.php");
				elseif ($action == "gender_dist")
					include_once("modules/reports/gender_dist.php");
				elseif ($action == "age_dist")
					include_once("modules/reports/age_group_dist.php");
				elseif ($action == "view_participants_list")
					include_once("modules/reports/participants_list.php");
				elseif ($action == "field_activities_count_per_objective")
					include_once("modules/reports/field_activities_count_per_objective.php");
				elseif ($action == "count_field_participants")
					include_once("modules/reports/count_field_participants.php");
				elseif ($action == "field_activities_status")
					include_once("modules/reports/field_activities_status.php");
				elseif ($action == "supervisor_contact_list")
					include_once("modules/reports/supervisor_contact_list.php");
				elseif ($action == "participants_list")
					include_once("modules/reports/participants_contact_list.php");
				elseif ($action == "profiled_participants")
					include_once("modules/reports/profiled_participants.php");
				//me$E reports
				elseif ($action == "srhr_comp")
					include_once("modules/reports/evaluation/pre_and_pos_srhr_comp.php");
				elseif ($action == "ssst_comp")
					include_once("modules/reports/evaluation/pre_and_pos_sst_comp.php");
				elseif ($action == "teachers_comp")
					include_once("modules/reports/evaluation/pre_and_pos_teachers_comp.php");
				elseif ($action == "srhr_comp_part")
					include_once("modules/reports/evaluation/pre_and_pos_srhr_comp_part.php");
				elseif ($action == "ssst_comp_part")
					include_once("modules/reports/evaluation/pre_and_pos_sst_comp_part.php");
				elseif ($action == "teachers_comp_part")
					include_once("modules/reports/evaluation/pre_and_pos_teachers_comp_part.php");
				elseif ($action == "person_profile")
					include_once("modules/reports/evaluation/profile_report.php");
				//dependencies for the m&e module
				elseif ($action == "evaluation")
					include_once("modules/evaluation/evaluation.php");
				//users
				elseif ($action == "users")
					include_once("modules/users/manage_users.php");
				elseif ($action == "user_logs")
					include_once("modules/users/user_logs.php");
				//forms data
				//Objectives
				elseif ($action == "manage_objectives" or $action == "objectives")
					include_once("modules/forms_data/objectives/manage_objectives.php");
				//activities
				elseif ($action == "manage_activities" or $action == "activities")
					include_once("modules/forms_data/activities/manage_activities.php");
				//donors
				elseif ($action == "manage_donors" or $action == "donors")
					include_once("modules/forms_data/donors/manage_donors.php");
				//training_grounds
				elseif ($action == "manage_grounds" or $action == "grounds")
					include_once("modules/forms_data/training_grounds/manage_grounds.php");
				//districts
				elseif ($action == "manage_locations" or $action == "locations")
					include_once("modules/forms_data/district/manage_district.php");
				//jobs
				elseif ($action == "jobs" or $action == "manage_jobs")
					include_once("modules/forms_data/jobs/manage_jobs.php");
				//district
				elseif ($action == "district" or $action == "manage_districts")
					include_once("modules/forms_data/district/manage_district.php");
				//fac
				elseif ($action == "facilities" or $action == "manage_facilities")
					include_once("modules/forms_data/facilities/manage_facility.php");
				//change_pwd
				elseif ($action == "change_pwd")
					include_once("modules/universal_funcs/change_password.php");
				?>

			</section><!-- /.content -->
		</div><!-- /.content-wrapper -->

		<!-- Daterange picker -->
		<script src="plugins/select2/select2.full.min.js"></script>
		<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/app.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="dist/js/pages/dashboard.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<footer class="main-footer" style="background:url(images/header_bg.png) 0 0 repeat-x; color:white;font-size:10px; margin-bottom:0px;">
			<strong>Copyright &copy; Memprow <?php echo date("Y") . " "; ?> <a href="http://takenet.net" target="blank"> </a> </strong> All rights reserved <version style="float:right;"></version>
		</footer>
</body>

</html>