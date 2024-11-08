<?php 
include("./layouts/session.php");

include 'conn.php'; // Include database connection

$conn = connectMainDB(); // Establish the connection to the user's database

$user_email = htmlspecialchars($_SESSION['email']); // User's email

// If value is posted and categoiry name is not empty
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['category_name'])) {
    $category_name = $_POST['category_name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO expense_category (user_email, category_name, description) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss",$user_email, $category_name, $description);

        if ($stmt->execute()) {
            // Success message using SweetAlert within DOMContentLoaded
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Expense category added successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'expense-category.php'; // Redirect after alert
                        });
                    });
                  </script>";
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error adding the category: " . $stmt->error . "',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                  </script>";
        }
        $stmt->close(); // Close the statement
    } else {
	echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				Swal.fire({
					title: 'Error!',
					text: 'Error preparing statement: " . $conn->error . "',
					icon: 'error',
					confirmButtonText: 'OK'
				});
			});
			</script>";
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
								<h4>Expense Category</h4>
								<h6>Manage Your Expense Category</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" href="export-expense-category_pdf.php" target="_blank"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Csv" href="export-expense-category_csv.php" target="_blank"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a  class="refresh" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i> Add Expense Category</a>
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
									<select class="select" name="sort_order" onchange="this.form.submit()">
										<option value="newest" <?php if (isset($_POST['sort_order']) && $_POST['sort_order'] === 'newest') echo 'selected'; ?>>Newest</option>
										<option value="oldest" <?php if (isset($_POST['sort_order']) && $_POST['sort_order'] === 'oldest') echo 'selected'; ?>>Oldest</option>
									</select>
								</form>
								</div>
							</div>
							
							<div class="table-responsive">
							<?php
							// Set default sort order
							$sort_order = "DESC"; // Default to "newest" (descending order)

							// Adjust the order based on user's choice
							if (isset($_POST['sort_order'])) {
								$sort_order = ($_POST['sort_order'] === 'oldest') ? "ASC" : "DESC";
							}
							// Fetch the categories from the database
							$sql = "SELECT id, category_name, description FROM 
							expense_category WHERE user_email = '$user_email' ORDER BY id $sort_order";

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
										<th>Category name</th>
										<th>Description</th>
										<th class="no-sort">Action</th>
									</tr>
								</thead>
								<tbody class="Expense-list-blk">
									<?php
									// Check if we have data
									if ($result->num_rows > 0) {
										// Output the data for each row
										while($row = $result->fetch_assoc()) {
											echo "<tr>
													<td>
														<label class='checkboxs'>
															<input type='checkbox'>
															<span class='checkmarks'></span>
														</label>
													</td>
													<td>" . htmlspecialchars($row['category_name']) . "</td>
													<td>" . htmlspecialchars($row['description']) . "</td>
													<td class='action-table-data'>
														<div class='edit-delete-action'>
															<a class='me-2 p-2 mb-0 edit-btn' data-bs-toggle='modal' data-id='" . $row['id'] . "' data-bs-target='#edit-units'>
																<i data-feather='edit' class='feather-edit'></i>
															</a>
															 <a class='me-0 confirm-tex p-2 mb-0 delete-btn' data-id='" . $row['id'] . "' href='javascript:void(0);'>
																<i data-feather='trash-2' class='feather-trash-2'></i>
															</a>
														</div>
													</td>
												</tr>";
										}
									} else {
										// Display a demo row if no data is found
										echo "<tr>
												<td>
													<label class='checkboxs'>
														<input type='checkbox'>
														<span class='checkmarks'></span>
													</label>
												</td>
												<td>Demo name</td>
												<td>Demo description</td>
												<td class='action-table-data'>
													<div class='edit-delete-action'>
														 <a class='me-2 p-2 mb-0 ' data-bs-toggle='modal' data-bs-target='#edit-modal'>
															<i data-feather='edit' class='feather-edit'></i>
														</a>
														<a class='me-0 confirm-tex p-2 mb-0' href='javascript:void(0);'>
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

			<!-- Add Expense Category-->
			<div class="modal fade" id="add-units">
				<div class="modal-dialog modal-dialog-centered custom-modal-two">
					<div class="modal-content">
						<div class="page-wrapper-new p-0">
							<div class="content">
								<div class="modal-header border-0 custom-modal-header">
									<div class="page-title">
										<h4>Add Expense Category</h4>
									</div>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body custom-modal-body">
								<!-- Expense category form -->
								<form action="expense-category.php" method="POST">
										<div class="row">
											<div class="col-lg-12">
												<div class="mb-3">
													<label class="form-label">Category Name</label>
													<input type="text" class="form-control" name="category_name" required>
												</div>
											</div>                                
											<div class="col-md-12">
												<div class="edit-add card">
													<div class="edit-add">
														<label class="form-label">Description</label>
													</div>
													<div class="card-body-list input-blocks mb-0">
														<textarea class="form-control" name="description" maxlength="60" required></textarea>
													</div>
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
			<!--/ Add Expense Category-->

    </div>
	<!-- end main Wrapper-->

	<!-- Edit Expense Category-->
	<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Expense Category</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
							<form id="edit-form" method="POST">
								<input type="hidden" name="id" id="edit-id">
								<div class="row">
									<div class="col-lg-12">
										<div class="mb-3">
											<label class="form-label">Category Name</label>
											<input type="text" class="form-control" name="category_name_" id="edit-category-name" required>
										</div>
									</div>                            
									<div class="col-md-12">
										<div class="edit-add card">
											<div class="edit-add">
												<label class="form-label">Description</label>
											</div>
											<div class="card-body-list input-blocks mb-0">
												<textarea class="form-control" name="description" id="edit-description" maxlength="60" required></textarea>
											</div>
											<p>Maximum 60 Characters</p>
										</div>
									</div>
								</div>
								<div class="modal-footer-btn">
									<a href="javascript:void(0);" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</a>
									<button type="submit" class="btn btn-submit">Submit</button>
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

	 // Handle edit button functionality (already implemented)
	document.addEventListener("DOMContentLoaded", function () {
    // Attach click event to edit buttons
    document.querySelectorAll(".edit-btn").forEach(function (button) {
        button.addEventListener("click", function () {
            const categoryId = this.getAttribute("data-id");
            
            // Log the category ID to verify if it's correct
            console.log("Category ID:", categoryId);

            // Fetch data using AJAX
            fetch(`get_category.php?id=${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error("Error:", data.error);
                    } else {
                        // Populate the modal with the data
                        document.getElementById("edit-id").value = data.id;
                        document.getElementById("edit-category-name").value = data.category_name_;
                        document.getElementById("edit-description").value = data.description;
                        
                        // Log the fetched data to verify correct values
                        console.log("Fetched Data:", data);
                    }
                })
                .catch(error => console.error("Error fetching category data:", error));
        });
    });

    // Handle form submission for updating
    document.getElementById("edit-form").addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        // Update data using AJAX
        fetch("update_expense_category.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Success message using SweetAlert
                Swal.fire({
                    title: 'Success!',
                    text: 'Category updated successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Reload the page to see changes
                });
            } else {
                // Error message using SweetAlert
                Swal.fire({
                    title: 'Error!',
                    text: 'Error updating category: ' + data.error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            // Handle AJAX errors using SweetAlert
            Swal.fire({
                title: 'Error!',
                text: 'There was an issue updating the category. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            console.error("Error updating category:", error);
        });
		});
	});


 // Handle delete button functionality
 document.querySelectorAll(".delete-btn").forEach(function (button) {
        button.addEventListener("click", function () {
            const categoryId = this.getAttribute("data-id");

            // Confirm deletion using SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to delete this category?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send DELETE request via AJAX
                    fetch("delete_expense_category.php?id=" + categoryId, {
                        method: "GET"  // Use GET for deletion in this case
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Category has been deleted.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
								console.log('data deleted!'); // log information
								location.reload(); // Reload the page after successful deletion

                                // Optionally, remove the row from the table without reloading
                                // document.querySelector(`[data-id='${categoryId}']`).closest("tr").remove();
                            });
                        } else {
                            // Show error message
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error deleting the category.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an issue deleting the category. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        console.error("Error deleting category:", error);
                    });
                }
            });
        });
    });
</script>
</body>
</html>