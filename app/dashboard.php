<?php
ini_set("date.timezone", "Africa/Kampala");

$action="";
if(isset($_GET['action']))
$action=$_GET['action'];
include_once("../init.php");
?>
<!DOCTYPE html>
<html>
<?php
      include_once("header_mobi.php");
      include_once("attendance/greeting.php");
					
	?>			
  <body class="hold-transition skin-red sidebar-mini" id="index" onload="startTime()">
    <div class="wrapper">

      <header class="static-top" style="position:fixed; margin:0 auto; width:100%; height:30px; z-index:5000">
        
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation" style="background-color:#7b9f0e; color:white;">
          <!-- Sidebar toggle button-->
          <a href="#" class="" data-toggle="offcanvas">
            <span class="" style="background:#000800; width:40px; height:40px; border-radius:2px; float:left;  margin-left:2px; margin-top:7px;"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu" style="background:#000800; color:#fff;    border-radius:2px;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 
                  <span class="" > <?php echo welcome();  ?> </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <p>
					<?php
					    $date = date('d/m/Y H:i:s');
						$q=10;
						$s=86400;
						$r=$q*$s;
						$timestamp=time('H:i:s'); //current timestamp
						$tm=$timestamp; // Will add 2 days to the $timestamp*/
						$da=date("d/m/Y", $timestamp);
						$today_mysql=date("Y/m/d", $timestamp);
						$thisyear=date("Y", $timestamp);

						?>
                      <small><?php echo $da;?></small>
					  <span id="txt1"></span>
			
</br></br>
     
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
					
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                   
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
    

      <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
		</section>
        <!-- Main content -->
		  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">

        <section class="content" >
	
		<style>
        .content{
		margin-top:20px;
	     min-height:760px;
	     background:#FEFFFF;
	     width:100%;
         overflow:auto;
          }
		   .noborder{
			 border:hidden;
			 font:1.5em;
			 
			 background:;
		  }
        </style>
           <?php
								if ($action=="home" OR $action=="clockin" OR $action=="")
								include_once("attendance/clockin.php");
								elseif($action=="clockout")
								include_once("attendance/clockout.php");
								?>
							
        <!-- /.content -->
       <!-- /.content-wrapper -->
	   </div>
	   </section>
      <footer class="main-footer"style="color:white;background-color:#7B9F0E; margin:0 auto; font-size:10px;">
        <strong>Copyright &copy; Agaba Andrew <?php echo date("Y").' ';?>Tel: 0702787688<a href="http://takenet.net" target="blank"> </a></strong> Developed by Agaba Andrew | Supported by Dr. Haruna Lule Senior HR Advisor IntraHealth International<version style="float:right;">Employee Tracking System</version>
      </footer>
	  
	 
  </body>
</html>
