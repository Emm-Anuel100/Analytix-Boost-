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
									<h4>Sales Return List</h4>
									<h6>Manage your Returns</h6>
								</div>
							</div>
							<ul class="table-top-head">
								<li>
									<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export_returns_pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
								</li>
								<li>
									<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export_returns_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
								</li>
								<li>
									<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
								</li>
								<li>
									<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
								</li>
							</ul>
							<div class="page-btn">
								<a href="javascript:void(0);" class="btn btn-added"  data-bs-toggle="modal" data-bs-target="#add-sales-new"><i data-feather="plus-circle" class="me-2"></i>Add New Sales Return</a>
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
											<select class="select" name="sort_order" onchange="this.form.submit()">
												<option value="newest" <?php if (isset($_POST['sort_order']) && $_POST['sort_order'] == 'newest') echo 'selected'; ?>>Newest</option>
												<option value="oldest" <?php if (isset($_POST['sort_order']) && $_POST['sort_order'] == 'oldest') echo 'selected'; ?>>Oldest</option>
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
												<th>Product</th>
												<th>Date</th>
												<th>Customer</th>
												<th>Reference</th>
												<th>Status</th>
												<th>Grand Total (₦)</th>
												<th>Returned (₦)</th>
												<th>Return Reason</th>
												<th>Qty</th>
												<th class="no-sort">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php  
										$user_email = $_SESSION['email']; // user's email

										// Set default sorting order
										$order_by = "ORDER BY id DESC"; // Newest by default

										// Check if a sort option has been submitted
										if (isset($_POST['sort_order'])) {
											$sort_order = $_POST['sort_order'];

											// Adjust sorting based on selected option
											if ($sort_order == "newest") {
												$order_by = "ORDER BY id DESC"; // Newest first
											} elseif ($sort_order == "oldest") {
												$order_by = "ORDER BY id ASC"; // Oldest first
											}
										}

										// Fetch data from sales_return table
										$query = "SELECT id, customer, date, reference, return_reason, status, 
										grand_total_returned, amount_returned, products FROM sales_return WHERE user_email = '$user_email' $order_by";
										$result = $conn->query($query);

										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												// Parse products string from the `products` column
												$products = explode('; ', $row['products']); // Separate products
										
												foreach ($products as $product_str) {
													// Extract product details using regex
													preg_match('/(.*) \(quantity: (\d+), price: ([\d.]+), image: (.*), discount type: (.*), discount value: ([\d.]+), tax: ([\d.]+), unit: (.*), total cost: ([\d.]+)\)/', $product_str, $matches);
										
													if ($matches) {
														// Generate a new row for each product
														echo '<tr>';
										
														// Checkbox
														echo '<td><label class="checkboxs"><input type="checkbox"><span class="checkmarks"></span></label></td>';
										
														// Product name and image
														echo '<td>';
														echo '<div class="productimgname">';
														echo '<a href="javascript:void(0);" class="product-img">';
														echo '<img src="uploads/' . $matches[4] . '" alt="product image">';
														echo '</a>';
														echo '<a href="javascript:void(0);">' . $matches[1] . '</a>'; // Product name
														echo '</div>';
														echo '</td>';
										
														// Shared sale details
														echo '<td>' . $row['date'] . '</td>';
														echo '<td>' . $row['customer'] . '</td>';
														echo '<td>' . $row['reference'] . '</td>';
														echo '<td><span class="badges bg-lightgreen">' . $row['status'] . '</span></td>';
										
														// Grand Total, Paid, Due, and Amount Returned
														echo '<td>' . $row['grand_total_returned'] . '</td>';
														echo '<td>' . $row['amount_returned'] . '</td>';
														echo '<td>' . $row['return_reason'] . '</td>';
										
														// Quantity Column (Qty)
														echo '<td>' . $matches[2] . '</td>'; // Display the quantity from the product
										
														// Action (Delete button)
														echo '<td class="action-table-data">';
														echo '<div class="edit-delete-action">';
														echo '<a class="confirm-tex p-2 delete_btn" href="javascript:void(0);" data-id="' . $row['id'] . '" onclick="delete_return();"><i data-feather="trash-2" class="feather-trash-2"></i></a>';
														echo '</div>';
														echo '</td>';
										
														echo '</tr>';
													}
												}
											}
										} else {
											// Display demo data when no records are found
											echo '<tr>';
											echo '<td><label class="checkboxs"><input type="checkbox"><span class="checkmarks"></span></label></td>';
											echo '<td>';
											echo '<div class="productimgname">';
											echo '<a href="javascript:void(0);" class="product-img">';
											echo '<img src="uploads/default_product.jpg" alt="product image" height="40px" width="40px" style="border-radius: 5px">'; // Demo image
											echo '</a>';
											echo '<a href="javascript:void(0);">Demo Product</a>'; // Demo product name
											echo '</div>';
											echo '</td>';
											echo '<td>' . date('Y-m-d') . '</td>'; // Current date
											echo '<td>Demo Customer</td>';
											echo '<td>Demo Reference</td>';
											echo '<td><span class="badges bg-lightgreen">Demo Status</span></td>';
											echo '<td>' . number_format(50.00, 2) . '</td>'; // Demo grand total returned
											echo '<td>' . number_format(50.00, 2) . '</td>'; // Demo amount returned
											echo '<td>Demo Reason</td>'; // Demo return reason
											echo '<td>1</td>'; // Demo quantity
											echo '<td class="action-table-data">';
											echo '<div class="edit-delete-action">';
											echo '<a class="confirm-tex p-2 delete_btn" href="javascript:void(0);" data-id="demo" onclick="delete_return();"><i data-feather="trash-2" class="feather-trash-2"></i></a>';
											echo '</div>';
											echo '</td>';
											echo '</tr>';
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
			<!-- /Main Wrapper -->

			<!-- add popup -->
			<div class="modal fade" id="add-sales-new">
				<div class="modal-dialog add-centered">
					<div class="modal-content">
						<div class="page-wrapper p-0 m-0">
							<div class="content p-0">
								<div class="modal-header border-0 custom-modal-header">
									<div class="page-title">
										<h4> Add Sales Return</h4>
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
														<option value="Received">Received</option>
														<!-- <option value="Pending">Pending</option> -->
													</select>
												</div>
											</div>

											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Amount Returned To Customer (₦)</label>
														<input type="text" placeholder="100" required name="amount_returned">
												</div>
											</div>

											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Reference</label>
														<input type="text" placeholder="W34wgft665 .." required name="reference">
												</div>
											</div>
											
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Return Reason</label>
														<input type="text" placeholder="Broken .." required name="return_reason">
												</div>
											</div>

											<div class="col-lg-12 text-end">
												<button type="button"  class="btn btn-cancel add-cancel me-3" data-bs-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-submit add-sale">Add Return</button>
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
										 <img class="image_url" src="uploads/${product.image_url}" alt="product image">
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
        unit: row.cells[6].textContent 
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

    // Send the data to the PHP script
	fetch('add_sales_return.php', {
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
			text: 'Sales return added successfully.',
			confirmButtonText: 'OK'
		}).then(() => {
			location.reload(); // Reload the page after succesful entry
		});
        } else {
            swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Failed to submit sales return.',
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
			text: 'An error occurred while submitting sales return.',
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

    // Split the productsString into individual product entries 
    const productsArray = productsString.split(";"); // ";" actually separates products

    productsArray.forEach(product => {
        // Regex pattern to include total cost
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


// Delete Sales return button functionality
// Select all delete buttons
const delete_btns_return = document.querySelectorAll('.delete_btn');

delete_btns_return.forEach(delete_btn => {
    delete_btn.addEventListener('click', function(e) {
        e.preventDefault();
        
        var saleId = $(this).data('id'); // Get the sale ID from the data attribute

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
                // AJAX request to delete the sale
                $.ajax({
                    url: 'delete_return.php', // The PHP page handling the delete request
                    type: 'GET',              // Passing the ID via GET
                    data: {id: saleId},       // Pass the sale ID
                    success: function(response) {
                        // Check for success in the response
                        if (response.includes('successfully')) {
                            Swal.fire(
                                'Deleted!',
                                'Sale return has been deleted.',
                                'success'
                            ).then(() => {
                                // Optionally, remove the deleted row or reload the page
                                location.reload(); // Reload the page to reflect the changes
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an issue deleting the sale return.',
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'There was an issue with the request.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>
</body>
</html>