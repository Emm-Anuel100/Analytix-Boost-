<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

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
				<div class="page-title me-auto">
					<h4>Low Stocks</h4>
					<h6>Manage your low stocks</h6>
				</div>
				<ul class="table-top-head low-stock-top-head">
					<li>
						<div class="status-toggle d-flex justify-content-between align-items-center">
							<input type="checkbox" id="user2" class="check" checked="">
							<label for="user2" class="checktoggle">checkbox</label>
							Notify
						</div>
					</li>
					<li>
						<a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#send-email"><i data-feather="mail" class="feather-mail"></i>Send Email</a>
					</li>
					<li>
						<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="low_stock_export_pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
					</li>
					<li>
						<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel" href="low_stock_export_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
					</li>
					<li>
						<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
					</li>
					<li>
						<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
					</li>
				</ul>
			</div>
			<div class="table-tab">
				<ul class="nav nav-pills" id="pills-tab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Stock Inventory</button>
					</li>
				</ul>

					<!--/ Out of stock section -->
					<div class="tab-pane " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
										<form method="POST" action="">
										<select class="select" name="order_by" onchange="this.form.submit()">
											<option value="newest" <?php if (isset($_POST['order_by']) && $_POST['order_by'] == 'newest') echo 'selected'; ?>>Newest</option>
											<option value="oldest" <?php if (isset($_POST['order_by']) && $_POST['order_by'] == 'oldest') echo 'selected'; ?>>Oldest</option>
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
											<input type="checkbox" id="select-all2">
											<span class="checkmarks"></span>
										</label>
									</th>
									<th>Warehouse</th>
									<th>Store</th>
									<th>Product</th>
									<th>Stock</th>
									<th>Category</th>
									<th>SKU</th>
									<th>Qty</th>
									<th>Price (₦)</th>
									<th>Date Uploaded</th>
								</tr>
							 </thead>
								<?php 
								// Sanitize the email session for safety
								$email = trim($conn->real_escape_string($_SESSION['email']));

								// Default to "newest" if no option is selected
								$order_by = isset($_POST['order_by']) ? $_POST['order_by'] : 'newest';

								// Set the ORDER BY clause based on the selected option
								$order_sql = $order_by == 'oldest' ? 'ASC' : 'DESC'; // Oldest = ASC, Newest = DESC

								// Query to fetch products data based on the selected order
								$query = "
									SELECT id, warehouse, store, product_name, category, image, sku, quantity, price, created_at 
									FROM products 
									WHERE email = '$email' 
									ORDER BY id $order_sql
								";
								$result = $conn->query($query);

								// Initialize count for in stock and out of stock
								$in_stock_count = 0;
								$out_of_stock_count = 0;
								?>
							<tbody>
								<?php
								// Loop through the result set and display data in table rows
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										// Check the quantity to determine stock status
										if ($row['quantity'] > 10) {
											$badge_class = 'badge badge-linesuccess';
											$badge_text = 'In stock';
											$in_stock_count++;
										} elseif ($row['quantity'] > 0) {
											$badge_class = 'badge badges-warning';
											$badge_text = 'Low stock';
											$out_of_stock_count++;
										} else {
											$badge_class = 'badge badge-linedanger';
											$badge_text = 'Out of stock';
											$out_of_stock_count++;
										}
										?>
										<tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>
											<td><?php echo htmlspecialchars($row['warehouse']); ?></td>
											<td><?php echo htmlspecialchars($row['store']); ?></td>
											<td>
												<div class="productimgname">
													<a href="javascript:void(0);" class="product-img stock-img">
													<img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="product">
													</a>
													<a href="javascript:void(0);"><?php echo htmlspecialchars($row['product_name']); ?></a>
												</div>
											</td>
											<td><span style="font-size: 11px;" class='<?php echo $badge_class; ?>'><?php echo $badge_text; ?></span></td>
											<td><?php echo htmlspecialchars($row['category']); ?></td>
											<td><?php echo htmlspecialchars($row['sku']); ?></td>
											<td><?php echo htmlspecialchars($row['quantity']); ?></td>
											<td><?php echo number_format($row['price'], 2); ?></td>
											<td><?php echo date("jS M Y", strtotime($row['created_at'])); ?></td>
										</tr>
										<?php
									}
								  } else {
									?>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td>demo warehouse</td>
										<td>demo store</td>
										<td>
											<div class="productimgname">
												<a href="javascript:void(0);" class="product-img stock-img">
												<img src="uploads/default_product.jpg" alt="demo image">
												</a>
												<a href="javascript:void(0);">product name</a>
											</div>
										</td>
										<td><span style="font-size: 11px;" class="badge badge-linesuccess">In stock</span></td>
										<td>category</td>
										<td>sku</td>
										<td>10</td>
										<td>100.00</td>
										<td>19th Oct 2024</td>
										</tr>
									<?php
								}
								?>
							</tbody>
						  </table>
							</div>
						</div>
						</div>
						<!-- /product list -->
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

<script>
	$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

	document.querySelector('.refresh').addEventListener('click', () =>{
	window.location.reload();
	});
</script>
</body>
</html>