<?php 
include 'layouts/session.php'; 
include 'conn.php'; // Include db connection

// Establish the connection
$conn = connectMainDB();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['store_name'])) {
	// Sanitize and validate input data
	$user_email = $_SESSION['email'];
	$store_name = htmlspecialchars(trim($_POST['store_name']));
	$user_name = htmlspecialchars(trim($_POST['user_name']));
	$password = htmlspecialchars(trim($_POST['password']));
	$phone = htmlspecialchars(trim($_POST['phone']));
	$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
	$status = isset($_POST['status']) && $_POST['status'] === 'active' ? 'active' : 'inactive';

	// Check if required fields are not empty
	if (empty($store_name) || empty($user_name) || empty($password) || empty($phone) || !$email) {
		 echo "<script>
					document.addEventListener('DOMContentLoaded', function() {
						 Swal.fire({
							  icon: 'error',
							  title: 'Oops...',
							  text: 'Please fill in all required fields.'
						 });
					});
				 </script>";
		 exit();
	}

	// Hash the password
	$hashed_password = password_hash($password, PASSWORD_BCRYPT);

	// Prepare SQL statement to insert into the store table
	$stmt = $conn->prepare("INSERT INTO store (user_email, store_name, user_name, password, phone, email, status) 
									 VALUES (?, ?, ?, ?, ?, ?, ?)");

	// Bind parameters
	$stmt->bind_param('sssssss', $user_email, $store_name, $user_name, $hashed_password, $phone, $email, $status);

	// Execute the query and check the result
	if ($stmt->execute()) {
		 echo "<script>
					document.addEventListener('DOMContentLoaded', function() {
						 Swal.fire({
							  icon: 'success',
							  title: 'Success!',
							  text: 'New store created successfully!'
						 }).then(() => {
							  window.location.href = 'store-list.php';
						 });
					});
				 </script>";
	   } else {
		 echo "<script>
					document.addEventListener('DOMContentLoaded', function() {
						 Swal.fire({
							  icon: 'error',
							  title: 'Error',
							  text: 'Failed to create store.'
						 });
					});
				 </script>";
	}

	// Close the statement 
	$stmt->close();
}



//*** Updating of store details */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['store_id']) && !empty($_POST['store_name_'])) {
	$store_id = $_POST['store_id'];
	$store_name = $_POST['store_name_'];
	$user_name = $_POST['user_name_'];
	$password = password_hash($_POST['password_'], PASSWORD_BCRYPT);
	$phone = $_POST['phone_'];
	$email = $_POST['email_'];
	$status = isset($_POST['status_']) ? "active" : "inactive"; 

	// Prepare the SQL statement
	$stmt = $conn->prepare("UPDATE store SET store_name = ?, user_name = ?, password = ?, phone = ?, email = ?, status = ? WHERE id = ?");
	$stmt->bind_param("ssssssi", $store_name, $user_name, $password, $phone, $email, $status, $store_id);

	// Execute the statement and check for success
	if ($stmt->execute()) {
		 $message = "Store updated successfully!";
		 $alert_type = "success"; // SweetAlert type

		 echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '$alert_type',
                text: '$message',
                icon: '$alert_type',
                confirmButtonText: 'OK'
            });
        });
    </script>";
	} else {
		 $message = "Error updating store: " . $stmt->error;
		 $alert_type = "error"; // SweetAlert type

		 echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '$alert_type',
                text: '$message',
                icon: '$alert_type',
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
								<h4>Store List</h4>
								<h6>Manage your Store</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="./store-list-export-pdf.php"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="./store-list-export-csv.php"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-stores"><i data-feather="plus-circle" class="me-2"></i> Add Store</a>
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
									<select class="select" onchange="updateOrder(this.value)">
									<option value="newest" <?php echo (isset($_GET['order']) && $_GET['order'] === 'newest') ? 'selected' : ''; ?>>Newest</option>
									<option value="oldest" <?php echo (isset($_GET['order']) && $_GET['order'] === 'oldest') ? 'selected' : ''; ?>>Oldest</option>
							   	</select>
								</div>
							</div>
							
					<div class="table-responsive">
					  <?php  
							// user's email
							$user_email = $_SESSION['email'];

							// Check if the order parameter is set in the query string
							$order = isset($_GET['order']) ? $_GET['order'] : 'newest';

							// Set the ORDER BY clause based on the selected option
							$orderBy = ($order === 'oldest') ? 'timestamp ASC' : 'timestamp DESC';

							// Prepare your SQL statement
							$stmt = $conn->prepare("SELECT id, store_name, user_name, phone, email, status FROM store WHERE user_email = ? ORDER BY $orderBy");

							// Bind the parameter
							$stmt->bind_param('s', $user_email);

							// Execute the statement
							$stmt->execute();

							// Get the result
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
									<th>Store name</th>
									<th>User name</th>
									<th>Phone</th>
									<th>Email</th>
									<th>Status</th>
									<th class="no-sort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if ($result->num_rows > 0): ?>
										<?php while($row = $result->fetch_assoc()): ?>
											<tr>
												<td>
													<label class="checkboxs">
														<input type="checkbox">
														<span class="checkmarks"></span>
													</label>
												</td>
												<td><?php echo htmlspecialchars($row['store_name']); ?></td>
												<td><?php echo htmlspecialchars($row['user_name']); ?></td>
												<td><?php echo htmlspecialchars($row['phone']); ?></td>
												<td><?php echo htmlspecialchars($row['email']); ?></td>
												<td>
												<?php 
													// Determine the badge class based on the status
													$badgeClass = (htmlspecialchars($row['status']) === 'inactive') ? 'badge badge-linedanger' : 'badge badge-linesuccess'; 
												?>
												<span class="<?php echo $badgeClass; ?>"><?php echo htmlspecialchars($row['status']); ?></span>
											   </td>
												<td class="action-table-data">
														<div class="edit-delete-action">
														<a class="me-2 p-2" href="#" data-id="<?php echo htmlspecialchars($row['id']); ?>" data-bs-toggle="modal" data-bs-target="#edit-stores" onclick="setStoreId(this)">
															<i data-feather="edit" class="feather-edit"></i>
														</a>
														<a class="confirm-tex p-2" href="#" data-id="<?php echo htmlspecialchars($row['id']); ?>" onclick="confirmDelete(this)">
															<i data-feather="trash-2" class="feather-trash-2"></i>
														</a>
														</div>
												</td>
											</tr>
										<?php endwhile; ?>
								      <?php else: ?>
										<!-- <tr>
											<td colspan="7">No records found</td>
										</tr> -->
								<?php endif; ?>
							</tbody>
						  </table>
						  <?php
							// Close connection
							//$conn->close();
							?>
							</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<!-- Add Store -->
		<div class="modal fade" id="add-stores">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Create Store</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
							<form action="store-list.php" method="POST">
								<div class="mb-3">
									<label class="form-label">Store Name</label>
									<input type="text" class="form-control" name="store_name" required>
								</div>
								<div class="mb-3">
									<label class="form-label">User Name</label>
									<input type="text" class="form-control" name="user_name" required>
								</div>
								<div class="input-blocks mb-3">
									<label>Password</label>
									<div class="pass-group">
										<input type="password" class=" pass-input" name="password" required>
										<span class="fas toggle-password fa-eye-slash"></span>
									</div>
								</div>
								<div class="mb-3">
									<label class="form-label">Phone</label>
									<input type="text" class="form-control" name="phone" required>
								</div>
								<div class="mb-3">
									<label class="form-label">Email</label>
									<input type="email" class="form-control" name="email" required>
								</div>
								<div class="mb-0">
									<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
										<span class="status-label">Status</span>
										<input type="checkbox" id="user2" class="check" name="status" checked="" value="active">
										<label for="user2" class="checktoggle"></label>
									</div>
								</div>
								<div class="modal-footer-btn">
									<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-submit">Create</button>
								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Store -->

		<!-- Edit Store -->
		<div class="modal fade" id="edit-stores">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Store</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="store-list.php" method="POST">
									<!-- Hidden input to hold the store ID -->
    								<input type="hidden" name="store_id" id="store_id" required value="<?php echo htmlspecialchars($row['id']); ?>">
									<div class="mb-3">
										<label class="form-label">Store Name</label>
										<input type="text" name="store_name_" class="form-control" required placeholder="Fred john ">
									</div>
									<div class="mb-3">
										<label class="form-label">User Name</label>
										<input type="text" name="user_name_" class="form-control" required placeholder="FredJ25">
									</div>
									<div class="input-blocks mb-3">
										<label>Password</label>
										<div class="pass-group">
											<input type="password" name="password_" class="pass-input" required placeholder="...">
											<span class="fas toggle-password fa-eye-slash"></span>
										</div>
									</div>
									<div class="mb-3">
										<label class="form-label">Phone</label>
										<input type="text" name="phone_" class="form-control" required placeholder="+23416358690">
									</div>
									<div class="mb-3">
										<label class="form-label">Email</label>
										<input type="email"name="email_" class="form-control" required placeholder="john@mail.com">
									</div>
									<div class="mb-0">
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
											<span class="status-label">Status</span>
											<input type="checkbox" name="status_" id="user3" class="check" checked="">
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
		<!-- /Edit Store -->

		<?php include 'layouts/customizer.php'; ?>

		<?php include 'layouts/vendor-scripts.php'; ?>
		<script src="assets/js/refresh.js"></script>
		<script>
			$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

			// sorting of store list
			function updateOrder(order) {
				// Get the current URL
				const url = new URL(window.location.href);

				// Update or add the order parameter
				url.searchParams.set('order', order);
				
				// Redirect to the updated URL
				window.location.href = url.toString();
			}

			// get store ID function for updating
			function setStoreId(link) {
				const storeId = link.getAttribute('data-id');
				document.getElementById('store_id').value = storeId; // input for the ID
			}

			function confirmDelete(element) {
         var storeId = element.getAttribute('data-id');
    
    // Display a confirmation dialog using SweetAlert
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, send an AJAX request to delete the store
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'store-delete.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    // Log the response from the server
                    console.log(xhr.responseText); // <- Add this line here for debugging

                    if (xhr.status === 200) {
                        Swal.fire(
                            'Deleted!',
                            'The store has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to reflect the changes
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the store.',
                            'error'
                        );
                    }
                }
						};
						xhr.send('id=' + storeId); // Send the store ID to the server for deletion
				}
			});
		}
		</script>
    </body>
</html>
