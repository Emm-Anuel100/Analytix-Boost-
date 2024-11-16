<?php 
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the database
$conn = connectMainDB();

$user_email = htmlspecialchars($_SESSION['email']); // User's email

// If value is posted and supplier name is not empty
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['supplier_name'])) {
    // Get form data and sanitize inputs
    $supplier_name = htmlspecialchars($_POST['supplier_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $rc_code = htmlspecialchars($_POST['rc_code']);
    $description = htmlspecialchars($_POST['description']);

    // Database query to insert supplier data
    $query = "INSERT INTO suppliers (user_email, name, email, phone, address, city, rc_code, description) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssssssss", $user_email,$supplier_name, $email, $phone, $address, $city, $rc_code, $description);
		if ($stmt->execute()) {
			echo "<script>
					document.addEventListener('DOMContentLoaded', function() {
						Swal.fire({
							title: 'Success!',
							text: 'Supplier added successfully.',
							icon: 'success',
							confirmButtonText: 'OK'
						}).then(() => {
							window.location.href = 'suppliers.php';
						});
					});
				  </script>";
		} else {
			echo "<script>
					document.addEventListener('DOMContentLoaded', function() {
						Swal.fire({
							title: 'Error!',
							text: 'Failed to add supplier. Please try again.',
							icon: 'error',
							confirmButtonText: 'OK'
						});
					});
				  </script>";
		}
        $stmt->close(); // Close the statement
    }
}


// Script to update supplier infor.
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supplier_id']) && !empty($_POST['supplier_name_'])) {
    // Fetch and sanitize form inputs
    $supplier_id = $_POST['supplier_id'];
    $supplier_name = htmlspecialchars($_POST['supplier_name_']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $rc_code = htmlspecialchars($_POST['rc_code']);
    $description = htmlspecialchars($_POST['description']);

    $stmt = $conn->prepare("UPDATE suppliers SET name = ?, email = ?, phone = ?, address = ?,
	 city = ?, rc_code = ?, description = ? WHERE id = ? AND user_email = ?");

    $stmt->bind_param("sssssssis", $supplier_name, $email, $phone, $address, $city, 
	$rc_code, $description, $supplier_id, $user_email);

    // Execute update and handle response
    if ($stmt->execute()) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Supplier updated successfully.',
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
                    text: 'Failed to update supplier.',
                    confirmButtonText: 'OK'
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
	 
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			
		<?php include 'layouts/menu.php'; ?>

			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Supplier List</h4>
								<h6>Manage Your Supplier</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export_suppliers_pdf.php" target="_blank"> <img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export_suppliers_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" class="refresh" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Supplier</a>
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
										<select class="select" name="sort_option" onchange="this.form.submit()">
											<option value="newest" <?= (isset($_POST['sort_option']) && $_POST['sort_option'] === 'newest') ? 'selected' : '' ?>>Newest</option>
											<option value="oldest" <?= (isset($_POST['sort_option']) && $_POST['sort_option'] === 'oldest') ? 'selected' : '' ?>>Oldest</option>
										</select>
									<form>
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
											<th>Supplier Name</th>
											<th>Rc Code</th>
											<th>email</th>
											<th>Phone</th>
											<th>City</th>
											<th class="no-sort">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											// Determine sorting order based on user input
											$sort_option = isset($_POST['sort_option']) ? $_POST['sort_option'] : 'newest';
											$order = ($sort_option === 'oldest') ? 'ASC' : 'DESC';

											// Fetch supplier data
											$stmt = $conn->prepare("SELECT id, name, rc_code, email, phone, city FROM suppliers
											WHERE user_email = ? ORDER BY id $order");

											$stmt->bind_param("s", $user_email);
											$stmt->execute();
											$result = $stmt->get_result();

											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													echo "<tr>
														<td>
															<label class='checkboxs'>
																<input type='checkbox'>
																<span class='checkmarks'></span>
															</label>
														</td>
														<td>{$row['name']}</td>
														<td>{$row['rc_code']}</td>
														<td>{$row['email']}</td>
														<td>{$row['phone']}</td>
														<td>{$row['city']}</td>
														<td class='action-table-data'>
															<div class='edit-delete-action'>
																<a class='me-2 p-2 mb-0' href='#' data-bs-toggle='modal' data-bs-target='#edit-units' onclick='editSupplier({$row['id']})'>
																	<i data-feather='edit' class='feather-edit'></i>
																</a>
																<a class='me-2 confirm-tex p-2 mb-0' href='javascript:void(0);' onclick='deleteSupplier({$row['id']})'>
																	<i data-feather='trash-2' class='feather-trash-2'></i>
																</a>
															</div>
														</td>
													</tr>";
												}
											} else {
												echo "<tr>
														<td>
															<label class='checkboxs'>
																<input type='checkbox'>
																<span class='checkmarks'></span>
															</label>
														</td>
														<td>Demo Supplier</td>
														<td>RC123</td>
														<td>email@example.com</td>
														<td>+234567890</td>
														<td>City Name</td>
														<td class='action-table-data'>
															<div class='edit-delete-action'>
																<a class='me-2 p-2 mb-0' href='javascript:void(0);' data-bs-toggle='modal'>
																	<i data-feather='edit' class='feather-edit'></i>
																</a>
																<a class='me-2 confirm-tex p-2 mb-0' href='javascript:void(0);'>
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

		<!-- Add Supplier -->
			<div class="modal fade" id="add-units">
				<div class="modal-dialog modal-dialog-centered custom-modal-two">
					<div class="modal-content">
						<div class="page-wrapper-new p-0">
							<div class="content">
								<div class="modal-header border-0 custom-modal-header">
									<div class="page-title">
										<h4>Add Supplier</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body custom-modal-body">

									<!-- Form to add supliers  -->
									<form action="suppliers.php" method="POST">
										<div class="row">
											<div class="col-lg-4">
												<div class="input-blocks">
													<label>Supplier Name</label>
													<input type="text" class="form-control" required placeholder="apexcomputers" name="supplier_name">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-blocks">
													<label>Email</label>
													<input type="email" class="form-control" required placeholder="apexcomputers@example.com" name="email">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-blocks">
													<label>Phone</label>
													<input type="text" class="form-control" required placeholder="+234897783 .." name="phone">
												</div>
											</div>
											<div class="col-lg-12">
												<div class="input-blocks">
													<label>Address</label>
													<input type="text" class="form-control" required placeholder="Dreams street .." name="address">
												</div>
											</div>
											<div class="col-lg-12 col-sm-10 col-10">
												<div class="input-blocks">
													<label>City</label>
													<input type="text" class="form-control" required placeholder="Lagos" name="city">
												</div>
											</div>

											<div class="col-lg-12 col-sm-10 col-10">
												<div class="input-blocks">
													<label>Rc Code</label>
													<input type="text" class="form-control" required placeholder="ET453b.." name="rc_code">
												</div>
											</div>
											
											<div class="col-md-12">
												<div class="mb-0 input-blocks">
													<label class="form-label">Descriptions</label>
													<textarea class="form-control mb-1" maxlength="60" required name="description"></textarea>
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
			<!-- /Add Supplier -->

			<!-- Edit Supplier -->
			<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Supplier</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">

							<!-- Form to update supplier infor. -->
							<form action="suppliers.php" method="POST" id="editSupplierModal">
								<input type="hidden" name="supplier_id" id="edit-supplier-id">
							 <div class="row">
								<div class="col-lg-4">
									<div class="input-blocks">
										<label>Supplier Name</label>
										<input type="text" name="supplier_name_" class="form-control" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="input-blocks">
										<label>Email</label>
										<input type="email" name="email" class="form-control" required>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="input-blocks">
										<label>Phone</label>
										<input type="text" name="phone" class="form-control" required>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="input-blocks">
										<label>Address</label>
										<input type="text" name="address" class="form-control" required>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="input-blocks">
										<label>City</label>
										<input type="text" name="city" class="form-control" required>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="input-blocks">
										<label>Rc Code</label>
										<input type="text" name="rc_code" class="form-control" required>
									</div>
								</div>
								<div class="input-blocks">
									<label>Description</label>
									<textarea name="description" class="form-control" required maxlength="60"></textarea>
									<p>Maximum 60 Characters</p>
								</div>
							</div>
							<div class="modal-footer-btn">
								<button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-submit">Submit</button>
							</div>
						</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Edit Supplier -->

		<?php include 'layouts/customizer.php'; ?>
		<?php include 'layouts/vendor-scripts.php'; ?>


<script src="assets/js/refresh.js"></script>
<script>
	$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

	document.addEventListener("DOMContentLoaded", function() {

	// Function to fetch and populate supplier data in the modal
	window.editSupplier = function(supplierId) {
    $.ajax({
        url: 'get_supplier.php', // Backend PHP file to fetch supplier data
        type: 'GET',
        data: { id: supplierId },
        dataType: 'json',
        success: function(response) {
			console.log(response); // Check the data format here
            if (response.success) {
                // Populate modal fields with data
				$('#editSupplierModal input[name="supplier_id"]').val(response.data.id);
                $('#editSupplierModal input[name="supplier_name_"]').val(response.data.name);
                $('#editSupplierModal input[name="email"]').val(response.data.email);
                $('#editSupplierModal input[name="phone"]').val(response.data.phone);
                $('#editSupplierModal input[name="address"]').val(response.data.address);
                $('#editSupplierModal input[name="city"]').val(response.data.city);
                $('#editSupplierModal input[name="rc_code"]').val(response.data.rc_code);
                $('#editSupplierModal textarea[name="description"]').val(response.data.description);

            } else {
                Swal.fire('Error', 'Unable to fetch supplier details.', 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'An error occurred while fetching supplier details.', 'error');
        }
		});
	};


    // Delete Supplier
    window.deleteSupplier = function(supplierId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                // Make an AJAX call to delete the supplier
                fetch(`delete_supplier.php?id=${supplierId}`, {
                    method: 'POST',
                }).then(response => response.json())
                  .then(data => {
                    if (data.success) {
                        Swal.fire("Deleted!", "Supplier has been deleted.", "success");
                        location.reload(); // Refresh page after deletion
                    } else {
                        Swal.fire("Error!", "There was a problem deleting the supplier.", "error");
                    }
                });
            }
        });
    };
});

</script>
</body>
</html>