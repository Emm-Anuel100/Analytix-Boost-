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
	<div id="global-loader">
		<div class="whirly-loader"> </div>
	</div>
	<!-- Main Wrapper -->
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
								<h5>$<span class="counters" data-count="307144.00">$307,144.00</span></h5>
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
								<h5>$<span class="counters" data-count="4385.00">$4,385.00</span></h5>
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
								<h5>$<span class="counters" data-count="385656.50">$385,656.50</span></h5>
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
								<h5>$<span class="counters" data-count="40000.00">$400.00</span></h5>
								<h6>Total Expense Amount</h6>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 col-12 d-flex">
						<div class="dash-count">
							<div class="dash-counts">
								<h4>100</h4>
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
								<h4>100</h4>
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
								<h4>100</h4>
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
								<h4>100</h4>
								<h5>Sales Invoice</h5>
							</div>
							<div class="dash-imgs">
								<img src="assets/img/icons/file-text-icon-01.svg" class="img-fluid" alt="icon">
							</div>
						</div>
					</div>
				</div>
				<!-- Button trigger modal -->

				<div class="row">
					<div class="col-xl-7 col-sm-12 col-12 d-flex">
						<div class="card flex-fill default-cover">
							<div class="card-header pb-0 d-flex justify-content-between align-items-center">
								<h5 class="card-title mb-0">Purchase & Sales</h5>
								<div class="graph-sets">
									<ul>
										<li>
											<span>Sales</span>
										</li>
										<li>
											<span>Purchase</span>
										</li>
									</ul>
									<div class="dropdown dropdown-wraper">
										<button class="btn btn-white btn-sm dropdown-toggle" type="button"
											id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
											2023 <img src="assets/img/icons/dropdown.svg" alt="img" class="ms-2">
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
									</div>
								</div>

							</div>
							<div class="card-body">
								<div id="sales_charts"></div>
							</div>
						</div>
					</div>
					<div class="col-xl-5 col-sm-12 col-12 d-flex">
						<div class="card flex-fill default-cover">
							<div class="card-header pb-0 d-flex justify-content-between align-items-center">
								<h4 class="card-title mb-0">Recently Added Products</h4>
								<div class="dropdown">
									<a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"
										class="dropset">
										<i class="fa fa-ellipsis-v"></i>
									</a>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<li>
											<a href="product-list.php" class="dropdown-item">Product List</a>
										</li>
										<li>
											<a href="add-product.php" class="dropdown-item">Product Add</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive dataview">
									<table class="table datatable dashboard-recent-products">
										<thead>
											<tr>
												<th>Sno</th>
												<th>Products</th>
												<th>Price</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td class="productimgname">
													<a href="product-list.php" class="product-img">
														<img src="assets/img/products/stock-img-01.png" alt="product">
													</a>
													<a href="product-list.php">Lenevo 3rd Generation</a>
												</td>
												<td>$12500</td>
											</tr>
											<tr>
												<td>2</td>
												<td class="productimgname">
													<a href="product-list.php" class="product-img">
														<img src="assets/img/products/stock-img-06.png" alt="product">
													</a>
													<a href="product-list.php">Bold V3.2</a>
												</td>
												<td>$1600</td>
											</tr>
											<tr>
												<td>3</td>
												<td class="productimgname">
													<a href="product-list.php" class="product-img">
														<img src="assets/img/products/stock-img-02.png" alt="product">
													</a>
													<a href="product-list.php">Nike Jordan</a>
												</td>
												<td>$2000</td>
											</tr>
											<tr>
												<td>4</td>
												<td class="productimgname">
													<a href="product-list.php" class="product-img">
														<img src="assets/img/products/stock-img-03.png" alt="product">
													</a>
													<a href="product-list.php">Apple Series 5 Watch</a>
												</td>
												<td>$800</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-0 default-cover">
					<div class="card-body">
						<h4 class="card-title">Expired Products</h4>
						<div class="table-responsive dataview">
							<table class="table datatable dashboard-expired-products">
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
										<th>Manufactured Date</th>
										<th>Expired Date</th>
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
												<a href="javascript:void(0);" class="product-img stock-img">
													<img src="assets/img/products/expire-product-01.png" alt="product">
												</a>
												<a href="javascript:void(0);">Red Premium Handy </a>
											</div>
										</td>
										<td><a href="javascript:void(0);">PT006</a></td>
										<td>17 Jan 2023</td>
										<td>29 Mar 2023</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="#" data-bs-toggle="modal"
													data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class=" confirm-text p-2" href="javascript:void(0);">
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
											<div class="productimgname">
												<a href="javascript:void(0);" class="product-img stock-img">
													<img src="assets/img/products/expire-product-02.png" alt="product">
												</a>
												<a href="javascript:void(0);">Iphone 14 Pro</a>
											</div>
										</td>
										<td><a href="javascript:void(0);">PT007</a></td>
										<td>22 Feb 2023</td>
										<td>04 Apr 2023</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="#" data-bs-toggle="modal"
													data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class=" confirm-text p-2" href="javascript:void(0);">
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
											<div class="productimgname">
												<a href="javascript:void(0);" class="product-img stock-img">
													<img src="assets/img/products/expire-product-03.png" alt="product">
												</a>
												<a href="javascript:void(0);">Black Slim 200 </a>
											</div>
										</td>
										<td><a href="javascript:void(0);">PT008</a></td>
										<td>18 Mar 2023</td>
										<td>13 May 2023</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="#" data-bs-toggle="modal"
													data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class=" confirm-text p-2" href="javascript:void(0);">
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
											<div class="productimgname">
												<a href="javascript:void(0);" class="product-img stock-img">
													<img src="assets/img/products/expire-product-04.png" alt="product">
												</a>
												<a href="javascript:void(0);">Woodcraft Sandal</a>
											</div>
										</td>
										<td><a href="javascript:void(0);">PT009</a></td>
										<td>29 Mar 2023</td>
										<td>27 May 2023</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="#" data-bs-toggle="modal"
													data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class=" confirm-text p-2" href="javascript:void(0);">
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
											<div class="productimgname">
												<a href="javascript:void(0);" class="product-img stock-img">
													<img src="assets/img/products/stock-img-03.png" alt="product">
												</a>
												<a href="javascript:void(0);">Apple Series 5 Watch </a>
											</div>
										</td>
										<td><a href="javascript:void(0);">PT010</a></td>
										<td>24 Mar 2023</td>
										<td>26 May 2023</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="#" data-bs-toggle="modal"
													data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class=" confirm-text p-2" href="javascript:void(0);">
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
			</div>
		</div>

	</div>

	<!-- /Main Wrapper -->

	<?php include 'layouts/customizer.php'; ?>

	<?php include 'layouts/vendor-scripts.php'; ?>
	
</body>

</html>