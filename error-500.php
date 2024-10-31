<?php 
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();



?>


<!DOCTYPE html>
<html lang="en">
<head>
 <?php include 'layouts/title-meta.php'; ?>
 <?php include 'layouts/head-css.php'; ?>
</head>
<body class="error-page">
<div id="global-loader" >
<div class="whirly-loader"> </div>
</div>
	  <!-- Main Wrapper -->
      <div class="main-wrapper">
            <div class="error-box">
				<div class="error-img">
                    <img src="assets/img/authentication/error-500.png" class="img-fluid" alt="">
                </div>
				<h3 class="h2 mb-3">Oops, something went wrong</h3>
				<p>Server Error 500. We apologise and are fixing the problem
                    Please try again at a  later stage</p>
                <a href="index.php" class="btn btn-primary">Back to Dashboard</a>
			</div>
        </div>
        <!-- /Main Wrapper -->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>