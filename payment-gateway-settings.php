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
									<div class="setting-title">
										<h4>Payment Gateway</h4>
									</div>
									<div class="row social-authent-settings">
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-01.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn">
																<a href="javascript:void(0);">Connected</a>
															</div>
														</div>
														<p>PayPal is the faster, safer way to send and receive money or make an online payment.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#payment-connect"><i data-feather="tool" class="me-2"></i>View Integration</a>
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
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-02.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>APIs to accept credit cards, manage subscriptions, send money.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>Connect Now</a>
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
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-03.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>Braintree offers more fraud protection and security features.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>Connect Now</a>
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
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-04.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>Razorpay is an India's all in one payment solution.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>Connect Now</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user4" class="check">
															<label for="user4" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-05.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn">
																<a href="javascript:void(0);">Connected</a>
															</div>
														</div>
														<p>Works stably and reliably and features are valuable and necessary for any software.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>View Integration</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user5" class="check" checked>
															<label for="user5" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-06.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>Allows  send international money transfers and payments quickly with low fees.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>Connect Now</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user6" class="check">
															<label for="user6" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-07.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn">
																<a href="javascript:void(0);">Connected</a>
															</div>
														</div>
														<p>Provide payment solution to individuals to make payments using credit card.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>View Integration</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user7" class="check" checked>
															<label for="user7" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-08.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>Replaces your physical cards and cash with an easier, safer, more private and secure </p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>Connect Now</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user8" class="check">
															<label for="user8" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-09.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>Fast, Low-Cost Solution for your International Business. </p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>Connect Now</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user9" class="check">
															<label for="user9" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-10.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>Online payment platform that enables to send and receive money via emails. </p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>Connect Now</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user10" class="check" checked>
															<label for="user10" class="checktoggle"></label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-11.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn">
																<a href="javascript:void(0);">Connected</a>
															</div>
														</div>
														<p>Paytm stands for Pay through mobile and it is India's largest mobile payments.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>View Integration</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user11" class="check" checked>
															<label for="user11" class="checktoggle"></label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-12.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>Midtrans provides the maximum number of payment methods across payment gateways. </p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>Connect Now</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user12" class="check" checked>
															<label for="user12" class="checktoggle"></label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-13.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>PyTorch is  a network through which your customers transfer funds to you.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>Connect Now</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user13" class="check" checked>
															<label for="user13" class="checktoggle"></label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-14.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn">
																<a href="javascript:void(0);">Connected</a>
															</div>
														</div>
														<p>Direct transfer of funds from one bank account into another.</p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>View Integration</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user14" class="check" checked>
															<label for="user14" class="checktoggle"></label>
														</div>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6 d-flex">
											<div class="connected-app-card d-flex w-100">
												<ul class="w-100">
													<li class="flex-column align-items-start">
														<div class="d-flex align-items-center justify-content-between w-100 mb-2">
															<div class="security-type d-flex align-items-center">
																<span>
																	<img src="assets/img/icons/payment-icon-15.svg" alt="Payment">
																</span>
															</div>
															<div class="connect-btn not-connect">
																<a href="javascript:void(0);">Not connected</a>
															</div>
														</div>
														<p>Indicating that goods must be paid for at the time of delivery. </p>
													</li>
													<li>
														<div class="integration-btn">
															<a href="javascript:void(0);"><i data-feather="tool" class="me-2"></i>Connect Now</a>
														</div>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
															<input type="checkbox" id="user15" class="check" checked>
															<label for="user15" class="checktoggle"></label>
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
<!-- end main Wrapper-->
	<!-- Php Mail -->
    <div class="modal fade" id="payment-connect">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Paypal</h4>
								</div>
								<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-auto me-2">
									<input type="checkbox" id="user16" class="check" checked>
									<label for="user16" class="checktoggle">	</label>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="payment-gateway-settings.php">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Email Address <span> *</span></label>
												<input type="email" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">API Key <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-0">
												<label class="form-label">Secret Key <span> *</span></label>
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
		<!-- /Php Mail -->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>