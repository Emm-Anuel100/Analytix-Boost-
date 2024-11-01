<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "./layouts/session.php";

include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();

// Update individual sale details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customer_name']) && !empty($_POST['customer_name'])) {
    $saleId = $_POST['sale_id'];
    $customerName = $_POST['customer_name'];
    $paymentBy = $_POST['payment_by'];
    $saleDate = $_POST['sale_date'];
    $status = $_POST['status'];
    $amountPaid = $_POST['amount_paid'];
    $amountDue = $_POST['amount_due'];
    $changeElement = $_POST['change_element'];

    // Update query
    $sql = "UPDATE sales SET 
        customer = ?, 
        payment_by = ?, 
        date = ?, 
        status = ?, 
        amount_paid = ?, 
        amount_due = ?, 
        change_element = ? 
        WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiii", $customerName, $paymentBy, $saleDate, $status, $amountPaid, $amountDue, $changeElement, $saleId);

    if ($stmt->execute()) {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            swal.fire({
                title: 'Success!',
                text: 'Sales details updated successfully.',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
        </script>
        <?php
    } else {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            swal.fire({
                title: 'Error!',
                text: 'There was an error',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        });
        </script>
        <?php
    }

    // Close Statement
    $stmt->close();
}
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
								<h4>Sales List</h4>
								<h6>Manage Your Sales</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="generate-sales-pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="generate-sales-csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-sales-new"><i data-feather="plus-circle" class="me-2"></i> Add New Sales</a>
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
									<select name="sort_order" class="select" onchange="this.form.submit()">
										<option value="newest" <?= (isset($_POST['sort_order']) && $_POST['sort_order'] === 'newest') ? 'selected' : '' ?>>Newest</option>
										<option value="oldest" <?= (isset($_POST['sort_order']) && $_POST['sort_order'] === 'oldest') ? 'selected' : '' ?>>Oldest</option>
									</select>
								</form>
							</div>
							</div>
							
							<div class="table-responsive">
							<?php  
							$user_email = $_SESSION['email'];  // user email

							// Determine sort order based on form submission
							$sortOrder = isset($_POST['sort_order']) ? $_POST['sort_order'] : 'newest';

							// Set SQL order clause based on selected option
							$orderClause = ($sortOrder === 'oldest') ? 'ASC' : 'DESC';

							// Fetch sales data from the database with the dynamic order clause
							$salesQuery = "SELECT * FROM sales WHERE user_email = '$user_email' ORDER BY id $orderClause"; 
							$salesResult = $conn->query($salesQuery);
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
										<th>Customer Name</th>
										<th>Reference</th>
										<th>Date</th>
										<th>Status</th>
										<th>Grand Total (₦)</th>
										<th>Payment By</th>
										<th>Paid (₦)</th>
										<th>Due (₦)</th>
										<th>Change Element (₦)</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody class="sales-list">
								<?php if ($salesResult->num_rows > 0) { ?>
									<?php while ($sale = $salesResult->fetch_assoc()) { ?>
										<tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>
											<td><?= htmlspecialchars($sale['customer']) ?></td>
											<td><?= htmlspecialchars($sale['reference']) ?></td>
											<td><?= htmlspecialchars($sale['date']) ?></td>
											<td>
												<?php 
												// Set badge class based on status
												$badgeClass = ($sale['status'] === 'In Progress') ? 'badge badge-warning' : 'badge badge-bgsuccess'; 
												?>
												<span class="<?= $badgeClass ?>"><?= htmlspecialchars($sale['status']) ?></span>
											</td>
											<td><?= htmlspecialchars($sale['grand_total']) ?></td>
											<td><?= htmlspecialchars($sale['payment_by']) ?></td>
											<td><?= htmlspecialchars($sale['amount_paid']) ?></td>
											<td><?= htmlspecialchars($sale['amount_due']) ?></td>
											<td><?= htmlspecialchars($sale['change_element']) ?></td>
											<td class="text-center">
												<a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
													<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
												</a>
												<ul class="dropdown-menu">
													<li>
														<a href="#" class="dropdown-item" 
														id="sales_anchor"
														data-bs-toggle="modal" 
														data-id="<?= $sale['id'] ?>" 
														data-customer="<?= $sale['customer'] ?>" 
														data-reference="<?= $sale['reference'] ?>" 
														data-status="<?= $sale['status'] ?>" 
														data-grand-total="<?= $sale['grand_total'] ?>"
														data-payment-by="<?= $sale['payment_by'] ?>" 
														data-amount-paid="<?= $sale['amount_paid'] ?>" 
														data-amount-due="<?= $sale['amount_due'] ?>" 
														data-change-element="<?= $sale['change_element'] ?>"
														data-products="<?= $sale['products'] ?>"
														data-bs-target="#sales-details-new"
														onclick="storeSalesData(this)">
															<i data-feather="eye" class="info-img"></i> Sale Detail
														</a>
													</li>
													<li>
														<a href="#" class="dropdown-item" data-bs-toggle="modal"
														data-customer="<?= $sale['customer'] ?>" 
														data-reference="<?= $sale['reference'] ?>" 
														data-status="<?= $sale['status'] ?>" 
														data-grand-total="<?= $sale['grand_total'] ?>"
														data-payment-by="<?= $sale['payment_by'] ?>" 
														data-amount-paid="<?= $sale['amount_paid'] ?>" 
														data-amount-due="<?= $sale['amount_due'] ?>" 
														data-date="<?= $sale['date'] ?>" 
														data-change-element="<?= $sale['change_element'] ?>" 
														data-id="<?= htmlspecialchars($sale['id']) ?>" 
														data-bs-target="#edit-sales-new">
															<i data-feather="edit" class="info-img"></i>Edit Detail
														</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="dropdown-item confirm-tet mb-0" data-id="<?= htmlspecialchars($sale['id']) ?>">
															<i data-feather="trash-2" class="info-img"></i>Delete Sale
														</a>
													</li>
												</ul>
											</td>
										</tr>
									<?php } ?>
								<?php } else { ?>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td>Demo Customer</td>
										<td>Demo Reference</td>
										<td><?= date('Y-m-d') ?></td>
										<td>
											<span class="badge badge-warning">Demo Status</span>
										</td>
										<td>100.00</td>
										<td>Cash</td>
										<td>100.00</td>
										<td>0.00</td>
										<td>0.00</td>
										<td class="text-center">
											<a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
												<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
											</a>
											<ul class="dropdown-menu">
												<li>
													<a href="#" class="dropdown-item" data-bs-toggle="modal">
														<i data-feather="eye" class="info-img"></i> Sale Detail
													</a>
												</li>
												<li>
													<a href="#" class="dropdown-item" data-bs-toggle="modal">
														<i data-feather="edit" class="info-img"></i>Edit Detail
													</a>
												</li>
												<li>
													<a href="javascript:void(0);" class="dropdown-item confirm-te mb-0">
														<i data-feather="trash-2" class="info-img"></i>Delete Sale
													</a>
												</li>
											</ul>
										</td>
									</tr>
								<?php } ?>
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


		<!--add popup -->
		<div class="modal fade" id="add-sales-new">
			<div class="modal-dialog add-centered">
				<div class="modal-content">
					<div class="page-wrapper p-0 m-0">
						<div class="content p-0">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4> Add Sales</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="card">
								<div class="card-body">

									<form id="sales-form">
										<div class="row">
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Customer Name</label>
													<div class="row">
														<div class="col-lg-10 col-sm-10 col-10">
															<select class="select" name="customer_name">
																<option value="Walk-in-customer">Walk-in-customer</option>
															</select>
														</div>
														<div class="col-lg-2 col-sm-2 col-2 ps-0">
															<div class="add-icon">
																<a href="customers.php" class="choose-add"><i data-feather="plus-circle" class="plus"></i></a>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Date</label>
													<div class="input-groupicon calender-input">
														<i data-feather="calendar" class="info-img"></i>
														<input type="text" class="datetimepicker" placeholder="Choose" required name="date">
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Product Barcode</label>
													<div class="input-groupicon select-code">
														<input type="text" id="barcode-input" placeholder="Enter product code">
														<div class="addonset">
															<img src="assets/img/icons/qrcode-scan.svg" alt="img">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="table-responsive no-pagination">
											<table class="table  datanew">
												<thead>
													<tr>
														<th>Product</th>
														<th>Qty</th>
														<th>Price (₦)</th>
														<th>Discount Type</th>
														<th>Discount Value</th>
														<th>Tax Amount (₦)</th>
														<th>Unit</th>
														<th>Total Cost (₦)</th>
													</tr>
												</thead>
												
												<tbody id="product-table-body">
													<!-- Rows will be inserted here via AJAX -->
												  <tr>
													<td>
																								
													</td>
													<td> </td>
													<td> </td>
													<td> </td>
													<td> </td>
													<td> </td>
													<td> </td>
													<td> </td>
												  </tr>
												</tbody>
											</table>
										</div>

			
										<div class="row">
											<div class="col-lg-6 ms-auto">
												<div class="total-order w-100 max-widthauto m-auto mb-4">
													<ul>
														<li>
															<h4>Grand Total</h4>
															<h5><input type="text" name="grand_total" class="grand_total" value="0.00" style="font-weight: 800; font-size: 18px; border: none; width: 110px; color: #092c4c; margin-right: 40px"></h5>
															<!-- <h5><b class="grand_total">₦ 0.00</b></h5> -->
														</li>
													</ul>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-5">
													<label>Status</label>
													<select class="select" name="status">
														<option value="Completed">Completed</option>
														<option value="In Progress">In Progress</option>
													</select>
												</div>
											</div>

											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-5">
													<label>Payment By</label>
													<select class="select" name="payment_by">
														<option value="Card">Card</option>
														<option value="Transfer">Transfer</option>
														<option value="Cash">Cash</option>
														<option value="Due">Due</option>
													</select>
												</div>
											</div>

											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Amount Paid (₦)</label>
														<input type="text" placeholder="0" required name="amount_paid">
												</div>
											</div>

											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Amount Due (₦)</label>
														<input type="text" placeholder="0" required name="amount_due">
												</div>
											</div>

											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Change Element (₦)</label>
														<input type="text" placeholder="0" required name="change_element">
												</div>
											</div>
											<div class="col-lg-12 text-end">
												<button type="button"  class="btn btn-cancel add-cancel me-3" data-bs-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-submit add-sale">Submit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /add popup -->

		<!-- details popup -->
		<div class="modal fade" id="sales-details-new">
			<div class="modal-dialog sales-details-modal">
				<div class="modal-content">
					<div class="page-wrapper details-blk">
						<div class="content p-0">
							<div class="page-header p-4 mb-0">
								<div class="add-item d-flex">
									<div class="page-title modal-datail">
										<h4>Sales Detail</h4>
									</div>
									<div class="page-btn">
										<a href="#" class="btn btn-added"><i data-feather="plus-circle" class="me-2"></i> Add New Sales</a>
									</div>
								</div>
								<ul class="table-top-head">
									<li>
										<a id="pdf-generate" data-bs-toggle="tooltip" data-bs-placement="top" title="Receipt"><i data-feather="printer" class="feather-rotate-ccw"></i></a>
									</li>
								</ul>
							</div>
							
							<div class="card">
								<div class="card-body">
									<form action="sales-list.php">
										<div class="invoice-box table-height" style="max-width: 1600px;width:100%;overflow: auto;padding: 0;font-size: 14px;line-height: 24px;color: #555;">
											<div class="sales-details-items d-flex">
												<div class="details-item">
													<h6>Customer's Name</h6>
													<p id="modal-customer-info">
													</p>
												</div>

												<div class="details-item">
													<h6>Invoice Info</h6>
													<p>Reference<br>
														Status
													</p>
												</div>
												<div class="details-item" style="margin-top: 2rem"> 
													<h5><span style="margin: 10px 0" id="modal-sales-ref"></span> <p id="modal-sale-status"></p></h5>
												</div>
											</div>
											<h5 class="order-text">Order Summary</h5>
											<div class="table-responsive no-pagination">
												<table class="table datanew">
												<thead>
													<tr>
														<th>Product</th>
														<th>Qty</th>
														<th>Price (₦)</th>
														<th>Discount Type</th>
														<th>Discount Value</th>
														<th>Tax Amount (₦)</th>
														<th>Unit</th>
														<th>Total Cost (₦)</th>
													</tr>
												</thead>
												<tbody id="modal-products-tbody">
													<!-- Rows will be populated dynamically here by JavaScript -->
												  <tr>
													<td> </td>
													<td> </td>
													<td> </td>
													<td> </td>
													<td> </td>
													<td> </td>
													<td> </td>
													<td> </td>
												  </tr>
												</tbody>
											</table>
											</div>
										</div>
										
										<div class="row">
											<div class="row">
												<div class="col-lg-6 ms-auto">
													<div class="total-order w-100 max-widthauto m-auto mb-4 ">
														<ul>
															<li>
																<h4>Grand Total</h4>
																<h5>₦ <span id="modal-grand-total"></span></h5>
															</li>
															<li>
																<h4>Payment By</h4>
																<h5><span id="modal-payment-by"></span></h5>
															</li>
															<li>
																<h4>Paid</h4>
																<h5>₦ <span id="modal-amount-paid"></span></h5>
															</li>
															<li>
																<h4>Due</h4>
																<h5>₦ <span id="modal-amount-due"></span></h5>
															</li>
															<li>
																<h4>Change Element</h4>
																<h5>₦ <span id="modal-change-element"></span></h5>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /details popup -->

		<!-- edit popup -->
		<div class="modal fade" id="edit-sales-new">
			<div class="modal-dialog edit-sales-modal">
				<div class="modal-content">
					<div class="page-wrapper p-0 m-0">
						<div class="content p-0">
							<div class="page-header p-4 mb-0">
								<div class="add-item new-sale-items d-flex">
									<div class="page-title">
										<h4>Edit Detail</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
							<div class="card">
								<div class="card-body">

								<form action="sales-list.php" method="post">
								<div class="modal-body">
									<input type="hidden" name="sale_id" id="sale_id"> <!-- Hidden field for sale ID -->
									<div class="row">
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Customer Name</label>
												<div class="row">
													<div class="col-lg-10 col-sm-10 col-10">
														<select class="select" name="customer_name" id="customer_name_edit">
															<option>Walk-in-customer</option>
															<!-- Add more customers if needed -->
														</select>
													</div>
													<div class="col-lg-2 col-sm-2 col-2 ps-0">
														<div class="add-icon">
															<a href="customers.php" class="choose-add"><i data-feather="plus-circle" class="plus"></i></a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks mb-5">
												<label>Payment By</label>
												<select class="select" name="payment_by" id="payment_by_edit">
													<option value="Card">Card</option>
													<option value="Transfer">Transfer</option>
													<option value="Cash">Cash</option>
													<option value="Due">Due</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Date</label>
												<div class="input-groupicon calender-input">
													<i data-feather="calendar" class="info-img"></i>
													<input type="text" class="datetimepicker" name="sale_date" id="sale_date_edit" placeholder="Choose" required>
												</div>
											</div>
										</div>

										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks mb-5">
												<label>Status</label>
												<select class="select" name="status" id="status_edit">
													<option value="Completed">Completed</option>
													<option value="In Progress">In Progress</option>
												</select>
											</div>
										</div>

										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Amount Paid (₦)</label>
												<input type="text" name="amount_paid" id="amount_paid_edit" placeholder="0" required>
											</div>
										</div>

										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Amount Due (₦)</label>
												<input type="text" name="amount_due" id="amount_due_edit" placeholder="0" required>
											</div>
										</div>

										<div class="col-lg-2 col-sm-6 col-12">
											<div class="input-blocks">
												<label>Change Element (₦)</label>
												<input type="text" name="change_element" id="change_element_edit" placeholder="0" required>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-cancel add-cancel me-3" data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit add-sale">Submit</button>
								</div>
							</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /edit popup -->

	   <?php include 'layouts/customizer.php'; ?>

	   <?php include 'layouts/vendor-scripts.php'; ?>
	

<script src="assets/js/refresh.js"></script>
<script async>
	$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

    document.addEventListener('DOMContentLoaded', function() {
    const grandTotalElement = document.querySelector('.grand_total'); // Element to update Grand Total
	const salesForm = document.getElementById('sales-form'); // Form containing sales data
	const barcodeInput = document.getElementById('barcode-input'); // Bracode input field

	// Calculate grand total
    function updateGrandTotal() {
        let grandTotal = 0;

        // Loop through all rows and sum up the total costs
        document.querySelectorAll('#product-table-body .total-cost').forEach(function(totalCostCell) {
            const totalCost = parseFloat(totalCostCell.textContent);
            grandTotal += totalCost;
        });

        // Update the Grand Total in the UI
        grandTotalElement.value = `${grandTotal.toFixed(2)}`;
    }


	let debounceTimeout; // Declare a timeout variable

	barcodeInput.addEventListener('input', function () {
	clearTimeout(debounceTimeout); // Clear the previous timeout to reset the waiting period

	// Set a new timeout to wait 1 second after the input
	debounceTimeout = setTimeout(() => {
	 const barcode = this.value;

	 if (barcode !== "") {
		 // Make AJAX request to fetch product details based on barcode
		 fetch('fetch_product.php', {
			 method: 'POST',
			 headers: {
				 'Content-Type': 'application/json'
			 },
			 body: JSON.stringify({ barcode: barcode })
		 })
		 .then(response => response.json())
		 .then(data => {
			 if (data.success) {
				 const product = data.product;

				 // Check if the product is already in the table
				 const existingRow = document.querySelector(`#product-table-body tr[data-barcode="${barcode}"]`);

				 if (existingRow) {
					 // Product already exists, increment quantity and update total cost
					 const qtyInput = existingRow.querySelector('.quantity-input');
					 const currentQty = parseInt(qtyInput.value);
					 const newQty = currentQty + 1; // Increment the current quantity
					 qtyInput.value = newQty; // Update the quantity input

					 // Clear barcode input field
					 barcodeInput.value = '';

					 // Update total cost based on new quantity using the returned total cost
					 const totalCostCell = existingRow.querySelector('.total-cost');
					 const newTotalCost = newQty * parseFloat(product.total_cost); // Use the total_cost returned from the server
					 totalCostCell.textContent = newTotalCost.toFixed(2); // Reflect updated total cost

				 } else {
					 // Product does not exist, add a new row
					 const productRow = `
						 <tr data-barcode="${barcode}">
							 <td>
								 <div class="productimgname">
									 <a href="javascript:void(0);" class="product-img stock-img">
										 <img class="image_url" src="uploads/${product.image_url}" alt="product">
									 </a>
									 <a href="javascript:void(0);" class="product-name">${product.name}</a>
								 </div>
							 </td>
							 <td><input type="text" class="quantity-input" value="1" style="width: 40px" readonly></td>
							 <td>${product.price.toFixed(2)}</td>
							 <td>${product.discount_type}</td>
							 <td>${product.discount_value.toFixed(2)}</td>
							 <td>${product.tax_value.toFixed(2)}</td>
							 <td>${product.unit}</td>
							 <td class="total-cost">${product.total_cost.toFixed(2)}</td>
						 </tr>
					 `;

					 // Append the new row to the table without resetting existing rows
					 document.getElementById('product-table-body').insertAdjacentHTML('beforeend', productRow);

					 // Clear barcode input field
					 barcodeInput.value = '';
				 }

				 // Call the function to update the grand total after adding or updating the row
				 updateGrandTotal();

			 } else {
				 swal.fire({
					 icon: 'error',
					 title: ' ',
					 text: 'The scanned product is not available in the system.',
					 confirmButtonText: 'OK'
				 });

				 // Clear barcode input field
				 barcodeInput.value = '';
			 }
		 })
		 .catch(error => {
			 console.error('Error:', error);
		 });
	 }
	 }, 1000); // Wait 1 second before making the request
   });


	// Submit sales data
	salesForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(salesForm);
    const products = [];

    // Collect product data from the table
   document.querySelectorAll('#product-table-body tr[data-barcode]').forEach(function(row) {
    const product = {
        name: row.querySelector('.product-name').textContent, // Add product name
        image_url: row.querySelector('.image_url').src.split('/').pop(), // Extract only the image file name
        quantity: row.querySelector('.quantity-input').value,
        price: row.cells[2].textContent,
        discountType: row.cells[3].textContent,
        discountValue: row.cells[4].textContent,
        taxValue: row.cells[5].textContent,
        totalCost: row.querySelector('.total-cost').textContent,
        unit: row.cells[6].textContent // Add unit (if available)
    };
    products.push(product);
	});

    // Log the products data to check its format
    console.log("Products Data:", JSON.stringify(products)); // Log the products data

    // Append products to the FormData
    formData.append('products', JSON.stringify(products));
    formData.append('grand_total', grandTotalElement.value);

	// For debugging purposes, print the FormData entries
	for (const pair of formData.entries()) {
		console.log(pair[0], pair[1]); // Check if 'products' is correctly appended
	}

    // Send the data to your PHP script
	fetch('insert_sales.php', {
    method: 'POST',
    body: formData
})
.then(response => response.text()) // Get the response as text first
.then(text => {
	console.log("Raw Response from PHP:", text);  // Log the raw response

    try {
        const data = JSON.parse(text); // Try to parse the response as JSON
        console.log("Response Data:", data);

        if (data.success) {
            swal.fire({
			icon: 'success',
			title: 'Success',
			text: 'Sales data added successfully.',
			confirmButtonText: 'OK'
		}).then(() => {
			location.reload(); // Reload the page after succesful entry
		});
        } else {
            swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Failed to submit sales data.',
                confirmButtonText: 'OK'
            });
        }
    } catch (error) {
        console.error("Error parsing JSON:", error, text); // Log the error and raw response
        swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Invalid response from the server.',
            confirmButtonText: 'OK'
        });
    }
})
.catch(error => {
    console.error('Error:', error);
    swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'An error occurred while submitting sales data.',
        confirmButtonText: 'OK'
    });
  });
});
});


	// Function to populate sales text details
	document.addEventListener('DOMContentLoaded', function () {
    const salesDetailsModal = document.getElementById('sales-details-new');

    salesDetailsModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal

        // Extract data from attributes
        const reference = button.getAttribute('data-reference');
        const customer = button.getAttribute('data-customer');
        const status = button.getAttribute('data-status');
        const grandTotal = button.getAttribute('data-grand-total');
        const paymentBy = button.getAttribute('data-payment-by');
        const amountPaid = button.getAttribute('data-amount-paid');
        const amountDue = button.getAttribute('data-amount-due');
        const changeElement = button.getAttribute('data-change-element');
		const products = button.getAttribute('data-products');
		const id = button.getAttribute('data-id'); // Get the sale ID

		// Debugging to check if values are being passed
		console.log('Customer:', customer);
        console.log('Reference:', reference);
        console.log('Status:', status);
        console.log('Grand Total:', grandTotal);
        console.log('Payment By:', paymentBy);
        console.log('Amount Paid:', amountPaid);
        console.log('Amount Due:', amountDue);
        console.log('Change Element:', changeElement);
		console.log('Products:', products);

        // Update modal content
		const salesAnchor = document.getElementById('sales_anchor');
        salesDetailsModal.querySelector('#modal-sales-ref').textContent = reference;
        salesDetailsModal.querySelector('#modal-customer-info').textContent = customer;
        salesDetailsModal.querySelector('#modal-sale-status').textContent = status;
        salesDetailsModal.querySelector('#modal-grand-total').textContent = grandTotal;
        salesDetailsModal.querySelector('#modal-payment-by').textContent = paymentBy;
        salesDetailsModal.querySelector('#modal-amount-paid').textContent = amountPaid;
        salesDetailsModal.querySelector('#modal-amount-due').textContent = amountDue;
        salesDetailsModal.querySelector('#modal-change-element').textContent = changeElement;

		// Populate the product details table in the modal
		populateProductsTable(products);
    });
});


// Function to populate the product details table in the modal
function populateProductsTable(productsString) {
    const tbody = document.getElementById("modal-products-tbody");
    tbody.innerHTML = ''; // Clear any existing rows

    // Split the productsString into individual product entries (based on how they are delimited)
    const productsArray = productsString.split(";"); // Assuming ";" separates products

    productsArray.forEach(product => {
        // Adjusted regex pattern to include total cost
        const productDetails = product.match(/(.*)\s\(quantity:\s(\d+),\sprice:\s([\d.]+),\simage:\s(.*),\sdiscount\stype:\s(.*),\sdiscount\svalue:\s([\d.]+),\stax:\s([\d.]+),\sunit:\s(.*),\stotal\scost:\s([\d.]+)\)/);

        if (productDetails) {
            const productName = productDetails[1];
            const quantity = productDetails[2];
            const price = productDetails[3];
            const image = productDetails[4];
            const discountType = productDetails[5];
            const discountValue = productDetails[6];
            const tax = productDetails[7];
            const unit = productDetails[8];
            const totalCost = productDetails[9]; // Get total cost from the regex match

            // Create a new row for this product
            const row = `
                <tr>
                    <td>
                        <div class="productimgname">
                            <a href="javascript:void(0);" class="product-img stock-img">
                                <img src="uploads/${image}" alt="${productName} image">
                            </a>
                            <a href="javascript:void(0);">${productName}</a>
                        </div>
                    </td>
                    <td>
                        <div class="product-quantity">
                            <input type="text" class="quntity-input" value="${quantity}" readonly>
                        </div>
                    </td>
                    <td>${price}</td>
                    <td>${discountType}</td>
                    <td>${discountValue}</td>
                    <td>${tax}</td>
                    <td>${unit}</td>
                    <td>${totalCost}</td> 
                </tr>
            `;

            // Append the row to the table body
            tbody.innerHTML += row;
        }
    });
  }


  // Store Products when the product detail button is clicked
  let currentSaleData = {}; // Global variable to store sale data

	function storeSalesData(button) {
		currentSaleData = {
			id: button.getAttribute('data-id'),
			products: button.getAttribute('data-products'),
			reference: button.getAttribute('data-reference'),
			grandTotal: button.getAttribute('data-grand-total'),
			changeElement: button.getAttribute('data-change-element'),
			customer: button.getAttribute('data-customer'),
			paymentBy: button.getAttribute('data-payment-by'),
			amountPaid: button.getAttribute('data-amount-paid'),
			amountDue: button.getAttribute('data-amount-due')
		};
	}


	// Generate Customer's Receipt 
	document.getElementById('pdf-generate').addEventListener('click', function(event) {

    // Log the current sale data
    console.log('Current Sale Data:', currentSaleData);

    // Check if we have data to generate the receipt
    if (Object.keys(currentSaleData).length === 0) {
        console.error("No sales data available.");
        return;
    }

    // Send the products data and other sales info as a form POST to the PHP script that generates the PDF
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'receipt.php'; // The PHP script that generates the PDF
    form.target = '_blank'; // Open in a new tab for preview

    // Create hidden input fields for each piece of data
    for (const [name, value] of Object.entries(currentSaleData)) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        form.appendChild(input);
    }

    // Append the form and submit it
    document.body.appendChild(form);
    form.submit();

    // Remove the form after submitting
    document.body.removeChild(form);
	});


	// Set the values for the product edit Modal
	// Event listener for the Edit Detail button
	document.querySelectorAll('.dropdown-item[data-bs-toggle="modal"]').forEach(button => {
    button.addEventListener('click', function() {
        const saleId = this.getAttribute('data-id');
        const customerName = this.getAttribute('data-customer');
        const saleDate = this.getAttribute('data-date');
        const amountPaid = this.getAttribute('data-amount-paid');
        const amountDue = this.getAttribute('data-amount-due');
        const changeElement = this.getAttribute('data-change-element');

        // Populate the modal fields
        document.getElementById('sale_id').value = saleId;
        document.getElementById('customer_name_edit').value = customerName;
        document.getElementById('sale_date_edit').value = saleDate;
        document.getElementById('amount_paid_edit').value = amountPaid;
        document.getElementById('amount_due_edit').value = amountDue;
        document.getElementById('change_element_edit').value = changeElement;
    });
});


// Sale Deletion function
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.confirm-tet').forEach(function(element) {
        element.addEventListener('click', function() {
            var saleId = this.getAttribute('data-id');

			console.log("ID: " + saleId)
            
            swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to undo this!',
                icon: 'warning',
                showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the deletion by submitting a form or using AJAX
                    deleteSale(saleId);
                }
            });
        });
    });
});

function deleteSale(saleId) {
    // If using AJAX
    fetch('delete-sale.php', {
        method: 'POST',
        body: new URLSearchParams({ 'sale_id': saleId }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
    .then(response => response.text())
    .then(data => {
		console.log("Raw Response from PHP:", data);  // Log the raw response

        swal.fire('Deleted!', 'The sale has been deleted.', 'success')
            .then(() => {
                location.reload(); // Reload the page after deletion
            });
    })
    .catch(error => {
        swal.fire('Error!', 'There was an error deleting the sale.', 'error');
    });
}
</script>
</body>
</html>