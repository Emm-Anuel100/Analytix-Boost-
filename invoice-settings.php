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
									<form action="invoice-settings.php">
										<div class="setting-title">
											<h4>Invoice Settings</h4>
										</div>
										<div class="company-info border-0">
											<ul class="logo-company">
												<li>
													<div class="row">
														<div class="col-md-4">
															<div class="logo-info me-0 mb-3 mb-md-0">
																<h6>Invoice Logo</h6>
																<p>Upload Logo of your Company to display in Invoice</p>
															</div>
														</div>
														<div class="col-md-6">
															<div class="profile-pic-upload mb-0 me-0">
																<div class="new-employee-field">
																	<div class="mb-3 mb-md-0">
																		<div class="image-upload mb-0">
																			<input type="file">
																			<div class="image-uploads">
																				<h4><i data-feather="upload"></i>Upload Photo</h4>
																			</div>
																		</div>
																		<span>For better preview recommended size is 450px x 450px. Max size 5mb.</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-2">
															<div class="new-logo ms-auto">
																<a href="#"><img src="assets/img/logo-small.png" alt="Logo"></a>
															</div>
														</div>
													</div>																								
												</li>
											</ul>
											<div class="localization-info">
												<div class="row align-items-center">
													<div class="col-sm-4">
														<div class="setting-info">
															<h6>Invoice Prefix</h6>
															<p>Add prefix to your invoice</p>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="localization-select">
															<input type="text" class="form-control" value="INV -">
														</div>
													</div>
												</div>
												<div class="row align-items-center">
													<div class="col-sm-4">
														<div class="setting-info">
															<h6>Invoice Due</h6>
															<p>Select due date  to display in Invoice</p>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="localization-select d-flex align-items-center fixed-width">
															<select class="select">
																<option>5</option>
																<option>6</option>
																<option>7</option>
															</select>
															<span class="ms-2">Days</span>
														</div>
													</div>
												</div>
												<div class="row align-items-center">
													<div class="col-sm-4">
														<div class="setting-info">
															<h6>Invoice Round Off</h6>
															<p>Value Roundoff in Invoice</p>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="localization-select d-flex align-items-center width-custom">
															<div class="status-toggle modal-status d-flex justify-content-between align-items-center me-3">
																<input type="checkbox" id="user3" class="check" checked>
																<label for="user3" class="checktoggle"></label>
															</div>
															<select class="select">
																<option>Round Off Up</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row align-items-center">
													<div class="col-sm-4">
														<div class="setting-info">
															<h6>Show Company Details</h6>
															<p>Show / Hide Company Details in Invoice</p>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="localization-select d-flex align-items-center">
															<div class="status-toggle modal-status d-flex justify-content-between align-items-center me-3">
																<input type="checkbox" id="user4" class="check" checked>
																<label for="user4" class="checktoggle"></label>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<div class="setting-info">
															<h6>Invoice Header Terms</h6>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="mb-3">
															<textarea  rows="4" class="form-control" placeholder="Type your message"></textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<div class="setting-info">
															<h6>Invoice Footer Terms</h6>
														</div>
													</div>
													<div class="col-sm-8">
														<div class="mb-3">
															<textarea  rows="4" class="form-control" placeholder="Type your message"></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer-btn">
											<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
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