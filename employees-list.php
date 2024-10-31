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
								<h4>Employees</h4>
								<h6>Manage your employees</h6>
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
							<a href="add-employee.php" class="btn btn-added"><i data-feather="plus-circle" class="me-2"></i>Add New Employee</a>
						</div>
					</div>
					<!-- /product list -->
					<div class="card table-list-card">
						<div class="card-body pb-0">
							<div class="table-top table-top-two table-top-new">
								
								<div class="search-set mb-0">
									<div class="total-employees">
										<h6><i data-feather="users" class="feather-user"></i>Total Employees <span>21</span></h6>
									</div>
									<div class="search-input">
										<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
									</div>
									
								</div>
								<div class="search-path d-flex align-items-center search-path-new">
									<div class="d-flex">
										<a class="btn btn-filter" id="filter_search">
											<i data-feather="filter" class="filter-icon"></i>
											<span><img src="assets/img/icons/closes.svg" alt="img"></span>
										</a>
										<a href="employees-list.php" class="btn-list active"><i data-feather="list" class="feather-user"></i></a>
										<a href="employees-grid.php" class="btn-grid"><i data-feather="grid" class="feather-user"></i></a>
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
								
							</div>
							<!-- /Filter -->
							<div class="card" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="user" class="info-img"></i>
												<select class="select">
													<option>Choose Name</option>
													<option>Mitchum Daniel</option>
													<option>Susan Lopez</option>
													<option>Robert Grossman</option>
													<option>Janet Hembre</option>
												</select>
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
											<th>Employee</th>
											<th>Employee ID</th>
											<th>Email</th>
											<th>Phone Number</th>
											<th>Shift</th>
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
														<a href="javascript:void(0);">Steven</a>
														<span class="emp-team">Designer</span>
													</div>
													
												</div>
											</td>
											<td>
												POS001
											</td>
											<td>
												mir34345@example.com									
											</td>
											<td>+1 54554 54788</td>
											<td>
												Regular
											</td>
											<td><span class="badge badge-linesuccess">Active</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="edit-employee.php">
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
											<td>
												POS002
											</td>
											<td>
												susanopez@example.com								
											</td>
											<td>+1 35132 14547</td>
											<td>
												Regular
											</td>
											<td><span class="badge badge-linesuccess">Active</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="edit-employee.php">
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
												robertgman@example.com								
											</td>
											<td>+1 14778 66454</td>
											<td>
												Regular
											</td>
											<td><span class="badges-inactive">Inactive</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="edit-employee.php">
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
												janetembre@example.com							
											</td>
											<td>+1 14554 54774</td>
											<td>
												Regular
											</td>
											<td><span class="badges-success">Active</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="edit-employee.php">
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
												russellbelle@example.com							
											</td>
											<td>+1 14478 45547</td>
											<td>
												Regular
											</td>
											<td><span class="badges-success">Active</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="edit-employee.php">
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
												edward@example.com							
											</td>
											<td>+1 47887 45547</td>
											<td>
												Regular
											</td>
											<td><span class="badges-inactive">Inactive</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="edit-employee.php">
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
												<div class="userimgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-07.jpg" alt="product">
													</a>
													<div>
														<a href="javascript:void(0);">Susan Moore</a>
														<span class="emp-team">Tech Lead</span>
													</div>
													
												</div>
											</td>
											<td>
												POS007
											</td>
											<td>
												susanmoore@example.com						
											</td>
											<td>+1 47787 54661</td>
											<td>
												Regular
											</td>
											<td><span class="badges-success">Active</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="edit-employee.php">
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
<!-- end main Wrapper-->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>