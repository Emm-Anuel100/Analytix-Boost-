<?php 
include "./layouts/session.php"; // include session

include 'conn.php'; // Include database connection

// Establish the connection
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
								<h4>Quotation List</h4>
								<h6>Manage Your Quotation</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export_quotation_pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export_quotation_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" class="refresh" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Quotation</a>
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
									<form method="get" action="">
										<select name="sort_order" class="select" onchange="this.form.submit()">
											<option value="newest" <?php if(isset($_GET['sort_order']) && $_GET['sort_order'] == 'newest') echo 'selected'; ?>>Newest</option>
											<option value="oldest" <?php if(isset($_GET['sort_order']) && $_GET['sort_order'] == 'oldest') echo 'selected'; ?>>Oldest</option>
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
									<th>Product Name</th>
									<th>Reference</th>
									<th>Customer Name</th>
									<th>Status</th>
									<th>Description</th>
									<th class="no-sort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								// Check for sort order in the GET request
								$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'newest'; // Default to 'newest'

								// Determine the ORDER BY clause based on selected option
								$order_by = ($sort_order === 'oldest') ? 'ASC' : 'DESC';

								$user_email = $_SESSION['email']; // Get user email from session

								// Fetch quotation and product details with JOIN on product name, filtered by user email
								$query = "
									SELECT q.id, q.product_name, q.customer_name, q.description, q.status, q.reference, p.image
									FROM quotation AS q
									LEFT JOIN products AS p ON q.product_name = p.product_name
									WHERE q.user_email = ?  ORDER BY q.id $order_by
								";

								// Prepare the statement
								$stmt = $conn->prepare($query);
								$stmt->bind_param("s", $user_email); // Bind user email to the prepared statement

								// Execute the statement
								$stmt->execute();

								// Get the result
								$result = $stmt->get_result();

								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										$imagePath = $row['image'] ? 'uploads/' . $row['image'] : '';
										
										// Define the status and badge class
										$status = $row['status']; // Assuming 'status' comes from your database
										$badgeClass = '';
								
										// Determine the badge class based on status
										if ($status == 'Pending') {
											$badgeClass = 'unstatus-badge'; // Apply warning badge for pending status
										} elseif ($status == 'Approved') {
											$badgeClass = 'status-badge'; // Green badge for approved status
										} 
										echo "
										<tr>
											<td>
												<label class='checkboxs'>
													<input type='checkbox'>
													<span class='checkmarks'></span>
												</label>
											</td>
											<td class='productimgname'>
												<div class='view-product me-2'>
													<a href='javascript:void(0);'>
														<img src='{$imagePath}' alt='{$row['product_name']}'>
													</a>
												</div>
												<a href='javascript:void(0);'>{$row['product_name']}</a>
											</td>
											<td>{$row['reference']}</td>
											<td>{$row['customer_name']}</td>
											<td><span class='badges {$badgeClass}'>{$status}</span></td>
											<td>{$row['description']}</td>
											<td class='action-table-data'>
												<div class='edit-delete-action data-row'>
													<a class='me-2 p-2 mb-0' data-bs-toggle='modal' data-bs-target='#edit-units' onclick='confirmUpdate({$row['id']})'>
														<i data-feather='edit' class='feather-edit'></i>
													</a>
													<a class='me-2 confirm-tex p-2 mb-0' href='javascript:void(0);' onclick='confirmDelete({$row['id']})'>
														<i data-feather='trash-2' class='feather-trash-2'></i>
													</a>
												</div>
											</td>
										</tr>
										";
										}
									  } else {
										// Display demo data when no quotations are found
										echo "
										<tr>
											<td>
												<label class='checkboxs'>
													<input type='checkbox'>
													<span class='checkmarks'></span>
												</label>
											</td>
											<td class='productimgname'>
												<div class='view-product me-2'>
													<a href='javascript:void(0);'>
														<img src='uploads/default_product.jpg' alt='product image' height='40px' width='40px' style='border-radius: 5px'>
													</a>
												</div>
												<a href='javascript:void(0);'>demo product</a>
											</td>
											<td>demo reference</td>
											<td>demo customer</td>
											<td><span class='badges status-badge'>Approved</span></td>
											<td>hello user</td>
											<td class='action-table-data'>
												<div class='edit-delete-action data-row'>
													<a class='me-2 p-2 mb-0' data-bs-toggle='modal' data-bs-target='#edit-unit''>
														<i data-feather='edit' class='feather-edit'></i>
													</a>
													<a class='me-2 confirm-tex p-2 mb-0' href='javascript:void(0);''>
														<i data-feather='trash-2' class='feather-trash-2'></i>
													</a>
												</div>
											</td>
										</tr>
									";
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

		<!--Add Quotation -->
		<div class="modal fade" id="add-units">
			<div class="modal-dialog purchase modal-dialog-centered stock-adjust-modal">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Quotation</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
							<form action="quotation-list.php" method="POST">
									<div class="row">
										<!-- Customer Name Field -->
										<div class="col-lg-4 col-md-6 col-sm-12">
											<div class="input-blocks add-product">
												<label>Customer Name</label>
												<div class="row">
													<div class="col-lg-10 col-sm-10 col-10">
														<select name="customer_name" class="select" required>
															<option value="Walk-in-customer">Walk-in-customer</option>
														</select>
													</div>
												</div>
											</div>
										</div>

										<!-- Date Field -->
										<div class="col-lg-4 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Date</label>
												<div class="input-groupicon calender-input">
													<i data-feather="calendar" class="info-img"></i>
													<input type="text" name="quotation_date" class="datetimepicker" placeholder="Choose Date" required>
												</div>
											</div>
										</div>

										<!-- Product Name Field -->
										<div class="col-lg-4 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Product Name</label>
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
										</div>
										</div>

									<div class="col-lg-12">
										<div class="modal-body-table">
											<!-- Table -->
										</div>
									</div>

									<div class="row">
										<!-- Order Tax, Discount, Shipping, and Status Fields -->
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks mb-3">
												<label>Order Tax (₦)</label>
												<input type="text" name="order_tax" placeholder="0" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks mb-3">
												<label>Discount (₦)</label>
												<input type="text" name="discount" placeholder="0" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks mb-3">
												<label>Shipping (₦)</label>
												<input type="text" name="shipping" placeholder="0" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks mb-3">
												<label>Status</label>
												<select name="status" class="select">
													<option value="Approved">Approved</option>
													<option value="Pending">Pending</option>
												</select>
											</div>
										</div>
									</div>

									<!-- Description Field -->
									<div class="col-lg-12">
										<div class="input-blocks summer-description-box">
											<label>Description</label>
											<textarea name="description" cols="30" required></textarea>
										</div>
									</div>

									<!-- Form Submission -->
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
		<!-- /Add Quotation -->

		<!-- edit popup -->
		<div class="modal fade" id="edit-units">
			<div class="modal-dialog edit-sales-modal">
				<div class="modal-content">
					<div class="page-wrapper p-0 m-0">
						<div class="content p-0">
							<div class="page-header p-4 mb-0">
								<div class="add-item new-sale-items d-flex">
									<div class="page-title">
										<h4>Edit Quotation</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<form action="quotation-list.php" method="post">
									   <input type="hidden" id="quotation_id" name="quotation_id" value=""> <!-- input to hold id -->
										<div class="row">
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Customer Name</label>
													<div class="row">
														<div class="col-lg-10 col-sm-10 col-10">
														    <select name="customer_name" class="select">
																<option>Walk-in-customer</option>
															</select>
														</div>
														<div class="col-lg-2 col-sm-2 col-2 ps-0">
															<a href="./customers.php">
															<div class="add-icon">
																<span class="choose-add"><i data-feather="plus-circle" class="plus"></i></span>
															</div>
															</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks">
													<label>Date</label>
													<div class="input-groupicon calender-input">
														<i data-feather="calendar" class="info-img"></i>
														<input type="text" name="date" class="datetimepicker" placeholder="Choose Date" required>
													</div>
												</div>
											  </div>

											  <div class="col-lg-4 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Order Tax (₦)</label>
													<div class="input-groupicon">
													<input type="text" id="order-tax-input" name="order_tax" placeholder="0" required>
													</div>
												</div>
											</div>
										</div>
			
										<div class="row">
										<div class="col-lg-6 ms-auto">
											<div class="total-order w-100 max-widthauto m-auto mb-4">
												<ul>
													<li>
														<h4>Order Tax</h4>
														<h5>₦ <span id="order-tax-display">0.00</span></h5>
													</li>
													<li>
														<h4>Discount</h4>
														<h5>₦ <span id="discount-display">0.00</span></h5>
													</li>
													<li>
														<h4>Shipping</h4>
														<h5>₦ <span id="shipping-display">0.00</span></h5>
													</li>
												</ul>
											</div>
										</div>
									</div>
										
										<div class="row">
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Discount (₦)</label>
													<div class="input-groupicon">
													 <input type="text" id="discount-input" name="discount_edit" placeholder="0" required>
													</div>
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Shipping (₦)</label>
													<div class="input-groupicon">
													  <input type="text" name="shipping" id="shipping-input" placeholder="0" required>
													</div>
												</div>
											</div>
											<div class="col-lg-3 col-sm-6 col-12">
												<div class="input-blocks mb-3">
													<label>Status</label>
													<select class="select" name="status">
														<option>Approved</option>
														<option>Pending</option>
													</select>	
												</div>
											</div>
											<div class="col-lg-12">
												<div class="input-blocks summer-description-box">
													<label>Description</label>
													<textarea cols="30" required name="description"></textarea>
												</div>
											</div>
											<div class="col-lg-12 text-end">
												<button type="button" class="btn btn-cancel add-cancel me-3" data-bs-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-submit add-sale">Update</button>
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
		<!-- /edit popup -->
		<?php include 'layouts/customizer.php'; ?>
		<?php include 'layouts/vendor-scripts.php'; ?>



<script src="assets/js/refresh.js"></script>
<script async>

  $.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

  function confirmDelete(id) {
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
            // Make the AJAX request
            $.ajax({
                url: 'delete_quotation.php', // URL to your deletion script
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    const res = JSON.parse(response); // Parse the JSON response
                    if (res.status === 'success') {
                        Swal.fire(
                            'Deleted!',
                            res.message,
                            'success'
                        ).then(() => {
                            // Optionally reload the page or remove the row from the table
                            location.reload(); // Reload the page
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            res.message,
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'Something went wrong with the deletion process.',
                        'error'
                    );
                }
            });
        }
    });
}


// Display of Datas when user types
document.getElementById('order-tax-input').addEventListener('keyup', function () {
        document.getElementById('order-tax-display').textContent = this.value || "0.00";
    });
    document.getElementById('discount-input').addEventListener('keyup', function () {
        document.getElementById('discount-display').textContent = this.value || "0.00";
    });
    document.getElementById('shipping-input').addEventListener('keyup', function () {
        document.getElementById('shipping-display').textContent = this.value || "0.00";
    });

	// pass the ID of quotation to be updated to the input type of hidden
	function confirmUpdate(id) {
    document.getElementById("quotation_id").value = id;
}

</script>



<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status']) && !empty($_POST['product_name'])) {
    // Retrieve form data and escape to prevent SQL injection
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $quotation_date = $conn->real_escape_string($_POST['quotation_date']);
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $order_tax = $conn->real_escape_string($_POST['order_tax']);
    $discount = $conn->real_escape_string($_POST['discount']);
    $shipping = $conn->real_escape_string($_POST['shipping']);
    $status = $conn->real_escape_string($_POST['status']);
    $description = $conn->real_escape_string($_POST['description']);
    $user_email = $_SESSION['email']; // Get user email from session

    // Generate a 10-character alphanumeric reference
    $reference = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);

    // Prepare and bind the SQL statement with the new reference column
    $stmt = $conn->prepare("INSERT INTO quotation (customer_name, quotation_date, product_name, order_tax, discount, shipping, status, description, user_email, reference) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiissss", $customer_name, $quotation_date, $product_name, $order_tax, $discount, $shipping, $status, $description, $user_email, $reference);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Quotation added successfully!',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'quotation-list.php';
                    }
                });
            });
        </script>";
      } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error adding quotation: " . $stmt->error . "',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }

    // Close the statement
    $stmt->close();
}



// Updating of quotations
if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['discount_edit']) && !empty($_POST['discount_edit'])) {
    // Retrieve form data
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $date = $conn->real_escape_string($_POST['date']);
    $order_tax = $conn->real_escape_string($_POST['order_tax']);
    $discount = $conn->real_escape_string($_POST['discount_edit']);
    $shipping = $conn->real_escape_string($_POST['shipping']);
    $status = $conn->real_escape_string($_POST['status']);
    $description = $conn->real_escape_string($_POST['description']);
    $quotation_id = $conn->real_escape_string($_POST['quotation_id']); // ID to identify which quotation to update
    $user_email = $conn->real_escape_string(( $_SESSION['email']));

    // Update the quotation in the database
    $updateQuery = "UPDATE quotation SET 
        customer_name = ?, 
        quotation_date = ?, 
        order_tax = ?, 
        discount = ?, 
        shipping = ?, 
        status = ?, 
        description = ?
        WHERE id = ? AND user_email = ?";

    if ($stmt = $conn->prepare($updateQuery)) {
        $stmt->bind_param("sssssssis", $customer_name, $date, $order_tax, $discount, $shipping, $status, $description, $quotation_id, $user_email);
        
        if ($stmt->execute()) {
            echo "
			 <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Quotation updated successfully!',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'quotation-list.php';
                        }
                    });
                });
            </script>";
			 exit; // Stop further output
        } else {
            echo "
			 <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update quotation.',
                        confirmButtonText: 'OK'
                    });
                });
            </script>";
        }
        $stmt->close(); // Close the statement
    } else {
        echo "
		 <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Database error.',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }
}


?>
</body>
</html>