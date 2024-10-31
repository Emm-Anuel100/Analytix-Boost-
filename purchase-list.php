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
				<div class="page-header transfer">
					<div class="add-item d-flex">
						<div class="page-title">
							<h4>Purchase List</h4>
							<h6>Manage your purchases</h6>
						</div>
					</div>
					<ul class="table-top-head">
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
									src="assets/img/icons/pdf.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
									src="assets/img/icons/excel.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
									src="assets/img/icons/printer.svg" alt="img"></a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
									data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
						</li>		
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
						</li>
					</ul>
					<div class="d-flex purchase-pg-btn">
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i
									data-feather="plus-circle" class="me-2"></i>Add New Purchase</a>
						</div>
						<div class="page-btn import">
							<a href="#" class="btn btn-added color" data-bs-toggle="modal" data-bs-target="#view-notes"><i
									data-feather="download" class="me-2"></i>Import Purchase</a>
						</div>
					</div>
					
				</div>

				<!-- /product list -->
				<div class="card table-list-card">
					<div class="card-body">
						<div class="table-top">
							<div class="search-set">
								<div class="search-input">
									<a href="" class="btn btn-searchset"><i data-feather="search"
											class="feather-search"></i></a>
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
									<option>Newest</option>
									<option>Oldest</option>
								</select>
							</div>
						</div>
						<!-- /Filter -->
						<div class="card" id="filter_inputs">
							<div class="card-body pb-0">
								<div class="row">
									<div class="col-lg-2 col-sm-6 col-12">
										<div class="input-blocks">
											<i data-feather="user" class="info-img"></i>
											<select class="select">
												<option>Choose Supplier Name</option>
												<option>Apex Computers</option>
												<option>Beats Headphones</option>
												<option>Dazzle Shoes</option>
												<option>Best Accessories</option>
											</select>
										</div>
									</div>
									<div class="col-lg-2 col-sm-6 col-12">
										<div class="input-blocks">
											<i data-feather="stop-circle" class="info-img"></i>
											<select class="select">
												<option>Choose Status</option>
												<option>Received</option>
												<option>Ordered</option>
												<option>Pending</option>
											</select>
										</div>
									</div>
									<div class="col-lg-2 col-sm-6 col-12">
										<div class="input-blocks">
											<i data-feather="file" class="info-img"></i>
											<select class="select">
												<option>Enter Reference</option>
												<option>PT001</option>
												<option>PT002</option>
												<option>PT003</option>
											</select>
										</div>
									</div>
									<div class="col-lg-2 col-sm-6 col-12">
										<div class="input-blocks">
											<i class="fas fa-money-bill info-img"></i>
											<select class="select">
												<option>Choose Payment Status</option>
												<option>Paid</option>
												<option>Partial</option>
												<option>Unpaid</option>
											</select>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6 col-12 ms-auto">
										<div class="input-blocks">
											<a class="btn btn-filters ms-auto"> <i data-feather="search"
													class="feather-search"></i> Search </a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Filter -->
						<div class="table-responsive product-list">
							<table class="table  datanew list">
								<thead>
									<tr>
										<th class="no-sort">
											<label class="checkboxs">
												<input type="checkbox" id="select-all">
												<span class="checkmarks"></span>
											</label>
										</th>
										<th>Supplier Name</th>
										<th>Reference</th>
										<th>Date</th>
										<th>Status</th>
										<th>Grand Total</th>
										<th>Paid</th>
										<th>Due</th>
										<th>Created by</th>
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
										<td>Apex Computers</td>
										<td>PT001 </td>
										<td>19 Jan 2023</td>
										<td><span class="badges status-badge">Received</span></td>
										<td>$550</td>
										<td>$550</td>
										<td>$0.00</td>
										<td><span class="badge-linesuccess">Paid</span></td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="javascript:void(0);">
													<i data-feather="eye" class="action-eye"></i>
												</a>
												<a class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
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
										<td>Beats Headphones</td>
										<td>PT002 </td>
										<td>27 Jan 2023</td>
										<td><span class="badges status-badge">Received</span></td>
										<td>$370</td>
										<td>$370</td>
										<td>$0.00</td>
										<td><span class="badge-linesuccess">Paid</span></td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="javascript:void(0);">
													<i data-feather="eye" class="action-eye"></i>
												</a>
												<a class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
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
										<td>Dazzle Shoes</td>
										<td>PT003 </td>
										<td>08 Feb 2023</td>
										<td><span class="badges status-badge ordered">Ordered</span></td>
										<td>$400</td>
										<td>$400</td>
										<td>$200</td>
										<td><span class="badges-warning">Partial</span></td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="javascript:void(0);">
													<i data-feather="eye" class="action-eye"></i>
												</a>
												<a class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
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
										<td>Best Accessories</td>
										<td>PT004 </td>
										<td>16 Feb 2023</td>
										<td><span class="badges unstatus-badge">Pending</span></td>
										<td>$560</td>
										<td>$0.00</td>
										<td>$560</td>
										<td><span class="badge badge-linedangered">Unpaid</span></td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="javascript:void(0);">
													<i data-feather="eye" class="action-eye"></i>
												</a>
												<a class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
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
										<td>A-Z Store</td>
										<td>PT005</td>
										<td>12 Mar 2023</td>
										<td><span class="badges unstatus-badge">Pending</span></td>
										<td>$240</td>
										<td>$0.00</td>
										<td>$240</td>
										<td><span class="badge badge-linedangered">Unpaid</span></td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="javascript:void(0);">
													<i data-feather="eye" class="action-eye"></i>
												</a>
												<a class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
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
										<td>Hatimi Hardwares</td>
										<td>PT006</td>
										<td>24 Mar 2023</td>
										<td><span class="badges status-badge">Received</span></td>
										<td>$170</td>
										<td>$170</td>
										<td>$0.00</td>
										<td><span class="badge-linesuccess">Paid</span></td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="javascript:void(0);">
													<i data-feather="eye" class="action-eye"></i>
												</a>
												<a class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
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
										<td>Aesthetic Bags</td>
										<td>PT007</td>
										<td>06 Apr 2023</td>
										<td><span class="badges unstatus-badge">Pending</span></td>
										<td>$230</td>
										<td>$0.00</td>
										<td>$230</td>
										<td><span class="badge badge-linedangered">Unpaid</span></td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="javascript:void(0);">
													<i data-feather="eye" class="action-eye"></i>
												</a>
												<a class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
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
										<td>Alpha Mobiles</td>
										<td>PT008</td>
										<td>14 Apr 2023</td>
										<td><span class="badges status-badge ordered">Ordered</span></td>
										<td>$300</td>
										<td>$150</td>
										<td>$300</td>
										<td><span class="badges-warning">Partial</span></td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="javascript:void(0);">
													<i data-feather="eye" class="action-eye"></i>
												</a>
												<a class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
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
										<td>Sigma Chairs</td>
										<td>PT009</td>
										<td>02 May 2023</td>
										<td><span class="badges unstatus-badge">Pending</span></td>
										<td>$620</td>
										<td>$0.00</td>
										<td>$620</td>
										<td><span class="badge badge-linedangered">Unpaid</span></td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="javascript:void(0);">
													<i data-feather="eye" class="action-eye"></i>
												</a>
												<a class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
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
										<td>Zenith Bags</td>
										<td>PT010</td>
										<td>23 May 2023</td>
										<td><span class="badges status-badge">Received</span></td>
										<td>$200</td>
										<td>$200</td>
										<td>$0.00</td>
										<td><span class="badge-linesuccess">Paid</span></td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<a class="me-2 p-2" href="javascript:void(0);">
													<i data-feather="eye" class="action-eye"></i>
												</a>
												<a class="me-2 p-2" data-bs-toggle="modal" data-bs-target="#edit-units">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
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
	<!-- /Main Wrapper -->

	<!-- Add Purchase -->
	<div class="modal fade" id="add-units">
		<div class="modal-dialog purchase modal-dialog-centered stock-adjust-modal">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Add Purchase</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="purchase-list.php">
								<div class="row">
									<div class="col-lg-3 col-md-6 col-sm-12">
										<div class="input-blocks add-product">
											<label>Supplier Name</label>
											<div class="row">
												<div class="col-lg-10 col-sm-10 col-10">
													<select class="select">
														<option>Select Customer</option>
														<option>Apex Computers</option>
														<option>Dazzle Shoes</option>
														<option>Best Accessories</option>
													</select>
												</div>
												<div class="col-lg-2 col-sm-2 col-2 ps-0">
													<div class="add-icon tab">
														<a href="javascript:void(0);"><i data-feather="plus-circle" class="feather-plus-circles"></i></a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-12">
										<div class="input-blocks">
											<label>Purchase Date</label>

											<div class="input-groupicon calender-input">
												<i data-feather="calendar" class="info-img"></i>
												<input type="text" class="datetimepicker" placeholder="Choose">
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-12">
										<div class="input-blocks">
											<label>Product Name</label>
											<select class="select">
												<option>Choose</option>
												<option>Shoe</option>
												<option>Mobile</option>

											</select>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-12">
										<div class="input-blocks">
											<label>Reference No</label>
											<input type="text" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="input-blocks">
											<label>Product Name</label>
											<input type="text" placeholder="Please type product code and select">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="modal-body-table">
											<div class="table-responsive">
												<table class="table  datanew">
													<thead>
														<tr>
															<th>Product</th>
															<th>Qty</th>
															<th>Purchase Price($)</th>
															<th>Discount($)</th>
															<th>Tax(%)</th>
															<th>Tax Amount($)</th>
															<th>Unit Cost($)</th>
															<th>Total Cost(%)</th>
														</tr>
													</thead>

													<tbody>
														<tr>
															<td class="p-5"></td>
															<td class="p-5"></td>
															<td class="p-5"></td>
															<td class="p-5"></td>
															<td class="p-5"></td>
															<td class="p-5"></td>
															<td class="p-5"></td>
															<td class="p-5"></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Order Tax</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Discount</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Shipping</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Status</label>
												<select class="select">
													<option>Choose</option>
													<option>Received</option>
													<option>Pending</option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="input-blocks summer-description-box">
										<label>Notes</label>
										<div id="summernote"></div>
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
	<!-- /Add Purchase -->

	<!-- Edit Purchase -->
	<div class="modal fade" id="edit-units">
		<div class="modal-dialog purchase modal-dialog-centered stock-adjust-modal">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Edit Purchase</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="purchase-list.php">							
								<div>
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Supplier Name</label>
												<div class="row">
													<div class="col-lg-10 col-sm-10 col-10">
														<select class="select">
															<option>Dazzle Shoes</option>
															<option>Apex Computers</option>
															<option>Beats Headphones</option>
														</select>
													</div>
													<div class="col-lg-2 col-sm-2 col-2 ps-0">
														<div class="add-icon tab">
															<a href="javascript:void(0);"><i data-feather="plus-circle" class="feather-plus-circles"></i></a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Purchase Date </label>
												<div class="input-groupicon">
													<input type="text" placeholder="19 Jan 2023" class="datetimepicker">
													<div class="addonset">
														<img src="assets/img/icons/calendars.svg" alt="img">
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Product Name</label>
												<select class="select">
													<option>Nike Jordan</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Reference No.</label>
												<input type="text" value="010203">
											</div>
										</div>
										<div class="col-lg-12 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Product</label>
												<div class="input-groupicon">
													<input type="text"
														placeholder="Scan/Search Product by code and select">
													<div class="addonset">
														<img src="assets/img/icons/scanners.svg" alt="img">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
										<div class="modal-body-table">
											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th>Product Name</th>
															<th>QTY</th>
															<th>Purchase Price($) </th>
															<th>Discount($) </th>
															<th>Tax %</th>
															<th>Tax Amount($)</th>
															<th class="text-end">Unit Cost($)</th>
															<th class="text-end">Total Cost ($) </th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<div class="productimgname">
																	<a href="javascript:void(0);" class="product-img stock-img">
																		<img src="assets/img/products/stock-img-02.png" alt="product">
																	</a>
																	<a href="javascript:void(0);">Nike Jordan</a>
																</div>
															</td>
															<td><div class="product-quantity">
																<span class="quantity-btn">+<i data-feather="plus-circle" class="plus-circle"></i></span>
																<input type="text" class="quntity-input" value="10">
																<span class="quantity-btn"><i data-feather="minus-circle" class="feather-search"></i></span>
															</div></td>
															<td>2000</td>
															<td>500.00</td>
															<td>0.00</td>
															<td>0.00</td>
															<td>0.00</td>
															<td>1500</td>
															<td>
																<a class="delete-set"><img
																		src="assets/img/icons/delete.svg" alt="svg"></a>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 float-md-right">
											<div class="total-order">
												<ul>
													<li>
														<h4>Order Tax</h4>
														<h5>$ 0.00</h5>
													</li>
													<li>
														<h4>Discount</h4>
														<h5>$ 0.00</h5>
													</li>
													<li>
														<h4>Shipping</h4>
														<h5>$ 0.00</h5>
													</li>
													<li class="total">
														<h4>Grand Total</h4>
														<h5>$1500.00</h5>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Order Tax</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Discount</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Shipping</label>
												<input type="text" value="0">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Status</label>
												<select class="select">
													<option>Sent</option>
													<option>Ordered</option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="input-blocks summer-description-box">
										<label>Description</label>
										<div id="summernote2">
											<p>These shoes are made with the highest quality materials. </p>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Save Changes</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Edit Purchase -->

	<!-- Import Purchase -->
	<div class="modal fade" id="view-notes">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="page-wrapper-new p-0">
					<div class="content">
						<div class="modal-header border-0 custom-modal-header">
							<div class="page-title">
								<h4>Import Purchase</h4>
							</div>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body custom-modal-body">
							<form action="purchase-list.php">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-12">
										<div class="input-blocks">
											<label>Supplier Name</label>
											<div class="row">
												<div class="col-lg-10 col-sm-10 col-10">
													<select class="select">
														<option>Choose</option>
														<option>Apex Computers</option>
														<option>Apex Computers</option>
													</select>
												</div>
												<div class="col-lg-2 col-sm-2 col-2 ps-0">
													<div class="add-icon tab">
														<a href="javascript:void(0);"><i data-feather="plus-circle" class="feather-plus-circles"></i></a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-12">
										<div class="input-blocks">
											<label>Purchase Status </label>
											<select class="select">
												<option>Choose</option>
												<option>Received</option>
												<option>Ordered</option>
												<option>Pending</option>
											</select>
										</div>
									</div>
									<div class="col-lg-12 col-sm-6 col-12">
										<div class="row">
											<div>
												<!-- <div class="input-blocks download">
													<a class="btn btn-submit">Download Sample File</a>
												</div> -->
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
									<div class="col-lg-4 col-sm-6 col-12">
										<div class="input-blocks">
											<label>Order Tax</label>
											<input type="text" value="0">
										</div>
									</div>
									<div class="col-lg-4 col-sm-6 col-12">
										<div class="input-blocks">
											<label>Discount</label>
											<input type="text" value="0" >
										</div>
									</div>
									<div class="col-lg-4 col-sm-6 col-12">
										<div class="input-blocks">
											<label>Shipping</label>
											<input type="text" value="0">
										</div>
									</div>
								</div>
								<div class="input-blocks summer-description-box transfer">
									<label>Description</label>
									<div id="summernote3">
									</div>
									<p>Maximum 60 Characters</p>
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
	<!-- /Import Purchase -->
	<?php include 'layouts/customizer.php'; ?>
	<?php include 'layouts/vendor-scripts.php'; ?>
</body>

</html>