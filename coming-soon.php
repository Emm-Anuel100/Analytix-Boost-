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
<body>
<div id="global-loader" >
<div class="whirly-loader"> </div>
</div>
	 <!-- Main Wrapper -->
     <div class="main-wrapper">
            <div class="comming-soon-pg w-100">
                <div class="coming-soon-box">
                    <div class="pos-logo">
                        <img src="assets/img/logo-small.png" alt="">
                    </div>
                    <span>Our Website is</span>
                    <h1><span> COMING </span> SOON </h1>
                    <p>Please check back later, We are working hard  to get everything  just  right.</p>
                    <ul class="coming-soon-timer">
                        <li><span class="days">54</span>days</li>
                        <li class="seperate-dot">:</li>
                        <li><span class="hours">10</span>Hrs</li>
                        <li class="seperate-dot">:</li>
                        <li><span class="minutes">47</span>Min</li>
                        <li class="seperate-dot">:</li>
                        <li><span class="seconds">00</span>Sec</li>
                    </ul>
                    <div class="subscribe-form">
                        <div class="mb-3">
                            <label class="form-label">Subscribe to get notified!</label>
                            <input type="email" class="form-control" placeholder="Enter Your Email">
                            <a href="" class="btn btn-primary subscribe-btn">Subscribe</a>
                        </div>
                    </div>
                    <ul class="social-media-icons">
                        <li><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="javascript:void(0);"><i class="fab fa-pinterest-p"></i></a></li>
                        <li><a href="javascript:void(0);"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Main Wrapper -->
    

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>