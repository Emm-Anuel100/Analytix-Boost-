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
								<div class="settings-page-wrap w-50">
									<div class="setting-title">
										<h4>Currency</h4>
									</div>
									<div class="page-header bank-settings justify-content-end">
										<div class="page-btn">
											<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-currency"><i data-feather="plus-circle" class="me-2"></i>Add New Currency</a>
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
																			<option>Euro</option>
																			<option>England Pound</option>
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
														<table class="table datanew">
															<thead>
																<tr>
																	<th class="no-sort">
																		<label class="checkboxs">
																			<input type="checkbox" id="select-all">
																			<span class="checkmarks"></span>
																		</label>
																	</th>
																	<th>Currency Name</th>
																	<th>Code </th>
																	<th>Symbol</th>
																	<th>Exchange Rate</th>
																	<th>Created On</th>
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
																		Euro
																	</td>
																	<td>
																		EUR
																	</td>
																	<td>
																		€
																	</td>
																	<td>Default</td>
																	<td>12 Jul 2023</td>
																	<td class="action-table-data justify-content-end">
																		<div class="edit-delete-action">
																			<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-currency">
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
																		England Pound
																	</td>
																	<td>
																		GBP
																	</td>
																	<td>
																		£		
																	</td>
																	<td>Default</td>
																	<td>14 Jul 2023</td>
																	<td class="action-table-data justify-content-end">
																		<div class="edit-delete-action">
																			<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-currency">
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
																		India Rupee
																	</td>
																	<td>
																		INR
																	</td>
																	<td>
																		₹
																	</td>
																	<td>76.154</td>
																	<td>14 Mar 2023</td>
																	<td class="action-table-data justify-content-end">
																		<div class="edit-delete-action">
																			<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-currency">
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
																		US Dollar
																	</td>
																	<td>
																		USD
																	</td>
																	<td>
																		$
																	</td>
																	<td>Default</td>
																	<td>10 Jan 2023</td>
																	<td class="action-table-data justify-content-end">
																		<div class="edit-delete-action">
																			<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-currency">
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
<!-- Add Currency -->
<div class="modal fade" id="add-currency">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Currency</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="currency-settings.php">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Currency Name <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Currency Symbol <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Currency Code <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Currency Rate <span> *</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
												<span class="status-label">Status</span>
												<input type="checkbox" id="user6" class="check" checked="">
												<label for="user6" class="checktoggle"></label>
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
		<!-- /Add Currency -->

		<!-- Edit Currency -->
		<div class="modal fade" id="edit-currency">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Currency</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="currency-settings.php">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Currency Name <span> *</span></label>
												<input type="text" class="form-control" value="Euro">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Currency Symbol <span> *</span></label>
												<input type="text" class="form-control" value="EUR">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Currency Code <span> *</span></label>
												<input type="text" class="form-control" value="€">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Currency Rate <span> *</span></label>
												<input type="text" class="form-control" value="Default">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
												<span class="status-label">Status</span>
												<input type="checkbox" id="user5" class="check" checked="">
												<label for="user5" class="checktoggle"></label>
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
		<!-- /Edit Currency -->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>