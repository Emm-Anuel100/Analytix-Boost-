<?php 
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {

	// Retrieve and sanitize form data
	$user_email = $_SESSION['email'];
	$category = htmlspecialchars(trim($_POST['name']));
	$category_slug = htmlspecialchars(trim($_POST['slug']));
	$status = isset($_POST['status']) ? "active" : "inactive"; // value becomes "active" when checked

	// Prepare an SQL statement
	$stmt = $conn->prepare("INSERT INTO categories (user_email, name, slug, status) VALUES (?, ?, ?, ?)");

	// Bind parameters (s = string, i = integer)
	$stmt->bind_param("ssss", $user_email, $category, $category_slug, $status);

	// Execute the prepared statement
	if ($stmt->execute()) {
		 // Success message
		 echo "<script>
					document.addEventListener('DOMContentLoaded', function() {
						 Swal.fire({
							  icon: 'success',
							  title: 'Category created successfully!',
							  confirmButtonText: 'OK'
						 });
					});
				 </script>";
	} else {
		 // Error message
		 $error_message = $stmt->error;
		 echo "<script>
					document.addEventListener('DOMContentLoaded', function() {
						 Swal.fire({
							  icon: 'error',
							  title: 'Error: $error_message',
							  confirmButtonText: 'OK'
						 });
					});
				 </script>";
	}

	// Close the statement
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
	<!-- main Wrapper-->
    <div class="main-wrapper">
    <?php include 'layouts/menu.php'; ?>

    <div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Category</h4>
								<h6>Manage your categories</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-category"><i data-feather="plus-circle" class="me-2"></i>Add New Category</a>
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
									<select class="select">
										<option value="newest">Newest</option>
										<option value="oldest">Oldest</option>
									</select>
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
									<th>Category</th>
									<th>Category slug</th>
									<th>Created On</th>
									<th>Status</th>
									<th class="no-sort">Action</th>
								</tr>
							</thead>
							<?php
							$user_email = $_SESSION['email']; // user's email
							
							// Assuming you already have a connection to the database in $conn
							$query = "SELECT name, slug, timestamp, status FROM categories WHERE user_email = '$user_email'";
							$result = $conn->query($query);

							if ($result->num_rows > 0) {
							// Start outputting the table
							echo '
							<tbody>';
						
							// Loop through the results and output each row
							while ($row = $result->fetch_assoc()) {
							// Convert status to a badge format
							$status = $row['status'] == 'active' 
											? '<span class="badge badge-linesuccess">Active</span>' 
											: '<span class="badge badge-linedanger">Inactive</span>';

							// Format created_at date
							$created_on = date("d M Y", strtotime($row['timestamp']));
							
							echo '<tr>
								<td>
									<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
									</label>
								</td>
								<td>' . htmlspecialchars($row['name']) . '</td>
								<td>' . htmlspecialchars($row['slug']) . '</td>
								<td>' . $created_on . '</td>
								<td>' . $status . '</td>
								<td class="action-table-data">
									<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-category">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a class="confirm-text p-2" href="javascript:void(0);">
												<i data-feather="trash-2" class="feather-trash-2"></i>
											</a>
									</div>
								</td>
							</tr>';
							}
							
							echo '</tbody>';
						} else {
							// If no data found
							echo '<tr>
								<td>
									<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>
									</label>
								</td>
								<td>demo name</td>
								<td>demo slug</td>
								<td>date</td>
								<td>Active</td>
								<td class="action-table-data">
									<div class="edit-delete-action">
											<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-cat">
												<i data-feather="edit" class="feather-edit"></i>
											</a>
											<a class="confirm-te p-2" href="javascript:void(0);">
												<i data-feather="trash-2" class="feather-trash-2"></i>
											</a>
									</div>
								</td>
							</tr>';
						}
						?>
						</table>
						</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
    </div>
<!-- end main Wrapper-->

<!-- Add Category -->
<div class="modal fade" id="add-category">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Create Category</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="category-list.php" method="post">
									<div class="mb-3">
										<label class="form-label">Category</label>
										<input type="text" class="form-control" required name="name">
									</div>
									<div class="mb-3">
										<label class="form-label">Category Slug</label>
										<input type="text" class="form-control" required name="slug">
									</div>
									<div class="mb-0">
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
											<span class="status-label">Status</span>
											<input type="checkbox" id="user2" class="check" checked="" name="status">
											<label for="user2" class="checktoggle"></label>
										</div>
									</div>
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Create Category</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Category -->

		<!-- Edit Category -->
		<div class="modal fade" id="edit-category">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Category</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="category-list.php">
									<div class="mb-3">
										<label class="form-label">Category</label>
										<input type="text" class="form-control" value="Laptop">
									</div>
									<div class="mb-3">
										<label class="form-label">Category Slug</label>
										<input type="text" class="form-control" value="laptop">
									</div>
									<div class="mb-0">
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
											<span class="status-label">Status</span>
											<input type="checkbox" id="user3" class="check" checked="">
											<label for="user3" class="checktoggle"></label>
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

<!-- /Edit Category -->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/refresh.js"></script>
<script>
	$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

</script>
</body>
</html>