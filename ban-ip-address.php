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
	<div id="global-loader">
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
							<div class="settings-page-wrap w-50">
								<div class="setting-title">
									<h4>Ban IP Address</h4>
								</div>
								<!-- <div class="page-header bank-settings justify-content-end">
									<div class="page-btn">
										<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-banip"><i data-feather="plus-circle" class="me-2"></i>Add New Ban IP</a>
									</div>
								</div> -->
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

												 <div class="page-header bank-settings justify-content-end">
											   	<div class="page-btn">
													 <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-banip"><i data-feather="plus-circle" class="me-2"></i>Add New Ban IP</a>
												   </div>
								             </div>
												</div>

												<div class="table-responsive">
													<table class="table datanew">
														<thead>
															<tr>
																<th class="no-sort">
																	<label class="checkboxs">
																		<input type="checkbox" id="select-all">
																		<span class="checkmarks"></span>
																	</label>
																</th>
																<th>IP Address</th>
																<th>Reason</th>
																<th>Date</th>
																<th class="no-sort text-end">Action</th>
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
																	211.11.0.25
																</td>
																<td>
																	<p>You can get on-demand services in
																		order to find a nearby service.</p>
																</td>
																<td>
																	12 Jul 2023
																</td>
																<td class="action-table-data justify-content-end">
																	<div class="edit-delete-action">
																		<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-banip">
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
																	211.03.0.11
																</td>
																<td>
																	<p>Extract pricing information at inventory levels.</p>
																</td>
																<td>
																	24 Aug 2023
																</td>
																<td class="action-table-data justify-content-end">
																	<div class="edit-delete-action">
																		<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-banip">
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
																	211.24.0.17
																</td>
																<td>
																	<p>Fetching data for competitors to gain competitive advantage.</p>
																</td>
																<td>
																	07 Sep 2023
																</td>
																<td class="action-table-data justify-content-end">
																	<div class="edit-delete-action">
																		<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-banip">
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
																	211.12.0.34
																</td>
																<td>
																	<p>Temporarily block to protect user accounts from internet fraudsters.</p>
																</td>
																<td>
																	13 Oct 2023
																</td>
																<td class="action-table-data justify-content-end">
																	<div class="edit-delete-action">
																		<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-banip">
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

	<!-- Add BanIp -->
	<div class="modal fade" id="add-banip">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Add New Ban IP Address</h4>
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
											<label class="form-label">IP Address</label>
											<input type="text" class="form-control" required placeholder="211.24.0.17">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="mb-3">
											<label class="form-label">Reason For Ban</label>
											<textarea rows="4" placeholder="Type your message" class="form-control" required></textarea>
										</div>
									</div>
								</div>
								<div class="modal-footer-btn">
									<button type="reset" class="btn btn-cancel me-2">Reset</button>
									<button type="submit" class="btn btn-submit">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Add BanIp -->

	<!-- Edit BanIp -->
	<div class="modal fade" id="edit-banip">
		<div class="modal-dialog modal-dialog-centered custom-modal-two">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Edit Ban IP Address</h4>
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
											<label class="form-label">IP Address</label>
											<input type="text" class="form-control" value="211.24.0.17" required>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="mb-3">
											<label class="form-label">Reason For Ban</label>
											<textarea rows="4" class="form-control" placeholder="Temporarily block to protect user accounts from internet fraudsters." required></textarea>
										</div>
									</div>
								</div>
								<div class="modal-footer-btn">
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
	<!-- /Edit BanIp -->
	<?php include 'layouts/customizer.php'; ?>
	<!-- JAVASCRIPT -->
	<?php include 'layouts/vendor-scripts.php'; ?>
</body>

</html>