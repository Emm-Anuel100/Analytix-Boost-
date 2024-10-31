<?php
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();

$alertMessage = ''; // Initialize alert message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Collect form data
$store = $_POST['store'];
$warehouse = $_POST['warehouse'];
$sku = $_POST['sku'];
$productName = $_POST['product_name'];
$slug = $_POST['slug'];
$category = $_POST['category'];
$sellingType = $_POST['selling_type'];
$brand = $_POST['brand'];
$unit = $_POST['unit'];
$barcodeSymbology = $_POST['barcode_symbology'];
$productBarCode = $_POST['product_barcode'];
$description = $_POST['description'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$taxValue = $_POST['tax_value'];
$discountType = $_POST['discount_type'];
$discountValue = $_POST['discount_value'];
$manufacturedDate = $_POST['manufactured_date'];
$expiryOn = $_POST['expiry_on'];
$user_email = $_SESSION['email'];

// Handle image upload
$imageName = '';
if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
$imageTmpName = $_FILES['product_image']['tmp_name'];
$imageSize = $_FILES['product_image']['size'];
$imageName = basename($_FILES['product_image']['name']);
$uploadDir = 'uploads/';
$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

// Check if the uploads directory exists
if (!is_dir($uploadDir)) {
mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
}

// Validate image size (50KB limit)
if ($imageSize > 51200) {
$alertMessage = 'Image size should not exceed 50KB.';
} else {
// Generate a unique name for the image if it already exists
$newImageName = uniqid('img_', true) . '.' . $imageExtension;
$uploadPath = $uploadDir . $newImageName;

// Move the uploaded file to the destination directory
if (move_uploaded_file($imageTmpName, $uploadPath)) {
$imageName = $newImageName; // Use the new image name for database storage
} else {
$alertMessage = 'Image upload failed.';
}
}
}

// Proceed with insertion only if there's no alert message
if (empty($alertMessage)) {
// Insert product into the database
$stmt = $conn->prepare("INSERT INTO products (email, store, warehouse, sku, product_name, slug, category, selling_type, brand, unit, barcode_symbology, product_barcode, description, quantity, price, tax_value, discount_type, discount_value, manufactured_date, expiry_on, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param('sssssssssssssiiisssss', $user_email, $store, $warehouse, $sku, $productName, $slug, $category, $sellingType, $brand, $unit, $barcodeSymbology, $productBarCode, $description, $quantity, $price, $taxValue, $discountType, $discountValue, $manufacturedDate, $expiryOn, $imageName);


if ($stmt->execute()) {
$alertMessage = 'Product added successfully.';
} else {
$alertMessage = 'Error: ' . $stmt->error;
}

$stmt->close();
}

// Display the alert using SweetAlert
if (!empty($alertMessage)) {
echo "<script>
document.addEventListener('DOMContentLoaded', function() {
Swal.fire({
	title: 'Alert',
	text: '$alertMessage',
	icon: 'info'
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
		<h4>New Product</h4>
		<h6>Create new product</h6>
	</div>
</div>
<ul class="table-top-head">
	<li>
		<div class="page-btn">
			<a href="product-list.php" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>Back to Product</a>
		</div>
	</li>
	<li>
		<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
	</li>
</ul>
</div>
<!-- /add -->
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" enctype="multipart/form-data">
<div class="card">
	<div class="card-body add-product pb-0">
		<div class="accordion-card-one accordion" id="accordionExample">
			<div class="accordion-item">
				<div class="accordion-header" id="headingOne">
					<div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne"  aria-controls="collapseOne">
						<div class="addproduct-icon">
							<h5><i data-feather="info" class="add-info"></i><span>Product Information</span></h5>
							<a href="javascript:void(0);"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
						</div>
					</div>
				</div>
				<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
				<div class="accordion-body">
					<div class="row">
						<div class="col-lg-4 col-sm-6 col-12">
							<div class="mb-3 add-product">
								<div class="add-newplus">
										<label class="form-label">Store</label>
										<a href="store-list.php" data-bs-target="#add-units-brand"><i data-feather="plus-circle" class="plus-down-add"></i><span>Add New</span></a>
									</div>
									<?php
										// user email address
										$user_email = $_SESSION["email"];
										// Prepare the SQL statement
										$sql = "SELECT user_email, store_name FROM store WHERE user_email = ? AND status = 'active'";
										$stmt = $conn->prepare($sql);

										// Bind parameters (s = string type)
										$stmt->bind_param("s", $user_email);

										// Execute the statement
										$stmt->execute();

										// Get the result
										$result = $stmt->get_result();

										if ($result->num_rows > 0) {
											echo '<select class="select" name="store">';
											// Loop through the results and create an option for each store
											while ($row = $result->fetch_assoc()) {
												echo '<option value="' . htmlspecialchars($row['store_name']) . '">' . htmlspecialchars($row['store_name']) . '</option>';
											}
											echo '</select>';
										} else {
											echo "<option value=''>No active store available</option>";
										}

										// Close the statement
										$stmt->close();
									?>
								<!-- <select class="select" name="store">
									<option value="Thomas">Thomas</option>
									<option value="Ramussen">Rasmussen</option>
									<option value="Fred john">Fred john</option>
								</select> -->
							</div>
						</div>
						<div class="col-lg-4 col-sm-6 col-12">
							<div class="mb-3 add-product">
							<div class="add-newplus">
								<label class="form-label">Warehouse</label>
								<a href="warehouse.php" data-bs-target="#add-units-brand"><i data-feather="plus-circle" class="plus-down-add"></i><span>Add New</span></a>
							</div>
							<?php
							// user email address
							$user_email = $_SESSION["email"];

							// Prepare the SQL query
							$sql = "SELECT name FROM warehouse WHERE user_email = ?";

							// Initialize the prepared statement
							$stmt = $conn->prepare($sql);

							// Bind the parameters
							$stmt->bind_param("s", $user_email);

							// Execute the prepared statement
							$stmt->execute();

							// Fetch the results
							$result = $stmt->get_result();
							?>

							<select class="select" name="warehouse">
							<?php
							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									echo "<option value='{$row['name']}'>{$row['name']}</option>";
								}
							} else {
								echo "<option value=''>No warehouses available</option>";
							}
							?>
							</select>

							<?php
							// Close the statement
							$stmt->close();
							?>

							</div>
						</div>
						<div class="col-lg-4 col-sm-6 col-12">
							<div class="input-blocks add-product list">
								<label>SKU</label>
								<input type="text" class="form-control list" placeholder="Enter SKU" name="sku" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-sm-6 col-12">
							<div class="mb-3 add-product">
								<label class="form-label">Product Name</label>
								<input type="text" class="form-control" placeholder="Product Name" name="product_name" required>
							</div>
						</div>
						<div class="col-lg-4 col-sm-6 col-12">
							<div class="mb-3 add-product">
								<label class="form-label">Slug</label>
								<input type="text" class="form-control" placeholder="Enter Slug" required name="slug">
							</div>
						</div>

						<div class="col-lg-4 col-sm-6 col-12">
						<div class="mb-3 add-product">
							<div class="add-newplus">
								<label class="form-label">Category</label>
								<a href="category-list.php"><i data-feather="plus-circle" class="plus-down-add"></i>
								<span>Add New</span></a>
							</div>

							<select class="select" name="category">
							<?php

							// Get user's email
							$user_email = $_SESSION['email'];

							// Prepare the SQL query using a prepared statement
							$stmt = $conn->prepare("SELECT name, status FROM categories WHERE user_email = ? AND status = 'active'");
							
							// Bind the email parameter to the prepared statement
							$stmt->bind_param("s", $user_email);
							
							// Execute the statement
							$stmt->execute();
							
							// Get the result
							$result = $stmt->get_result();

							// Check if categories exist
							if ($result->num_rows > 0) {
								// Loop through the results and output each category as an option
								while ($row = $result->fetch_assoc()) {
										$category_name = htmlspecialchars($row['name']); // Sanitize the output
										echo '<option value="' . $category_name . '">' . $category_name . '</option>';
								}
							} else {
								// If no categories are found, show a placeholder option
								echo '<option value="">No active categories available</option>';
							}

							// Close the prepared statement
							$stmt->close();
							?>
						</select>
						</div>
					</div>
					</div>
					<div class="addservice-info">
						<div class="row">
							<!-- <div class="col-lg-4 col-sm-6 col-12">
								<div class="mb-3 add-product">
									<div class="add-newplus">
										<label class="form-label">Sub Category</label>
										<a href="sub-categories.php"><i data-feather="plus-circle" class="plus-down-add"></i><span>Add
										New</span></a>
									</div>
									<select class="select" name="sub_category">
										<option value="Lenevo">Lenovo</option>
										<option value="Electronics">Electronics</option>
									</select>
								</div>
							</div> -->
							<div class="col-lg-4 col-sm-6 col-12">
							<div class="mb-3 add-product">
								<label class="form-label">Selling Type</label>
								<select class="select" name="selling_type">
									<option value="Transactional selling">Transactional selling</option>
									<option value="Solution selling">Solution selling</option>
									<option value="Consultative selling">Consultative selling</option>
									<option value="Relationship selling">Relationship selling</option>
									<option value="Value selling">Value selling</option>
									<option value="Insight selling">Insight selling</option>
									<option value="Challenger selling">Challenger selling</option>
									<option value="Social selling">Social selling</option>
									<option value="Cross-Selling">Cross-Selling</option>
									<option value="Up-Selling">Up-Selling</option>
									<option value="Partnership selling">Partnership selling</option>
									<option value="Direct selling">Direct selling</option>
								</select>
						   </div>
							</div>

							<div class="col-lg-4 col-sm-6 col-12">
								<div class="mb-3 add-product">
									<div class="add-newplus">
										<label class="form-label">Brand</label>
										<a href="brand-list.php" data-bs-target="#add-units-brand"><i data-feather="plus-circle" class="plus-down-add"></i><span>Add New</span></a>
									</div>
									<select class="select" name="brand">
									<?php
									// Get user's email from the session
									$user_email = $_SESSION['email'];

									// Prepare a SQL statement to fetch only active brands for the logged-in user
									$stmt = $conn->prepare("SELECT name FROM brands WHERE user_email = ? AND status = 'active'");
									$stmt->bind_param("s", $user_email);
									$stmt->execute();
									$result = $stmt->get_result();

									// Check if there are any active brands
									if ($result->num_rows > 0) {
										// Loop through the results and create an option for each active brand
										while ($row = $result->fetch_assoc()) {
												$brand_name = htmlspecialchars($row['name']); // Sanitize brand name
												echo '<option value="' . $brand_name . '">' . $brand_name . '</option>';
										}
									} else {
										// If no active brands are found, show a placeholder option
										echo '<option value="">No active brands available</option>';
									}

									// Close the statement
									$stmt->close();
									?>
								</select>
								</div>
							</div>
							
							<div class="col-lg-4 col-sm-6 col-12">
								<div class="mb-3 add-product">
									<div class="add-newplus">
										<label class="form-label">Unit</label>
										<a href="units.php"><i data-feather="plus-circle" class="plus-down-add"></i><span>Add New</span></a>
									</div>
									<?php
									// Get user's email
									$user_email = $_SESSION['email'];

									// Prepare the SQL statement using a prepared statement
									$stmt = $conn->prepare("SELECT short_name FROM units WHERE status = ? AND user_email = ?");
									
									// Bind the parameters to the prepared statement: 'status' and 'user_email'
									$status = 'active';
									$stmt->bind_param("ss", $status, $user_email); // 'ss' indicates two strings

									// Execute the prepared statement
									$stmt->execute();

									// Get the result set
									$result = $stmt->get_result();

									// Generate the <select> element with options based on the result
									if ($result->num_rows > 0) {
										echo '<select class="select" name="unit">';
										// Fetch each row and create an <option> tag
										while ($row = $result->fetch_assoc()) {
											echo "<option value='{$row['short_name']}'>{$row['short_name']}</option>";
										}
										echo '</select>';
									} else {
										// If no results are found, show a placeholder option
										echo '<select class="select" name="unit">
													<option value="">No active units available</option>
												</select>';
									}

									// Close the statement
									$stmt->close();
								?>
								</div>
							</div>
						</div>
					</div>
		
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-12">
							<div class="mb-3 add-product">
								<label class="form-label">Barcode Symbology</label>
								<select class="select" name="barcode_symbology">
								<option value="UPC-A">UPC-A</option>
								<option value="EAN-13">EAN-13</option>
								<option value="Code 128">Code 128</option>
								<option value="Code 39">Code 39</option>
							</select>
							</div>
						</div>
						<div class="col-lg-6 col-sm-6 col-12">
							<div class="input-blocks add-product list">
								<label>Product BarCode</label>
								<input type="text" class="form-control list"  placeholder="Enter Item Code" required name="product_barcode">
								<button type="button" class="btn btn-primaryadd">
									| | |
								</button>
							</div>
						</div>
					</div>
					<!-- Editor -->
					<div class="col-lg-12">
						<div class="input-blocks summer-description-box transfer mb-3">
							<label>Description</label>
							<textarea class="form-control h-100" rows="5" maxlength="60" required name="description" placeholder="Enter product description"></textarea>
							<p class="mt-1">Maximum 60 Characters</p>
						</div>
					</div>
					<!-- /Editor -->
				</div>
				</div>
			</div>
		</div>
		<div class="accordion-card-one accordion" id="accordionExample2">
			<div class="accordion-item">
				<div class="accordion-header" id="headingTwo">
				<div class="accordion-button"  data-bs-toggle="collapse" data-bs-target="#collapseTwo"  aria-controls="collapseTwo">
					<div class="text-editor add-list">
						<div class="addproduct-icon list icon">
							<h5><i data-feather="life-buoy" class="add-info"></i><span>Pricing & Stocks</span></h5>
							<a href="javascript:void(0);"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
						</div>
					</div>
				</div>
				</div>
				<div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
					<div class="accordion-body">
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel"
								aria-labelledby="pills-home-tab">
								<div class="row">
									<div class="col-lg-4 col-sm-6 col-12">
										<div class="input-blocks add-product">
											<label>Quantity</label>
											<input type="number" min="1" class="form-control" name="quantity" required placeholder="Enter product quantity">
										</div>
									</div>
									<div class="col-lg-4 col-sm-6 col-12">
										<div class="input-blocks add-product">
											<label>Price</label>
											<input type="number" min="1" class="form-control" name="price" required placeholder="Enter product price">
										</div>
									</div>
									<div class="col-lg-4 col-sm-6 col-12">
										<div class="input-blocks add-product">
											<label>Tax Value</label>
											<input type="number" min="0" class="form-control" required name="tax_value" placeholder="Enter tax value">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-sm-6 col-12">
										<div class="input-blocks add-product">
											<label>Discount Type</label>
											<select class="select" name="discount_type">
												<option value="Percentage">Percentage</option>
												<option value="Cash">Cash</option>
											</select>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6 col-12">
										<div class="input-blocks add-product">
											<label>Discount Value</label>
											<input type="number" min="0" class="form-control" required placeholder="Enter discount value" name="discount_value">
										</div>
									</div>
								</div>
								<div class="accordion-card-one accordion" id="accordionExample3">
									<div class="accordion-item">
										<div class="accordion-header" id="headingThree">
											<div class="accordion-button"  data-bs-toggle="collapse" data-bs-target="#collapseThree"  aria-controls="collapseThree">
												<div class="addproduct-icon list">
													<h5><i data-feather="image" class="add-info"></i><span>Product Image</span></h5>
													<a href="javascript:void(0);"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
												</div>
											</div>
										</div>
										<div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
										<div class="accordion-body">
											<div class="text-editor add-list add">
												<div class="col-lg-12">
													<div class="add-choosen">
														<div class="input-blocks">
															<div class="image-upload">
																<input type="file" name="product_image" required>
																<div class="image-uploads">
																	<i data-feather="plus-circle" class="plus-down-add me-0"></i>
																	<h4>Upload Image</h4> 50KB Max
																</div>
															</div> 
														</div>
													</div>
												</div>
											</div>
											</div>
										</div>
									</div>
								</div>						
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="accordion-card-one accordion" id="accordionExample4">
			<div class="accordion-item">
				<div class="accordion-header" id="headingFour">
					<div class="accordion-button"  data-bs-toggle="collapse" data-bs-target="#collapseFour"  aria-controls="collapseFour">
					<div class="text-editor add-list">
						<div class="addproduct-icon list">
							<h5><i data-feather="list" class="add-info"></i><span>Custom Fields</span></h5>
							<a href="javascript:void(0);"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
						</div>
					</div>
					</div>
				</div>
				<div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample4">
					<div class="accordion-body">
						<div class="text-editor add-list add">
								<!-- <div class="custom-filed">
									<div class="input-block add-lists">
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>Warranties
										</label>
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>Manufacturer
										</label>
										<label class="checkboxs">
											<input type="checkbox">
											<span class="checkmarks"></span>Expiry
										</label>
									</div>
								</div> -->
							<div class="row">
								<div class="col-lg-4 col-sm-6 col-12">
									<div class="input-blocks">
										<label>Manufactured Date</label>

										<div class="input-groupicon calender-input">
											<i data-feather="calendar" class="info-img"></i>
											<input type="text" class="datetimepicker" placeholder="Choose Date" required name="manufactured_date">
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6 col-12">
									<div class="input-blocks">
										<label>Expiry On</label>

										<div class="input-groupicon calender-input">
											<i data-feather="calendar" class="info-img"></i>
											<input type="text" class="datetimepicker" placeholder="Choose Date" required name="expiry_on">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="btn-addproduct mb-4">
		<button type="reset" class="btn btn-cancel me-2">Reset</button>
		<button type="submit" class="btn btn-submit">Add Product</button>
	</div>
</div>
</form>
<!-- /add -->
</div>
</div>
</div>
<!-- end main Wrapper-->

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>