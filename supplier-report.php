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
								<h4>Supplier Report</h4>
								<h6>Manage Your Supplier Report</h6>
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
					<div class="table-tab">
						<ul class="nav nav-pills" id="pills-tab" role="tablist">
							<li class="nav-item" role="presentation">
							  <button class="nav-link active" id="purchase-report-tab" data-bs-toggle="pill" data-bs-target="#purchase-report" type="button" role="tab" aria-controls="purchase-report" aria-selected="true">Purchase</button>
							</li>
							<li class="nav-item" role="presentation">
							  <button class="nav-link" id="payment-report-tab" data-bs-toggle="pill" data-bs-target="#payment-report" type="button" role="tab" aria-controls="payment-report" aria-selected="false">Payment</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="return-report-tab" data-bs-toggle="pill" data-bs-target="#return-report" type="button" role="tab" aria-controls="return-report" aria-selected="false">Return</button>
							  </li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="purchase-report" role="tabpanel" aria-labelledby="purchase-report-tab">
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
												<a class="btn btn-filter" id="filter_search">
													<i data-feather="filter" class="filter-icon"></i>
													<span><img src="assets/img/icons/closes.svg" alt="img"></span>
												</a>
											</div>
											<div class="form-sort">
												<i data-feather="sliders" class="info-img"></i>
												<select class="select">
													<option>Sort by Date</option>
													<option>17 09 23</option>
													<option>19 09 23</option>
												</select>
											</div>
										</div>
										<!-- /Filter -->
										<div class="card" id="filter_inputs">
											<div class="card-body pb-0">
												<div class="row">
													<div class="col-lg-2 col-sm-6 col-12">
														<div class="input-blocks">
															<i data-feather="box" class="info-img"></i>
															<select class="select">
																<option>Choose Product</option>
																<option>Apple Series 5 Watch</option>
																<option>Amazon Echo Dot</option>
															</select>
														</div>
													</div>
													<div class="col-lg-2 col-sm-6 col-12">
														<div class="input-blocks">
															<i data-feather="stop-circle" class="info-img"></i>
															<select class="select">
																<option>Choose Status</option>
																<option>Received</option>
															</select>
														</div>
													</div>
													<div class="col-lg-2 col-sm-6 col-12">
														<div class="input-blocks">
															<div class="position-relative daterange-wraper">
																<input type="text" class="form-control" name="datetimes" placeholder="From Date - To Date" >
																<i data-feather="calendar" class="feather-14 info-img"></i>
															</div>
														</div>
													</div>
													<div class="col-lg-6 col-sm-6 col-12 ms-auto">
														<div class="input-blocks">
															<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
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
														<th>Purchase Date</th>
														<th>Product</th>
														<th>Purchase Amount</th>
														<th>Purchase Qty</th>
														<th>Paid</th>
														<th>Balance</th>
														<th>Status</th>
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
														<td>19 Jan 2023</td>
														<td class="productimgname">
															<div class="view-product me-2">
																<a href="javascript:void(0);">
																	<img src="assets/img/products/stock-img-01.png" alt="product">
																</a>
															</div>
															<a href="javascript:void(0);">Lenovo 3rd Generation</a>
														</td>
														<td>$1500</td>
														<td>50</td>
														<td>$1500</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Received</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>24 Jan 2023</td>
														<td class="productimgname">
															<div class="view-product me-2">
																<a href="javascript:void(0);">
																	<img src="assets/img/products/stock-img-06.png" alt="product">
																</a>
															</div>
															<a href="javascript:void(0);">Bold V3.2</a>
														</td>
														<td>$1200</td>
														<td>20</td>
														<td>$1200</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Received</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>03 Feb 2023</td>
														<td class="productimgname">
															<div class="view-product me-2">
																<a href="javascript:void(0);">
																	<img src="assets/img/products/stock-img-02.png" alt="product">
																</a>
															</div>
															<a href="javascript:void(0);">Nike Jordan</a>
														</td>
														<td>$2000</td>
														<td>30</td>
														<td>$2000</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Received</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>15 Feb 2023</td>
														<td class="productimgname">
															<div class="view-product me-2">
																<a href="javascript:void(0);">
																	<img src="assets/img/products/stock-img-03.png" alt="product">
																</a>
															</div>
															<a href="javascript:void(0);">Apple Series 5 Watch</a>
														</td>
														<td>$800</td>
														<td>80</td>
														<td>$800</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Received</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>12 Mar 2023</td>
														<td class="productimgname">
															<div class="view-product me-2">
																<a href="javascript:void(0);">
																	<img src="assets/img/products/stock-img-04.png" alt="product">
																</a>
															</div>
															<a href="javascript:void(0);">Amazon Echo Dot</a>
														</td>
														<td>$500</td>
														<td>70</td>
														<td>$500</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Received</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>25 Mar 2023</td>
														<td class="productimgname">
															<div class="view-product me-2">
																<a href="javascript:void(0);">
																	<img src="assets/img/products/stock-img-05.png" alt="product">
																</a>
															</div>
															<a href="javascript:void(0);">Lobar Handy</a>
														</td>
														<td>$400</td>
														<td>100</td>
														<td>$400</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Received</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>02 Apr 2023</td>
														<td class="productimgname">
															<div class="view-product me-2">
																<a href="javascript:void(0);">
																	<img src="assets/img/products/expire-product-01.png" alt="product">
																</a>
															</div>
															<a href="javascript:void(0);">Red Premium Handy</a>
														</td>
														<td>$300</td>
														<td>120</td>
														<td>$300</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Received</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>19 Apr 2023</td>
														<td class="productimgname">
															<div class="view-product me-2">
																<a href="javascript:void(0);">
																	<img src="assets/img/products/expire-product-02.png" alt="product">
																</a>
															</div>
															<a href="javascript:void(0);">Iphone 14 Pro</a>
														</td>
														<td>$1800</td>
														<td>40</td>
														<td>$1800</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Received</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>11 May 2023</td>
														<td class="productimgname">
															<div class="view-product me-2">
																<a href="javascript:void(0);">
																	<img src="assets/img/products/expire-product-03.png" alt="product">
																</a>
															</div>
															<a href="javascript:void(0);">Black Slim 200</a>
														</td>
														<td>$700</td>
														<td>300</td>
														<td>$700</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Received</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>27 May 2023</td>
														<td class="productimgname">
															<div class="view-product me-2">
																<a href="javascript:void(0);">
																	<img src="assets/img/products/expire-product-04.png" alt="product">
																</a>
															</div>
															<a href="javascript:void(0);">Woodcraft Sandal</a>
														</td>
														<td>$600</td>
														<td>200</td>
														<td>$600</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Received</span></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- /product list -->
							</div>
							<div class="tab-pane fade" id="payment-report" role="tabpanel" aria-labelledby="payment-report-tab">
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
												<a class="btn btn-filter" id="filter_search1">
													<i data-feather="filter" class="filter-icon"></i>
													<span><img src="assets/img/icons/closes.svg" alt="img"></span>
												</a>
											</div>
											<div class="form-sort">
												<i data-feather="sliders" class="info-img"></i>
												<select class="select">
													<option>Sort by Date</option>
													<option>22 09 23</option>
													<option>18 09 23</option>
												</select>
											</div>
										</div>
										<!-- /Filter -->
										<div class="card" id="filter_inputs1">
											<div class="card-body pb-0">
												<div class="row">
													<div class="col-lg-3 col-sm-6 col-12">
														<div class="input-blocks">
															<i data-feather="user" class="info-img"></i>
															<select class="select">
																<option>Choose Supplier Name</option>
																<option>Apex Computers</option>
																<option>Beats Headphones</option>
															</select>
														</div>
													</div>
													<div class="col-lg-3 col-sm-6 col-12">
														<div class="input-blocks">
															<i data-feather="calendar" class="info-img"></i>
															<div class="input-groupicon">
																<input type="text" class="datetimepicker" placeholder="Choose Date" >
															</div>
														</div>
													</div>
													<div class="col-lg-3 col-sm-6 col-12">
														<div class="input-blocks">
															<i data-feather="file-text" class="info-img"></i>
															<input type="text" placeholder="Enter Reference">
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
										<div class="table-responsive">
											<table class="table  datanew">
												<thead>
													<tr>
														<th class="no-sort">
															<label class="checkboxs">
																<input type="checkbox" id="select-all2">
																<span class="checkmarks"></span>
															</label>
														</th>
														<th>Date</th>
														<th>Purchase</th>
														<th>Reference</th>
														<th>Supplier Name</th>
														<th>Amount</th>
														<th>Paid</th>
														<th>Paid By</th>
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
														<td>19 Jan 2023</td>
														<td>PR_0001</td>
														<td>INV/PR_0001</td>
														<td>Apex Computers</td>
														<td>$1800</td>
														<td>$1800</td>
														<td>Cash</td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>24 Jan 2023</td>
														<td>PR_0002</td>
														<td>INV/PR_0002</td>
														<td>Beats Headphones</td>
														<td>$1100</td>
														<td>$1100</td>
														<td>Cash</td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>02 Feb 2023</td>
														<td>PR_0003</td>
														<td>INV/PR_0003</td>
														<td>Dazzle Shoes</td>
														<td>$2000</td>
														<td>$2000</td>
														<td>Cash</td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>15 Feb 2023</td>
														<td>PR_0004</td>
														<td>INV/PR_0004</td>
														<td>Best Accessories</td>
														<td>$700</td>
														<td>$700</td>
														<td>Cash</td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>12 Mar 2023</td>
														<td>PR_0005</td>
														<td>INV/PR_0005</td>
														<td>Aesthetic Bags</td>
														<td>$500</td>
														<td>$500</td>
														<td>Cash</td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>26 Mar 2023</td>
														<td>PR_0006</td>
														<td>INV/PR_0006</td>
														<td>Hatimi Hardwares</td>
														<td>$1600</td>
														<td>$1600</td>
														<td>Cash</td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>16 Apr 2023</td>
														<td>PR_0007</td>
														<td>INV/PR_0007</td>
														<td>Shine Bags</td>
														<td>$600</td>
														<td>$600</td>
														<td>Cash</td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>24 Apr 2023</td>
														<td>PR_0008</td>
														<td>INV/PR_0008</td>
														<td>Alpha Mobiles</td>
														<td>$120</td>
														<td>$120</td>
														<td>Cash</td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>13 May 2023</td>
														<td>PR_0009</td>
														<td>INV/PR_0009</td>
														<td>Sigma Chairs</td>
														<td>$300</td>
														<td>$300</td>
														<td>Cash</td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>29 May 2023</td>
														<td>PR_0010</td>
														<td>INV/PR_0011</td>
														<td>Zenith Bags</td>
														<td>$350</td>
														<td>$350</td>
														<td>Cash</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- /product list -->
							</div>
							<div class="tab-pane fade" id="return-report" role="tabpanel" aria-labelledby="return-report-tab">
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
												<a class="btn btn-filter" id="filter_search2">
													<i data-feather="filter" class="filter-icon"></i>
													<span><img src="assets/img/icons/closes.svg" alt="img"></span>
												</a>
											</div>
											<div class="form-sort">
												<i data-feather="sliders" class="info-img"></i>
												<select class="select">
													<option>Sort by Date</option>
													<option>24 09 23</option>
													<option>30 09 23</option>
												</select>
											</div>
										</div>
										<!-- /Filter -->
										<div class="card" id="filter_inputs2">
											<div class="card-body pb-0">
												<div class="row">
													<div class="col-lg-3 col-sm-6 col-12">
														<div class="input-blocks">
															<i data-feather="user" class="info-img"></i>
															<select class="select">
																<option>Choose Name</option>
																<option>Apex Computers</option>
																<option>Beats Headphones</option>
															</select>
														</div>
													</div>
													<div class="col-lg-3 col-sm-6 col-12">
														<div class="input-blocks">
															<i data-feather="stop-circle" class="info-img"></i>
															<select class="select">
																<option>Choose Status</option>
																<option>Completed</option>
																<option>Incompleted</option>
															</select>
														</div>
													</div>
													<div class="col-lg-3 col-sm-6 col-12">
														<div class="input-blocks">
															<img src="assets/img/icons/payment-status.svg" class="info-img status-icon" alt="Icon">
															<select class="select">
																<option>Choose Payment Status</option>
																<option>Paid</option>
																<option>Unpaid</option>
																<option>Overdue</option>
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
										<div class="table-responsive">
											<table class="table  datanew">
												<thead>
													<tr>
														<th class="no-sort">
															<label class="checkboxs">
																<input type="checkbox" id="select-all3">
																<span class="checkmarks"></span>
															</label>
														</th>
														<th>Reference</th>
														<th>Supplier Name</th>
														<th>Amount</th>
														<th>Paid</th>
														<th>Due Amount</th>
														<th>Status</th>
														<th>Payment Status</th>
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
														<td>PR0001</td>
														<td>Apex Computers</td>
														<td>$1800</td>
														<td>$1800</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Completed</span></td>
														<td><span class="badge-linesuccess">Paid</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>PR0002</td>
														<td>Beats Headphones</td>
														<td>$1200</td>
														<td>$0.00</td>
														<td>$1200</td>
														<td><span class="badges status-badge">Completed</span></td>
														<td><span class="badge badge-linedanger">Unpaid</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>PR0003</td>
														<td>Dazzle Shoes</td>
														<td>$2000</td>
														<td>$2000</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Completed</span></td>
														<td><span class="badge-linesuccess">Paid</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>PR0004</td>
														<td>Best Accessories</td>
														<td>$1300</td>
														<td>$1300</td>
														<td>$1300</td>
														<td><span class="badges status-badge">Completed</span></td>
														<td><span class="badges-warning">Overdue</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>PR0005</td>
														<td>Aesthetic Bags</td>
														<td>$400</td>
														<td>$0.00</td>
														<td>$400</td>
														<td><span class="badges status-badge">Completed</span></td>
														<td><span class="badge badge-linedanger">Unpaid</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>PR0006</td>
														<td>Hatimi Hardwares</td>
														<td>$700</td>
														<td>$700</td>
														<td>$700</td>
														<td><span class="badges status-badge">Completed</span></td>
														<td><span class="badges-warning">Overdue</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>PR0007</td>
														<td>Shine Bags</td>
														<td>$800</td>
														<td>$800</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Completed</span></td>
														<td><span class="badge-linesuccess">Paid</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>PR0008</td>
														<td>Alpha Mobiles</td>
														<td>$300</td>
														<td>$300</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Completed</span></td>
														<td><span class="badge-linesuccess">Paid</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>PR0009</td>
														<td>Sigma Chairs</td>
														<td>$120</td>
														<td>$120</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Completed</span></td>
														<td><span class="badge-linesuccess">Paid</span></td>
													</tr>
													<tr>
														<td>
															<label class="checkboxs">
																<input type="checkbox">
																<span class="checkmarks"></span>
															</label>
														</td>
														<td>PR0010</td>
														<td>Zenith Bags</td>
														<td>$600</td>
														<td>$600</td>
														<td>$0.00</td>
														<td><span class="badges status-badge">Completed</span></td>
														<td><span class="badge-linesuccess">Paid</span></td>
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
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<?php include 'layouts/customizer.php'; ?>

		<?php include 'layouts/vendor-scripts.php'; ?>
	
    </body>
</html>