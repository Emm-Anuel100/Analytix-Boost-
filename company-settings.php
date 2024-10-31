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
											<h4>Company Settings</h4>
										</div>
										<div class="company-info">
											<div class="card-title-head">
												<h6><span><i data-feather="zap"></i></span>Company Information</h6>
											</div>
											<div class="row">
												<div class="col-xl-4 col-lg-6 col-md-4">
													<div class="mb-3">
														<label class="form-label">Company Name</label>
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="col-xl-4 col-lg-6 col-md-4">
													<div class="mb-3">
														<label class="form-label">Company Email Address</label>
														<input type="email" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="mb-3">
														<label class="form-label">Phone Number</label>
														<input type="number" class="form-control" min="1">
													</div>
												</div>
												<div class="col-md-4">
													<div class="mb-3">
														<label class="form-label">Fax</label>
														<input type="number" class="form-control" min="1">
													</div>
												</div>
											</div>
										</div>
										<div class="company-info company-images">
											<div class="card-title-head">
												<h6><span><i data-feather="image"></i></span>Company Image</h6>
											</div>
											<ul class="logo-company">
												<li class="d-flex align-items-center">
													<div class="logo-info">
														<h6>Company Logo</h6>
														<p>Upload Logo of your Company to display in invoice</p>
													</div>
													<div class="profile-pic-upload mb-0">
														<div class="new-employee-field">
															<div class="mb-0">
																<div class="image-upload mb-0">
																	<input type="file">
																	<div class="image-uploads">
																		<h4><i data-feather="upload"></i>Upload Photo</h4>
																	</div>
																</div>
																<span>For better preview recommended size is 450px x 450px. Max size 50KB.</span>
															</div>
														</div>
													</div>
													<div class="new-logo ms-auto">
														<a href="#"><img src="assets/img/logo-small.png" alt="Logo"></a>
													</div>
												</li>
											</ul>
										</div>
										<div class="company-address">
											<div class="card-title-head">
												<h6><span><i data-feather="map-pin"></i></span>Address</h6>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="mb-3">
														<label class="form-label">Address</label>
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="col-xl-3 col-lg-4 col-md-3">
													<div class="mb-3">
														<label class="form-label">Country</label>
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="col-xl-3 col-lg-4 col-md-3">
													<div class="mb-3">
														<label class="form-label">State / Province</label>
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="col-xl-3 col-lg-4 col-md-3">
													<div class="mb-3">
														<label class="form-label">City</label>
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="col-xl-3 col-lg-4 col-md-3">
													<div class="mb-3">
														<label class="form-label">Postal Code</label>
														<input type="text" class="form-control">
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer-btn">
											<button type="reset" class="btn btn-cancel me-2" data-bs-dismiss="modal">Reset</button>
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