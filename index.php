<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("./layouts/session.php"); // Include session

// Include connection 
include 'conn.php';

// Establish the connection to the database
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email

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
				<div class="row">
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash1.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5>&#8358;<span class="counters" data-count="0.00"> </span></h5>
								<h6>Total Purchase Due</h6>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget dash1 w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash2.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5>&#8358;<span class="counters" data-count="0.00"> </span></h5>
								<h6>Total Sales Due</h6>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget dash2 w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash3.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5>&#8358;<span class="counters" data-count="0.00"> </span></h5>
								<h6>Total Sale Amount</h6>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-widget dash3 w-100">
							<div class="dash-widgetimg">
								<span><img src="assets/img/icons/dash4.svg" alt="img"></span>
							</div>
							<div class="dash-widgetcontent">
								<h5>&#8358;<span class="counters" data-count="0.00"> </span></h5>
								<h6>Total Expense Amount</h6>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-count">
							<div class="dash-counts">
								<h4>0</h4>
								<h5>Customers</h5>
							</div>
							<div class="dash-imgs">
								<i data-feather="user"></i>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-count das1">
							<div class="dash-counts">
								<h4>0</h4>
								<h5>Suppliers</h5>
							</div>
							<div class="dash-imgs">
								<i data-feather="user-check"></i>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-count das2">
							<div class="dash-counts">
								<h4>0</h4>
								<h5>Purchase Invoice</h5>
							</div>
							<div class="dash-imgs">
								<img src="assets/img/icons/file-text-icon-01.svg" class="img-fluid" alt="icon">
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-count das3">
							<div class="dash-counts">
								<h4>0</h4>
								<h5>Sales Invoice</h5>
							</div>
							<div class="dash-imgs">
								<i data-feather="file"></i>
							</div>
						</div>
					</div>
				</div>
				<!-- Button trigger modal -->

				<div class="row">
					<div class="col-xl-7 col-sm-12 col-12 d-flex">
						<div class="card flex-fill">
							<div class="card-header d-flex justify-content-between align-items-center">
								<h5 class="card-title mb-0">Purchase & Sales</h5>
								<div class="graph-sets">
									<ul class="mb-0">
										<li>
											<span>Sales</span>
										</li>
										<li>
											<span>Purchase</span>
										</li>
									</ul>
									<!-- <div class="dropdown dropdown-wraper">
										<button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
											2023
										</button>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<li>
												<a href="javascript:void(0);" class="dropdown-item">2023</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="dropdown-item">2022</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="dropdown-item">2021</a>
											</li>
										</ul>
									</div> -->
								</div>
							</div>
							<div class="card-body">
								<div id="sales_charts"></div>
							</div>
						</div>
					</div>
					<div class="col-xl-5 col-sm-12 col-12 d-flex">
						<div class="card flex-fill default-cover mb-4">
							<div class="card-header d-flex justify-content-between align-items-center">
								<h4 class="card-title mb-0">Recent Products</h4>
								<div class="view-all-link">
									<a href="product-list.php" class="view-all d-flex align-items-center">
										View All<span class="ps-2 d-flex align-items-center"><i data-feather="arrow-right" class="feather-16"></i></span>
									</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive dataview">
									<!-- HTML Table to Display Products -->
									<table class="table dashboard-recent-products">
										<thead>
											<tr>
												<th>#</th>
												<th>Products</th>
												<th>Price</th>
											</tr>
										</thead>
										<tbody>
											<?php
											// Fetch products from the database
											$query = "SELECT id, product_name, price, image FROM products WHERE email = '$user_email'
											ORDER BY id DESC LIMIT 4"; // Limit 4 products and show the most recent

											$result = mysqli_query($conn, $query);

											// Check if any products were found
											$products = mysqli_num_rows($result) > 0 ? $result : null;

											if ($products) {
												$counter = 1;
												while ($row = mysqli_fetch_assoc($products)) {
													$product_id = $row['id'];
													$product_name = htmlspecialchars($row['product_name']); // Using htmlspecialchars for security
													$product_price = number_format($row['price'], 2); // Format price
													$product_image = "uploads/" . $row['image']; // product image

													echo "<tr>
															<td>$counter</td>
															<td class='productimgname'>
																<a href='product-list.php' class='product-img'>
																	<img src='$product_image' alt='product'>
																</a>
																<a href='product-list.php'>$product_name</a>
															</td>
															<td>&#8358;$product_price</td>
														</tr>";
													$counter++;
												}
											} else {
												// If no products, show a demo row
												echo "<tr>
														<td>1</td>
														<td class='productimgname'>
															<a href='product-list.php' class='product-img'>
																<img src='assets/img/space-upgrade.jpg' alt='product'>
															</a>
															<a href='product-list.php'>Demo Product</a>
														</td>
														<td>&#8358;500</td>
													</tr>";
											}
											?>
										</tbody>
									</table>
								</div>
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

<script src="assets/js/refresh.js"></script>
<script>
	$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

	
</script>
</body>
</html>
