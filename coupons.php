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
								<h4>Coupons</h4>
								<h6>Manage Your Coupons</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export_coupons_pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export_coupons_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Coupons</a>
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
									<form action="" method="get">
										<select class="select">
											<option>Newest</option>
											<option>Oldest</option>
										</select>
									</form>
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
											<th>Product</th>
											<th>Name</th>
											<th>Code</th>
											<th>Type</th>
											<th>Discount</th>
											<th>Limit</th>
											<th>Valid Till</th>
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
											<td>Tomato</td>
											<td>Coupons 21 </td>
											<td><span class="badge badge-bgdanger">Christmas</span></td>
											<td>
												Fixed										
											</td>
											<td>$20</td>
											<td>
												04
											</td>
											<td>04 Jan 2023</td>
											<td><span class="badge badge-linesuccess">Active</span></td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-tex p-2" href="javascript:void(0);">
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

	<!-- Add coupons -->
    <div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Coupons</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="coupons.php" method="post">
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Name</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Code</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Type</label>
												<select class="select">
													<option>Fixed</option>
													<option>Percentage</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Discount Value</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label"> Limit</label>
												<input type="text" class="form-control">
												<span class="unlimited-text">0 for Unlimited</span>
											</div>
											
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Start Date</label>
												
												<div class="input-groupicon calender-input">
													<i data-feather="calendar" class="info-img"></i>
													<input type="text" class="datetimepicker form-control" placeholder="Select Date" >
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>End Date</label>
												
												<div class="input-groupicon calender-input">
													<i data-feather="calendar" class="info-img"></i>
													<input type="text" class="datetimepicker form-control" placeholder="Select Date" >
												</div>
											</div>
										</div>
										<div class="input-blocks">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center mb-2">
												<span class="status-label">All Products</span>
											</div>
											<select name="product_name" class="select" required>
													<?php
													$user_email = $_SESSION['email']; // user's email

													// Fetch products from the products table
													$productQuery = "SELECT product_name FROM products
													 WHERE email = '$user_email' ORDER BY product_name ASC"; // Sorts product in alphabetical order

													$result = $conn->query($productQuery);

													// Check if there are products available
													if ($result->num_rows > 0) {
														while ($product = $result->fetch_assoc()) {
															// Display each product name and set the id as the value
															echo "<option value='" . $product['product_name'] . "'>" . htmlspecialchars($product['product_name']) . "</option>";
														}
													} else {
														echo "<option value=''>No products available</option>";
													}
													?>
												</select>
										</div>
									
										<div class="input-blocks m-0">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
												<span class="status-label">Status</span>
												<input type="checkbox" id="user3" class="check" checked>
												<label for="user3" class="checktoggle">	</label>
											</div>
										</div>
									</div>
									
									
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Create Coupon</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Coupons -->

		<!-- Edit coupons -->
		<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Coupons</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="coupons.php">
									<div class="row">
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Name</label>
												<input type="text" value="Coupons 21">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Code</label>
												<input type="text" value="Christmas">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Type</label>
												<select class="select">
													<option>Fixed</option>
													<option>Percentage</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Discount Value</label>
												<input type="text" value="$20">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="input-blocks">
												<label>Limit</label>
												<input type="text" value="04">
												<span class="unlimited-text">0 for Unlimited</span>
											</div>
											
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Start Date</label>
												<div class="input-groupicon calender-input">
													<i data-feather="calendar" class="info-img"></i>
													<input type="text" class="datetimepicker form-control" placeholder="Select Date" >
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>End Date</label>
												<div class="input-groupicon calender-input">
													<i data-feather="calendar" class="info-img"></i>
													<input type="text" class="datetimepicker form-control" placeholder="Select Date" >
												</div>
											</div>
										</div>
										<div class="input-blocks">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center mb-2">
												<span class="status-label">All Products</span>
											</div>
											<select name="product_name" class="select" required>
												<?php
												$user_email = $_SESSION['email']; // user's email

												// Fetch products from the products table
												$productQuery = "SELECT product_name FROM products
													WHERE email = '$user_email' ORDER BY product_name ASC"; // Sorts product in alphabetical order

												$result = $conn->query($productQuery);

												// Check if there are products available
												if ($result->num_rows > 0) {
													while ($product = $result->fetch_assoc()) {
														// Display each product name and set the id as the value
														echo "<option value='" . $product['product_name'] . "'>" . htmlspecialchars($product['product_name']) . "</option>";
													}
												} else {
													echo "<option value=''>No products available</option>";
												}
												?>
											</select>
									      </div>
									
										<div class="input-blocks m-0">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
												<span class="status-label">Status</span>
												<input type="checkbox" id="user6" class="check" checked>
												<label for="user6" class="checktoggle">	</label>
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
		<!-- /Edit Coupons -->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>


<script src="assets/js/refresh.js"></script>
<script async>

  $.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable


</script>
</body>
</html>