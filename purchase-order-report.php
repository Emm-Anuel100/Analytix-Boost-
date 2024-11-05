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
									<h4>Purchase order report</h4>
									<h6>Manage your Purchase order report</h6>
								</div>
							</div>
							<ul class="table-top-head">
								<li>
									<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export-purchase-order-report_pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
								</li>
								<li>
									<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export-purchase-order-report_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
								</li>
								<li>
									<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
								</li>
								<li>
									<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
								</li>
							</ul>
						</div>

						<!-- /product list -->
						<div class="card">
							<div class="card-body">
								<div class="table-top">
									<div class="search-set">
										<div class="search-input">
											<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
										</div>
									</div>
									
									<div class="form-sort">
										<i data-feather="sliders" class="info-img"></i>
										<?php 
											 $order = isset($_POST['sort_order']) && $_POST['sort_order'] === 'Oldest' ? 'ASC' : 'DESC';
											?>
											<form action="" method="post">
											<select name="sort_order" class="select" onchange="this.form.submit()">
												<option value="Newest" <?php if ($order === 'DESC') echo 'selected'; ?>>Newest</option>
												<option value="Oldest" <?php if ($order === 'ASC') echo 'selected'; ?>>Oldest</option>
											</select>
										</form>
									</div>								
								</div>
								
								<div class="table-responsive">
								<?php
								// Check if the user selected a sorting order; default to 'Newest'
							    $order = isset($_POST['sort_order']) && $_POST['sort_order'] === 'Oldest' ? 'ASC' : 'DESC';

								// Fetch data from purchases and products tables
								$query = "
									SELECT 
										p.product_name,
										p.grand_total AS purchased_amount,
										p.pack_quantity * p.items_per_pack AS purchased_qty,
										pr.quantity AS instock_qty,
										pr.image AS product_image
									FROM 
										purchases AS p
									JOIN 
										products AS pr ON p.product_name = pr.product_name AND p.user_email = pr.email
									WHERE 
										p.user_email = ? ORDER BY p.id $order
								";

								$stmt = $conn->prepare($query);
								$stmt->bind_param("s", $_SESSION['email']);
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
											<th>Purchased Amount (₦)</th>
											<th>Purchased QTY</th>
											<th>Instock QTY</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($result->num_rows > 0): ?>
											<?php while ($row = $result->fetch_assoc()) { ?>
												<tr>
													<td>
														<label class="checkboxs">
															<input type="checkbox">
															<span class="checkmarks"></span>
														</label>
													</td>
													<td class="productimgname">
														<a class="product-img">
															<img src="uploads/<?php echo htmlspecialchars($row['product_image']); ?>" alt="product image">
														</a>
														<a href="javascript:void(0);"><?php echo htmlspecialchars($row['product_name']); ?></a>
													</td>
													<td><?php echo number_format($row['purchased_amount'], 2); ?></td>
													<td><?php echo intval($row['purchased_qty']); ?></td>
													<td><?php echo intval($row['instock_qty']); ?></td>
												</tr>
											<?php } ?>
										<?php else: ?>
											<!-- Demo data when no records are found -->
											<tr>
												<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>
												<td class="productimgname">
													<a class="product-img">
														<img src="assets/img/products/product1.jpg" alt="product image">
													</a>
													<a href="javascript:void(0);">Demo Product</a>
												</td>
												<td>500.00</td>
												<td>100</td>
												<td>200</td>
											</tr>
											<?php endif; ?>
										</tbody>
									</table>

									<?php
									$stmt->close(); // Close the statement
									?>
								</div>
							</div>
						</div>
						<!-- /product list -->
					</div>
				</div>


				<!-- /Main Wrapper -->
				<!-- <div class="searchpart">
					<div class="searchcontent">
						<div class="searchhead">
							<h3>Search </h3>
							<a id="closesearch"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
						</div>
						<div class="searchcontents">
							<div class="searchparts">
								<input type="text" placeholder="search here">
								<a class="btn btn-searchs" >Search</a>
							</div>
							<div class="recentsearch">
								<h2>Recent Search</h2>
								<ul>
									<li>
										<h6><i class="fa fa-search me-2"></i> Settings</h6>
									</li>
									<li>
										<h6><i class="fa fa-search me-2"></i> Report</h6>
									</li>
									<li>
										<h6><i class="fa fa-search me-2"></i> Invoice</h6>
									</li>
									<li>
										<h6><i class="fa fa-search me-2"></i> Sales</h6>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<?php include 'layouts/customizer.php'; ?>
			<?php include 'layouts/vendor-scripts.php'; ?>


<script src="assets/js/refresh.js"></script>
<script>
$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable


</script>
	
</body>
</html>