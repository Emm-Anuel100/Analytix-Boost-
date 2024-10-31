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
									<div class="setting-title">
										<h4>Storage</h4>
									</div>

									<div class="row">
										<div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100 d-flex justify-content-between align-items-center">
													<li class="storage-icon mb-0">
														<span class="system-app-icon">
															<img src="assets/img/icons/storage-icon-01.svg" alt="">
														</span>
														<h6>Local Storage</h6>
													</li>
													<!-- <li class="setting-gateway d-flex align-items-center">
														<a href="javascript:void(0);"></a>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user1" class="check" checked>
															<label for="user1" >	</label>
														</div>	
													</li> -->
												</ul>
												
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100 d-flex justify-content-center align-items-center">
													<li class="storage-icon mb-0">
														<span class="system-app-icon">
															<img src="assets/img/icons/storage-icon-02.svg" alt="">
														</span>
														<h6>AWS</h6> 
													</li>
													<li class="setting-gateway d-flex align-items-center">
														<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#aws-config"><i data-feather="settings" class="me-2 m-2"></i></a>
														<!-- <div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user2" class="check" checked>
															<label for="user2" class="checktoggle">	</label>
														</div> -->
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<!-- Aws Config -->
		<div class="modal fade" id="aws-config">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>AWS Settings</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">

								<form action="#" method="post">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">AWS Access Key <span> *</span></label>
												<input type="text" class="form-control" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Secret Key <span> *</span></label>
												<input type="text" class="form-control" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label"> Bucket Name <span> *</span></label>
												<input type="text" class="form-control" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label"> Region <span> *</span></label>
												<input type="text" class="form-control" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-0">
												<label class="form-label"> Base URL <span> *</span></label>
												<input type="text" class="form-control" required>
											</div>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="Reset" class="btn btn-cancel me-2">Reset</button>
										<button type="submit" class="btn btn-submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Aws Config -->

		<?php include 'layouts/customizer.php'; ?>

		<?php include 'layouts/vendor-scripts.php'; ?>
	
    </body>
</html>