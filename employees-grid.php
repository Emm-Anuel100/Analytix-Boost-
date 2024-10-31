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
					<div class="card">
						<div class="card-body pb-0">
							<div class="table-top table-top-two table-top-new">
								
								<div class="search-set mb-0">
									<div class="total-employees">
										<h6><i data-feather="users" class="feather-user"></i>Total Employees <span>21</span></h6>
									</div>
									<div class="search-input">
										<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
										<input type="search" class="form-control">
									</div>
									
								</div>
								<div class="search-path d-flex align-items-center search-path-new">
									<div class="d-flex">
										<a class="btn btn-filter" id="filter_search">
											<i data-feather="filter" class="filter-icon"></i>
											<span><img src="assets/img/icons/closes.svg" alt="img"></span>
										</a>
										<a href="employees-list.php" class="btn-list"><i data-feather="list" class="feather-user"></i></a>
										<a href="employees-grid.php" class="btn-grid active"><i data-feather="grid" class="feather-user"></i></a>
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
							
						</div>
					</div>
					<!-- /product list -->

					
					<div class="employee-grid-widget">
						<div class="row">
							<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
								<div class="employee-grid-profile">
									<div class="profile-head">
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
										</label>
										<div class="profile-head-action">
											<span class="badge badge-linesuccess text-center w-auto me-1">Active</span>
											<div class="dropdown profile-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="more-vertical" class="feather-user"></i></a>
												<ul class="dropdown-menu">
													<li>
														<a href="edit-employee.php" class="dropdown-item"><i data-feather="edit" class="info-img"></i>Edit</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i data-feather="trash-2" class="info-img"></i>Delete</a>
													</li>								
												</ul>
											</div>
										</div>
									</div>
									<div class="profile-info">
										<div class="profile-pic active-profile">
											<img src="assets/img/users/user-01.jpg" alt="">
										</div>
										<h5>EMP ID : POS001</h5>
										<h4>Mitchum Daniel</h4>
										<span>Designer</span>
									</div>
									<ul class="department">
										<li>
											Joined
											<span>23 Jul 2023</span>
										</li>
										<li>
											Department
											<span>UI/UX</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
								<div class="employee-grid-profile">
									<div class="profile-head">
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
										</label>
										<div class="profile-head-action">
											<span class="badge badge-linesuccess text-center w-auto me-1">Active</span>
											<div class="dropdown profile-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="more-vertical" class="feather-user"></i></a>
												<ul class="dropdown-menu">
													<li>
														<a href="edit-employee.php" class="dropdown-item"><i data-feather="edit" class="info-img"></i>Edit</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i data-feather="trash-2" class="info-img"></i>Delete</a>
													</li>								
												</ul>
											</div>
										</div>
									</div>
									<div class="profile-info">
										<div class="profile-pic active-profile">
											<img src="assets/img/users/user-02.jpg" alt="">
										</div>
										<h5>EMP ID : POS002</h5>
										<h4>Susan Lopez</h4>
										<span>Curator</span>
									</div>
									<ul class="department">
										<li>
											Joined
											<span>30 May 2023</span>
										</li>
										<li>
											Department
											<span>HR</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
								<div class="employee-grid-profile">
									<div class="profile-head">
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
										</label>
										<div class="profile-head-action">
											<span class="badge badge-linedanger text-center w-auto me-1">Inactive</span>
											<div class="dropdown profile-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="more-vertical" class="feather-user"></i></a>
												<ul class="dropdown-menu">
													<li>
														<a href="edit-employee.php" class="dropdown-item"><i data-feather="edit" class="info-img"></i>Edit</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i data-feather="trash-2" class="info-img"></i>Delete</a>
													</li>								
												</ul>
											</div>
										</div>
									</div>
									<div class="profile-info">
										<div class="profile-pic">
											<img src="assets/img/users/user-03.jpg" alt="">
										</div>
										<h5>EMP ID : POS003</h5>
										<h4>Robert Grossman</h4>
										<span>System Administrator</span>
									</div>
									<ul class="department">
										<li>
											Joined
											<span>14 Aug 2023</span>
										</li>
										<li>
											Department
											<span>Admin</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
								<div class="employee-grid-profile">
									<div class="profile-head">
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
										</label>
										<div class="profile-head-action">
											<span class="badge badge-linesuccess text-center w-auto me-1">Active</span>
											<div class="dropdown profile-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="more-vertical" class="feather-user"></i></a>
												<ul class="dropdown-menu">
													<li>
														<a href="edit-employee.php" class="dropdown-item"><i data-feather="edit" class="info-img"></i>Edit</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i data-feather="trash-2" class="info-img"></i>Delete</a>
													</li>								
												</ul>
											</div>
										</div>
									</div>
									<div class="profile-info">
										<div class="profile-pic active-profile">
											<img src="assets/img/users/user-06.jpg" alt="">
										</div>
										<h5>EMP ID : POS004</h5>
										<h4>Janet Hembre</h4>
										<span>Administrative Officer</span>
									</div>
									<ul class="department">
										<li>
											Joined
											<span>17 Jun 2023</span>
										</li>
										<li>
											Department
											<span>Admin</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
								<div class="employee-grid-profile">
									<div class="profile-head">
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
										</label>
										<div class="profile-head-action">
											<span class="badge badge-linesuccess text-center w-auto me-1">Active</span>
											<div class="dropdown profile-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="more-vertical" class="feather-user"></i></a>
												<ul class="dropdown-menu">
													<li>
														<a href="edit-employee.php" class="dropdown-item"><i data-feather="edit" class="info-img"></i>Edit</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i data-feather="trash-2" class="info-img"></i>Delete</a>
													</li>								
												</ul>
											</div>
										</div>
									</div>
									<div class="profile-info">
										<div class="profile-pic active-profile">
											<img src="assets/img/users/user-04.jpg" alt="">
										</div>
										<h5>EMP ID : POS005</h5>
										<h4>Russell Belle</h4>
										<span>Technician</span>
									</div>
									<ul class="department">
										<li>
											Joined
											<span>16 Jan 2014</span>
										</li>
										<li>
											Department
											<span>Technical</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
								<div class="employee-grid-profile">
									<div class="profile-head">
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
										</label>
										<div class="profile-head-action">
											<span class="badge badge-linedanger text-center w-auto me-1">Inactive</span>
											<div class="dropdown profile-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="more-vertical" class="feather-user"></i></a>
												<ul class="dropdown-menu">
													<li>
														<a href="edit-employee.php" class="dropdown-item"><i data-feather="edit" class="info-img"></i>Edit</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i data-feather="trash-2" class="info-img"></i>Delete</a>
													</li>								
												</ul>
											</div>
										</div>
									</div>
									<div class="profile-info">
										<div class="profile-pic">
											<img src="assets/img/users/user-05.jpg" alt="">
										</div>
										<h5>EMP ID : POS006</h5>
										<h4>Edward K. Muniz</h4>
										<span>Office Support Secretary</span>
									</div>
									<ul class="department">
										<li>
											Joined
											<span>07 Feb 2017</span>
										</li>
										<li>
											Department
											<span>Support</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
								<div class="employee-grid-profile">
									<div class="profile-head">
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
										</label>
										<div class="profile-head-action">
											<span class="badge badge-linesuccess text-center w-auto me-1">Active</span>
											<div class="dropdown profile-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="more-vertical" class="feather-user"></i></a>
												<ul class="dropdown-menu">
													<li>
														<a href="edit-employee.php" class="dropdown-item"><i data-feather="edit" class="info-img"></i>Edit</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i data-feather="trash-2" class="info-img"></i>Delete</a>
													</li>								
												</ul>
											</div>
										</div>
									</div>
									<div class="profile-info">
										<div class="profile-pic active-profile">
											<img src="assets/img/users/user-07.jpg" alt="">
										</div>
										<h5>EMP ID : POS007</h5>
										<h4>Susan Moore</h4>
										<span>Tech Lead</span>
									</div>
									<ul class="department">
										<li>
											Joined
											<span>14 Mar 2023</span>
										</li>
										<li>
											Department
											<span>Engineering</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
								<div class="employee-grid-profile">
									<div class="profile-head">
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
										</label>
										<div class="profile-head-action">
											<span class="badge badge-linesuccess text-center w-auto me-1">Active</span>
											<div class="dropdown profile-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="more-vertical" class="feather-user"></i></a>
												<ul class="dropdown-menu">
													<li>
														<a href="edit-employee.php" class="dropdown-item"><i data-feather="edit" class="info-img"></i>Edit</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item confirm-text mb-0"><i data-feather="trash-2" class="info-img"></i>Delete</a>
													</li>								
												</ul>
											</div>
										</div>
									</div>
									<div class="profile-info">
										<div class="profile-pic active-profile">
											<img src="assets/img/users/user-08.jpg" alt="">
										</div>
										<h5>EMP ID : POS008</h5>
										<h4>Lance Jackson</h4>
										<span>Database administrator</span>
									</div>
									<ul class="department">
										<li>
											Joined
											<span>23 July 2023</span>
										</li>
										<li>
											Department
											<span>Admin</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="row custom-pagination">
							<div class="col-md-12">
								<div class="paginations d-flex justify-content-end mb-3">
									<span><i class="fas fa-chevron-left"></i></span>
									<ul class="d-flex align-items-center page-wrap">
										<li>
											<a href="javascript:void(0);" class="active">
												  1
											</a>  
										</li>
										<li>
											<a href="javascript:void(0);">
												2
										  </a> 
										</li>
										<li>
											<a href="javascript:void(0);">
												3
										  </a> 
										</li>
										<li>
											<a href="javascript:void(0);">
												4
										  </a> 
										</li>
									</ul>
									<span><i class="fas fa-chevron-right"></i></span>
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