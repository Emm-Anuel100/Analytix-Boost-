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
				<div class="content settings-content">
					<div class="page-header settings-pg-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Settings</h4>
								<h6>Manage your settings on portal</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-xl-12">
							 <div class="settings-wrapper d-flex">
								
							 <?php include 'layouts/settings-sidebar.php'; ?>
								<div class="settings-page-wrap">

									<form action="#" method="post">
										<div class="setting-title">
											<h4>Countdown Settings</h4>
										</div>
										<div class="card-title-head">
											<h6><span><i data-feather="user" class="feather-chevron-up"></i></span>Expiry Countdown</h6>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="mb-3">
													<label class="form-label">Countdown in days</label>
													<input type="number" class="form-control" required min="1" placeholder="20">
												</div>
											</div>
										</div> <br />

										<div class="card-title-head">
											<h6><span><i data-feather="user" class="feather-chevron-up"></i></span>Low Stocks Threshold</h6>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="mb-3">
													<label class="form-label">Low Stock Threshold</label>
													<input type="number" class="form-control" required min="1" placeholder="10">
												</div>
											</div>
										</div>

										<div class="text-end settings-bottom-btn">
											<button type="reset" class="btn btn-cancel me-2">Reset</button>
											<button type="submit" class="btn btn-submit">Save Changes</button>
										</div>
									</form>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
    </div>
<!-- end main Wrapper-->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>