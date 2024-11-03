<?php 
include("./layouts/session.php");
include 'conn.php'; // Include database connection

// Establish connection
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
								<h4>Product List</h4>
								<h6>Manage your products</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a href="export-product-pdf.php" data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a href="export-product-csv.php" data-bs-toggle="tooltip" data-bs-placement="top" title="Csv"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="add-product.php" class="btn btn-added"><i data-feather="plus-circle" class="me-2"></i>Add New Product</a>
						</div>	
						<div class="page-btn import">
							<a href="#" class="btn btn-added color" data-bs-toggle="modal" data-bs-target="#view-notes"><i
								data-feather="download" class="me-2"></i>Import Product</a>
						</div>
					</div>
					
						<!-- /product list -->
						<div class="card table-list-card">
						<div class="card-body">
							<div class="table-top">
								<div class="search-set">
									<div class="search-input">
										<a href="javascript:void(0);" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
									</div>
								</div>
							 
								<div class="form-sort">
								<form method="POST" action="">
									<i data-feather="sliders" class="info-img"></i>
									 <?php
										// Check if a sort order is set, otherwise default to 'newest'
										$sortOrder = isset($_POST['sort']) ? $_POST['sort'] : 'newest';
									 ?>
									<select name="sort" class="select" onchange="this.form.submit()">
										<option value="newest" <?php echo ($sortOrder == 'newest') ? 'selected' : ''; ?>>Newest</option>
										<option value="oldest" <?php echo ($sortOrder == 'oldest') ? 'selected' : ''; ?>>Oldest</option>
									</select>
								</form>
							</div>
							</div>
							
							<div class="table-responsive product-list">
							<?php
								// Sanitize email (for safety)
								$email = trim($conn->real_escape_string($_SESSION['email']));

								// Determine the ORDER BY clause based on the sort order
								$orderClause = $sortOrder === 'oldest' ? 'ASC' : 'DESC';

								// Prepare the query with the dynamic ORDER BY clause
								$query = "SELECT id, product_name, image, sku, store, warehouse, category, selling_type, price, unit, quantity, expiry_on, created_at 
											FROM products 
											WHERE email = ? 
											ORDER BY created_at $orderClause";

								$stmt = $conn->prepare($query);
								// Bind the email parameter
								$stmt->bind_param("s", $email);
								$stmt->execute();
								$result = $stmt->get_result();
							  ?>
							  <table class="table datanew">
								<thead>
									<tr>
										<th class="no-sort">
											<label class="checkboxs">
												<input type="checkbox" id="select-all">
												<span class="checkmarks"></span>
											</label>
										</th>
										<th>Product</th>
										<th>SKU</th>
										<th>Store</th>
										<th>Warehouse</th>
										<th>Category</th>
										<th>Selling Type</th>
										<th>Price (₦)</th>
										<th>Unit</th>
										<th>Qty</th>
										<th>Expiry</th>
										<th class="no-sort">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									// Check if there are products to display
									if ($result && $result->num_rows > 0) {
										// Loop through the products
										while($row = $result->fetch_assoc()) { ?>
											<tr>
												<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>
												<td>
													<div class="productimgname">
														<a href="javascript:void(0);" class="product-img stock-img">
															<img src="uploads/<?= htmlspecialchars($row['image']); ?>" alt="product image">
														</a>
														<a href="javascript:void(0);"><?= htmlspecialchars($row['product_name']); ?></a>
													</div>
												</td>
												<td><?= htmlspecialchars($row['sku']); ?></td>
												<td><?= htmlspecialchars($row['store']); ?></td>
												<td><?= htmlspecialchars($row['warehouse']); ?></td>
												<td><?= htmlspecialchars($row['category']); ?></td>
												<td><?= htmlspecialchars($row['selling_type']); ?></td>
												<td><?= htmlspecialchars($row['price']); ?></td>
												<td><?= htmlspecialchars($row['unit']); ?></td>
												<td><?= htmlspecialchars($row['quantity']); ?></td>
												<td><?= htmlspecialchars(date('d M Y', strtotime($row['expiry_on']))); ?></td>
												<td class="action-table-data">
													<div class="edit-delete-action">
														<a class="me-2 edit-icon p-2" href="product-details.php?id=<?= $row['id']; ?>">
															<i data-feather="eye" class="feather-eye"></i>
														</a>
														<a class="me-2 p-2" href="edit-product.php?id=<?= $row['id']; ?>">
															<i data-feather="edit" class="feather-edit"></i>
														</a>
														<a class="confirm-tex p-2" href="#" data-id="<?= $row['id']; ?>" data-image="<?= $row['image']; ?>" onclick="confirmDelete(<?= $row['id']; ?>, '<?= $row['image']; ?>');">
															<i data-feather="trash-2" class="feather-trash-2"></i>
														</a>
													</div>
												</td>
											</tr>
										<?php }
									} else {
										// Debugging: Output if no product is found
									} ?>
								</tbody>
							</table>

						<!-- <?php if (isset($product_count)): ?>
							<p>Product count: <?= $product_count ?></p>
						<?php else: ?>
							<p>No rows found or an error occurred.</p>
						<?php endif; ?> -->
						</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<!-- Add Adjustment -->
		<div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered stock-adjust-modal">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Variation Attribute</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="input-blocks">
											<label>Attribute Name</label>
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="input-blocks">
											<label>Add Value</label>
											<input type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<ul class="nav user-menu">
										<li class="nav-item nav-searchinputs">
											<div class="top-nav-search">
												<form action="#" class="dropdown">
													<div class="searchinputs list dropdown-toggle" id="dropdownMenuClickable2" data-bs-toggle="dropdown" data-bs-auto-close="false" >
														<input type="text" placeholder="Search">
														<i data-feather="search" class="feather-16 icon"></i>
														<div class="search-addon d-none">
															<span><i data-feather="x-circle" class="feather-14"></i></span>
														</div>
													</div>
													<div class="dropdown-menu search-dropdown idea" aria-labelledby="dropdownMenuClickable">
														<div class="search-info">
															<p>Black </p>
															<p>Red</p>
															<p>Green</p>
															<p>S</p>
															<p>M</p>
														</div>
													</div>
													<!-- <a class="btn"  id="searchdiv"><img src="assets/img/icons/search.svg" alt="img"></a> -->
												</form>
											</div>
										</li>
										</ul>
									</div>
									<div class="col-lg-6">
									<div class="modal-footer-btn popup">
										<a href="javascript:void(0);" class="btn btn-cancel me-2">Cancel</a>
										<a href="javascript:void(0);" class="btn btn-submit">Create Adjustment</a>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Adjustment -->

		<!-- Add Category -->
		<div class="modal fade" id="add-units-category">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add New Category</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<div class="mb-3">
									<label class="form-label">Name</label>
									<input type="text" class="form-control">
								</div>
								<div class="modal-footer-btn">
									<a href="javascript:void(0);" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</a>
									<a href="units.php" class="btn btn-submit">Submit</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Category -->

		<!-- Add Brand -->
		<div class="modal fade" id="add-units-brand">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add New Brand</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<div class="mb-3">
									<label class="form-label">Brand</label>
									<input type="text" class="form-control">
								</div>
								<div class="modal-footer-btn">
									<a href="javascript:void(0);" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</a>
									<a href="units.php" class="btn btn-submit">Submit</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Brand -->

		<!-- Add Unit -->
		<div class="modal fade" id="add-unit">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Unit</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<div class="mb-3">
									<label class="form-label">Unit</label>
									<input type="text" class="form-control">
								</div>
								<div class="modal-footer-btn">
									<a href="javascript:void(0);" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</a>
									<a href="units.php" class="btn btn-submit">Submit</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Unit -->

		<!-- Add Variatent -->
		<div class="modal fade" id="add-variation">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Variation</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<div class="modal-title-head people-cust-avatar">
									<h6>Variant Thumbnail</h6>
								</div>
								<div class="new-employee-field">
									<div class="profile-pic-upload">
										<div class="profile-pic">
											<span><i data-feather="plus-circle" class="plus-down-add"></i> Add Image</span>
										</div>
										<div class="mb-3">
											<div class="image-upload mb-0">
												<input type="file">
												<div class="image-uploads">
													<h4>Change Image</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Barcode Symbology</label>
											<select class="select">
												<option>Choose</option>
												<option>Code34</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<div class="form-group add-product list">
												<label>Item Code</label>
												<input type="text" class="form-control list" value="455454478844">
												<button type="submit" class="btn btn-primaryadd">
													Generate Code
												</button>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group image-upload-down">
											<div class="image-upload download">
												<input type="file">
												<div class="image-uploads">
													<img src="assets/img/download-img.png" alt="img">
													<h4>Drag and drop a <span>file to upload</span></h4>
												</div>
											</div>
										</div>
										<div class="accordion-body">
											<div class="text-editor add-list add">
												<div class="col-lg-12">
													<div class="add-choosen mb-3">
														<div class="phone-img ms-0">
															<img src="assets/img/products/phone-add-2.png" alt="image">
															<a href="javascript:void(0);"><i data-feather="x" class="x-square-add remove-product"></i></a>
														</div>
			
														<div class="phone-img">
															<img src="assets/img/products/phone-add-1.png" alt="image">
															<a href="javascript:void(0);"><i data-feather="x" class="x-square-add remove-product"></i></a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Quantity</label>
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Quantity Alert</label>
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Tax Type</label>
											<select class="select">
												<option>Choose</option>
												<option>Direct</option>
												<option>Indirect</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 pe-0">
										<div class="mb-3">
											<label class="form-label">Tax </label>
											<select class="select">
												<option>Choose</option>
												<option>Income Tax</option>
												<option>Service Tax</option>
											</select>
										</div>
									</div>
									<div class="col-lg-12 pe-0">
										<div class="mb-3">
											<label class="form-label">Discount Type </label>
											<select class="select">
												<option>Choose</option>
												<option>Percentage</option>
												<option>Early Payment</option>
											</select>
										</div>
									</div>
									<div class="col-lg-12 pe-0">
										<div >
											<label class="form-label">Discount Value</label>
											<input type="text" class="form-control">
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
		<!-- /Add Variatent -->

		<!-- Import Product -->
		<div class="modal fade" id="view-notes">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Import Product</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="product-list.php">
									<div class="row">
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Product</label>
												<select class="select">
													<option>Choose</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Category</label>
												<select class="select">
													<option>Choose</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Status</label>
												<select class="select">
													<option>Active</option>
													<option>Inactive</option>
												</select>
											</div>
										</div>
										<div class="col-lg-12 col-sm-6 col-12">
											<div class="row">
												<div>
													<div class="modal-footer-btn download-file">
														<a href="javascript:void(0)" class="btn btn-submit">Download Sample File</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="input-blocks image-upload-down">
												<label>	Upload CSV File</label>
												<div class="image-upload download">
													<input type="file">
													<div class="image-uploads">
														<img src="assets/img/download-img.png" alt="img">
														<h4>Drag and drop a <span>file to upload</span></h4>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-sm-6 col-12">
											<div class="mb-3">
												<label class="form-label">Created by</label>
												<input type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="mb-3 input-blocks">
											<label class="form-label">Description</label>
											<textarea class="form-control"></textarea>
											<p class="mt-1">Maximum 60 Characters</p>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="modal-footer-btn">
											<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
											<button type="submit" class="btn btn-submit">Submit</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Import Product -->
		<?php include 'layouts/customizer.php'; ?>		
		<?php include 'layouts/vendor-scripts.php'; ?>	

	<script src="assets/js/refresh.js"></script>
	<script>
		$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

		function confirmDelete(productId, imageName) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with AJAX call for deletion
                $.ajax({
                    url: 'delete-product.php',  // PHP script to handle the deletion
                    type: 'POST',
                    data: {
                        id: productId,  // Product ID to delete
                        image: imageName  // Image to unlink
                    },
                    success: function(response) {
                        if (response === 'success') {
                            Swal.fire('Deleted!', 'Product deleted. successfully!', 'success')
                                .then(() => {
                                    location.reload();  // Reload the page to reflect changes
                                });
                        } else {
                            Swal.fire('Error!', 'There was a problem deleting the product.', 'error');
                        }
                    }
                });
            }
        });
    }
	</script>
	</body>
</html>