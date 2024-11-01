<?php
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the database
$conn = connectMainDB();

// Check if form is submitted via POST and brand name is set
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['brand_name'])) {
// Handle image upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
	$imageTmpName = $_FILES['image']['tmp_name'];
	$imageSize = $_FILES['image']['size'];
	$imageName = basename($_FILES['image']['name']);
	$uploadDir = 'uploads/';
	$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

	// Validate image size (50KB limit)
	if ($imageSize > 51200) {
		echo "<script>
					document.addEventListener('DOMContentLoaded', function() {
						Swal.fire({
								icon: 'error',
								title: 'Upload Failed!',
								text: 'Image size should not exceed 50KB.',
								confirmButtonText: 'Ok'
						});
					});
				</script>";
	} else {
		// Check if the uploads directory exists, if not, create it
		if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
		}

		// Generate a unique name for the image
		$newImageName = uniqid('img_', true) . '.' . $imageExtension;
		$uploadPath = $uploadDir . $newImageName;

		// Move the uploaded file to the destination directory
		if (move_uploaded_file($imageTmpName, $uploadPath)) {
				$imageName = $newImageName; // Use the new image name for database storage

				// Collect other brand data from the form
				$brand_name = htmlspecialchars(trim($_POST['brand_name']));
				
				$status = isset($_POST['status']) ? 'Active' : 'Inactive';
				$user_email = $_SESSION['email']; // user's email

				// Prepare SQL query to insert the brand data including the image name
				$stmt = $conn->prepare("INSERT INTO brands (user_email, name, image, status) VALUES (?, ?, ?, ?)");
				$stmt->bind_param("ssss", $user_email, $brand_name, $imageName, $status);

				// Execute the query and check if the insertion was successful
				if ($stmt->execute()) {
					// Close the statement
					$stmt->close();
					
					// Redirect to the same page with a success message
					header("Location: " . $_SERVER['PHP_SELF'] . "?message=success");
					exit();
				} else {
					echo "<script>
								document.addEventListener('DOMContentLoaded', function() {
									Swal.fire({
											icon: 'error',
											title: 'Error!',
											text: 'Error: " . $stmt->error . "',
											confirmButtonText: 'Ok'
									});
								});
							</script>";
				}

				// Close the statement
				$stmt->close();
			} else {
				echo "<script>
					document.addEventListener('DOMContentLoaded', function() {
						Swal.fire({
							icon: 'error',
							title: 'Upload Failed!',
							text: 'Image upload failed.',
							confirmButtonText: 'Ok'
						});
					});
				</script>";
			}
		}
	  }
	}

	// Check for message in URL and display SweetAlert if present
	if (isset($_GET['message']) && $_GET['message'] == 'success') {
	echo "<script>
				document.addEventListener('DOMContentLoaded', function() {
					Swal.fire({
						icon: 'success',
						title: 'Success!',
						text: 'Brand added successfully!',
						confirmButtonText: 'Ok'
					});
				});
			</script>";
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
							<h4>Brand</h4>
							<h6>Manage your brands</h6>
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
						<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-brand"><i data-feather="plus-circle" class="me-2"></i>Add New Brand</a>
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
				<?php
				// Get user's email
				$user_email = $_SESSION['email'];

				// Prepare the SQL statement to retrieve brands for the logged-in user
				$stmt = $conn->prepare("SELECT name, image, timestamp, status FROM brands WHERE user_email = ?");
				$stmt->bind_param("s", $user_email);
				$stmt->execute();
				$result = $stmt->get_result();

			// Start the table
			echo '<table class="table datanew">
					<thead>
						<tr>
							<th class="no-sort">
								<label class="checkboxs">
										<input type="checkbox" id="select-all">
										<span class="checkmarks"></span>
								</label>
							</th>
							<th>Brand</th>
							<th>Logo</th>
							<th>Created On</th>
							<th>Status</th>
							<th class="no-sort">Action</th>
						</tr>
				</thead>
				<tbody>';

		// Check if there are any results
		if ($result->num_rows > 0) {
		// Loop through the results and output each brand as a row
		while ($row = $result->fetch_assoc()) {
        $brand_name = htmlspecialchars($row['name']); // Sanitize the output
        $logo = htmlspecialchars($row['image']); // Logo filename
        $created_on = htmlspecialchars($row['timestamp']); 
        $status = htmlspecialchars($row['status']); // Sanitize status

		  // Assign badge class based on status
        $badgeClass = ($status == 'Active') ? 'badge-linesuccess' : 'badge-linedanger';

        echo '<tr>
                <td>
                    <label class="checkboxs">
                        <input type="checkbox">
                        <span class="checkmarks"></span>
                    </label>
                </td>
                <td>' . $brand_name . '</td>
                <!--- <td><span class="d-flex"><img src="uploads/' . $logo . '" alt="brand image" height="20px" width="50px"></span></td> --->
				// <td><span class="d-flex"><img src="uploads/' . $logo . '" alt="brand image"></span></td>
                <td>' . date("d M Y", strtotime($created_on)) . '</td>
                <td><span class="badge ' . $badgeClass . '">' . ucfirst($status) . '</span></td>
                <td class="action-table-data">
                    <div class="edit-delete-action">
                        <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-brand">
                            <i data-feather="edit" class="feather-edit"></i>
                        </a>
                        <a class="confirm-text p-2" href="#">
                            <i data-feather="trash-2" class="feather-trash-2"></i>
                        </a>
                    </div>
                </td>
            </tr>';
				}
			} else {
				// If no brands are found, show a placeholder row
				//  echo '<tr>
				//          <td colspan="6">No brands available.</td>
				//        </tr>';
				}

			// Close the table
			echo '    </tbody>
					</table>';

			// Close the statement
			$stmt->close();
			?>
			</div>
		</div>
	</div>
	<!-- /product list -->
</div>
</div>
</div>
<!-- end main Wrapper-->

<!-- Add Brand -->
<div class="modal fade" id="add-brand">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Create Brand</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body new-employee-field">
								<form action="brand-list.php" method="post" enctype="multipart/form-data">
									<div class="mb-3">
										<label class="form-label">Brand</label>
										<input type="text" class="form-control" required name="brand_name">
									</div>
									<label class="form-label">Logo</label>
									<div class="profile-pic-upload mb-3">
										<div class="profile-pic brand-pic">
											<span><i data-feather="plus-circle" class="plus-down-add"></i> 50KB Max</span>
										</div>
										<div class="image-upload mb-0">
											<input type="file" required name="image">
											<div class="image-uploads">
												<h4>Upload Image</h4>
											</div>
										</div>
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
										<button type="submit" class="btn btn-submit">Create Brand</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Brand -->

		<!-- Edit Brand -->
		<div class="modal fade" id="edit-brand">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Brand</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body new-employee-field">
								<form action="brand-list.php">
									<div class="mb-3">
										<label class="form-label">Brand</label>
										<input type="text" class="form-control" required name="name_">
									</div>
									<label class="form-label">Logo</label>
									<div class="profile-pic-upload mb-3">
										<div class="profile-pic brand-pic">
											<span><img src="assets/img/brand/brand-icon-02.png" alt="brand logo"></span>
											<!-- <a href="javascript:void(0);" class="remove-photo"><i data-feather="x" class="x-square-add"></i></a> -->
										</div>
										<div class="image-upload mb-0">
											<input type="file" required="" name="image_">
											<div class="image-uploads">
												<h4>Change Image</h4>
											</div>
										</div>
									</div>
									<div class="mb-0">
										<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
											<span class="status-label">Status</span>
											<input type="checkbox" id="user4" class="check" checked="">
											<label for="user4" class="checktoggle"></label>
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
		<!-- Edit Brand -->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/refresh.js"></script>
<script>
$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable
</script>
</body>
</html>