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
										<h4>Preference</h4>
									</div>
									<div class="row">
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
											<div class="connected-app-card">
												<ul>
													<li>
														<div class="security-type">
															<div class="security-title">
																<h5>Maintenance Mode</h5>
															</div>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user1" class="check" checked>
															<label for="user1" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
											<div class="connected-app-card">
												<ul>
													<li>
														<div class="security-type">
															<div class="security-title">
																<h5>Copoun</h5>
															</div>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user2" class="check" checked>
															<label for="user2" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
											<div class="connected-app-card">
												<ul>
													<li>
														<div class="security-type">
															<div class="security-title">
																<h5>Offers</h5>
															</div>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user3" class="check" checked>
															<label for="user3" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
											<div class="connected-app-card">
												<ul>
													<li>
														<div class="security-type">
															<div class="security-title">
																<h5>MultiLanguage</h5>
															</div>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user4" class="check" checked>
															<label for="user4" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
											<div class="connected-app-card">
												<ul>
													<li>
														<div class="security-type">
															<div class="security-title">
																<h5>Multicurrency</h5>
															</div>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user5" class="check" checked>
															<label for="user5" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
											<div class="connected-app-card">
												<ul>
													<li>
														<div class="security-type">
															<div class="security-title">
																<h5>SMS</h5>
															</div>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user6" class="check" checked>
															<label for="user6" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
											<div class="connected-app-card">
												<ul>
													<li>
														<div class="security-type">
															<div class="security-title">
																<h5>Stores</h5>
															</div>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user7" class="check" checked>
															<label for="user7" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
											<div class="connected-app-card">
												<ul>
													<li>
														<div class="security-type">
															<div class="security-title">
																<h5>Warehouses</h5>
															</div>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user8" class="check" checked>
															<label for="user8" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
											<div class="connected-app-card">
												<ul>
													<li>
														<div class="security-type">
															<div class="security-title">
																<h5>Barcode</h5>
															</div>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user9" class="check" checked>
															<label for="user9" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
											<div class="connected-app-card">
												<ul>
													<li>
														<div class="security-type">
															<div class="security-title">
																<h5>QR Code</h5>
															</div>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user10" class="check" checked>
															<label for="user10" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
											<div class="connected-app-card">
												<ul>
													<li>
														<div class="security-type">
															<div class="security-title">
																<h5>HRMS</h5>
															</div>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user11" class="check" checked>
															<label for="user11" class="checktoggle">	</label>
														</div>
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

		<?php include 'layouts/customizer.php'; ?>	
		<?php include 'layouts/vendor-scripts.php'; ?>	
    </body>
</html>