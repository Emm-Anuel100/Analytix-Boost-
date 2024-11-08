<?php 
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the database
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email

// If value is posted and expense category is not empty
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['expense_category']) && $user_email) {
    // Retrieve form data
    $category = $_POST['expense_category'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $reference = $_POST['reference'];
    $expense_for = $_POST['expense_for'];
    $description = $_POST['description'];

    // Insert data into expenses table
    $stmt = $conn->prepare("INSERT INTO expenses (user_email, category_name, date, amount, reference, expense_for, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdsss", $user_email, $category, $date, $amount, $reference, $expense_for, $description);

    if ($stmt->execute()) {
        // Display success message with SweetAlert
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Expense added successfully!',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'expense-list.php'; // Redirect back to page
                });
            });
        </script>";
    } else {
        // Display error message with SweetAlert for execution failure
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to add expense. Please try again.',
                    icon: 'error'
                }).then(() => {
                   window.location.href = 'expense-list.php'; // Redirect back to page
                });
            });
        </script>";
    }
    $stmt->close(); // Close the statement
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
								<h4>Expense List</h4>
								<h6>Manage Your Expenses</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export_expense_list_pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export_expense_list_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a class="refresh" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i> Add New Expense</a>
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
										<select class="select">
											<option>Newest</option>
											<option>Oldest</option>
										</select>
									</form>
								</div>
							</div>
							
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
											<th>Category name</th>
											<th>Reference</th>
											<th>Date</th>
											<th>Status</th>
											<th>Amount</th>
											<th>Description</th>
											<th class="no-sort">Action</th>
										</tr>
									</thead>
									<tbody class="Expense-list-blk">
										<tr >
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>
											<td>Employee Benefits</td>
											<td>PT001</td>
											<td>19 Jan 2023</td>
											<td><span class="badge badge-linesuccess">Active</span></td>
											<td>$550</td>
											<td>Employee Vehicle</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2 mb-0" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="me-3 confirm-tex p-2 mb-0" href="javascript:void(0);">
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

			<!-- Add Expense -->
			<div class="modal fade" id="add-units">
				<div class="modal-dialog modal-dialog-centered custom-modal-two">
					<div class="modal-content">
						<div class="page-wrapper-new p-0">
							<div class="content">
								<div class="modal-header border-0 custom-modal-header">
									<div class="page-title">
										<h4>Add Expense</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<!-- Form to add expenses -->
								<form action="expense-list.php" method="POST">
									<div class="modal-body custom-modal-body">
										<div class="row">
											<div class="col-lg-6">
												<div class="mb-3">
													<?php
													// Fetch categories from the expense_category table
													$query = "SELECT category_name FROM expense_category WHERE user_email = '$user_email'";
													$result = $conn->query($query);
													?>

													<label class="form-label">Expense Category</label>
													<select name="expense_category" class="select" required>
														<?php
														// Loop through the fetched categories and create options
														if ($result->num_rows > 0) {
															while ($row = $result->fetch_assoc()) {
																echo "<option value=\"" . htmlspecialchars($row['category_name']) . "\">" . htmlspecialchars($row['category_name']) . "</option>";
															}
														} else {
															echo "<option value=\"\">No categories available</option>";
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="input-blocks date-group">
													<i data-feather="calendar" class="info-img"></i>
													<div class="input-groupicon">
														<input type="text" name="date" class="datetimepicker" required placeholder="Choose Date">
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="mb-3">
													<label class="form-label">Amount</label>
													<input type="text" name="amount" class="form-control" placeholder="₦" required>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="mb-3">
													<label class="form-label">Reference</label>
													<input type="text" name="reference" class="form-control" required>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="mb-3">
													<label class="form-label">Expense For</label>
													<input type="text" name="expense_for" class="form-control" required>
												</div>
											</div>                          
											<div class="col-md-12">
												<div class="edit-add card">
													<div class="edit-add">
														<label class="form-label">Description</label>
													</div>
													<div class="card-body-list input-blocks mb-0">
														<textarea name="description" class="form-control" maxlength="60" required></textarea>
													</div>
													<p>Maximum 60 Characters</p>
												</div>
											</div>
										</div>                          
										<div class="modal-footer-btn">
											<a href="javascript:void(0);" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</a>
											<button type="submit" class="btn btn-submit">Save Changes</button>
										</div>
									</div>
								</form>
								<!--/ Form to add expenses -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Add Expense -->
    </div>
	<!-- end main Wrapper-->


	<!-- Edit Expense -->
	<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Expense</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body custom-modal-body">
								<form action="expense-list.php" method="POST">
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Expense Category</label>
												<?php
												// Fetch categories from the expense_category table
												$query = "SELECT category_name FROM expense_category WHERE user_email = '$user_email'";
												$result = $conn->query($query);
												?>
												
												<select name="expense_category" class="select" required>
													<?php
													// Loop through the fetched categories and create options
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															echo "<option value=\"" . htmlspecialchars($row['category_name']) . "\">" . htmlspecialchars($row['category_name']) . "</option>";
														}
													} else {
														echo "<option value=\"\">No categories available</option>";
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks date-group">
												<i data-feather="calendar" class="info-img"></i>
												<div class="input-groupicon">
													<input type="text" class="datetimepicker ps-5" required placeholder="19 Jan 2023" >
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Amount</label>
												<input type="text" class="form-control" placeholder="₦" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Reference</label>
												<input type="text" class="form-control" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3 input-blocks">
												<label class="form-label">Expense For</label>
												<input type="text" class="form-control" required>
											</div>
											
										</div>								
										<!-- Editor -->
										<div class="col-md-12">
											<div class="edit-add card">
												<div class="edit-add">
													<label class="form-label">Description</label>
												</div>
												<div class="card-body-list input-blocks mb-0">
													<textarea class="form-control" required maxlenght="60"></textarea>
												</div>
												<p>Maximum 60 Characters</p>
											</div>
										</div>
										<!-- /Editor -->
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
		<!-- /Edit Expense -->

	<?php include 'layouts/customizer.php'; ?>
	<!-- JAVASCRIPT -->
	<?php include 'layouts/vendor-scripts.php'; ?>

	<script src="assets/js/refresh.js"></script>
<script>
	$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable


</script>
</body>
</html>