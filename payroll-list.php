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
								<h4>Payroll</h4>
								<h6>Manage Your Employees</h6>
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
							<button class="btn btn-primary add-em-payroll" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-add" aria-controls="offcanvasRight-add"><i data-feather="plus-circle" class="me-2"></i>Add New Payoll</button>
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
									</div>
									
								</div>
								<div class="form-sort">
									<i data-feather="sliders" class="info-img"></i>
									<select class="select">
										<option>Sort by Date</option>
										<option>12 09 23</option>
										<option>26 09 23</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
							<div class="card mb-0" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-lg-12 col-sm-12">
											<div class="row">
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="input-blocks">
														<i data-feather="user" class="info-img"></i>
														<select class="select">
															<option>Choose Name</option>
															<option>Macbook pro</option>
															<option>Orange</option>
														</select>
													</div>
												</div>
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="input-blocks">
														<i data-feather="stop-circle" class="info-img"></i>
														<select class="select">
															<option>Choose Status</option>
															<option>Computers</option>
															<option>Fruits</option>
														</select>
													</div>
												</div>
												<div class="col-lg-6 col-sm-6 col-12">
													<div class="input-blocks">
														<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
													</div>
												</div>
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
											<th>Salary</th>
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
											<td >
												<div class="userimgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-01.jpg" alt="product">
													</a>
													<div class="emp-name ">
														<a href="javascript:void(0);">Mitchum Daniel</a>
														<p class="role">Database Administrator</p>
													</div>
												</div>
											</td>
											<td>POS001</td>
											<td>mir34345@example.com</td>
											<td>$30,000</td>
											<td><span class="badge badge-linesuccess">Paid</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action data-view">
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="eye" class="action-eye"></i>
													</a>
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="download" class="action-download"></i>
													</a>
													<a class="me-2" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
														<i data-feather="edit" class="action-edit"></i>
													</a>
													<a class="confirm-text" href="javascript:void(0);">
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
													<div class="emp-name">
														<a href="javascript:void(0);">Susan Lopez</a>
														<p class="role">Curator</p>
													</div>
												</div>
											</td>
											<td>POS002</td>
											<td>susanopez@example.com</td>
											<td>$20,000</td>
											<td><span class="badge badge-linesuccess">Paid</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action data-view">
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="eye" class="action-eye"></i>
													</a>
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="download" class="action-download"></i>
													</a>
													<a class="me-2" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
														<i data-feather="edit" class="action-edit"></i>
													</a>
													<a class="confirm-text" href="javascript:void(0);">
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
													<div class="emp-name">
														<a href="javascript:void(0);">Robert</a>
														<p class="role">System Administrator</p>
													</div>
												</div>
											</td>
											<td>POS003</td>
											<td>robertgman@example.com</td>
											<td>$25,000</td>
											<td><span class="badge badge-linedanger">UnPaid</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action data-view">
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="eye" class="action-eye"></i>
													</a>
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="download" class="action-download"></i>
													</a>
													<a class="me-2" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
														<i data-feather="edit" class="action-edit"></i>
													</a>
													<a class="confirm-text" href="javascript:void(0);">
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
													<div class="emp-name">
														<a href="javascript:void(0);">Janet Hembre</a>
														<p class="role">Administrative Officer</p>
													</div>
												</div>
											</td>
											<td>POS004</td>
											<td>janetembre@example.com</td>
											<td>$23,000</td>
											<td><span class="badge badge-linesuccess">Paid</span></td>
											<td class="action-table-data"> 
												<div class="edit-delete-action data-view">
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="eye" class="action-eye"></i>
													</a>
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="download" class="action-download"></i>
													</a>
													<a class="me-2" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
														<i data-feather="edit" class="action-edit"></i>
													</a>
													<a class="confirm-text" href="javascript:void(0);">
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
													<div class="emp-name">
														<a href="javascript:void(0);">Russell Belle</a>
														<p class="role">Technician</p>
													</div>
												</div>
											</td>
											<td>POS005</td>
											<td>russellbelle@example.com</td>
											<td>$35,000</td>
											<td><span class="badge badge-linesuccess">Paid</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action data-view">
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="eye" class="action-eye"></i>
													</a>
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="download" class="action-download"></i>
													</a>
													<a class="me-2" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
														<i data-feather="edit" class="action-edit"></i>
													</a>
													<a class="confirm-text" href="javascript:void(0);">
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
													<div class="emp-name">
														<a href="javascript:void(0);">Edward Muniz</a>
														<p class="role">Office Support Secretary</p>
													</div>
												</div>
											</td>
											<td>POS006</td>
											<td>edward@example.com</td>
											<td>$28,000</td>
											<td><span class="badge badge-linedanger">UnPaid</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action data-view">
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="eye" class="action-eye"></i>
													</a>
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="download" class="action-download"></i>
													</a>
													<a class="me-2" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
														<i data-feather="edit" class="action-edit"></i>
													</a>
													<a class="confirm-text" href="javascript:void(0);">
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
													<div class="emp-name">
														<a href="javascript:void(0);">Susan Moore</a>
														<p class="role">Tech Lead</p>
													</div>
												</div>
											</td>
											<td>POS007</td>
											<td>susanmoore@example.com</td>
											<td>$27,000</td>
											<td><span class="badge badge-linesuccess">Paid</span></td>
											<td class="action-table-data"> 
												<div class="edit-delete-action data-view">
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="eye" class="action-eye"></i>
													</a>
													<a class="me-2" href="javascript:void(0);">
														<i data-feather="download" class="action-download"></i>
													</a>
													<a class="me-2" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
														<i data-feather="edit" class="action-edit"></i>
													</a>
													<a class="confirm-text" href="javascript:void(0);">
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

			<!-- Add Payroll -->
			<div class="offcanvas offcanvas-end em-payrol-add" tabindex="-1" id="offcanvasRight-add">
				<div class="offcanvas-body p-0">
					<div class="page-wrapper-new">
						<div class="content">
							<div class="page-header justify-content-between">
								<div class="page-title">
									<h4>Add New Payroll</h4>
								</div>
								<div class="page-btn">
									<a href="javascript:void(0);" class="btn btn-added" data-bs-dismiss="offcanvas"><i data-feather="arrow-left" class="me-2"></i>Back To List</a>
								</div>
							</div>
							<!-- /add -->
							<div class="card">
								<div class="card-body">
									<form action="payroll-list.php">
										<div class="row">
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Select Employee <span>*</span></label>
													<select class="select select2">
														<option>Choose</option>
														<option>Computers</option>
													</select>
												</div>
											</div>
											<div class="text-title">
												<p>Salary Information</p>
											</div>
											<div class="mb-3">
												<label class="form-label">Basic Salary <span>*</span></label>
													<input type="text" class="text-form form-control">
											</div>
											<div class="payroll-info d-flex">
												<p>Status</p>
												<div class="status-updates">
													<ul class="nav nav-pills list mb-3" id="pills-tab" role="tablist">
														<li class="nav-item" role="presentation">
															<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
																data-bs-target="#pills-home" type="button" role="tab">
																<span class="form-check form-check-inline ">
																	<span class="form-check-label">Paid</span>
																</span>
															</button>
														</li>
														<li class="nav-item" role="presentation">
															<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
																data-bs-target="#pills-profile" type="button" role="tab">
																<span class="form-check form-check-inline">
																	<span class="form-check-label">Unpaid</span>
																</span>
															</button>
														</li>
													</ul>
														
												</div>
											</div>
											<div class="payroll-title">
												<p>Allowances</p>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">HRA Allowance <span>*</span></label>
													<input type="text" class="form-control" id="allowances-one">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Conveyance <span>*</span></label>
													<input type="text" class="form-control" id="conveyance">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Medical Allowance <span>*</span></label>
													<input type="text" class="form-control" id="medical-allowance">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Bonus <span>*</span></label>
													<input type="text" class="form-control" id="bonus">
												</div>
											</div>
											<div class="sub-form">
												<div class="mb-3 flex-grow-1">
													<label class="form-label">Others</label>
														<input type="text" class="text-form form-control">
												</div>
												<div class="subadd-btn">
													<a href="#" class="btn btn-add"><i data-feather="plus-circle"></i></a>
												</div>
											</div>
											<div class="payroll-title">
												<p>Deductions</p>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">PF <span>*</span></label>
													<input type="text" class="form-control" id="pf-allowances">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Professional Tax <span>*</span></label>
													<input type="text" class="form-control" id="professional">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">TDS <span>*</span></label>
													<input type="text" class="form-control" id="tds-allowances">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Loans & Others <span>*</span></label>
													<input type="text" class="form-control" id="other-allowances">
												</div>
											</div>
											<div class="sub-form">
												<div class="mb-3 flex-grow-1">
													<label class="form-label">Others</label>
														<input type="text" class="text-form form-control">
												</div>
												<div class="subadd-btn">
													<a href="#" class="btn btn-add"><i data-feather="plus-circle"></i></a>
												</div>
											</div>
											<div class="payroll-title">
												<p>Deductions</p>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Total Allowance <span>*</span></label>
													<input type="text" class="form-control" id="total-allowances">
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Total Deduction <span>*</span></label>
													<input type="text" class="form-control" id="total-deduction">
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Net Salary <span>*</span></label>
													<input type="text" class="form-control" id="salary-allowances">
												</div>
											</div>
											<div class="col-lg-12">
												<div class="view-btn">
													<button type="button" class="btn btn-previw me-2">Preview</button>
													<button type="button" class="btn btn-reset me-2">Reset</button>
													<button type="submit" class="btn btn-save">Save</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<!-- /add -->
						</div>
					</div>
				</div>
			</div>
			<!-- /Add Payroll -->

            <!-- Edit Payroll -->
			<div class="offcanvas offcanvas-end em-payrol-add" tabindex="-1" id="offcanvasRight">
				<div class="offcanvas-body p-0">
					<div class="page-wrapper-new">
						<div class="content">
							<div class="page-header justify-content-between">
								<div class="page-title">
									<h4>Edit Payroll</h4>
								</div>
								<div class="page-btn">
									<a href="#" class="btn btn-added" data-bs-dismiss="offcanvas"><i data-feather="arrow-left" class="me-2"></i>Back To List</a>
								</div>
							</div>
							<!-- /add -->
							<div class="card">
								<div class="card-body">
									<form action="payroll-list.php">
										<div class="row">
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Select Employee <span>*</span></label>
													<select class="select select2">
														<option>Herald james</option>
														<option>Herald1</option>
													</select>
												</div>
											</div>
											<div class="text-title">
												<p>Salary Information</p>
											</div>
											<div class="mb-3">
												<label class="form-label">Basic Salary <span>*</span></label>
													<input type="text" class="form-control" value="$32,000">
											</div>
											<div class="payroll-info d-flex">
												<p>Status</p>
												<div class="status-updates">
													<ul class="nav nav-pills list mb-3" id="pills-tab2" role="tablist">
														<li class="nav-item" role="presentation">
															<button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
																data-bs-target="#pills-home" type="button" role="tab">
																<span class="form-check form-check-inline ">
																	<span class="form-check-label">Paid</span>
																</span>
															</button>
														</li>
														<li class="nav-item" role="presentation">
															<button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
																data-bs-target="#pills-profile" type="button" role="tab">
																<span class="form-check form-check-inline">
																	<span class="form-check-label">Unpaid</span>
																</span>
															</button>
														</li>
													</ul>
													
												</div>
											</div>
											<div class="payroll-title">
												<p>Allowances</p>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">HRA Allowance <span>*</span></label>
													<input type="text" class="form-control" id="hra-allowances-one" value="0.00">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Conveyance <span>*</span></label>
													<input type="text" class="form-control" id="conveyance-two" value="0.00">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Medical Allowance <span>*</span></label>
													<input type="text" class="form-control" id="medical-allowance-three" value="0.00">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Bonus <span>*</span></label>
													<input type="text" class="form-control" id="bonus-allowances-four" value="0.00">
												</div>
											</div>
											<div class="sub-form">
												<div class="mb-3 flex-grow-1">
													<label class="form-label">Others</label>
														<input type="text" class="form-control" value="0.00">
												</div>
												<div class="subadd-btn">
													<a href="#" class="btn btn-add"><i data-feather="plus-circle"></i></a>
												</div>
											</div>
											<div class="payroll-title">
												<p>Deductions</p>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">PF <span>*</span></label>
													<input type="text" class="form-control" id="pf-allowances-five" value="0.00">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Professional Tax <span>*</span></label>
													<input type="text" class="form-control" id="professional-allowances-six" value="0.00">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">TDS <span>*</span></label>
													<input type="text" class="form-control" id="tds-allowances-seven" value="0.00">
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Loans & Others <span>*</span></label>
													<input type="text" class="form-control" id="other-allowances-eight" value="0.00">
												</div>
											</div>
											<div class="sub-form">
												<div class="mb-3 flex-grow-1">
													<label class="form-label">Others</label>
														<input type="text" class="text-form form-control" value="0.00">
												</div>
												<div class="subadd-btn">
													<a href="#" class="btn btn-add"><i data-feather="plus-circle"></i></a>
												</div>
											</div>
											<div class="payroll-title">
												<p>Deductions</p>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Total Allowance <span>*</span></label>
													<input type="text" class="form-control" id="total-allowances-nine" value="0.00">
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Total Deduction <span>*</span></label>
													<input type="text" class="form-control" id="deductio-allowances-ten" value="0.00">
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="mb-3">
													<label class="form-label">Net Salary <span>*</span></label>
													<input type="text" class="form-control" id="salary-allowances-leven" value="$32.000">
												</div>
											</div>
											<div class="col-lg-12">
												<div class="view-btn">
													<button type="button" class="btn btn-previw me-2">Preview</button>
													<button type="submit" class="btn btn-reset me-2">Reset</button>
													<button type="submit" class="btn btn-save">Save</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<!-- /add -->
						</div>
					</div>
				</div>
			</div>
			 <!-- Edit Payroll -->

    </div>
<!-- end main Wrapper-->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>