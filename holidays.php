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
								<h4>Holiday</h4>
								<h6>Manage your Holiday</h6>
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
							<a href="" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-department"><i data-feather="plus-circle" class="me-2"></i>Add New Holiday</a>
						</div>
					</div>
					<!-- /product list -->
					<div class="card table-list-card">
						<div class="card-body pb-0">
							<div class="table-top">
								<div class="input-blocks search-set mb-0">
									<div class="search-input">
										<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
									</div>
								</div>
								<div class="search-path d-flex align-items-center search-path-new">
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
												<i data-feather="file-text" class="info-img"></i>
												<select class="select">
													<option>Choose Holiday</option>
													<option>UI/UX</option>
													<option>HR</option>
													<option>Admin</option>
													<option>Engineering</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="users" class="info-img"></i>
												<select class="select">
													<option>Choose HOD</option>
													<option>Mitchum Daniel</option>
													<option>Susan Lopez</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="stop-circle" class="info-img"></i>
												<select class="select">
													<option>Choose Status</option>
													<option>Mitchum Daniel</option>
													<option>Susan Lopez</option>
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
							<!-- product list -->
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
									<th>Date</th>
									<th>Duration</th>
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
									<td>Newyear</td>
									
									<td>
										01 Jan 2024								
									</td>
									<td>1 Day</td>
									<td>
										04 Aug 2023
									</td>
									<td><span class="badge badge-linesuccess">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-department">
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
									<td>Pongal</td>
									
									<td>
										14 Jan 2024								
									</td>
									<td>1 Day</td>
									<td>
										31 Jan 2022
									</td>
									<td><span class="badge badge-linesuccess">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-department">
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
									<td>Republic Day</td>
									
									<td>
										25 Jan 2024								
									</td>
									<td>1 Day</td>
									<td>
										21 July 2023
									</td>
									<td><span class="badges-success">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-department">
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
									<td>Worker’s Day</td>
								
									<td>
										01 May 2024							
									</td>
									<td>1 Day</td>
									<td>
										15 May 2023
									</td>
									<td><span class="badges-success">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-department">
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
									<td>Deepavali</td>
									
									<td>
										14 Oct 2024							
									</td>
									<td>1 Day</td>
									<td>
										04 Aug 2023
									</td>
									<td><span class="badges-success">Active</span></td>
									<td class="action-table-data">
										<div class="edit-delete-action">
											<a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-department">
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
					<!-- /product list -->
						</div>
					</div>
				</div>
			</div>
    </div>
<!-- end main Wrapper-->
<!-- Add Department -->
<div class="modal fade" id="add-department">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Holiday</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="holidays.php">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label>Add Holiday</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
											<label>Start Date</label>
											<div class="input-groupicon calender-input">
											<i data-feather="calendar" class="info-img"></i>
											<input type="text" class="datetimepicker" placeholder="Select">
											</div>
										</div>		
									</div>
									<div class="col-lg-6">
										<div class="input-blocks">
										<label>End Date</label>
										<div class="input-groupicon calender-input">
										<i data-feather="calendar" class="info-img"></i>
										<input type="text" class="datetimepicker" placeholder="Select">
										</div>
									</div>		
									</div>
										<div class="col-lg-12">
											<div class="input-blocks">
												<label>No of Days</label>
												<input type="text" class="form-control" placeholder="01">
											</div>
										</div>	
										<div class="input-blocks m-0">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
												<span class="status-label">Status</span>
												<input type="checkbox" id="user5" class="check" checked>
												<label for="user5" class="checktoggle">	</label>
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
		<!-- /Add Department -->

		<!-- Edit Department -->
		<div class="modal fade" id="edit-department">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Holiday</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="holidays.php">
									<div class="row">
										<div class="col-lg-12">
											<div class="input-blocks">
												<label>Add Holiday</label>
												<input type="text" class="form-control" value="Newyear">
											</div>
										</div>		
										<div class="col-lg-6">
											<div class="input-blocks">
											<label>Start Date</label>
											<div class="input-groupicon calender-input">
											<i data-feather="calendar" class="info-img"></i>
											<input type="text" class="datetimepicker" placeholder="01 Jan 2023">
											</div>
										</div>		
									</div>
									<div class="col-lg-6">
										<div class="input-blocks">
										<label>End Date</label>
										<div class="input-groupicon calender-input">
											<i data-feather="calendar" class="info-img"></i>
											<input type="text" class="datetimepicker" placeholder="01 Jan 2023">
										</div>
									</div>		
									</div>
										<div class="mb-0">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
												<span class="status-label">Status</span>
												<input type="checkbox" id="user3" class="check" checked>
												<label for="user3" class="checktoggle">	</label>
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
		<!-- /Edit Department -->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>