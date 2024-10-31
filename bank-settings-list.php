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
								<div class="sidebars settings-sidebar theiaStickySidebar" id="sidebar2">
									<div class="sidebar-inner slimscroll">
										<div id="sidebar-menu5" class="sidebar-menu">
											<ul>
												<li class="submenu-open">
													<ul>
														<li class="submenu">
															<a href="javascript:void(0);"><i data-feather="settings"></i><span>General Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="general-settings.php">Profile</a></li>
																<li><a href="security-settings.php">Security</a></li>
																<li><a href="notification.php">Notifications</a></li>
																<li><a href="connected-apps.php">Connected Apps</a></li>
															</ul>
														</li>
														<li class="submenu">
															<a href="javascript:void(0);"><i data-feather="airplay"></i><span>Website Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="system-settings.php">System Settings</a></li>
																<li><a href="company-settings.php">Company Settings </a></li>
																<li><a href="localization-settings.php">Localization</a></li>
																<li><a href="prefixes.php">Prefixes</a></li>
																<li><a href="preference.php">Preference</a></li>
																<li><a href="appearance.php">Appearance</a></li>
																<li><a href="social-authentication.php">Social Authentication</a></li>
																<li><a href="language-settings.php">Language</a></li>
															</ul>
														</li>
														<li class="submenu">
															<a href="javascript:void(0);"><i data-feather="archive"></i><span>App Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="invoice-settings.php">Invoice</a></li>
																<li><a href="printer-settings.php">Printer </a></li>
																<li><a href="pos-settings.php">POS</a></li>
																<li><a href="custom-fields.php">Custom Fields</a></li>
															</ul>
														</li>
														<li class="submenu">
															<a href="javascript:void(0);"><i data-feather="server"></i><span>System Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="email-settings.php">Email</a></li>
																<li><a href="sms-gateway.php">SMS Gateways</a></li>
																<li><a href="otp-settings.php">OTP</a></li>
																<li><a href="gdpr-settings.php">GDPR Cookies</a></li>
															</ul>
														</li>
														<li class="submenu">
															<a href="javascript:void(0);" class="active subdrop"><i data-feather="credit-card"></i><span>Financial Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="payment-gateway-settings.php">Payment Gateway</a></li>
																<li><a href="bank-settings-grid.php" class="active">Bank Accounts </a></li>
																<li><a href="tax-rates.php">Tax Rates</a></li>
																<li><a href="currency-settings.php">Currencies</a></li>
															</ul>
														</li>
														<li class="submenu">
															<a href="javascript:void(0);"><i data-feather="layout"></i><span>Other Settings</span><span class="menu-arrow"></span></a>
															<ul>
																<li><a href="storage-settings.php">Storage</a></li>
																<li><a href="ban-ip-address.php">Ban IP Address </a></li>
															</ul>
														</li>
													</ul>								
												</li>
												
											</ul>
										</div>
									</div>
								</div>
								<div class="settings-page-wrap w-50">
									<div class="setting-title">
										<h4>Bank Account</h4>
									</div>
									<div class="page-header bank-settings justify-content-end">
										<a href="bank-settings-list.php" class="btn-list me-2 active"><i data-feather="list" class="feather-user"></i></a>
										<a href="bank-settings-grid.php" class="btn-grid"><i data-feather="grid" class="feather-user"></i></a>
										<div class="page-btn">
											<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-account"><i data-feather="plus-circle" class="me-2"></i>Add New Account</a>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="card table-list-card">
												<div class="card-body">
													<div class="table-top">
														<div class="search-set">
															<div class="search-input">
																<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
															</div>
														</div>
														<div class="search-path">
															<div class="d-flex align-items-center">
																<a class="btn btn-filter" id="filter_search">
																	<i data-feather="filter" class="filter-icon"></i>
																	<span><img src="assets/img/icons/closes.svg" alt="img"></span>
																</a>
															</div>
														</div>
														<div class="form-sort">
															<i data-feather="sliders" class="info-img"></i>
															<select class="select">
																<option>Sort by Date</option>
																<option>Newest</option>
																<option>Oldest</option>
															</select>
														</div>
													</div>
													<!-- /Filter -->
													<div class="card" id="filter_inputs">
														<div class="card-body pb-0">
															<div class="row">
																<div class="col-lg-4 col-sm-6 col-12">
																	<div class="input-blocks">
																		<i data-feather="user" class="info-img"></i>
																		<select class="select">
																			<option>Choose Name</option>
																			<option>Mathew</option>
																			<option>John Smith</option>
																			<option>Andrew</option>
																		</select>
																	</div>
																</div>
																<div class="col-lg-4 col-sm-6 col-12">
																	<div class="input-blocks">
																		<i data-feather="edit-2" class="info-img"></i>
																		<select class="select">
																			<option>Choose Bank</option>
																			<option>HDFC</option>
																			<option>Swiss Bank</option>
																			<option>Canara Bank</option>
																		</select>
																	</div>
																</div>
																<div class="col-lg-3 col-sm-6 col-12 ms-auto">
																	<div class="input-blocks">
																		<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!-- /Filter -->
													<div class="table-responsive">
														<table class="table  datanew">
															<thead>
																<tr>
																	<th class="no-sort">
																		<label class="checkboxs">
																			<input type="checkbox" id="select-all">
																			<span class="checkmarks"></span>
																		</label>
																	</th>
																	<th>Name</th>
																	<th>Bank</th>
																	<th>Branch</th>
																	<th>Account No</th>
																	<th>IFSC</th>
																	<th>Created On</th>
																	<th class="no-sort">Action</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>
																		<label class="checkboxs">
																			<input type="checkbox">
																			<span class="checkmarks"></span>
																		</label>
																	</td>
																	<td>
																		Mathew
																	</td>
																	<td>
																		HDFC
																	</td>
																	<td>
																		Bringham			
																	</td>
																	<td>**** **** 1832</td>
																	<td>124547</td>
																	<td>12 Jul 2023</td>
																	<td class="action-table-data">
																		<div class="edit-delete-action">
																			<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-account">
																				<i data-feather="edit" class="feather-edit"></i>
																			</a>
																			<a class="confirm-text p-2" href="javascript:void(0);">
																				<i data-feather="trash-2" class="feather-trash-2"></i>
																			</a>
																		</div>
																		
																	</td>
																</tr>
																<tr>
																	<td>
																		<label class="checkboxs">
																			<input type="checkbox">
																			<span class="checkmarks"></span>
																		</label>
																	</td>
																	<td>
																		Toby Lando
																	</td>
																	<td>
																		SBI
																	</td>
																	<td>
																		Leicester					
																	</td>
																	<td>**** **** 1596</td>
																	<td>156723</td>
																	<td>17 Aug 2023</td>
																	<td class="action-table-data">
																		<div class="edit-delete-action">
																			<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-account">
																				<i data-feather="edit" class="feather-edit"></i>
																			</a>
																			<a class="confirm-text p-2" href="javascript:void(0);">
																				<i data-feather="trash-2" class="feather-trash-2"></i>
																			</a>
																		</div>
																		
																	</td>
																</tr>
																<tr>
																	<td>
																		<label class="checkboxs">
																			<input type="checkbox">
																			<span class="checkmarks"></span>
																		</label>
																	</td>
																	<td>
																		John Smith
																	</td>
																	<td>
																		KVB
																	</td>
																	<td>
																		Bristol				
																	</td>
																	<td>**** **** 1982</td>
																	<td>198367</td>
																	<td>08 Sep 2023</td>
																	<td class="action-table-data">
																		<div class="edit-delete-action">
																			<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-account">
																				<i data-feather="edit" class="feather-edit"></i>
																			</a>
																			<a class="confirm-text p-2" href="javascript:void(0);">
																				<i data-feather="trash-2" class="feather-trash-2"></i>
																			</a>
																		</div>
																		
																	</td>
																</tr>
																<tr>
																	<td>
																		<label class="checkboxs">
																			<input type="checkbox">
																			<span class="checkmarks"></span>
																		</label>
																	</td>
																	<td>
																		Andrew
																	</td>
																	<td>
																		Swiss Bank
																	</td>
																	<td>
																		Nottingham		
																	</td>
																	<td>**** **** 1796</td>
																	<td>186730</td>
																	<td>21 Oct 2023</td>
																	<td class="action-table-data">
																		<div class="edit-delete-action">
																			<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-account">
																				<i data-feather="edit" class="feather-edit"></i>
																			</a>
																			<a class="confirm-text p-2" href="javascript:void(0);">
																				<i data-feather="trash-2" class="feather-trash-2"></i>
																			</a>
																		</div>
																		
																	</td>
																</tr>	
																<tr>
																	<td>
																		<label class="checkboxs">
																			<input type="checkbox">
																			<span class="checkmarks"></span>
																		</label>
																	</td>
																	<td>
																		Robert
																	</td>
																	<td>
																		Canara Bank
																	</td>
																	<td>
																		Norwich		
																	</td>
																	<td>**** **** 1645</td>
																	<td>146026</td>
																	<td>03 Nov 2023</td>
																	<td class="action-table-data">
																		<div class="edit-delete-action">
																			<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-account">
																				<i data-feather="edit" class="feather-edit"></i>
																			</a>
																			<a class="confirm-text p-2" href="javascript:void(0);">
																				<i data-feather="trash-2" class="feather-trash-2"></i>
																			</a>
																		</div>
																		
																	</td>
																</tr>																		
															</tbody>
														</table>
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
			</div>

    </div>
<!-- end main Wrapper-->
<!-- Add Bank Account -->
<div class="modal fade" id="add-account">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Bank Account</h4>
								</div>
								<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-auto me-2">
									<input type="checkbox" id="user1" class="check" checked>
									<label for="user1" class="checktoggle">	</label>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="bank-settings-list.php">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Bank Name <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Account Number <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Account Name <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Branch <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">IFSC <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center mb-3">
												<span class="status-label">Status</span>
												<input type="checkbox" id="user2" class="check" checked="">
												<label for="user2" class="checktoggle"></label>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
												<span class="status-label">Make as default</span>
												<input type="checkbox" id="user3" class="check" checked="">
												<label for="user3" class="checktoggle"></label>
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
		<!-- /Add Bank Account -->

		<!-- Edit Bank Account -->
		<div class="modal fade" id="edit-account">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Bank Account</h4>
								</div>
								<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-auto me-2">
									<input type="checkbox" id="user4" class="check" checked>
									<label for="user4" class="checktoggle">	</label>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="bank-settings-list.php">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Bank Name <span> *</span></label>
												<input type="text" class="form-control" value="HDFC">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Account Number <span> *</span></label>
												<input type="text" class="form-control" value="**** **** 1832">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Account Name <span> *</span></label>
												<input type="text" class="form-control" value="Mathew">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Branch <span> *</span></label>
												<input type="text" class="form-control" value="Bringham">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">IFSC <span> *</span></label>
												<input type="text" class="form-control" value="124547">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center mb-3">
												<span class="status-label">Status</span>
												<input type="checkbox" id="user5" class="check" checked="">
												<label for="user5" class="checktoggle"></label>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
												<span class="status-label">Make as default</span>
												<input type="checkbox" id="user6" class="check" checked="">
												<label for="user6" class="checktoggle"></label>
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
		<!-- /Edit Bank Account -->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>