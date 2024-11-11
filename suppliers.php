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
	 
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			
		<?php include 'layouts/menu.php'; ?>

			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Supplier List</h4>
								<h6>Manage Your Supplier</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export_suppliers_pdf.php" target="_blank"> <img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export_suppliers_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" class="refresh" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Supplier</a>
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

								<div class="form-sort">
									<i data-feather="sliders" class="info-img"></i>
										<form action="" method="post">
										<select class="select">
											<option>Newest</option>
											<option>Oldest</option>
										</select>
									</form>
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
											<th>Supplier Name</th>
											<th>code</th>
											<th>email</th>
											<th>Phone</th>
											<th>Country</th>
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
												<div class="productimgname">
													<a href="javascript:void(0);" class="product-img supplier-img">
														<img src="assets/img/supplier/supplier-01.png" alt="product">
													</a>
													<div>
														<a href="javascript:void(0);" class="ms-2">Apex Computers</a>
													</div>
													
												</div>
											</td>
											<td>201</td>
											<td>apexcomputers@example.com</td>
											<td>+12163547758 </td>
											<td>Germany</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="me-2 confirm-text p-2 mb-0" href="javascript:void(0);">
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

		<!-- Add Supplier -->
			<div class="modal fade" id="add-units">
				<div class="modal-dialog modal-dialog-centered custom-modal-two">
					<div class="modal-content">
						<div class="page-wrapper-new p-0">
							<div class="content">
								<div class="modal-header border-0 custom-modal-header">
									<div class="page-title">
										<h4>Add Supplier</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body custom-modal-body">

									<form action="suppliers.php" method="POST">
										<div class="row">
											<div class="col-lg-12">
												<div class="new-employee-field">
													<span>Avatar</span>
													<div class="profile-pic-upload mb-2">
														<div class="profile-pic">
															<span><i data-feather="plus-circle" class="plus-down-add"></i> Profile Photo</span>
														</div>
														<div class="input-blocks mb-0">
															<div class="image-upload mb-0">
																<input type="file" required accept=".png, .jpg, .jpeg">
																<div class="image-uploads">
																	<h4>Upload Image</h4>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-blocks">
													<label>Supplier Name</label>
													<input type="text" class="form-control" required>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-blocks">
													<label>Email</label>
													<input type="email" class="form-control" required>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-blocks">
													<label>Phone</label>
													<input type="text" class="form-control" required>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="input-blocks">
													<label>Address</label>
													<input type="text" class="form-control" required>
												</div>
											</div>
											<div class="col-lg-12 col-sm-10 col-10">
												<div class="input-blocks">
													<label>City</label>
													<input type="text" class="form-control" required>
												</div>
											</div>
											
											<div class="col-md-12">
												<div class="mb-0 input-blocks">
													<label class="form-label">Descriptions</label>
													<textarea class="form-control mb-1" maxlength="60" required></textarea>
													<p>Maximum 60 Characters</p>
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
			<!-- /Add Supplier -->

		<!-- Edit Supplier -->
		<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Supplier</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="suppliers.php">
									<div class="row">
									<div class="col-lg-12">
												<div class="new-employee-field">
													<span>Avatar</span>
													<div class="profile-pic-upload mb-2">
														<div class="profile-pic">
															<span><i data-feather="plus-circle" class="plus-down-add"></i> Profile Photo</span>
														</div>
														<div class="input-blocks mb-0">
															<div class="image-upload mb-0">
																<input type="file" accept=".png, .jpg, .jpeg">
																<div class="image-uploads">
																	<h4>Change Image</h4>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<div class="col-lg-4">
											<div class="input-blocks">
												<label>Supplier Name</label>
												<input type="text" placeholder="Apex Computers" required>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="input-blocks">
												<label>Email</label>
												<input type="email" placeholder="apexcomputers@example.com" required>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="input-blocks">
												<label>Phone</label>
												<input type="text" placeholder="+23463547758" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="input-blocks">
												<label>Address</label>
												<input type="text" placeholder="Budapester Strasse 2027259" required>
											</div>
										</div>
										<div class="col-lg-12 col-sm-10 col-10">
											<div class="input-blocks">
												<label>City</label>
												<input type="text" required>
											</div>
										</div>
										
										<div class="mb-0 input-blocks">
											<label class="form-label">Descriptions</label>
											<textarea class="form-control mb-1" required maxlength="60"></textarea>
											<p>Maximum 60 Characters</p>
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
		<!-- /Edit Supplier -->

		<?php include 'layouts/customizer.php'; ?>
		<?php include 'layouts/vendor-scripts.php'; ?>


<script src="assets/js/refresh.js"></script>
<script>
	$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable


</script>
</body>
</html>