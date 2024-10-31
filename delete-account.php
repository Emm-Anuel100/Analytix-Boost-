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
								<h4>Delete Account Request</h4>
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
					</div>
					<!-- /product list -->
					<div class="card table-list-card">
						<div class="card-body pb-0">
							<div class="table-top table-top-two">
								<div class="input-blocks search-set mb-0">
									<div class="search-input">
										<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
									</div>
									
								</div>
								<div class="search-path d-flex align-items-center search-path-new">
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
											<th>User Name</th>
											<th>Requisition Date</th>
											<th>Delete Request Date</th>
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
													</div>
													
												</div>
											</td>
											<td>25 Sep 2023</td>
											<td>
												01 Oct 2023
											</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
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
													</div>
													
												</div>
											</td>
											<td>30 Sep 2023</td>
											<td>
												05 Oct 2023
											</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
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
													</div>
													
												</div>
											</td>
											<td>10 Sep 2023</td>
											<td>
												25 Sep 2023
											</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
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
													</div>
													
												</div>
											</td>
											<td>15 Sep 2023</td>
											<td>
												20 Sep 2023
											</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
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
													</div>
													
												</div>
											</td>
											<td>15 Aug 2023</td>
											<td>
												01 Sep 2023
											</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
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