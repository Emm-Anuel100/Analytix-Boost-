<?php 
ob_start(); // Start output buffering

include("./layouts/session.php"); // include session

include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();

// If value is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supplier_name_']) && !empty($_POST['supplier_name_'])) {
    // Capture and sanitize form data
    $supplierName = $_POST['supplier_name_'];
    $purchaseDate = $_POST['purchase_date'];
    $productName = $_POST['product_name'];
    $costPerUnit = $_POST['cost_per_unit'];
    $packQuantity = $_POST['pack_quantity'];
    $itemsPerPack = $_POST['items_per_pack'];
    $status = $_POST['status'];
    $orderTax = $_POST['order_tax'];
    $amountPaid = $_POST['amount_paid'];
    $amountDue = $_POST['amount_due'];
    $notes = $_POST['notes'];
    $grandTotal = $_POST['grand_total']; // Retrieve the hidden grand total field
    $user_email = htmlspecialchars($_SESSION['email']); // User's email

    // Generate a 10-digit alphanumeric reference code
    $referenceCode = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

    // Insert into the purchases table
    $query = "INSERT INTO purchases (user_email, supplier_name, purchase_date, product_name, cost_per_unit, pack_quantity, items_per_pack, status, order_tax, amount_paid, amount_due, notes, grand_total, reference)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssiissiiisds", $user_email, $supplierName, $purchaseDate, $productName, $costPerUnit, $packQuantity, $itemsPerPack, $status, $orderTax, $amountPaid, $amountDue, $notes, $grandTotal, $referenceCode);

    if ($stmt->execute()) {
        // Only update the products table if the status is "Received"
        if ($status === 'Received') {
            // Calculate total items to add to stock
            $newQuantity = $packQuantity * $itemsPerPack;

			$user_email = $_SESSION['email']; // user's email

            // Update quantity in the products table based on product name
            $updateQuery = "UPDATE products SET quantity = quantity + ? WHERE product_name = ? AND email = '$user_email'";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("is", $newQuantity, $productName);

            if ($updateStmt->execute()) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Purchase added successfully!',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'purchase-list.php';
                            }
                        });
                    });
                </script>";
                } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error updating product quantity',
                            text: '{$updateStmt->error}',
                            confirmButtonText: 'OK'
                        });
                    });
                </script>";
            }

            $updateStmt->close(); // Close the update statement
          } else {
            // If the status is not "Received", show a success message without updating the product quantity
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Purchase added successfully!',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'purchase-list.php';
                        }
                    });
                });
            </script>";
        }
      } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{$stmt->error}',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    }

    $stmt->close(); // Close the insert statement
}


// Script to insert uploaded purchase CSV file into the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['csv_file']['tmp_name'];
        $fileName = $_FILES['csv_file']['name'];

        // Check if the file is a CSV
        if (pathinfo($fileName, PATHINFO_EXTENSION) !== 'csv') {
            header("Location: purchase-list.php?error=not_csv");
			ob_end_flush(); // Flush the output buffer and send headers
            exit;
        }

        // Open the file for reading
        if (($handle = fopen($fileTmpPath, 'r')) !== false) {
            // Get database connection
            $conn = connectMainDB();
            $rowCount = 0;

            // Skip header row
            fgetcsv($handle);

            while (($data = fgetcsv($handle)) !== false) {
                // Validate data
                if (count($data) < 14) { // Ensure you have all required columns
                    fclose($handle);
                    $conn->close();
                    header("Location: purchase-list.php?error=incomplete_row&row=" . ($rowCount + 2));
					ob_end_flush(); // Flush the output buffer and send headers
                    exit;
                }

                // Prepare data for insertion
                $user_email = htmlspecialchars(trim($data[0]));
                $supplier_name = htmlspecialchars(trim($data[1]));
                $purchase_date = date("Y-m-d", strtotime(trim($data[2])));
                $product_name = htmlspecialchars(trim($data[3]));
                $cost_per_unit = floatval(str_replace(',', '', trim($data[4])));
                $pack_quantity = intval(trim($data[5]));
                $items_per_pack = intval(trim($data[6]));
                $status = htmlspecialchars(trim($data[7]));
                $order_tax = floatval(str_replace(',', '', trim($data[8])));
                $amount_paid = floatval(str_replace(',', '', trim($data[9])));
                $amount_due = floatval(str_replace(',', '', trim($data[10])));
                $notes = htmlspecialchars(trim($data[11]));
                $grand_total = floatval(str_replace(',', '', trim($data[12])));
                $reference = htmlspecialchars(trim($data[13]));

                // Insert data into the purchases table
                $query = "INSERT INTO purchases (user_email, supplier_name, purchase_date, product_name, cost_per_unit, pack_quantity, items_per_pack, status, order_tax, amount_paid, amount_due, notes, grand_total, reference) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssssdisdssdsds", $user_email, $supplier_name, $purchase_date, $product_name, $cost_per_unit, $pack_quantity, $items_per_pack, $status, $order_tax, $amount_paid, $amount_due, $notes, $grand_total, $reference);

                if (!$stmt->execute()) {
                    fclose($handle);
                    $conn->close();
                    header("Location: purchase-list.php?error=insert_failed&row=" . ($rowCount + 2));
					ob_end_flush(); // Flush the output buffer and send headers
                    exit;
                }

                // Calculate total quantity to add to stock
                $newQuantity = $pack_quantity * $items_per_pack;

				$user_email = htmlspecialchars($_SESSION['email']); // user's email

                // Update the products table based on product name only if status is "Received"
                if ($status === 'Received') {
                    $updateQuery = "UPDATE products SET quantity = quantity + ? WHERE product_name = ? AND email = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param("iss", $newQuantity, $product_name, $user_email);

                    if (!$updateStmt->execute()) {
                        fclose($handle);
                        $conn->close();
                        header("Location: purchase-list.php?error=update_failed&row=" . ($rowCount + 2));
						ob_end_flush(); // Flush the output buffer and send headers
                        exit;
                    }
                    $updateStmt->close(); // Close the update statement
                }

                $rowCount++;
            }

            fclose($handle);
            $conn->close();
            header("Location: purchase-list.php?success=$rowCount"); // Redirect on success
			ob_end_flush(); // Flush the output buffer and send headers
            exit;  // Stop further execution after redirecting
        }
    } 
}
// Flush the output buffer if no redirect occurred
ob_end_flush();


// Get the parameters passed to check the status of the uploaded file
if (isset($_GET['success'])): ?>
	<?php if (isset($_GET['success'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successCount = <?php echo intval($_GET['success']); ?>;
            const message = successCount === 1 
                ? '1 record imported successfully.' 
                : successCount + ' records imported successfully.';
            
            Swal.fire({
                title: 'Success!',
                text: message,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
					window.location.href = 'purchase-list.php';
				});
        });
    </script>
	<?php endif; ?>
	<?php elseif (isset($_GET['error'])): ?>
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			<?php if ($_GET['error'] == 'not_csv'): ?>
				Swal.fire({
					title: 'Error!',
					text: 'Uploaded file is not a CSV file.',
					icon: 'error',
					confirmButtonText: 'OK',
					allowOutsideClick: true
				}).then(() => {
					window.location.href = 'purchase-list.php';
				});
			<?php elseif ($_GET['error'] == 'incomplete_row'): ?>
				Swal.fire({
					title: 'Error!',
					text: 'Some fields are missing in row <?php echo htmlspecialchars($_GET['row']); ?>. Please check the CSV file.',
					icon: 'error',
					confirmButtonText: 'OK',
					allowOutsideClick: true
				}).then(() => {
					window.location.href = 'purchase-list.php';
				});
			<?php elseif ($_GET['error'] == 'insert_failed'): ?>
				Swal.fire({
					title: 'Error!',
					text: 'Failed to insert data for row <?php echo htmlspecialchars($_GET['row']); ?>. Please try again.',
					icon: 'error',
					confirmButtonText: 'OK',
					allowOutsideClick: true
				}).then(() => {
					window.location.href = 'purchase-list.php';
				});
			<?php elseif ($_GET['error'] == 'update_failed'): ?>
				Swal.fire({
					title: 'Error!',
					text: 'Failed to update product quantity for row <?php echo htmlspecialchars($_GET['row']); ?>. Please check the product data.',
					icon: 'error',
					confirmButtonText: 'OK',
					allowOutsideClick: true
				}).then(() => {
					window.location.href = 'purchase-list.php';
				});
			<?php endif; ?>
			
		});
	</script>
<?php endif; ?>



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
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export_purchace_pdf.php" target="_blank"><img
									src="assets/img/icons/pdf.svg" alt="img">
							</a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export_purchace_csv.php" target="_blank"><img
									src="assets/img/icons/excel.svg" alt="img">
							</a>
						</li>
						<li>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i
									data-feather="rotate-ccw" class="feather-rotate-ccw"></i>
							</a>
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
						
						<div class="table-responsive product-list">
							<?php
							
							// Check if the user selected a sorting order; default to 'Newest'
							$order = isset($_POST['sort_order']) && $_POST['sort_order'] === 'Oldest' ? 'ASC' : 'DESC';

							$email = htmlspecialchars($_SESSION['email']); // user's email
							// query
							$query = "SELECT * FROM purchases
							 WHERE user_email = '$email' ORDER BY id $order";
							$result = $conn->query($query);
						   ?>

						<table class="table datanew list">
							<thead>
								<tr>
									<th class="no-sort">
										<label class="checkboxs">
											<input type="checkbox" id="select-all">
											<span class="checkmarks"></span>
										</label>
									</th>
									<th>Supplier Name</th>
									<th>Product Name</th>
									<th>Order Tax (₦)</th>
									<th>Reference</th>
									<th>Date</th>
									<th>Status</th>
									<th>Grand Total (₦)</th>
									<th>Paid (₦)</th>
									<th>Due (₦)</th>
									<th class="no-sort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($result->num_rows > 0) {
									// Fetch and display each row
									while ($row = $result->fetch_assoc()) {
										echo "<tr>";
										echo "<td>
												<label class='checkboxs'>
													<input type='checkbox'>
													<span class='checkmarks'></span>
												</label>
											</td>";
										echo "<td>" . htmlspecialchars($row['supplier_name']) . "</td>";
										echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
										echo "<td>" . htmlspecialchars($row['order_tax']) . "</td>";
										echo "<td>" . htmlspecialchars($row['reference']) . "</td>";
										echo "<td>" . date("d M Y", strtotime($row['purchase_date'])) . "</td>";
										
										// Display status with appropriate styling
										$statusClass = ($row['status'] === 'Received') ? 'status-badge' : 'order-badge';
										echo "<td><span class='badges {$statusClass}'>" . htmlspecialchars($row['status']) . "</span></td>";
										
										echo "<td>" . number_format($row['grand_total']) . "</td>";
										echo "<td>" . number_format($row['amount_paid']) . "</td>";
										echo "<td>" . number_format($row['amount_due']) . "</td>";
										
										echo "<td class='action-table-data'>
											<div class='edit-delete-action'>
												<a class='me-2 p-2 edit-btn' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#edit-units'>
													<i data-feather='edit' class='feather-edit'></i>
												</a>
												<a class='confirm-tex p-2 delete-btn' href='javascript:void(0);' data-id='" . $row['id'] . "'>
													<i data-feather='trash-2' class='feather-trash-2'></i>
												</a>
											</div>
										</td>";
										echo "</tr>";
									  }
							    	} else {
									// Display demo data if there are no records
									echo "<tr>
									<td>
										<label class='checkboxs'>
											<input type='checkbox'>
											<span class='checkmarks'></span>
										</label>
									</td>
									<td>Demo Supplier</td>
									<td>Demo Product</td>
									<td>0</td>
									<td>Demo-Ref</td>
									<td>" . date("d M Y") . "</td>
									<td><span class='badges status-badge'>Received</span></td>
									<td>" . number_format(1000) . "</td>
									<td>" . number_format(1000) . "</td>
									<td>" . number_format(0) . "</td>
									<td class='action-table-data'>
										<div class='edit-delete-action'>
											<a class='me-2 p-2 edit-bt'  data-bs-toggle='modal' data-bs-target='#edit-unit'>
												<i data-feather='edit' class='feather-edit'></i>
											</a>
											<a class='confirm-tex p-2 delete-bt' href='javascript:void(0);'>
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
							<form action="purchase-list.php" method="POST">
								<div class="row">
									<div class="col-lg-3 col-md-6 col-sm-12">
										<div class="input-blocks add-product">
											<label>Supplier Name</label>
											<div class="row">
												<div class="col-lg-10 col-sm-10 col-10">
												    <select name="supplier_name_" class="select">
														<option>Demo supplier</option>
													</select>
												</div>
												<div class="col-lg-2 col-sm-2 col-2 ps-0">
													<div class="add-icon tab">
														<a href="suppliers.php"><i data-feather="plus-circle" class="feather-plus-circles"></i></a>
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
												<input type="text" name="purchase_date" class="datetimepicker" placeholder="Choose" required>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-12">
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
									<div class="col-lg-3 col-md-6 col-sm-12">
										<div class="input-blocks">
											<label>Cost per unit (₦)</label>
											<input type="text" name="cost_per_unit" id="cost_per_unit" class="form-control" placeholder="100" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="row">
										<div class="col-lg-12 float-md-right">
											<div class="total-order">
												<ul>
													<li class="total">
														<h4>Grand Total</h4>
														<h5><span class="grand_total" id="grand_total_display">₦</span></h5>
													</li>
												</ul>
											</div>
										</div>
										 <!-- Hidden input for Grand Total -->
										<input type="hidden" name="grand_total" id="grand_total">
									</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Order Tax (₦)</label>
												<input type="text" name="order_tax" id="order_tax" placeholder="0" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Pack Quantity</label>
												<input type="text" name="pack_quantity" id="pack_quantity" placeholder="1" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Items per pack</label>
												<input type="text" placeholder="10" required name="items_per_pack" id="items_per_pack">
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Status</label>
												<select class="select" name="status">
													<option>Received</option>
													<option>Pending</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
										  <div class="input-blocks">
											<label>Amount Paid (₦)</label>
											<input type="text" class="form-control" placeholder="100" required name="amount_paid">
										  </div>
									    </div>
										<div class="col-lg-3 col-md-6 col-sm-12">
										  <div class="input-blocks">
											<label>Amount Due (₦)</label>
											<input type="text" class="form-control" placeholder="100" required name="amount_due">
										  </div>
									    </div>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="input-blocks summer-description-box">
										<label>Notes</label>
										<textarea name="notes" maxlength="30" cols="30" placeholder="Enter your note .." required></textarea>
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
						<form action="purchase-list.php" method="POST">
								<div class="row">
									<div class="col-lg-3 col-md-6 col-sm-12">
										<div class="input-blocks add-product">
											<label>Supplier Name</label>
											<div class="row">
												<div class="col-lg-10 col-sm-10 col-10">
													<select class="select" name="supplier_name">
														<option>Demo supplier</option>
													</select>
												</div>
												<div class="col-lg-2 col-sm-2 col-2 ps-0">
													<div class="add-icon tab">
														<a href="suppliers.php"><i data-feather="plus-circle" class="feather-plus-circles"></i></a>
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
												<input type="text" name="purchase_date_" class="datetimepicker" placeholder="Choose" required id="purchase_date">
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-12">
										<div class="input-blocks">
											<label>Product Name</label>
											<select name="product_name_" class="select" required>
												<?php
												$user_email = htmlspecialchars($_SESSION['email']); // user's email

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
									<div class="col-lg-3 col-md-6 col-sm-12">
										<div class="input-blocks">
											<label>Cost per unit (₦)</label>
											<input type="text" name="cost_per_unit_" class="form-control" placeholder="100" required id="cost_per_unit_">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="row">
									<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Pack Quantity</label>
												<input type="text" name="pack_quantity_" id="pack_quantity_" placeholder="1" required>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Items per pack</label>
												<input type="text" name="items_per_pack_" placeholder="10" required id="items_per_pack_">
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
											<div class="input-blocks">
												<label>Status</label>
												<select class="select" name="status_">
													<option>Received</option>
													<option>Pending</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-md-6 col-sm-12">
										  <div class="input-blocks">
											<label>Amount Paid (₦)</label>
											<input type="text" name="amount_paid_" id="amount_paid" class="form-control" placeholder="100" required>
										  </div>
									    </div>
										<div class="col-lg-3 col-md-6 col-sm-12">
										  <div class="input-blocks">
											<label>Amount Due (₦)</label>
											<input type="text" id="amount_due" name="amount_due_" class="form-control" placeholder="100" required>
										  </div>
									    </div>
										<div class="col-lg-3 col-md-6 col-sm-12">
										  <div class="input-blocks">
											<label>Order Tax (₦)</label>
											<input type="text" id="tax" name="tax_" class="form-control" placeholder="10" required>
										  </div>
									    </div>
										<div class="col-lg-3 col-md-6 col-sm-12">
										  <div class="input-blocks">
											<label>Grand Total (₦)</label>
											<input type="text" id="total" name="total_" class="form-control" placeholder="100" required>
										  </div>
									    </div>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="input-blocks summer-description-box">
										<label>Notes</label>
										<textarea name="notes_" id="notes" maxlength="30" cols="30" placeholder="Enter your note .." required></textarea>
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
							<form action="purchase-list.php" method="POST" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-12 col-sm-6 col-12">
										<div class="row">
											<div>
												<div class="modal-footer-btn download-file">
													<a href="purchase_record.csv" download="" class="btn btn-submit">Download Sample File</a>
												</div>
											</div>
										</div>
									</div> 
									<div class="col-lg-12">
										<div class="input-blocks image-upload-down">
											<label>	Upload CSV File</label>
											<div class="image-upload download">
												<input type="file" name="csv_file" required>
												<div class="image-uploads">
													<img src="assets/img/download-img.png" alt="img">
													<h4>Drag and drop a <span>file to upload</span></h4>
												</div>
											</div>
										</div>
									</div>
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


<script src="assets/js/refresh.js"></script>
<script>
$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

// JavaScript for Grand Total Calculation 
const costPerUnit = document.getElementById('cost_per_unit');
const packQuantity = document.getElementById('pack_quantity');
const itemsPerPack = document.getElementById('items_per_pack');
const grandTotalDisplay = document.getElementById('grand_total_display');
const grandTotalInput = document.getElementById('grand_total'); // Hidden input for grand total

// Calculate and update grand total
function calculateGrandTotal() {
	const unitCost = parseFloat(costPerUnit.value) || 0;
	const packs = parseInt(packQuantity.value) || 0;
	const items = parseInt(itemsPerPack.value) || 0;
	const grandTotal = unitCost * packs * items;

	// Update the displayed and hidden grand total values
	grandTotalDisplay.textContent = '₦' + grandTotal.toFixed(2);
	grandTotalInput.value = grandTotal.toFixed(2); // Set the hidden input's value
}

// Event Listeners
costPerUnit.addEventListener('input', calculateGrandTotal);
packQuantity.addEventListener('input', calculateGrandTotal);
itemsPerPack.addEventListener('input', calculateGrandTotal);



// Purchase deletion begins here
document.addEventListener("DOMContentLoaded", function() {
    // Attach event listeners to all delete buttons
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            const purchaseId = this.getAttribute("data-id");

            // SweetAlert confirmation dialog
            Swal.fire({
                title: "Are you sure?",
                text: "This action can't be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete record
                    fetch("delete_purchase.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: "id=" + purchaseId
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data === "success") {
                            Swal.fire("Deleted!", "Purchase has been deleted.", "success")
                            .then(() => location.reload());
                        } else {
                            Swal.fire("Error!", "There was an issue deleting the record.", "error");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                }
            });
        });
    });
});


// Function to populate purchase editing form
document.addEventListener("DOMContentLoaded", function() {
    // Attach event listeners to all edit buttons
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            const purchaseId = this.getAttribute("data-id");
            
            // Fetch purchase details using AJAX
            fetch("get_purchase_details.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + purchaseId
            })
            .then(response => response.json())
            .then(data => {
                // Populate modal form fields with data
                document.querySelector("#purchase_date").value = data.purchase_date;
                document.querySelector("#cost_per_unit_").value = data.cost_per_unit;
                document.querySelector("#pack_quantity_").value = data.pack_quantity;
                document.querySelector("#items_per_pack_").value = data.items_per_pack;
                document.querySelector("#amount_paid").value = data.amount_paid;
                document.querySelector("#amount_due").value = data.amount_due;
				document.querySelector("#tax").value = data.order_tax;
				document.querySelector("#total").value = data.grand_total;
                document.querySelector("#notes").value = data.notes;
                
                // Store the ID in a hidden field within the form
                document.querySelector("#edit-units form").setAttribute("data-id", purchaseId);
            })
            .catch(error => console.error("Error fetching data:", error));
        });
    });
});


// get the Id from the data-id attribute
$('#edit-units').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget); // Button that triggered the modal
    const purchaseId = button.data('id'); // Extract info from data-* attributes

    const form = $(this).find('form');
    form.attr('data-id', purchaseId); // Set the purchase ID to the form's data-id attribute
});

// Ajax to update purchase details
document.querySelector("#edit-units form").addEventListener("submit", function(e) {
    e.preventDefault(); // Prevent default form submission

    const purchaseId = this.getAttribute("data-id"); // Get the ID from the form's data-id attribute
    const formData = new FormData(this);
    formData.append("id", purchaseId); // Append the ID to the FormData

    // Log data to the console
    console.log("Purchase ID:", purchaseId);
    formData.forEach((value, key) => console.log(`${key}: ${value}`)); // Log each form data item

    // Send the AJAX request
    fetch("update_purchase.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log("Server response:", data); // Log server response

        if (data.trim() === "success") {
            Swal.fire("Updated!", "Record updated successfully!", "success")
            .then(() => location.reload()); // Refresh the page to show updated data
        } else {
            Swal.fire("Error!", "There was an issue updating the record.", "error");
        }
    })
    .catch(error => console.error("Error:", error));
});

</script>
</body>
</html>