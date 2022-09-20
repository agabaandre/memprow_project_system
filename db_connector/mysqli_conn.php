<?php
$dbcon = mysqli_connect("localhost","memprow_meuser","zX#pAxzRt!","memprow_projects",'3306');

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
