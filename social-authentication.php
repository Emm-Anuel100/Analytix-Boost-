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
										<h4>System Settings</h4>
									</div>
									<div class="row social-authent-settings">
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100">
															<div class="security-type d-flex align-items-center">
																<span class="system-app-icon">
																	<img src="assets/img/icons/fb-icon.svg" alt="">
																</span>
																<div class="security-title">
																	<h5>Facebook</h5>
																</div>
															</div>
															<div class="connect-btn">
																<a href="javascript:void(0);">Connected</a>
															</div>
														</div>
														<p>Connect with friends, family and other people you know.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#fb-connect"><i data-feather="tool" class="me-2"></i>View Integration</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user1" class="check" checked>
															<label for="user1" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100">
															<div class="security-type d-flex align-items-center">
																<span class="system-app-icon">
																	<img src="assets/img/icons/twitter-icon.svg" alt="">
																</span>
																<div class="security-title">
																	<h5>Twitter</h5>
																</div>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>Communicate and stay connected through the exchange of quick, frequent messages</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#twitter-connect"><i data-feather="tool" class="me-2"></i>Connect Now</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user2" class="check" checked>
															<label for="user2" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100">
															<div class="security-type d-flex align-items-center">
																<span class="system-app-icon">
																	<img src="assets/img/icons/google-icon.svg" alt="">
																</span>
																<div class="security-title">
																	<h5>Google</h5>
																</div>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>Google has many special features to help you find exactly what you're looking for.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#google-connect"><i data-feather="tool" class="me-2"></i>Connect Now</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user3" class="check" checked>
															<label for="user3" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100">
															<div class="security-type d-flex align-items-center">
																<span class="system-app-icon">
																	<img src="assets/img/icons/linkedin-icon.svg" alt="">
																</span>
																<div class="security-title">
																	<h5>Linkedin</h5>
																</div>
															</div>
															<div class="connect-btn">
																<a href="javascript:void(0);">Connected</a>
															</div>
														</div>
														<p>Network with people and professional organizations in your industry.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#linkedin-connect"><i data-feather="tool" class="me-2"></i>View Integration</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user4" class="check" checked>
															<label for="user4" class="checktoggle">	</label>
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

		<!-- Connect Facebook -->
		<div class="modal fade" id="fb-connect">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Facebook Login Settings</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="social-authentication.php">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">App ID <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">App Secret <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-0">
												<label class="form-label">Login Redirect URL <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Connect Facebook -->

		<!-- Connect Twitter -->
		<div class="modal fade" id="twitter-connect">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Twitter Login Settings</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="social-authentication.php">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Consumer Key (API Key) <span> *</span></label>
												<input type="text" class="form-control">
												<p class="input-notify-info">If you are not sure what is your APP ID, Please head over to <span>Getting Started.</span></p>
											</div>
											<div class="mb-3">
												<label class="form-label">Consumer Secret (Secret Key) <span> *</span></label>
												<input type="text" class="form-control">
											</div>
											<div class="mb-0">
												<label class="form-label">Login Redirect URL <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Connect Twitter -->

		<!-- Connect Google -->
		<div class="modal fade" id="google-connect">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Google Login Settings</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="social-authentication.php">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Client ID <span> *</span></label>
												<input type="text" class="form-control">
												<p class="input-notify-info">If you are not sure what is your APP ID, Please head over to <span>Getting Started.</span></p>
											</div>
											<div class="mb-3">
												<label class="form-label">Client Secret Key <span> *</span></label>
												<input type="text" class="form-control">											
											</div>
											<div class="mb-0">
												<label class="form-label">Login Redirect URL <span> *</span></label>
												<input type="text" class="form-control">											
											</div>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Connect Google -->

		<!-- Connect Linkedin -->
		<div class="modal fade" id="linkedin-connect">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>LinkedIn Login Settings</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="social-authentication.php">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Client ID <span> *</span></label>
												<input type="text" class="form-control">
												<p class="input-notify-info">If you are not sure what is your APP ID, Please head over to <span>Getting Started.</span></p>
											</div>
											<div class="mb-3">
												<label class="form-label">Client Secret Key <span> *</span></label>
												<input type="text" class="form-control">											
											</div>
											<div class="mb-0">
												<label class="form-label">Login Redirect URL <span> *</span></label>
												<input type="text" class="form-control">											
											</div>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Connect Linkedin -->

		<?php include 'layouts/customizer.php'; ?>
		 
		<?php include 'layouts/vendor-scripts.php'; ?>
	
    </body>
</html>