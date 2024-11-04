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
	<!-- main Wrapper-->
    <div class="main-wrapper">
    <?php include 'layouts/menu.php'; ?>
    <div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Invoice Report	</h4>
								<h6>Manage Your Sales Invoice Report</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="generate_invoice_pdf.php?sort_option=<?php echo isset($_POST['sort_option']) ? $_POST['sort_option'] : 'newest'; ?>" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="generate_invoice_csv.php?sort_option=<?php echo isset($_POST['sort_option']) ? $_POST['sort_option'] : 'newest'; ?>" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
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
					<div class="card table-list-card">
						<div class="card-body">
							<div class="table-top">
								<div class="search-set">
									<div class="search-input">
										<a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
									</div>
								</div>
								<?php  
								// Default sorting order
								$order = "DESC"; // Newest by default

								// Check if a sorting option is selected
								if (isset($_POST['sort_option'])) {
									$sortOption = $_POST['sort_option'];
									
									if ($sortOption == 'oldest') {
										$order = "ASC"; // Oldest first
									} else {
										$order = "DESC"; // Newest first
									}
								}
								?>

								<div class="form-sort">
								<i data-feather="sliders" class="info-img"></i>
								<form action="" method="post">
									<select class="select" name="sort_option" onchange="this.form.submit()">
										<option value="newest" <?= (isset($_POST['sort_option']) && $_POST['sort_option'] == 'newest') ? 'selected' : ''; ?>>Newest</option>
										<option value="oldest" <?= (isset($_POST['sort_option']) && $_POST['sort_option'] == 'oldest') ? 'selected' : ''; ?>>Oldest</option>
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
								<th>Reference No</th>
								<th>Customer</th>
								<th>Due Date</th>
								<th>Grand Total (₦)</th>
								<th>Paid (₦)</th>
								<th>Amount Due (₦)</th>
								<th>Change Element (₦)</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$user_email = $_SESSION['email'];  // user email

						// Fetch sales data from the database with the selected order
						$sql = "SELECT reference, customer, date, grand_total, amount_paid, amount_due, change_element, status 
								FROM sales WHERE user_email = ? ORDER BY id $order";

						$stmt = $conn->prepare($sql);
						$stmt->bind_param("s", $user_email);
						$stmt->execute();
						$result = $stmt->get_result();

						if ($result->num_rows > 0) {
							// Output data for each row
							while ($row = $result->fetch_assoc()) {
								// Assuming you store amounts in your database as integers or decimals without the currency symbol
								$reference = htmlspecialchars($row['reference']);
								$customer = htmlspecialchars($row['customer']);
								$dueDate = htmlspecialchars($row['date']); // Format date if needed
								$grandTotal = number_format($row['grand_total'], 2);
								$amountPaid = number_format($row['amount_paid'], 2);
								$amountDue = number_format($row['amount_due'], 2);
								$changeElement = number_format($row['change_element'], 2);
								$status = htmlspecialchars($row['status']);

								// Determine badge class based on status
								$badgeClass = ($status == 'In Progress') ? 'badge-warning' : 'badge-linesuccess';

								echo "<tr>
									<td>
										<label class='checkboxs'>
											<input type='checkbox'>
											<span class='checkmarks'></span>
										</label>
									</td>
									<td>$reference</td>
									<td>$customer</td>
									<td>$dueDate</td>
									<td>$grandTotal</td>
									<td>$amountPaid</td>
									<td>$amountDue</td>
									<td>$changeElement</td>
									<td><span class='badge $badgeClass'>$status</span></td>
								</tr>";
							}
						} else {
							// Display demo data when no records are found
							echo "<tr>
								<td>
									<label class='checkboxs'>
										<input type='checkbox'>
										<span class='checkmarks'></span>
									</label>
								</td>
								<td>Demo Reference</td>
								<td>Demo Customer</td>
								<td>" . date('Y-m-d') . "</td>
								<td>" . number_format(100.00, 2) . "</td>
								<td>" . number_format(100.00, 2) . "</td>
								<td>" . number_format(0.00, 2) . "</td>
								<td>" . number_format(0.00, 2) . "</td>
								<td><span class='badge badge-warning'>Demo Status</span></td>
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


<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>


<script src="assets/js/refresh.js"></script>
<script async>
	$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable


</script>
</body>
</html>