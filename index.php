<?php
session_start();
if (!include_once("db_connector/mysqli_conn.php")) {
	echo "Database Connector Missing";
}
if (isset($_SESSION['user_data'])) {
	header("location:dashboard.php"); // Re-direct to index.php
}
?>
<?php
$tbl_name = "users"; // Table name

// username and password sent from form 
@$myusername = $_REQUEST['username'];
@$password = $_REQUEST['password'];
@$mypassword = $password;

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($dbcon, $myusername);
$mypassword = mysqli_real_escape_string($dbcon, $mypassword);
$mypassword_enc = sha1(md5($mypassword));

$sql = "SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword_enc' and flag=1";
$result = mysqli_query($dbcon, $sql);

// Mysql_num_row is counting table row
$count = mysqli_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if ($count == 1) {
	// Register $myusername, $mypassword and redirect to file "dashboard.php"
	$row = mysqli_fetch_array($result);

	//print_r($row);

	$_SESSION['user_data'] = $row;

	$action = $_SESSION['user_data']['lname'] . " " . $_SESSION['user_data']['fname'] . " logged In As " . $_SESSION['user_data']['user_type'] . " user";

	if ($row[3] == "admin") {
		$sql = mysqli_query($dbcon, "INSERT INTO `user_system_log` (`id`, `uuid`, `time`, `actions`) VALUES (NULL, '$id', CURRENT_TIMESTAMP, '$action')");
		header("location:dashboard.php");
	} else if ($row[3] == "hr") {
		$sql = mysqli_query($dbcon, "INSERT INTO `user_system_log` (`id`, `uuid`, `time`, `actions`) VALUES (NULL, '$id', CURRENT_TIMESTAMP, '$action')");
		header("location:dashboard.php");
	} else if ($row[3] == "data") {
		$sql = mysqli_query($dbcon, "INSERT INTO `user_system_log` (`id`, `uuid`, `time`, `actions`) VALUES (NULL, '$id', CURRENT_TIMESTAMP, '$action')");
		header("location:dashboard.php");
	} else {
		header("location:index.php?msg=Wrong Password or Username! Contact the Systems Admin");
	}
} else {
	/*echo $msg='<div class="alert alert-warning alert-dismissable">
                   <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Wrong Password or Username! Contact the Systems Admin</strong>
                   </div>';*/
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Memprow MIS</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
	<div class="wrap" style="margin-top:-120px;">
		<!-- strat-contact-form -->
		<div class="contact-form">

			<!-- start-form -->
			<form class="contact_form" action="#" method="post" name="contact_form">
				<h1><b>MEMPROW System Login</b></h1>
				<div class="">
					<?php
					if (isset($_GET['msg'])) {
						$print_msg = $_GET['msg'];


						echo '<div class="alert alert-danger alert-dismissable">
                  <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>' . $print_msg . '</strong>
                  </div>';
					}
					?>
				</div>
				<div class="" style="margin-top: 15px;">

					<input type="username" class="form-control" name="username" id="username" placeholder="Username" required style="width:100%; height:50px;" />
					<span class="form_hint">Enter a valid Username</span>
					<p><img src="" alt=""></p>
				</div>
				<div class="" style="margin-top: 15px;">

					<input type="password" name="password" class="form-control" id="password" placeholder="Password" style="width:100%; height:50px;" required>
					<span class="form_hint">Enter a valid Password</span>
					<p><img src="" alt=""></p>
				</div>
				<div class="">

					<input type="submit" name="Sign In" value="Sign In" />
					<div class="clear"></div>
					<label class="checkbox"><input type="checkbox" name="checkbox" checked><i></i>Remember me</label>
				</div>
				<div class="forgot">
					<a href="#">forgot password?</a>
				</div>
				<div class="clear"></div>

			</form>
			<!-- end-form -->
			<!-- start-account -->
			<div class="account" style="border-radius:5px;">

				<img src="images/memprow_banner.PNG" style="border-radius:5px; margin:2px; width:250px;height:200px; border:#fff 1px solid;">
				<h4 style="clear:both;text-algin:centre;"></h4>
			</div>
			<!-- end-account -->
			<div class="clear"></div>
		</div>
		<!-- end-contact-form -->
		<div class="footer">
			<p> <span class="powered">
					<span class="ticket-color"></span>
					<span class="simply_color"><small>™</small></span>
					</a>
				</span><span class="maintained_by">
					<a href="http://www.takent.net">
						<span class="bitla_color"><small>™</small></span>
					</a>
				</span></a></p>
			<p><strong>Copyright &copy; Memprow <?php echo date("Y"); ?> <a href="http://takenet.net" target="blank"> </a></strong>
				<version style="float:right;">Memprow Information Management System V 1.0</version>
			</p>
		</div>
	</div>
</body>

</html>