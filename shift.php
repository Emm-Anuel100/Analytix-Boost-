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
		<!-- Mobile CSS-->
		<link rel="stylesheet" href="assets/plugins/intltelinput/css/intlTelInput.css">
    	<link rel="stylesheet" href="assets/plugins/intltelinput/css/demo.css">
	
    </head>
    <body>
		
		<div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div>

		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
		<?php include 'layouts/menu.php'; ?>

			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Shift</h4>
								<h6>Manage your employees shift</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Shift</a>
						</div>
					</div>
					<!-- /product list -->
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
										<div class="layout-hide-box">
											<a href="javascript:void(0);" class="me-3 layout-box"><i data-feather="layout" class="feather-search"></i></a>
											<div class="layout-drop-item card">
												<div class="drop-item-head">
													<h5>Want to manage datatable?</h5>
													<p>Please drag and drop your column to reorder your table and enable see option as you want.</p>
												</div>
												<ul>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Shop</span>
															<input type="checkbox" id="option1" class="check" checked>
															<label for="option1" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Product</span>
															<input type="checkbox" id="option2" class="check" checked>
															<label for="option2" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Reference No</span>
															<input type="checkbox" id="option3" class="check" checked>
															<label for="option3" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Date</span>
															<input type="checkbox" id="option4" class="check" checked>
															<label for="option4" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Responsible Person</span>
															<input type="checkbox" id="option5" class="check" checked>
															<label for="option5" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Notes</span>
															<input type="checkbox" id="option6" class="check" checked>
															<label for="option6" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Quantity</span>
															<input type="checkbox" id="option7" class="check" checked>
															<label for="option7" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Actions</span>
															<input type="checkbox" id="option8" class="check" checked>
															<label for="option8" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
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
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="zap" class="info-img"></i>
												<select class="select">
													<option>Choose Shift</option>
													<option>Fixed</option>
													<option>Rotating</option>
													<option>Split</option>
													<option>On-Call</option>
													<option>Weekend</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="calendar" class="info-img"></i>
												<div class="input-groupicon">
													<input type="text" class="datetimepicker" placeholder="Created Date" >
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="stop-circle" class="info-img"></i>
												<select class="select">
													<option>Choose Status</option>
													<option>Active</option>
													<option>Inactive</option>
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
											<th>Shift Name</th>
											<th>Time</th>
											<th>Week off</th>
											<th>Created On</th>
											<th>Status</th>
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
												Fixed
											</td>
											<td>09:00 AM  - 6:00 PM</td>
											<td>
												Sunday, Monday								
											</td>
											<td>04 Aug 2023</td>
											<td><span class="badge badge-linesuccess">Active</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
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
												Rotating
											</td>
											<td>06:00 AM  - 3:00 PM</td>
											<td>
												Saturday, Sunday					
											</td>
											<td>21 July 2023</td>
											<td><span class="badges-inactive">Inactive</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
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
												Split
											</td>
											<td>03:00 AM  - 9:00 PM</td>
											<td>
												Tuesday, Saturday				
											</td>
											<td>31 Jan 2022</td>
											<td><span class="badge badge-linesuccess">Active</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
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
												On-Call
											</td>
											<td>09:00 AM  - 6:00 PM</td>
											<td>
												Monday			
											</td>
											<td>15 May 2023</td>
											<td><span class="badge badge-linesuccess">Active</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
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
												Weekend
											</td>
											<td>06:00 AM  - 3:00 PM</td>
											<td>
												Friday		
											</td>
											<td>04 Aug 2023</td>
											<td><span class="badge badge-linesuccess">Active</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
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
					<!-- /product list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<!-- Add Shift -->
		<div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add New Shift</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="shift.php">
									<ul class="nav nav-pills modal-table-tab" id="pills-tab" role="tablist">
										<li class="nav-item" role="presentation">
										<button class="nav-link active" id="pills-add-shift-info-tab" data-bs-toggle="pill" data-bs-target="#pills-add-shift-info" type="button" role="tab" aria-controls="pills-add-shift-info" aria-selected="true">Shift Info</button>
										</li>
										<li class="nav-item" role="presentation">
										<button class="nav-link" id="pills-add-break-tab" data-bs-toggle="pill" data-bs-target="#pills-add-break" type="button" role="tab" aria-controls="pills-add-break" aria-selected="false">Break Timings</button>
										</li>
									</ul>
									<div class="tab-content" id="pills-tabContent">
										<div class="tab-pane fade show active" id="pills-add-shift-info" role="tabpanel" aria-labelledby="pills-add-shift-info-tab">
											<div class="row">
												<div class="col-lg-12">
													<div class="input-blocks">
														<label>Shift Name</label>
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="col-lg-6">
													<div class="input-blocks">
														<label>From</label>
														<div class="form-icon">
															<input type="text" class="form-control timepicker" placeholder="Select Time">
															<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="input-blocks">
														<label>To</label>
														<div class="form-icon">
															<input type="text" class="form-control timepicker" placeholder="Select Time">
															<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
														</div>
													</div>
												</div>
												<div class="col-lg-12">
													<div class="input-blocks">
														<label>Weekoff</label>
														<select class="select">
															<option>Choose</option>
															<option>Sunday, Monday</option>
															<option>Saturday, Sunday</option>
															<option>Tuesday, Saturday</option>
														</select>
													</div>
												</div>
												<div class="col-lg-12">
													<div class="modal-table-item">
														<h4>Weekdays Defeniton</h4>
														<div class="table-responsive no-pagination">
															<table class="table  datanew">
																<thead>
																	<tr>
																		<th>Days</th>
																		<th class="text-center">Weeks</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>
																			<div class="status-toggle modal-status d-flex align-items-center">													
																				<input type="checkbox" id="day1" class="check">
																				<label for="day1" class="checktoggle"></label>
																				<span class="status-label ms-2">Monday</span>
																			</div>							
																		</td>
																		<td>
																			<div class="text-end">
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					All
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					1st
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					2nd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					3rd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					4th
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					5th
																				</label>
																			</div>
																		</td>
																	</tr>	
																	<tr>
																		<td>
																			<div class="status-toggle modal-status d-flex align-items-center">													
																				<input type="checkbox" id="day2" class="check">
																				<label for="day2" class="checktoggle"></label>
																				<span class="status-label ms-2">Tuesday</span>
																			</div>							
																		</td>
																		<td>
																			<div class="text-end">
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					All
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					1st
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					2nd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					3rd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					4th
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					5th
																				</label>
																			</div>
																			
																		</td>
																	</tr>																										
																	<tr>
																		<td>
																			<div class="status-toggle modal-status d-flex align-items-center">													
																				<input type="checkbox" id="day3" class="check">
																				<label for="day3" class="checktoggle"></label>
																				<span class="status-label ms-2">Wednesday</span>
																			</div>							
																		</td>
																		<td>
																			<div class="text-end">
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					All
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					1st
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					2nd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					3rd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					4th
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					5th
																				</label>
																			</div>
																			
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<div class="status-toggle modal-status d-flex align-items-center">													
																				<input type="checkbox" id="day4" class="check">
																				<label for="day4" class="checktoggle"></label>
																				<span class="status-label ms-2">Thursday</span>
																			</div>							
																		</td>
																		<td>
																			<div class="text-end">
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					All
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					1st
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					2nd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					3rd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					4th
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					5th
																				</label>
																			</div>
																			
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<div class="status-toggle modal-status d-flex align-items-center">													
																				<input type="checkbox" id="day5" class="check">
																				<label for="day5" class="checktoggle"></label>
																				<span class="status-label ms-2">Friday</span>
																			</div>							
																		</td>
																		<td>
																			<div class="text-end">
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					All
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					1st
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					2nd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					3rd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					4th
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					5th
																				</label>
																			</div>
																			
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<div class="status-toggle modal-status d-flex align-items-center">													
																				<input type="checkbox" id="day6" class="check">
																				<label for="day6" class="checktoggle"></label>
																				<span class="status-label ms-2">Saturday</span>
																			</div>							
																		</td>
																		<td>
																			<div class="text-end">
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					All
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					1st
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					2nd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					3rd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					4th
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					5th
																				</label>
																			</div>
																			
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<div class="status-toggle modal-status d-flex align-items-center">													
																				<input type="checkbox" id="day7" class="check">
																				<label for="day7" class="checktoggle"></label>
																				<span class="status-label ms-2">Sunday</span>
																			</div>							
																		</td>
																		<td>
																			<div class="text-end">
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					All
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					1st
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					2nd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					3rd
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					4th
																				</label>
																				<label class="checkboxs modal-table-check">
																					<input type="checkbox">
																					<span class="checkmarks"></span>
																					5th
																				</label>
																			</div>
																			
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
														<div class="input-blocks custom-form-check">
															<label class="checkboxs modal-table-check">
																<input type="checkbox">
																<span class="checkmarks"></span>
																Recurring Shift
															</label>
														</div>
														
														<div class="input-blocks m-0">
															<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
																<span class="status-label">Status</span>
																<input type="checkbox" id="user6" class="check" checked>
																<label for="user6" class="checktoggle mb-0"></label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="pills-add-break" role="tabpanel" aria-labelledby="pills-add-break-tab">
											<div class="break-title">
												<h4>Morning Break</h4>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="input-blocks">
														<label>From</label>
														<div class="form-icon">
															<input type="text" class="form-control timepicker" placeholder="Select Time">
															<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="input-blocks">
														<label>To</label>
														<div class="form-icon">
															<input type="text" class="form-control timepicker" placeholder="Select Time">
															<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="break-title">
												<h4>Lunch</h4>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="input-blocks">
														<label>From</label>
														<div class="form-icon">
															<input type="text" class="form-control timepicker" placeholder="Select Time">
															<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="input-blocks">
														<label>To</label>
														<div class="form-icon">
															<input type="text" class="form-control timepicker" placeholder="Select Time">
															<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="break-title">
												<h4>Evening Break</h4>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<div class="input-blocks">
														<label>From</label>
														<div class="form-icon">
															<input type="text" class="form-control timepicker" placeholder="Select Time">
															<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="input-blocks">
														<label>To</label>
														<div class="form-icon">
															<input type="text" class="form-control timepicker" placeholder="Select Time">
															<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
														</div>
													</div>
												</div>
											</div>
											<div class="input-blocks summer-description-box">
												<label>Description</label>
												<div id="summernote"></div>
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
		<!-- /Add Shift -->

			<!-- Edit Shift -->
			<div class="modal fade" id="edit-units">
				<div class="modal-dialog modal-dialog-centered custom-modal-two">
					<div class="modal-content">
						<div class="page-wrapper-new p-0">
							<div class="content">
								<div class="modal-header border-0 custom-modal-header">
									<div class="page-title">
										<h4>Edit Shift</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body custom-modal-body">
									<form action="shift.php">
										<ul class="nav nav-pills modal-table-tab" id="pills-tab2" role="tablist">
											<li class="nav-item" role="presentation">
												<button class="nav-link active" id="pills-edit-shift-info-tab" data-bs-toggle="pill" data-bs-target="#pills-edit-shift-info" type="button" role="tab" aria-controls="pills-edit-shift-info" aria-selected="true">Shift Info</button>
											</li>
											<li class="nav-item" role="presentation">
												<button class="nav-link" id="pills-edit-break-tab" data-bs-toggle="pill" data-bs-target="#pills-edit-break" type="button" role="tab" aria-controls="pills-edit-break" aria-selected="false">Break Timings</button>
											</li>
										</ul>
										<div class="tab-content" id="pills-tabContent2">
											<div class="tab-pane fade show active" id="pills-edit-shift-info" role="tabpanel" aria-labelledby="pills-edit-shift-info-tab">
												<div class="row">
													<div class="col-lg-12">
														<div class="input-blocks">
															<label>Shift Name</label>
															<input type="text" class="form-control">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="input-blocks">
															<label>From</label>
															<div class="form-icon">
																<input type="text" class="form-control timepicker" placeholder="Select Time">
																<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="input-blocks">
															<label>To</label>
															<div class="form-icon">
																<input type="text" class="form-control timepicker" placeholder="Select Time">
																<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
															</div>
														</div>
													</div>
													<div class="col-lg-12">
														<div class="input-blocks">
															<label>Weekoff</label>
															<select class="select">
																<option>Sunday, Monday</option>
																<option>Saturday, Sunday</option>
																<option>Tuesday, Saturday</option>
															</select>
														</div>
													</div>
													<div class="col-lg-12">
														<div class="modal-table-item">
															<h4>Weekdays Defeniton</h4>
															<div class="table-responsive no-pagination">
																<table class="table  datanew">
																	<thead>
																		<tr>
																			<th>Days</th>
																			<th class="text-center">Weeks</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td>
																				<div class="status-toggle modal-status d-flex align-items-center">													
																					<input type="checkbox" id="days1" class="check" checked>
																					<label for="days1" class="checktoggle"></label>
																					<span class="status-label ms-2">Monday</span>
																				</div>							
																			</td>
																			<td>
																				<div class="text-end">
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						All
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						1st
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						2nd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						3rd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						4th
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						5th
																					</label>
																				</div>
																			</td>
																		</tr>	
																		<tr>
																			<td>
																				<div class="status-toggle modal-status d-flex align-items-center">													
																					<input type="checkbox" id="days2" class="check" checked>
																					<label for="days2" class="checktoggle"></label>
																					<span class="status-label ms-2">Tuesday</span>
																				</div>							
																			</td>
																			<td>
																				<div class="text-end">
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						All
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						1st
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						2nd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						3rd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						4th
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						5th
																					</label>
																				</div>
																				
																			</td>
																		</tr>																										
																		<tr>
																			<td>
																				<div class="status-toggle modal-status d-flex align-items-center">													
																					<input type="checkbox" id="days3" class="check" checked>
																					<label for="days3" class="checktoggle"></label>
																					<span class="status-label ms-2">Wednesday</span>
																				</div>							
																			</td>
																			<td>
																				<div class="text-end">
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						All
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						1st
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						2nd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						3rd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						4th
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						5th
																					</label>
																				</div>
																				
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="status-toggle modal-status d-flex align-items-center">													
																					<input type="checkbox" id="days4" class="check" checked>
																					<label for="days4" class="checktoggle"></label>
																					<span class="status-label ms-2">Thursday</span>
																				</div>							
																			</td>
																			<td>
																				<div class="text-end">
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						All
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						1st
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						2nd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						3rd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						4th
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox" checked>
																						<span class="checkmarks"></span>
																						5th
																					</label>
																				</div>
																				
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="status-toggle modal-status d-flex align-items-center">													
																					<input type="checkbox" id="days5" class="check">
																					<label for="days5" class="checktoggle"></label>
																					<span class="status-label ms-2">Friday</span>
																				</div>							
																			</td>
																			<td>
																				<div class="text-end">
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						All
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						1st
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						2nd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						3rd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						4th
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						5th
																					</label>
																				</div>
																				
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="status-toggle modal-status d-flex align-items-center">													
																					<input type="checkbox" id="days6" class="check">
																					<label for="days6" class="checktoggle"></label>
																					<span class="status-label ms-2">Saturday</span>
																				</div>							
																			</td>
																			<td>
																				<div class="text-end">
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						All
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						1st
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						2nd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						3rd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						4th
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						5th
																					</label>
																				</div>
																				
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="status-toggle modal-status d-flex align-items-center">													
																					<input type="checkbox" id="days7" class="check">
																					<label for="days7" class="checktoggle"></label>
																					<span class="status-label ms-2">Sunday</span>
																				</div>							
																			</td>
																			<td>
																				<div class="text-end">
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						All
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						1st
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						2nd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						3rd
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						4th
																					</label>
																					<label class="checkboxs modal-table-check">
																						<input type="checkbox">
																						<span class="checkmarks"></span>
																						5th
																					</label>
																				</div>
																				
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
															<div class="input-blocks custom-form-check">
																<label class="checkboxs modal-table-check">
																	<input type="checkbox" checked>
																	<span class="checkmarks"></span>
																	Recurring Shift
																</label>
															</div>
															
															<div class="input-blocks m-0">
																<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
																	<span class="status-label">Status</span>
																	<input type="checkbox" id="users6" class="check" checked>
																	<label for="users6" class="checktoggle mb-0"></label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="pills-edit-break" role="tabpanel" aria-labelledby="pills-edit-break-tab">
												<div class="break-title">
													<h4>Morning Break</h4>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="input-blocks">
															<label>From</label>
															<div class="form-icon">
																<input type="text" class="form-control timepicker" placeholder="11:00 AM">
																<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="input-blocks">
															<label>To</label>
															<div class="form-icon">
																<input type="text" class="form-control timepicker" placeholder="11:15 AM">
																<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
															</div>
														</div>
													</div>
												</div>
												<div class="break-title">
													<h4>Lunch</h4>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="input-blocks">
															<label>From</label>
															<div class="form-icon">
																<input type="text" class="form-control timepicker" placeholder="01:00 PM">
																<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="input-blocks">
															<label>To</label>
															<div class="form-icon">
																<input type="text" class="form-control timepicker" placeholder="02:00 PM">
																<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
															</div>
														</div>
													</div>
												</div>
												<div class="break-title">
													<h4>Evening Break</h4>
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="input-blocks">
															<label>From</label>
															<div class="form-icon">
																<input type="text" class="form-control timepicker" placeholder="05:00 PM">
																<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="input-blocks">
															<label>To</label>
															<div class="form-icon">
																<input type="text" class="form-control timepicker" placeholder="05:30 PM">
																<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
															</div>
														</div>
													</div>
												</div>
												<div class="input-blocks summer-description-box">
													<label>Description</label>
													<div id="summernote2"></div>
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
			<!-- /Edit Shift -->
			
			<?php include 'layouts/customizer.php'; ?>
		 
			<?php include 'layouts/vendor-scripts.php'; ?>
			<!-- Mobile Input -->
			<script src="assets/plugins/intltelinput/js/intlTelInput.js"></script>
	
    </body>
</html>