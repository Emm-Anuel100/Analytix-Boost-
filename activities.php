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
	<!-- main Wrapper-->
    <div class="main-wrapper">
		<?php include 'layouts/menu.php'; ?>
		<div class="page-wrapper">
					<div class="content">
						<div class="page-header">
							<div class="page-title">
								<h4>All Notifications</h4>
								<h6>View your all activities</h6>
							</div>
						</div>
						<!-- /product list -->
						<div class="activity">
							<div class="activity-box">
								<ul class="activity-list">
									<li> 
										<div class="activity-user">
											<a href="profile.php" title="" data-toggle="tooltip"  data-original-title="Lesley Grauer">
												<img alt="Lesley Grauer" src="assets/img/customer/profile3.jpg" class=" img-fluid">
											</a>
										</div>
										<div class="activity-content">
											<div class="timeline-content">
												<a href="profile.php" class="name">Elwis Mathew </a> added a new product <a href="javascript:void(0);">Redmi Pro 7 Mobile</a>
												<span class="time">4 mins ago</span>
											</div>
										</div>
									</li>
									<li>
										<div class="activity-user">
											<a href="profile.php" title="" data-toggle="tooltip"   data-original-title="Lesley Grauer">
												<img alt="Lesley Grauer" src="assets/img/customer/profile4.jpg" class=" img-fluid">
											</a>
										</div>
										<div class="activity-content">
											<div class="timeline-content">
												<a href="profile.php" class="name">Elizabeth Olsen</a> added a new product category <a href="javascript:void(0);">Desktop Computers</a>
												<span class="time">6 mins ago</span>
											</div>
										</div>
									</li>
									<li>
										<div class="activity-user">
											<a href="profile.php" title="" data-toggle="tooltip"   data-original-title="Lesley Grauer">
												<img alt="Lesley Grauer" src="assets/img/customer/profile5.jpg" class=" img-fluid">
											</a>
										</div>
										<div class="activity-content">
											<div class="timeline-content">
												<div class="timeline-content">
													<a href="profile.php" class="name">William Smith</a> added a new sales list for<a href="javascript:void(0);">January Month</a>
													<span class="time">12 mins ago</span>
												</div>
											</div>
										</div>
									</li>
									<li>
										<div class="activity-user">
											<a href="profile.php" title="" data-toggle="tooltip"   data-original-title="Lesley Grauer">
												<img alt="Lesley Grauer" src="assets/img/customer/customer4.jpg" class=" img-fluid">
											</a>
										</div>
										<div class="activity-content">
												<div class="timeline-content">
													<a href="profile.php" class="name">Lesley Grauer</a> has updated invoice <a href="javascript:void(0);">#987654</a>
													<span class="time">4 mins ago</span>
												</div>
										</div>
									</li>
									<li> 
										<div class="activity-user">
											<a href="profile.php" title="" data-toggle="tooltip"  data-original-title="Lesley Grauer">
												<img alt="Lesley Grauer" src="assets/img/customer/profile3.jpg" class=" img-fluid">
											</a>
										</div>
										<div class="activity-content">
											<div class="timeline-content">
												<a href="profile.php" class="name">Elwis Mathew </a> added a new product <a href="javascript:void(0);">Redmi Pro 7 Mobile</a>
												<span class="time">4 mins ago</span>
											</div>
										</div>
									</li>
									<li>
										<div class="activity-user">
											<a href="profile.php" title="" data-toggle="tooltip"   data-original-title="Lesley Grauer">
												<img alt="Lesley Grauer" src="assets/img/customer/profile4.jpg" class=" img-fluid">
											</a>
										</div>
										<div class="activity-content">
											<div class="timeline-content">
												<a href="profile.php" class="name">Elizabeth Olsen</a> added a new product category <a href="javascript:void(0);">Desktop Computers</a>
												<span class="time">6 mins ago</span>
											</div>
										</div>
									</li>
									<li>
										<div class="activity-user">
											<a href="profile.php" title="" data-toggle="tooltip"   data-original-title="Lesley Grauer">
												<img alt="Lesley Grauer" src="assets/img/customer/profile5.jpg" class=" img-fluid">
											</a>
										</div>
										<div class="activity-content">
											<div class="timeline-content">
												<div class="timeline-content">
													<a href="profile.php" class="name">William Smith</a> added a new sales list for<a href="javascript:void(0);">January Month</a>
													<span class="time">12 mins ago</span>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<!-- /product list -->
					</div>
		</div>		
	</div>
	<!-- end main Wrapper-->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>