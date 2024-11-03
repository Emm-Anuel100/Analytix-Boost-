<?php 
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the database
$conn = connectMainDB();

$message = ''; // Initialize a message variable
$icon = 'info'; // Default icon

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    // Get data
    $name = $_POST['name'];
	 $user_email = $_SESSION['email'];
    $short_name = $_POST['short_name'];
    $status = isset($_POST['status']) ? "active" : "inactive"; 

    // Prepare the SQL statement
    $sql = "INSERT INTO units (user_email, name, short_name, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $user_email, $name, $short_name, $status); // "s" -> string

    // Execute the statement
    if ($stmt->execute()) {
        $message = "New unit created successfully!";
        $icon = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $icon = "error";
    }

    // Close the statement
    $stmt->close();
    
    // Output SweetAlert code with DOMContentLoaded
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "' . ($icon === "error" ? "Error!" : "Success!") . '",
                text: "' . addslashes($message) . '",
                icon: "' . $icon . '",
                confirmButtonText: "OK"
            });
        });
    </script>';
}


//Update Units data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['unit_id'])) {
    // Get the form data
    $unit_id = intval($_POST['unit_id']);
    $name = $_POST['name_'];
    $short_name = $_POST['short_name_'];
    $status = isset($_POST['status_']) ? 'active' : 'inactive';

    // Sanitize inputs
    $name = $conn->real_escape_string($name);
    $short_name = $conn->real_escape_string($short_name);

    // Prepare the SQL query for updating the unit
    $sql = "UPDATE units SET name = ?, short_name = ?, status = ? WHERE id = ? AND user_email = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssis", $name, $short_name, $status, $unit_id, $_SESSION['email']);

        if ($stmt->execute()) {
            // Success message
            $message = "Unit updated successfully!";
            $icon = "success";
        } else {
            // Error message
            $message = "Error updating unit.";
            $icon = "error";
        }
        $stmt->close();
    } else {
        // SQL preparation error
        $message = "Error preparing the update query.";
        $icon = "error";
    }

    // Output SweetAlert code with DOMContentLoaded
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "' . ($icon === "error" ? "Error!" : "Success!") . '",
                text: "' . addslashes($message) . '",
                icon: "' . $icon . '",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.href = "units.php"; // Redirect after the alert
            });
        });
    </script>';
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
 <?php include 'layouts/title-meta.php'; ?>
 <?php include 'layouts/head-css.php'; ?>
 <!-- Include SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
								<h4>Units</h4>
								<h6>Manage your units</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export_units_pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export_units_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i> Add New Unit</a>
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
								<?php
			                     // Check if a sort option is selected
						         $sort_option = isset($_POST['sort']) ? $_POST['sort'] : 'newest';
								 ?>
								<div class="form-sort">
									<i data-feather="sliders" class="info-img"></i>
									<form method="POST" action="">
									<select name="sort" class="select" onchange="this.form.submit()">
										<option value="newest" <?php echo $sort_option === 'newest' ? 'selected' : ''; ?>>Newest</option>
										<option value="oldest" <?php echo $sort_option === 'oldest' ? 'selected' : ''; ?>>Oldest</option>
									</select>
								</form>
								</div>
							</div>
							<div class="table-responsive">
						<?php
						// Sanitize user email for safety
						$user_email = trim($conn->real_escape_string($_SESSION['email']));

						// Set the ORDER BY clause based on the selected option
						if ($sort_option === 'newest') {
							$order_by = 'id DESC'; // Assuming id is the primary key for 'newest'
						} else {
							$order_by = 'id ASC'; // 'oldest'
						}

						$sql = "SELECT * FROM units WHERE user_email = '$user_email' ORDER BY $order_by";
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
								<th>Unit</th>
								<th>Short name</th>
								<th>No of Products</th>
								<th>Created on</th>
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
								$unit_name = $row['name']; // Get the 'unit name' 
								$unit_short_name = $row['short_name']; // Get the 'unit short name'
								$user_email = $_SESSION['email']; // Get the user's Email
								$product_count_sql = "SELECT COUNT(*) as total_units FROM products WHERE unit = '$unit_short_name' AND email = '$user_email'";
								$product_count_result = $conn->query($product_count_sql);
								$product_count_row = $product_count_result->fetch_assoc();
								$total_units = $product_count_row['total_units'];
								$badgeClass = ($row['status'] === 'active') ? 'badge-linesuccess' : 'badge-linedanger';

								echo "<tr>";
								echo "<td><label class='checkboxs'><input type='checkbox'><span class='checkmarks'></span></label></td>";
								echo "<td>{$row['name']}</td>";
								echo "<td>{$row['short_name']}</td>";
								// Output total products count for each warehouse
								echo "<td>{$total_units}</td>";
								echo "<td>" . date('d M Y', strtotime($row['timestamp'])) . "</td>";
								echo "<td><span class='badge {$badgeClass}'>{$row['status']}</span></td>";
								echo "<td class='action-table-data'>";
								echo "<div class='edit-delete-action'>";
								echo "<a class='me-2 p-2 edit-unit' href='#' data-bs-toggle='modal' data-bs-target='#edit-units' 
									data-id='{$row['id']}' 
									data-name='{$row['name']}' 
									data-shortname='{$row['short_name']}' 
									data-status='{$row['status']}'><i data-feather='edit' class='feather-edit'></i></a>";
								echo "<a class='confirm-tex p-2 delete-unit' href='javascript:void(0);' data-id='{$row['id']}'><i data-feather='trash-2' class='feather-trash-2'></i></a>";
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

		<!-- Add Unit -->
		<div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Create Unit</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="units.php" method="post">
									<div class="mb-3">
										<label class="form-label">Name</label>
										<input type="text" class="form-control" required name="name">
									</div>
									<div class="mb-3">
										<label class="form-label">Short Name</label>
										<input type="text" class="form-control" required name="short_name">
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
										<button type="submit" class="btn btn-submit">Create Unit</button>
									</div>
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ Add Unit -->

		<!--/ Edit Unit -->
		<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Unit</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body custom-modal-body">

								<form action="units.php" method="post">
									<div class="mb-3">
										<label class="form-label">Name</label>
										<input type="text" class="form-control" required name="name_">
									</div>
									<div class="mb-3">
										<label class="form-label">Short Name</label>
										<input type="text" class="form-control"  required name="short_name_">
									</div>
									<div class="mb-0">
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
											<span class="status-label">Status</span>
											<input type="checkbox" id="user3" class="check" checked="" name="status_">
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
		<?php include 'layouts/customizer.php'; ?>
<!-- /Edit Unit -->
	
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/refresh.js"></script>
<script>
	$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

	// Delete Unit
	$(document).ready(function() {
    $('.delete-unit').on('click', function() {
        var unitId = $(this).data('id');

        // SweetAlert confirmation dialog
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this unit!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'delete_unit.php', // Path to your delete PHP file
                    type: 'POST',
                    data: { id: unitId },
                    success: function(response) {
                        try {
                            var jsonResponse = JSON.parse(response);
                            if (jsonResponse.success) {
                                Swal.fire(
                                    "Deleted!",
                                    jsonResponse.message,
                                    "success"
                                ).then(() => {
                                    location.reload(); // Reload the page to reflect changes
                                });
                            } else {
                                Swal.fire(
                                    "Error!",
                                    jsonResponse.message,
                                    "error"
                                );
                            }
                        } catch (e) {
                            console.error('Parsing error:', e);
                            Swal.fire(
                                "Error!",
                                "An unexpected error occurred.",
                                "error"
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', xhr.responseText);
                        Swal.fire(
                            "Error!",
                            "An error occurred while deleting the unit.",
                            "error"
                        );
                    }
                });
            } else {
                Swal.fire("Your unit is safe!");
            }
        });
    });
});


// Populate form fields
$(document).ready(function() {
    $('.edit-unit').on('click', function() {
        var unitId = $(this).data('id');
        var unitName = $(this).data('name');
        var unitShortName = $(this).data('shortname');
        var unitStatus = $(this).data('status');

        // Populate the form fields with the unit data
        $('#edit-units input[name="name_"]').val(unitName);
        $('#edit-units input[name="short_name_"]').val(unitShortName);
        $('#edit-units input[name="status_"]').prop('checked', unitStatus === 'active');
        
        // Add hidden input to pass the unit ID
        $('#edit-units form').append('<input type="hidden" name="unit_id" value="' + unitId + '">');
    });
});
</script>
</body>
</html>			