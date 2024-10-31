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
										<h4>Notification Settings</h4>
									</div>
									<div class="security-settings">
										<ul>
											<li>
												<div class="security-type">
													<div class="security-title">
														<h5>Mobile Push Notifications</h5>
													</div>
												</div>
												<div class="status-toggle modal-status">
													<input type="checkbox" id="user1" class="check" checked>
													<label for="user1" class="checktoggle">	</label>
												</div>
											</li>
											<li>
												<div class="security-type">
													<div class="security-title">
														<h5>Desktop Notifications</h5>
													</div>
												</div>
												<div class="status-toggle modal-status">
													<input type="checkbox" id="user2" class="check" checked>
													<label for="user2" class="checktoggle">	</label>
												</div>
											</li>
											<li>
												<div class="security-type">
													<div class="security-title">
														<h5>Email Notifications</h5>
													</div>
												</div>
												<div class="status-toggle modal-status">
													<input type="checkbox" id="user3" class="check" checked>
													<label for="user3" class="checktoggle">	</label>
												</div>
											</li>
											<li>
												<div class="security-type">
													<div class="security-title">
														<h5>MSMS Notifications</h5>
													</div>
												</div>
												<div class="status-toggle modal-status d-flex justify-content-between align-items-center ms-2">
													<input type="checkbox" id="user4" class="check" checked>
													<label for="user4" class="checktoggle">	</label>
												</div>
											</li>
										</ul>
										<div class="table-responsive no-pagination">
											<table class="table  datanew">
												<thead>
													<tr>
														<th>General Notification</th>
														<th>Push</th>
														<th>SMS</th>
														<th>Email</th>
													</tr>
												</thead>
												<tbody class="custom-table-data">
													<tr>
												
														<td>
															Legendary
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="users4" class="check" checked>
																<label for="users4" class="checktoggle">	</label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="users5" class="check" checked>
																<label for="users5" class="checktoggle">	</label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="users6" class="check" checked>
																<label for="users6" class="checktoggle">	</label>
															</div>
														</td>
													</tr>	
													<tr>
														<td>
															Transaction
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user5" class="check" checked>
																<label for="user5" class="checktoggle">	</label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user6" class="check" checked>
																<label for="user6" class="checktoggle">	</label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user7" class="check" checked>
																<label for="user7" class="checktoggle">	</label>
															</div>
														</td>
													</tr>												
													<tr>
												
														<td>
															Email Verification
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user8" class="check" checked>
																<label for="user8" class="checktoggle"></label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user9" class="check" checked>
																<label for="user9" class="checktoggle"></label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user10" class="check" checked>
																<label for="user10" class="checktoggle"></label>
															</div>
														</td>
													</tr>
													<tr>
												
														<td>
															OTP
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user11" class="check" checked>
																<label for="user11" class="checktoggle"></label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user12" class="check" checked>
																<label for="user12" class="checktoggle"></label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user13" class="check" checked>
																<label for="user13" class="checktoggle"></label>
															</div>
														</td>
													</tr>
													<tr>
												
														<td>
															Activity
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user14" class="check" checked>
																<label for="user14" class="checktoggle"></label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user15" class="check" checked>
																<label for="user15" class="checktoggle"></label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user16" class="check" checked>
																<label for="user16" class="checktoggle"></label>
															</div>
														</td>
													</tr>
													<tr>
												
														<td>
															Account
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user17" class="check" checked>
																<label for="user17" class="checktoggle"></label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user18" class="check" checked>
																<label for="user18" class="checktoggle"></label>
															</div>
														</td>
														<td>
															<div class="status-toggle modal-status">
																<input type="checkbox" id="user19" class="check" checked>
																<label for="user19" class="checktoggle"></label>
															</div>
														</td>
													</tr>										
												</tbody>
											</table>
											<div class="text-end settings-bottom-btn">
												<a href="javascript:void(0);" class="btn btn-cancel me-2">Reset</a>
												<a href="general-settings.php" class="btn btn-submit">Save Changes</a>
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
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>