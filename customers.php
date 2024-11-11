<?php 
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the  database
$conn = connectMainDB();

// If value is posted and customer name field is not empty
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['customer_name'])) {
    $customerName = htmlspecialchars($_POST['customer_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $description = htmlspecialchars($_POST['description']);
	$user_email = htmlspecialchars($_SESSION['email']); // User's email

    // Insert into database
    $query = "INSERT INTO customers (user_email, name, email, phone, address, city, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $user_email,$customerName, $email, $phone, $address, $city, $description);

    // Success and error handling with SweetAlert
    if ($stmt->execute()) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Customer added successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'customers.php';
                    });
                });
              </script>";
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to add customer. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
              </script>";
    }
}

// Script to update customer's details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['customer_name_']) && isset($_POST['customer_id'])) {
    $id = htmlspecialchars( $_POST['customer_id']);
    $name = htmlspecialchars( $_POST['customer_name_']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars( $_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $description = htmlspecialchars($_POST['description']);

    if ($id) { // Update existing customer
        $query = "UPDATE customers SET name = ?, email = ?, phone = ?, address = ?, city = ?, description = ? 
		WHERE id = ?";
		
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $name, $email, $phone, $address, $city, $description, $id);

        if ($stmt->execute()) {
            echo "<script>
			        document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Customer updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'customers.php';
                   	 });
					});
                  </script>";
        } else {
            echo "<script>
					document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update customer. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                   	 });
					});
                  </script>";
        }
    }
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
								<h4>Customer List</h4>
								<h6>Manage your warehouse</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export_customers_pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export_customers_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" class="refresh" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Customer</a>
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
									<form action="customers.php" method="POST" id="sortForm">
										<select class="select" name="sort_option" onchange="this.form.submit()">
											<option value="newest" <?php echo isset($_POST['sort_option']) && $_POST['sort_option'] == 'newest' ? 'selected' : ''; ?>>Newest</option>
											<option value="oldest" <?php echo isset($_POST['sort_option']) && $_POST['sort_option'] == 'oldest' ? 'selected' : ''; ?>>Oldest</option>
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
										<th>Customer Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>City</th>
										<th class="no-sort">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
								// Form logic to handle sorting
								$sort_option = isset($_POST['sort_option']) ? $_POST['sort_option'] : 'newest';
								$order = ($sort_option === 'oldest') ? 'ASC' : 'DESC';

								// Query for fetching customer data with sorting
								$query = "SELECT id, name, email, phone, city FROM customers WHERE
								 user_email = ? ORDER BY id $order";
								
								// Prepare and execute the query
								$stmt = $conn->prepare($query);
								$stmt->bind_param("s", $user_email); // user’s email
								$stmt->execute();
								$result = $stmt->get_result();

									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											echo "<tr>";
											echo "<td>
													<label class='checkboxs'>
														<input type='checkbox'>
														<span class='checkmarks'></span>
													</label>
												</td>";
											echo "<td>
													<div class='userimgname cust-imgname'>
														<a href='javascript:void(0);'>" . htmlspecialchars($row['name']) . "</a>
													</div>
												</td>";
											echo "<td>" . htmlspecialchars($row['email']) . "</td>";
											echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
											echo "<td>" . htmlspecialchars($row['city']) . "</td>";
											echo "<td class='action-table-data'>
													<div class='edit-delete-action'>
														<a class='me-2 p-2' href='#' data-bs-toggle='modal' data-bs-target='#edit-units' 
														onclick='openEditModal(" . $row['id'] . ")'>
															<i data-feather='edit' class='feather-edit'></i>
														</a>
														<a class='confirm-tex p-2' href='javascript:void(0);' onclick='deleteCustomer(" . $row['id'] . ")'>
															<i data-feather='trash-2' class='feather-trash-2'></i>
														</a>
													</div>
												</td>";
											echo "</tr>";
											}
										} else {
										 // Show Demo datas
										echo "<tr>";
										echo "<td>
												<label class='checkboxs'>
													<input type='checkbox'>
													<span class='checkmarks'></span>
												</label>
											</td>";
										echo "<td>
												<div class='userimgname cust-imgname'>
													<a href='javascript:void(0);'>Demo Customer</a>
												</div>
											</td>";
										echo "<td>Demo@example.com</td>";
										echo "<td>+2348567890</td>";
										echo "<td>Demo City</td>";
										echo "<td class='action-table-data'>
												<div class='edit-delete-action'>
													<a class='me-2 p-2' href='#' data-bs-toggle='modal' data-bs-target='#edit-unit'>
														<i data-feather='edit' class='feather-edit'></i>
													</a>
													<a class='confirm-tex p-2' href='javascript:void(0);'>
														<i data-feather='trash-2' class='feather-trash-2'></i>
													</a>
												</div>
											</td>";
										echo "</tr>";
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

		<!-- Add Customer -->
		<div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Customer</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">

							  <!-- Form to save customers  -->
							   <form action="customers.php" method="POST">
									<div class="row">
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Customer Name</label>
												<input type="text" class="form-control" name="customer_name" required>
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="email" class="form-control" name="email" required>
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="input-blocks">
												<label class="mb-2">Phone</label>
												<input class="form-control" id="phone" name="phone" type="text" required>
											</div>
										</div>
										<div class="col-lg-12 pe-0">
											<div class="mb-3">
												<label class="form-label">Address</label>
												<input type="text" class="form-control" name="address" required>
											</div>
										</div>
										<div class="col-lg-12 pe-0">
											<div class="mb-3">
												<label class="form-label">City</label>
												<input type="text" class="form-control" name="city" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3 input-blocks">
												<label class="form-label">Descriptions</label>
												<textarea class="form-control" name="description" maxlength="60" required></textarea>
												<p>Maximum 60 Characters</p>
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
		<!-- /Add Customer -->

        <!-- Edit Customer -->
		<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Customer</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">

								<!-- Form to edit customer's details -->
								<form action="customers.php" method="POST">
								<!-- Input field to hold customer's ID -->
								<input type="hidden" name="customer_id" id="customer_id">

									<div class="row">
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Customer Name</label>
												<input type="text" class="form-control" name="customer_name_" placeholder="Thomas" required>
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="email" class="form-control" name="email" placeholder="thomas@example.com" required>
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="input-blocks">
												<label class="mb-2">Phone</label>
												<input class="form-control form-control-lg group_formcontrol" id="phone2" name="phone" type="text" required>
											</div>
										</div>
										<div class="col-lg-12 pe-0">
											<div class="mb-3">
												<label class="form-label">Address</label>
												<input type="text" class="form-control" name="address" placeholder="Budapester Strasse 2027259" required>
											</div>
										</div>
										<div class="col-lg-12 pe-0">
											<div class="mb-3">
												<label class="form-label">City</label>
												<input type="text" class="form-control" name="city">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-0 input-blocks">
												<label class="form-label">Descriptions</label>
												<textarea class="form-control mb-1" name="description" maxlength="60" required></textarea>
												<p>Maximum 60 Characters</p>
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
		<!-- /Edit Customer -->
		 

	<?php include 'layouts/customizer.php'; ?>
	<!-- JAVASCRIPT -->
		<!-- Mobile Input -->
		<script src="assets/plugins/intltelinput/js/intlTelInput.js"></script>
	<?php include 'layouts/vendor-scripts.php'; ?>

	
<script src="assets/js/refresh.js"></script>
<script>
	$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

	function deleteCustomer(customerId) {
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
            // AJAX request to delete customer
            fetch('delete_customer.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: customerId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Deleted!', 'Customer has been deleted.', 'success')
                        .then(() => location.reload());
                } else {
                    Swal.fire('Error!', 'Failed to delete customer.', 'error');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
}


// Function to populate the input fields
function openEditModal(customerId) {
    fetch('get_customer.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: customerId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
			// Populate the hidden input field with customer ID
            document.querySelector('#edit-units [name="customer_id"]').value = customerId;
			// Populate other input fields with their corresponding datas
            document.querySelector('#edit-units [name="customer_name_"]').value = data.customer.name;
            document.querySelector('#edit-units [name="email"]').value = data.customer.email;
            document.querySelector('#edit-units [name="phone"]').value = data.customer.phone;
            document.querySelector('#edit-units [name="address"]').value = data.customer.address;
            document.querySelector('#edit-units [name="city"]').value = data.customer.city;
            document.querySelector('#edit-units [name="description"]').value = data.customer.description;
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
</body>
</html>