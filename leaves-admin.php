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
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Leaves</h4>
								<h6>Manage your Leaves</h6>
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
							<a href="leave-types.php" class="btn btn-added">Leave type</a>
						</div>
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
										<div class="col-lg-2 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="user" class="info-img"></i>
												<select class="select">
													<option>Choose Employee</option>
													<option>Mitchum Daniel</option>
													<option>Susan Lopez</option>
													<option>Robert Grossman</option>
													<option>Janet Hembre</option>
												</select>
											</div>
										</div>
										<div class="col-lg-2 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="box" class="info-img"></i>
												<select class="select">
													<option>Choose Type</option>
													<option>Sick Leave</option>
													<option>Maternity</option>
													<option>Vacation</option>
												</select>
											</div>
										</div>
										<div class="col-lg-2 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="calendar" class="info-img"></i>
												<div class="input-groupicon">
													<input type="text" class="datetimepicker" placeholder="From Date - To Date" >
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="calendar" class="info-img"></i>
												<div class="input-groupicon">
													<input type="text" class="datetimepicker" placeholder="Applied Date" >
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="stop-circle" class="info-img"></i>
												<select class="select">
													<option>Choose Status</option>
													<option>Approved</option>
													<option>Rejected</option>
												</select>
											</div>
										</div>
										<div class="col-lg-2 col-sm-6 col-12 ms-auto">
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
											<th>Emp Name</th>
											<th>Emp Id</th>
											<th>Type</th>
											<th>From Date</th>
											<th>To Date</th>
											<th>Days/Hours</th>
											<th>Shift</th>
											<th>Applied  On</th>
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
												<div class="userimgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-01.jpg" alt="product">
													</a>
													<div>
														<a href="javascript:void(0);">Mitchum Daniel</a>
														<span class="emp-team">Database Administrator</span>
													</div>
												</div>
											</td>
											<td>POS001</td>
											<td>Sick Leave</td>
											<td>02 Aug 2023</td>
											<td>03 Aug 2023</td>
											<td>01 Day</td>
											<td>Regular</td>
											<td>02 Aug 2023</td>
											<td><span class="badges status-badge">Approved</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-3 confirm-text p-2" href="javascript:void(0);">
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
														<a href="javascript:void(0);">Susan Lopez</a>
														<span class="emp-team">Curator</span>
													</div>
													
												</div>
											</td>
											<td>POS002</td>
											<td>Sick Leave</td>
											<td>07 Aug 2023</td>
											<td>07 Aug 2023</td>
											<td>2 hrs</td>
											<td>Regular</td>
											<td>07 Aug 2023</td> 
											<td><span class="badges unstatus-badge">Rejected</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-3 confirm-text p-2" href="javascript:void(0);">
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
														<span class="emp-team">System Administrator</span>
													</div>
													
												</div>
											</td>
											<td>
												POS003
											</td>
											<td>
												Sick Leave								
											</td>
											<td>03 Aug 2023</td>
											<td>
												04 Aug 2023
											</td>
											<td>01 Day</td>
											<td>Regular</td>
											<td>03 Aug 2023</td>
											<td><div class="input-blocks leave-table">
												<select class="select">
													<option>Approve</option>
													<option>Rejected</option>
												</select>
											</div></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-3 confirm-text p-2" href="javascript:void(0);">
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
														<img src="assets/img/users/user-06.jpg" alt="product">
													</a>
													<div>
														<a href="javascript:void(0);">Janet Hembre</a>
														<span class="emp-team">Administrative Officer</span>
													</div>
													
												</div>
											</td>
											<td>
												POS004
											</td>
											<td>
												Maternity						
											</td>
											<td>05 Aug 2023</td>
											<td>
												07 Aug 2023
											</td>
											<td>02 Days</td>
											<td>Regular</td>
											<td>05 Aug 2023</td>
											<td><div class="input-blocks leave-table">
												<select class="select">
													<option>Approve</option>
													<option>Rejected</option>
												</select>
											</div></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-3 confirm-text p-2" href="javascript:void(0);">
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
											<td>
												POS005
											</td>
											<td>
												Vacation							
											</td>
											<td>08 Aug 2023</td>
											<td>
												10 Aug 2023
											</td>
											<td>03 Days</td>
											<td>Regular</td>
											<td>08 Aug 2023</td>
											<td><div class="input-blocks leave-table">
												<select class="select">
													<option>Approve</option>
													<option>Rejected</option>
												</select>
											</div></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-3 confirm-text p-2" href="javascript:void(0);">
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
														<a href="javascript:void(0);">Edward K. Muniz</a>
														<span class="emp-team">Office Support Secretary</span>
													</div>
													
												</div>
											</td>
											<td>
												POS006
											</td>
											<td>
												Sick Leave							
											</td>
											<td>03 Aug 2023</td>
											<td>03 Aug 2023</td>
											<td>2 hrs</td>
											<td>
												Regular
											</td>
											<td>03 Aug 2023</td>
											<td><div class="input-blocks leave-table">
												<select class="select">
													<option>Approve</option>
													<option>Rejected</option>
												</select>
											</div></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-3 confirm-text p-2" href="javascript:void(0);">
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
<!-- end main Wrapper-->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>