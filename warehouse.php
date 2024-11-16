<?php
include('./layouts/session.php');
include('./conn.php');

// Establish the connection to the user's database
$conn = connectMainDB();

// User's email
$user_email = htmlspecialchars( $_SESSION['email']); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && !empty($_POST['contact'])) {

		// Set parameters with htmlspecialchars to sanitize inputs
		$name = htmlspecialchars($_POST['name']);
		$contact = htmlspecialchars($_POST['contact']);
		$phone_1 = htmlspecialchars($_POST['phone_1']);
		$email = htmlspecialchars($_POST['email']);
		$address_1 = htmlspecialchars($_POST['address_1']);
		$address_2 = htmlspecialchars($_POST['address_2']);
		$country = htmlspecialchars($_POST['country']);
		$state = htmlspecialchars($_POST['state']);
		$city = htmlspecialchars($_POST['city']);
		$zipcode = htmlspecialchars($_POST['zipcode']);
		$user_email = htmlspecialchars($_SESSION['email']); // User's email

		// Prepare and bind parameters
		$stmt = $conn->prepare("INSERT INTO warehouse (user_email, name, contact_person, phone,
		 email, address_1, address_2, country, state, city, zip_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

		$stmt->bind_param("sssssssssss", $user_email, $name, $contact, $phone_1, $email,
		 $address_1, $address_2, $country, $state, $city, $zipcode);

		 // Execute statement
		 if ($stmt->execute()) {
			  echo "<script>
						 document.addEventListener('DOMContentLoaded', function() {
							  Swal.fire({
									icon: 'success',
									title: 'Success',
									text: 'Warehouse information saved successfully.',
									confirmButtonText: 'OK'
							  });
						 });
					  </script>";
		  } else {
			echo "<script>
						document.addEventListener('DOMContentLoaded', function() {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: 'Error saving data: " . addslashes($stmt->error) . "',
								confirmButtonText: 'OK'
							});
						});
					</script>";
		    }

		 // Close the statement
		 $stmt->close();
		}


		// Script to update warehouse information
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name_']) && !empty($_POST['name_'])) {

			// Sanitize inputs using htmlspecialchars
			$id = htmlspecialchars($_POST['id_']);
			$name = htmlspecialchars($_POST['name_']);
			$contact = htmlspecialchars($_POST['contact_']);
			$phone = htmlspecialchars($_POST['phone_']);
			$email = htmlspecialchars($_POST['email_']);
			$address_1 = htmlspecialchars($_POST['address_1_']);
			$address_2 = htmlspecialchars($_POST['address_2_']);
			$country = htmlspecialchars($_POST['country_']);
			$state = htmlspecialchars($_POST['state_']);
			$city = htmlspecialchars($_POST['city_']);
			$zipcode = htmlspecialchars($_POST['zipcode_']);
		
			// Update query
			$sql = "UPDATE warehouse SET 
					name = ?, 
					contact_person = ?, 
					phone = ?, 
					email = ?, 
					address_1 = ?, 
					address_2 = ?, 
					country = ?, 
					state = ?, 
					city = ?, 
					zip_code = ?
					WHERE id = ? AND user_email = '$user_email'";
		
			$stmt = $conn->prepare($sql);
			$stmt->bind_param(
				"ssssssssssi", 
				$name, $contact, $phone, $email, 
				$address_1, $address_2, $country, 
				$state, $city, $zipcode, $id
			);
		
			if ($stmt->execute()) {
				echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire({
								icon: "success",
								title: "Success",
								text: "Warehouse information updated successfully.",
								confirmButtonText: "OK"
							}).then(() => {
								window.location = "warehouse.php";
							});
						});
					  </script>';
			} else {
				echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire({
								icon: "error",
								title: "Error",
								text: "Failed to update warehouse information. Please try again.",
								confirmButtonText: "OK"
							});
						});
					  </script>';
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

		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<?php include 'layouts/menu.php'; ?>

			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Warehouse</h4>
								<h6>Manage your warehouse</h6>
							</div>						
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export_warehouse_pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export_warehouse_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Warehouse</a>
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
								<div class="search-path">
									<div class="d-flex align-items-center">
										<div class="layout-hide-box">
											<a href="javascript:void(0);" class="me-3 layout-box"><i data-feather="layout" class="feather-search"></i></a>
											<div class="layout-drop-item card">
												<div class="drop-item-head">
													<h5>Want to manage datatable?</h5>
													<p>Please drag and drop your column to reorder your table and enable see option as you want.</p>
												</div>
												<ul>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Shop</span>
															<input type="checkbox" id="option1" class="check" checked>
															<label for="option1" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Product</span>
															<input type="checkbox" id="option2" class="check" checked>
															<label for="option2" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Reference No</span>
															<input type="checkbox" id="option3" class="check" checked>
															<label for="option3" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Date</span>
															<input type="checkbox" id="option4" class="check" checked>
															<label for="option4" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Responsible Person</span>
															<input type="checkbox" id="option5" class="check" checked>
															<label for="option5" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Notes</span>
															<input type="checkbox" id="option6" class="check" checked>
															<label for="option6" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Quantity</span>
															<input type="checkbox" id="option7" class="check" checked>
															<label for="option7" class="checktoggle">	</label>
														</div>
													</li>
													<li>
														<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
															<span class="status-label"><i data-feather="menu" class="feather-menu"></i>Actions</span>
															<input type="checkbox" id="option8" class="check" checked>
															<label for="option8" class="checktoggle">	</label>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="form-sort">
									<i data-feather="sliders" class="info-img"></i>
									<form action="" method="post">
										<select class="select" name="sort_option" onchange="this.form.submit()">
											<option value="newest" <?= (isset($_POST['sort_option']) && $_POST['sort_option'] === 'newest') ? 'selected' : '' ?>>Newest</option>
											<option value="oldest" <?= (isset($_POST['sort_option']) && $_POST['sort_option'] === 'oldest') ? 'selected' : '' ?>>Oldest</option>
										</select>
								</form>
								</div>
							</div>

				   <div class="table-responsive">
					<?php
					// Get the sorting option from the POST data, defaulting to 'newest' if not set
					$sort_option = isset($_POST['sort_option']) ? $_POST['sort_option'] : 'newest';

					// Determine the SQL order based on the selected option
					$order = ($sort_option === 'oldest') ? 'ASC' : 'DESC';

						// Fetch data from the warehouses table
						$sql = "SELECT * FROM warehouse WHERE user_email = '$user_email' ORDER BY id $order";
						$result = $conn->query($sql);
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
								<th>Name</th>
								<th>Contact Person</th>
								<th>Phone</th>
								<th>Total Products</th>
								<th>Country</th>
								<th>State</th>
								<th>Email</th>
								<th>Address</th>
								<th>Created On</th>
								<th>Status</th>
								<th class="no-sort">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// Check if there are results and populate the table
							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
								// Count the total products for each warehouse
								$warehouse_name = $row['name'];  // Get the 'name' 
								$user_email = htmlspecialchars($_SESSION['email']); // Get the user's email
								$product_count_sql = "SELECT COUNT(*) as total_products FROM products 
								WHERE warehouse = '$warehouse_name' AND email = '$user_email'";

								$product_count_result = $conn->query($product_count_sql);
								$product_count_row = $product_count_result->fetch_assoc();
								$total_products = $product_count_row['total_products'];

								$warehouse_id = $row['id']; // Warehouse ID

								echo "<tr>";
								echo "<td><label class='checkboxs'><input type='checkbox'><span class='checkmarks'></span></label></td>";
								echo "<td>{$row['name']}</td>";
								echo "<td><div class='userimgname'><a href='javascript:void(0);' class='product-img'><img src='assets/img/users/user-08.jpg' alt='product'></a><a href='javascript:void(0);'>{$row['contact_person']}</a></div></td>";
								echo "<td>{$row['phone']}</td>";
								// Output total products count for each warehouse
								echo "<td>{$total_products}</td>";
								echo "<td>{$row['country']}</td>";
								echo "<td>{$row['state']}</td>";
								echo "<td>{$row['email']}</td>";
								echo "<td>{$row['address_1']}</td>";
								echo "<td>" . date('d M Y', strtotime($row['timestamp'])) . "</td>";
								echo "<td><span class='badge badge-linesuccess'>{$row['status']}</span></td>";
								echo "<td class='action-table-data'>";
								echo "<div class='edit-delete-action'>";
								echo "<a class='me-2 p-2 edit-btn' href='#' data-bs-toggle='modal' data-id='{$warehouse_id}' data-bs-target='#edit-units'><i data-feather='edit' class='feather-edit'></i></a>";
								echo "<a class='confirm-tex p-2 delete-btn' href='javascript:void(0);' data-id='{$warehouse_id}'><i data-feather='trash-2' class='feather-trash-2'></i></a>";
								echo "</div></td>";
								echo "</tr>";
								}
							 } else {
								// echo "<tr><td colspan='10'>No records found.</td></tr>";
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

		<!-- Add Warehouse -->
		<div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Warehouse</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
							<form action="warehouse.php" method="POST">
									<div class="modal-title-head">
										<h6><span><i data-feather="info" class="feather-edit"></i></span>Warehouse Info</h6>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Name</label>
												<input type="text" class="form-control" required name="name">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Contact Person</label>
												<input type="text" class="form-control" required name="contact">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3 war-edit-phone">
												<label class="mb-2">Phone Number</label>
												<input class="form-control" id="phone3" name="phone_1" type="text">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="email" class="form-control" required name="email">
											</div>
										</div>
										<div class="modal-title-head">
											<h6><span><i data-feather="map-pin"></i></span>Location</h6>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Address 1</label>
												<input type="text" class="form-control" required name="address_1">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="input-blocks">
												<label class="form-label">Address 2</label>
												<input type="text" class="form-control" required name="address_2">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Country</label>
												<select class="select" required name="country">
												<option value="Ghana">Ghana</option>
													<option value="Nigeria">Nigeria</option>
													<option value="Senegal">Senegal</option>
													<option value="Sierra Leone">Sierra Leone</option>
													<option value="South Africa">South Africa</option>
											</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">State</label>
												<input type="text" class="form-control" required name="state">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3 mb-0">
												<label class="form-label">City</label>
												<input type="text" class="form-control" required name="city">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3 mb-0">
												<label class="form-label">Zipcode</label>
												<input type="text" class="form-control" required name="zipcode">
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
		<!-- /Add Warehouse -->

		<!-- Edit Warehouse -->
		<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Warehouse</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<!-- Form to update warehouse information -->
								<form action="warehouse.php" method="POST">
									<input type="hidden" name="id_" value=""> <!-- Hidden field for ID -->
									<div class="modal-title-head">
										<h6><span><i data-feather="info" class="feather-edit"></i></span>Warehouse Info</h6>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">Name</label>
												<input type="text" class="form-control" required name="name_">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Contact Person</label>
												<input class="form-control" name="contact_" type="text" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3 war-edit-phone">
												<label class="mb-2">Phone Number</label>
												<input class="form-control" id="phone" name="phone_" type="text" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="email" class="form-control" name="email_" required>
											</div>
										</div>
										<div class="modal-title-head">
											<h6><span><i data-feather="map-pin"></i></span>Location</h6>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label class="form-label">Address 1</label>
												<input type="text" class="form-control" name="address_1_" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="input-blocks">
												<label class="form-label">Address 2</label>
												<input type="text" class="form-control" name="address_2_" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="input-blocks">
												<label>Country</label>
												<select class="select" required name="country_">
													<option value="Ghana">Ghana</option>
													<option value="Nigeria">Nigeria</option>
													<option value="Senegal">Senegal</option>
													<option value="Sierra Leone">Sierra Leone</option>
													<option value="South Africa">South Africa</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label class="form-label">State</label>
												<input type="text" class="form-control" name="state_" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3 mb-0">
												<label class="form-label">City</label>
												<input type="text" class="form-control" name="city_" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3 mb-0">
												<label class="form-label">Zipcode</label>
												<input type="text" class="form-control" name="zipcode_" required>
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
		<!-- /Edit Warehouse -->


		<?php include 'layouts/customizer.php'; ?>
		<!-- Mobile Input -->
		<script src="assets/plugins/intltelinput/js/intlTelInput.js"></script>
		<?php include 'layouts/vendor-scripts.php'; ?>


		<script src="./assets/js/refresh.js"></script>
		<script>
			$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable
			
		document.addEventListener('DOMContentLoaded', function () {
		// Event listener for edit buttons
		document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const warehouseId = this.getAttribute('data-id');

            // Fetch warehouse data with AJAX (assuming you have a PHP file for this)
            fetch(`get_warehouse_data.php?id=${warehouseId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate modal fields with the fetched data
					document.querySelector("input[name='id_']").value = data.id;	
                    document.querySelector("input[name='name_']").value = data.name;
                    document.querySelector("input[name='contact_']").value = data.contact_person;
                    document.querySelector("input[name='phone_']").value = data.phone;
                    document.querySelector("input[name='email_']").value = data.email;
                    document.querySelector("input[name='address_1_']").value = data.address_1;
                    document.querySelector("input[name='address_2_']").value = data.address_2;
                    document.querySelector("input[name='state_']").value = data.state;
                    document.querySelector("input[name='city_']").value = data.city;
                    document.querySelector("input[name='zipcode_']").value = data.zip_code;
                });
				});
			});
		});


		// Function to delete individual warehouse data
		document.addEventListener('DOMContentLoaded', function () {
		const deleteButtons = document.querySelectorAll('.delete-btn');

		deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const warehouseId = this.getAttribute('data-id');
            
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
                    // Use AJAX to delete the warehouse data
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'delete_warehouse.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'The warehouse has been deleted.',
                                    'success'
                                ).then(() => {
                                    // Optionally remove the row from the table
                                    document.querySelector(`[data-id="${warehouseId}"]`).closest('tr').remove();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was an error deleting the warehouse.',
                                    'error'
                                );
                            }
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error with the request.',
                                'error'
                            );
                        }
                    };

                    xhr.send('id=' + warehouseId); // Send warehouse ID to delete_warehouse.php
                }
				});
			});
		});
	});	
	</script>
    </body>
</html>