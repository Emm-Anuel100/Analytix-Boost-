<?php 
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();


// Initialize a variable to hold the message
$message = '';
$alertType = 'success'; // Default alert type

// Check if the form is submitted for insertion of coupons
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['coupon_name_insert']) && !empty($_POST['coupon_name_insert'])) {
    $coupon_name = $_POST['coupon_name_insert'];
    $coupon_code = $_POST['coupon_code'];
    $coupon_type = $_POST['coupon_type'];
    $discount_value = $_POST['discount_value'];
    $coupon_limit = $_POST['coupon_limit'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $product_name = $_POST['product_name'];
    $status = isset($_POST['status']) ? "Active" : "Inactive"; // Check if checkbox is set
    $user_email = $_SESSION['email'];

    // Prepare and bind the statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO coupons (user_email, name, code, type, discount_value, coupon_limit, start_date, end_date, product_name, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdissss", $user_email, $coupon_name, $coupon_code, $coupon_type, $discount_value, $coupon_limit, $start_date, $end_date, $product_name, $status);

    // Execute the query and set message
    if ($stmt->execute()) {
        $message = "Coupon created successfully!";
        $alertType = 'success'; // Set alert type for success
    } else {
        $message = "Error: " . addslashes($stmt->error);
        $alertType = 'error'; // Set alert type for error
    }

    // Close the statement
    $stmt->close();
    
    // Echo the SweetAlert script for feedback
    echo "<script>
	document.addEventListener('DOMContentLoaded', function() {
		Swal.fire({
			icon: '$alertType',
			title: '" . ($alertType === 'success' ? 'Success' : 'Error') . "',
			text: '$message',
			confirmButtonText: 'OK'
		});
	});
	</script>";
	}


	// Script to updating Coupons
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && !empty($_POST['coupon_name'])) {
		$id = $_POST['id'];
		$name = $_POST['coupon_name'];
		$code = $_POST['code'];
		$type = $_POST['type'];
		$discount_value = $_POST['discount_value'];
		$limit = $_POST['limit'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$product_name = $_POST['product_name'];
		$status = isset($_POST['status']) ? 'Active' : 'Inactive';
		$user_email = $_SESSION['email']; // user's email

		$query = "UPDATE coupons SET name=?, code=?, type=?, discount_value=?, coupon_limit=?, product_name=?, start_date=?, end_date=?, status=? WHERE id=? AND user_email = '$user_email'";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("sssssssssi", $name, $code, $type, $discount_value, $limit, $product_name, $start_date, $end_date, $status, $id);
    
    if ($stmt->execute()) {
		$message = "Coupon updated successfully!";
        $alertType = 'success'; // Set alert type for success
    } else {
        $message = "Error: " . addslashes($stmt->error);
        $alertType = 'error'; // Set alert type for error
    }

	// Close the statement
	$stmt->close();

	// Echo the SweetAlert script for feedback
	echo "<script>
	document.addEventListener('DOMContentLoaded', function() {
		Swal.fire({
			icon: '$alertType',
			title: '" . ($alertType === 'success' ? 'Success' : 'Error') . "',
			text: '$message',
			confirmButtonText: 'OK'
		});
	});
	</script>";
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
	<!-- main Wrapper-->
    <div class="main-wrapper">
    <?php include 'layouts/menu.php'; ?>

    <div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Coupons</h4>
								<h6>Manage Your Coupons</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export_coupons_pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export_coupons_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Coupons</a>
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
									<form action="" method="get">
									<select name="sort" class="select" onchange="this.form.submit()">
										<option value="newest" <?= isset($_GET['sort']) && $_GET['sort'] === 'newest' ? 'selected' : '' ?>>Newest</option>
										<option value="oldest" <?= isset($_GET['sort']) && $_GET['sort'] === 'oldest' ? 'selected' : '' ?>>Oldest</option>
									</select>
								</form>
								</div>
							</div>

								<?php
								// Default sorting order
								$order = 'DESC';  // Newest first

								// Check if a sorting option is set in the URL
								if (isset($_GET['sort'])) {
									$sortOption = $_GET['sort'];
									$order = $sortOption === 'oldest' ? 'ASC' : 'DESC';
								}
								?>	

							<div class="table-responsive">
								<?php
							// Fetch coupons from the coupons table
							$couponQuery = "
								SELECT id, product_name, name, code, type, discount_value, coupon_limit, end_date, status 
								FROM coupons 
								WHERE user_email = ? 
								ORDER BY id $order";

							$stmt = $conn->prepare($couponQuery);
							$stmt->bind_param("s", $user_email);
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
									<th>Name</th>
									<th>Code</th>
									<th>Type</th>
									<th>Discount</th>
									<th>Limit</th>
									<th>Valid Till</th>
									<th>Status</th>
									<th class="no-sort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								// Check if there are coupons available
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										// Get coupon details
										$product_name = htmlspecialchars($row['product_name']);
										$coupon_name = htmlspecialchars($row['name']);
										$coupon_code = htmlspecialchars($row['code']);
										$coupon_type = htmlspecialchars($row['type']);
										$discount_value = htmlspecialchars($row['discount_value']);
										$coupon_limit = htmlspecialchars($row['coupon_limit']);
										$end_date = htmlspecialchars($row['end_date']);
										$status = htmlspecialchars($row['status']);
										$id = htmlspecialchars($row['id']);
								
										// Determine status badge
										$status_class = ($status === 'Active') ? 'badge-linesuccess' : 'badge-bgdanger';
								
										// Add a row to the table
										echo "<tr>
											<td>
												<label class='checkboxs'>
													<input type='checkbox'>
													<span class='checkmarks'></span>
												</label>
											</td>
											<td>$product_name</td>
											<td>$coupon_name</td>
											<td><span class='badge badge-bgdanger'>$coupon_code</span></td>
											<td>$coupon_type</td>
											<td>$discount_value</td>
											<td>$coupon_limit</td>
											<td>$end_date</td>
											<td>
												<span class='badge $status_class'>" . htmlspecialchars($status) . "</span>
											</td>
											<td class='action-table-data'>
												<div class='edit-delete-action'>
													<a class='me-2 p-2 edit-coupon' href='#' data-bs-toggle='modal' data-id='{$id}' data-bs-target='#edit-units'>
														<i data-feather='edit' class='feather-edit'></i>
													</a>
													<a class='confirm-tex p-2 delete-coupon' data-id='{$id}' href='javascript:void(0);'>
														<i data-feather='trash-2' class='feather-trash-2'></i>
													</a>
												</div>
											</td>
										</tr>";
									}
								} else {
									// Demo values if no coupons found
									echo "<tr>
										<td>
											<label class='checkboxs'>
												<input type='checkbox'>
												<span class='checkmarks'></span>
											</label>
										</td>
										<td>Demo product</td>
										<td>Coupon 1</td>
										<td><span class='badge badge-bgdanger'>demo code</span></td>
										<td>Fixed</td>
										<td>100</td>
										<td>1</td>
										<td>04 Jan 2025</td>
										<td>
											<span class='badge badge-linesuccess'>Active</span>
										</td>
										<td class='action-table-data'>
											<div class='edit-delete-action'>
												<a class='me-2 p-2' href='#' data-bs-toggle='modal' data-bs-target='#edit-unit'>
													<i data-feather='edit' class='feather-edit'></i>
												</a>
												<a class='confirm-tex p-2' href='javascript:void(0);'>
													<i data-feather='trash-2' class='feather-trash-2'></i>
												</a>
											</div>
										</td>
									</tr>";
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
	<!-- end main Wrapper-->

	<!-- Add coupons -->
    <div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Coupons</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
							<form action="coupons.php" method="post">
								<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Name</label>
											<input type="text" class="form-control" name="coupon_name_insert" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Code</label>
											<input type="text" class="form-control" name="coupon_code" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Type</label>
											<select class="select" name="coupon_type" required>
												<option value="Fixed">Fixed</option>
												<option value="Percentage">Percentage</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">Discount Value</label>
											<input type="text" class="form-control" name="discount_value" required>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="mb-3">
											<label class="form-label">Limit</label>
											<input type="text" class="form-control" name="coupon_limit" required>
											<span class="unlimited-text">0 for Unlimited</span>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="input-blocks">
											<label>Start Date</label>
											<div class="input-groupicon calender-input">
												<i data-feather="calendar" class="info-img"></i>
												<input type="text" class="datetimepicker form-control" name="start_date" placeholder="Select Date" required>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="input-blocks">
											<label>End Date</label>
											<div class="input-groupicon calender-input">
												<i data-feather="calendar" class="info-img"></i>
												<input type="text" class="datetimepicker form-control" name="end_date" placeholder="Select Date" required>
											</div>
										</div>
									</div>
									<div class="input-blocks">
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center mb-2">
											<span class="status-label">All Products</span>
										</div>
										<select name="product_name" class="select" required>
											<?php
											$user_email = $_SESSION['email']; // User's email
											$productQuery = "SELECT product_name FROM products WHERE email = '$user_email' ORDER BY product_name ASC"; // Fetch products alphabetically

											$result = $conn->query($productQuery);
											if ($result->num_rows > 0) {
												while ($product = $result->fetch_assoc()) {
													echo "<option value='" . $product['product_name'] . "'>" . htmlspecialchars($product['product_name']) . "</option>";
												}
											} else {
												echo "<option value=''>No products available</option>";
											}
											?>
										</select>
									</div>
									<div class="input-blocks m-0">
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
											<span class="status-label">Status</span>
											<input type="checkbox" id="user3" class="check" name="status" checked>
											<label for="user3" class="checktoggle"></label>
										</div>
									</div>
								</div>
								
								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Create Coupon</button>
								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Coupons -->

		<!-- Edit coupons -->
		<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Coupons</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="coupons.php" method="POST">
									<input type="hidden" name="id" id="editCouponId"> <!-- hidden input field to store id -->
									<div class="row">
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Name</label>
												<input type="text" name="coupon_name" placeholder="Coupons 21" required id="edit-name">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Code</label>
												<input type="text" name="code" placeholder="Christmas" required id="edit-code">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Type</label>
												<select class="select" name="type" id="edit-type">
													<option>Fixed</option>
													<option>Percentage</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Discount Value</label>
												<input type="text" name="discount_value" placeholder="20" required id="edit-discount">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="input-blocks">
												<label>Limit</label>
												<input type="text" name="limit" placeholder="4" required id="edit-limit">
												<span class="unlimited-text">0 for Unlimited</span>
											</div>
											
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Start Date</label>
												<div class="input-groupicon calender-input">
													<i data-feather="calendar" class="info-img"></i>
													<input type="text" name="start_date" class="datetimepicker form-control" id="edit-start" placeholder="Select Date" required>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>End Date</label>
												<div class="input-groupicon calender-input">
													<i data-feather="calendar" class="info-img"></i>
													<input type="text" name="end_date" class="datetimepicker form-control" id="edit-end" placeholder="Select Date" required>
												</div>
											</div>
										</div>
										<div class="input-blocks">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center mb-2">
												<span class="status-label">All Products</span>
											</div>
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
									
										<div class="input-blocks m-0">
											<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
												<span class="status-label">Status</span>
												<input type="checkbox" id="user6" name="status" class="check" checked>
												<label for="user6" class="checktoggle">	</label>
											</div>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Save Changes</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Edit Coupons -->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>


<script src="assets/js/refresh.js"></script>
<script async>

  $.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

  // Ajax Function for Coupon Deletion
  $('.delete-coupon').click(function() {
    var couponId = $(this).data('id');
    console.log("Coupon ID:", couponId);  // Console log to verify ID

    if (couponId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6 ',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX call
                $.ajax({
                    url: 'delete_coupon.php',
                    type: 'POST',
                    data: JSON.stringify({ id: couponId }), // Send data as JSON
                    contentType: 'application/json', // Set content type to JSON
                    dataType: 'json',
                    success: function(response) {
						console.log(response); // Log entire response for debugging
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'The coupon has been deleted successfully.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message || 'An error occurred while deleting the coupon.',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to communicate with the server.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: 'Coupon ID is missing.',
            confirmButtonText: 'OK'
        });
    }
});


  // Ajax Function for Coupon Updating
  $(document).on('click', '.edit-coupon', function () {
    const couponId = $(this).data('id');

    // Set coupon ID to a hidden input or variable
    $('#editCouponId').val(couponId);

    // Make an AJAX request to fetch coupon details
    $.ajax({
        url: 'get_coupon_details.php',
        type: 'GET',
        data: { id: couponId },
        success: function (data) {
            const coupon = JSON.parse(data);
            // Populate form fields with fetched coupon details
            $('#edit-name').val(coupon.name);
            $('#edit-code').val(coupon.code);
            $('#edit-type').val(coupon.type);
            $('#edit-discount').val(coupon.discount_value);
            $('#edit-limit').val(coupon.coupon_limit);
            $('#edit-start').val(coupon.start_date);
            $('#edit-end').val(coupon.end_date);
        },
        error: function () {
            console.log('Failed to fetch coupon details.');
        }
    });
});

</script>
</body>
</html>