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
					<div class="content">
						<div class="attendance-header">
							<div class="attendance-content">
							<img src="./assets/img/icons/hand01.svg" class="hand-img" alt="img">
							<h3>Good Morning, <span>John Smilga</span></h3>
							</div>
							<div>
								<ul class="table-top-head employe">	
								<li>
									<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
								</li>
									<li>
										<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
									</li>
								</ul>
							</div>
						</div>
						<div class="attendance-widget">
							<div class="row">
								<div class="col-xl-4 col-lg-12 col-md-4 d-flex">
									<div class="card w-100">
										<div class="card-body">
											<h5>Attendance<span>22 Aug 2023</span></h5>
											<div class="card attendance">
												<div>
												<img src="./assets/img/icons/time-big.svg" alt="time-img">
												</div>
												<div>
													<h2>05:45:22</h2>
													<p>Current Time</p>
												</div>
											</div>
											<div class="modal-attendance-btn flex-column flex-lg-row">
												<a href="javascript:void(0);" class="btn btn-submit w-100">Clock Out</a>
												<a href="javascript:void(0);" class="btn btn-cancel me-2 w-100" >Break</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-8 col-lg-12 col-md-8 d-flex">
									<div class="card w-100">
										<div class="card-body">
											<h5>Days Overview This Month</h5>
											<ul class="widget-attend">
												<li class="box-attend">
													<div class="warming-card">
														<h4>31</h4>
														<h6>Total Working
															Days</h6>
													</div>
												</li>
												<li class="box-attend">
													<div class="danger-card">
														<h4>05</h4>
														<h6>Abesent
															Days</h6>
													</div>
												</li>
												<li class="box-attend">
													<div class="light-card">
														<h4>28</h4>
														<h6>Present
															Days</h6>
													</div>
												</li>
												<li class="box-attend">
													<div class="warming-card">
														<h4>02</h4>
														<h6>Half 
															Days</h6>
													</div>
												</li>
												<li class="box-attend">
													<div class="warming-card">
														<h4>01</h4>
														<h6>Late
															Days</h6>
													</div>
												</li>
												<li class="box-attend">
													<div class="success-card">
														<h4>02</h4>
														<h6>Holidays</h6>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="page-header">
							<div class="add-item d-flex">
								<div class="page-title">
									<h4>Attendance</h4>
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
							</ul>
						</div>
						<!-- /product list -->
						<div class="card table-list-card">
							<div class="card-body pb-0">
								<div class="table-top">
									
									<div class="input-blocks search-set mb-0">
										<!-- <div class="total-employees">
											<h6><i data-feather="users" class="feather-user"></i>Total Employees <span>21</span></h6>
										</div> -->
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
									<!-- <div class="search-path d-flex align-items-center search-path-new">
										<a class="btn btn-filter" id="filter_search">
											<i data-feather="filter" class="filter-icon"></i>
											<span><img src="assets/img/icons/closes.svg" alt="img"></span>
										</a>
										<a href="employees-list.php" class="btn-list active"><i data-feather="list" class="feather-user"></i></a>
										<a href="employees-grid.php" class="btn-grid"><i data-feather="grid" class="feather-user"></i></a>

									</div> -->
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
													<i data-feather="calendar" class="info-img"></i>
													<div class="input-groupicon">
														<input type="text" class="datetimepicker" placeholder="Choose Date" >
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<i data-feather="stop-circle" class="info-img"></i>
													<select class="select">
														<option>Choose Status</option>
														<option>Present</option>
														<option>Absent</option>
														<option>Holiday </option>
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12 ms-auto">
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
												<th>Date</th>
												<th>Clock In</th>
												<th>Clock Out</th>
												<th>Production</th>
												<th>Break</th>
												<th>Overtime</th>
												<th>Progress</th>
												<th>Status</th>
												<th>Total Hours</th>
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
												<td>01 Jan 2023</td>
												<td>09:15 AM</td>
												<td>08:55 PM</td>
												<td>9h 00m</td>
												<td>1h 13m</td>
												<td>00h 50m</td>
												<td>
													<div class="progress attendance">
														<div class="progress-bar progress-bar-success" role="progressbar" style="width:78%">
														</div>
														<div class="progress-bar progress-bar-warning" role="progressbar" style="width:55%">
														</div>
														<div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%">
														</div>
													</div>
												</td>
												<td><span class="badge-linesuccess">Present</span></td>
												<td>09h 50m</td>
											</tr>
											<tr>
												<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>
												<td>02 Jan 2023</td>
												<td>09:07 AM</td>
												<td>08:40 PM</td>
												<td>9h 10m</td>
												<td>1h 07m</td>
												<td>01h 13m</td>
												<td>
													<div class="progress attendance">
														<div class="progress-bar progress-bar-success" role="progressbar" style="width:124%">
														</div>
													</div>
												</td>
												<td><span class="badge-linesuccess">Present</span></td>
												<td>10h 23m</td>
											</tr>
											<tr>
												<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>
												<td>03 Jan 2023</td>
												<td>09:04 AM</td>
												<td>08:52 PM</td>
												<td>8h 47m</td>
												<td>1h 04m</td>
												<td>01h 07m</td>
												<td>
													<div class="progress attendance">
														<div class="progress-bar progress-bar-success" role="progressbar" style="width:124%">
														</div>
														<div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%">
														</div>
													</div>
												</td>
												<td><span class="badge-linesuccess">Present</span></td>
												<td>10h 04m</td>
											</tr>
											<tr>
												<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>
												<td>04 Jan 2023</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
												<td>
													<div class="progress attendance">
														<div class="progress-bar progress-bar-success" role="progressbar" style="width:78%">
														</div>
														<div class="progress-bar progress-bar-warning" role="progressbar" style="width:55%">
														</div>
														<div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%">
														</div>
													</div>
												</td>
												<td><span class="badges-inactive">Absent</span></td>
												<td>-</td>
											</tr>
											<tr>
												<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>
												<td>06 Jan 2023</td>
												<td>09:10 AM</td>
												<td>08:48 PM</td>
												<td>8h 38m</td>
												<td>0h 58m</td>
												<td>01h 08m</td>
												<td>
													<div class="progress attendance">
														<div class="progress-bar progress-bar-success" role="progressbar" style="width:78%">
														</div>
														<div class="progress-bar progress-bar-warning" role="progressbar" style="width:55%">
														</div>
														<div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%">
														</div>
													</div>
												</td>
												<td><span class="badge-linesuccess">Present</span></td>
												<td>09h 46m</td>
											</tr>
											<tr>
												<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>
												<td>07 Jan 2023</td>
												<td>09:03 AM</td>
												<td>08:57 PM</td>
												<td>8h 50m</td>
												<td>1h 26m</td>
												<td>0h 43m</td>
												<td>
													<div class="progress attendance">
														<div class="progress-bar progress-bar-success" role="progressbar" style="width:78%">
														</div>
														<div class="progress-bar progress-bar-warning" role="progressbar" style="width:55%">
														</div>
														<div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%">
														</div>
													</div>
												</td>
												<td><span class="badge-linesuccess">Present</span></td>
												<td>08h 33m</td>
											</tr>
											<tr>
												<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>
												<td>04 Jan 2023</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
												<td>
													<div class="progress attendance">
														<div class="progress-bar progress-bar-success" role="progressbar" style="width:78%">
														</div>
														<div class="progress-bar progress-bar-warning" role="progressbar" style="width:55%">
														</div>
														<div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%">
														</div>
													</div>
												</td>
												<td><span class="badges-inactive Holiday">Holiday </span></td>
												<td>-</td>
											</tr>
											<!-- <tr>
												<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>
												<td>
													<div class="userimgname">
														<a href="javascript:void(0);" class="product-img">
															<img src="assets/img/users/user-06.jpg" alt="product">
														</a>
														<div>
															<a href="javascript:void(0);">Janet Hembre</a>
															<span class="emp-team">Administrative</span>
														</div>
														
													</div>
												</td>
												<td>POS003</td>
												<td>15 Jan 2023</td>
												<td>Regular</td>
												<td>09:07 AM</td>
												<td>09h : 00mins</td>
												<td>00h:50mins</td>
												<td>10h:50mins</td>
												<td><div class="input-blocks leave-table">
													<select class="select">
														<option>Approve</option>
														<option>Rejected</option>
													</select>
												</div></td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
															<i data-feather="eye" class="feather-eye"></i>
														</a>
														<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
															<i data-feather="edit" class="feather-edit"></i>
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
													<div class="userimgname">
														<a href="javascript:void(0);" class="product-img">
															<img src="assets/img/users/user-04.jpg" alt="product">
														</a>
														<div>
															<a href="javascript:void(0);">Russell Belle</a>
															<span class="emp-team">Technician</span>
														</div>
														
													</div>
												</td>
												<td>POS004</td>
												<td>15 Jan 2023</td>
												<td>Regular</td>
												<td>08:58 AM</td>
												<td>09h : 00mins</td>
												<td>01h:05mins</td>
												<td>10h:05mins</td>
												<td><div class="input-blocks leave-table">
													<select class="select">
														<option>Approve</option>
														<option>Rejected</option>
													</select>
												</div></td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
															<i data-feather="eye" class="feather-eye"></i>
														</a>
														<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
															<i data-feather="edit" class="feather-edit"></i>
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
													<div class="userimgname">
														<a href="javascript:void(0);" class="product-img">
															<img src="assets/img/users/user-03.jpg" alt="product">
														</a>
														<div>
															<a href="javascript:void(0);">Robert Grossman</a>
															<span class="emp-team">Administrator</span>
														</div>
														
													</div>
												</td>
												<td>POS005</td>
												<td>15 Jan 2023</td>
												<td>03 Aug 2023</td>
												<td>Regular</td>
												<td>09h : 00mins</td>
												<td>01h:03mins</td>
												<td>10h:03mins</td>
												<td><div class="input-blocks leave-table">
													<select class="select">
														<option>Approve</option>
														<option>Rejected</option>
													</select>
												</div></td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
															<i data-feather="eye" class="feather-eye"></i>
														</a>
														<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
															<i data-feather="edit" class="feather-edit"></i>
														<a class="me- 0confirm-text p-2" href="javascript:void(0);">
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
													<div class="userimgname">
														<a href="javascript:void(0);" class="product-img">
															<img src="assets/img/users/user-05.jpg" alt="product">
														</a>
														<div>
															<a href="javascript:void(0);">Edward Muniz</a>
															<span class="emp-team">Secretary</span>
														</div>
														
													</div>
												</td>
												<td>POS006</td>
												<td>15 Jan 2023</td>
												<td>Regular</td>
												<td>09:08 AM</td>
												<td>09h : 00mins</td>
												<td>00h:55mins</td>
												<td>10h:55mins</td>
												<td><div class="input-blocks leave-table">
													<select class="select">
														<option>Approve</option>
														<option>Rejected</option>
													</select>
												</div></td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
															<i data-feather="eye" class="feather-eye"></i>
														</a>
														<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
															<i data-feather="edit" class="feather-edit"></i>
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
													<div class="userimgname">
														<a href="javascript:void(0);" class="product-img">
															<img src="assets/img/users/user-02.jpg" alt="product">
														</a>
														<div>
															<a href="javascript:void(0);">Susan Moore</a>
															<span class="emp-team">Tech Lead</span>
														</div>
														
													</div>
												</td>
												<td>POS007</td>
												<td>15 Jan 2023</td>
												<td>Regular</td>
												<td>09:13 AM</td>
												<td>09h : 00mins</td>
												<td>00h:52mins</td>
												<td>10h:52mins</td>
												<td><div class="input-blocks leave-table">
													<select class="select">
														<option>Approve</option>
														<option>Rejected</option>
													</select>
												</div></td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
															<i data-feather="eye" class="feather-eye"></i>
														</a>
														<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
															<i data-feather="edit" class="feather-edit"></i>
														<a class="confirm-text p-2" href="javascript:void(0);">
															<i data-feather="trash-2" class="feather-trash-2"></i>
														</a>
													</div>
													
												</td>
											</tr>		 -->
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- /product list -->

					</div>
		</div>
    </div>
	<!-- end main Wrapper-->
<!-- Add Attendance -->
<div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Attendance</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="input-blocks">
											<label>Employee Name</label>
											<select class="select">
												<option>Choose</option>
												<option>Mitchum Daniel</option>
												<option>Janet Hembre</option>
												<option>Russell Belle</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="input-blocks">
											<label>Clock In</label>
											<div class="form-icon">
												<input type="text" class="form-control timepicker" placeholder="Select">
												<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="input-blocks">
											<label>Clock Out</label>
											<div class="form-icon">
												<input type="text" class="form-control timepicker" placeholder="Select">
												<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
											</div>
										</div>
									</div>
								</div>					
								<div class="modal-footer-btn">
									<a href="javascript:void(0);" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</a>
									<a href="warehouse.php" class="btn btn-submit">Submit</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Attendance -->

		<!-- Edit Warehouse -->
		<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Attendance</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="input-blocks">
											<label>Employee Name</label>
											<select class="select">
												<option>Mitchum Daniel</option>
												<option>Janet Hembre</option>
												<option>Russell Belle</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="input-blocks">
											<label>Clock In</label>
											<div class="form-icon">
												<input type="text" class="form-control timepicker" placeholder="09:15 AM">
												<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="input-blocks">
											<label>Clock Out</label>
											<div class="form-icon">
												<input type="text" class="form-control timepicker" placeholder="07:30 PM">
												<span class="cus-icon"><i data-feather="clock" class="feather-clock"></i></span>
											</div>
										</div>
									</div>
								</div>					
								<div class="modal-footer-btn">
									<a href="javascript:void(0);" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</a>
									<a href="warehouse.php" class="btn btn-submit">Save Changes</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Edit Warehouse -->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>