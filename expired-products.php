<?php 
include("./layouts/session.php");

include 'conn.php'; // Include database connection

// Establish the connection to the user's database
$conn = connectMainDB();


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
								<h4>Expired Products</h4>
								<h6>Manage your expired products</h6>
							</div>						
						</div>
						<ul class="table-top-head">
							<li>
								<a id="generatePdfBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf" data-bs-toggle="modal" data-bs-target="#add-units"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a id="csvExport" data-bs-toggle="tooltip" data-bs-placement="top" title="Csv"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>

								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" class="refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Clean up" id="cleanupExpired"><img src="./assets/img/brush.png" alt="." width="30px" height="20px"></a>
							</li>
						</ul>
					</div>

					<!-- /product list -->
					<div class="card table-list-card">
						<div class="card-body">

						<div class="table-top">
								<div class="search-set">
									<div class="search-input">
										<a href="javascript:void(0);" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
									</div>
								</div>
							 
								<div class="form-sort">
								<form method="POST" action="">
									<i data-feather="sliders" class="info-img"></i>
									 <?php
										// Check if a sort order is set, otherwise default to 'newest'
										$sortOrder = isset($_POST['sort']) ? $_POST['sort'] : 'newest';

										// Determine the ORDER BY clause based on the sort order
										$orderClause = $sortOrder === 'oldest' ? 'ASC' : 'DESC';
									 ?>
									<select name="sort" class="select" onchange="this.form.submit()">
										<option value="newest" <?php echo ($sortOrder == 'newest') ? 'selected' : ''; ?>>Newest</option>
										<option value="oldest" <?php echo ($sortOrder == 'oldest') ? 'selected' : ''; ?>>Oldest</option>
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
											<th>Product</th>
											<th>Store</th>
											<th>SKU</th>
											<th>Manufactured Date</th>
											<th>Expiry Date</th>
										</tr>
									</thead>
									<?php
									// Sanitize email (for safety)
								    $email = trim($conn->real_escape_string($_SESSION['email']));

									// Check for expired products and insert them into the expired_products table
									$query = "SELECT * FROM products WHERE DATEDIFF(STR_TO_DATE(expiry_on, '%d-%m-%Y'), CURDATE())
									 BETWEEN 0 AND 30 AND email = '$email'";

									$result = $conn->query($query);

									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
											$id = $row['id'];  // Unique identifier
											$product_name = $row['product_name'];
											$store = $row['store'];
											$sku = $row['sku'];
											$manufactured_date = $row['manufactured_date'];
											$expiry_on = $row['expiry_on'];
											$image = $row['image'];

											// Check if the product is already in the expired_products table
											$check_query = "SELECT * FROM expired_products WHERE product_id = ?";
											$check_stmt = $conn->prepare($check_query);
											$check_stmt->bind_param('i', $id);
											$check_stmt->execute();
											$check_result = $check_stmt->get_result();

											if ($check_result->num_rows == 0) {
												// Insert the product into expired_products table
												$insert_query = "INSERT INTO expired_products (email, product_name, product_id, store, sku, manufactured_date, expiry_date, image) 
																VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
												$insert_stmt = $conn->prepare($insert_query);
												$insert_stmt->bind_param('ssisssss', $email, $product_name, $id, $store, $sku, $manufactured_date, $expiry_on, $image);
												$insert_stmt->execute();
											}
										}
									}

									// Fetch expired products from the expired_products table for display
									$fetch_expired_query = "SELECT * FROM expired_products WHERE email = '$email' ORDER BY id $orderClause";
									$fetch_expired_result = $conn->query($fetch_expired_query);

									if ($fetch_expired_result->num_rows > 0) {
										while ($row = $fetch_expired_result->fetch_assoc()) {
											$id = $row['product_id'];
											$product_name = $row['product_name'];
											$store = $row['store'];
											$sku = $row['sku'];
											$manufactured_date = $row['manufactured_date'];
											$expiry_on = $row['expiry_date'];
											$image = $row['image'];
									
											// Display the expired product in the table
											echo "
											<tr>
												<td>
													<label class='checkboxs'>
														<input type='checkbox'>
														<span class='checkmarks'></span>
													</label>
												</td>
												<td>
													<div class='productimgname'>
														<a href='javascript:void(0);' class='product-img stock-img'>
															<img src='uploads/$image' alt='product image'>
														</a>
														<a href='javascript:void(0);'>$product_name</a>
													</div>
												</td>
												<td>$store</td>
												<td>$sku</td>
												<td>$manufactured_date</td>
												<td>$expiry_on</td>
											</tr>";
										}
									} else {
										// Display demo data when no expired products are found
										echo "
										<tr>
											<td>
												<label class='checkboxs'>
													<input type='checkbox'>
													<span class='checkmarks'></span>
												</label>
											</td>
											<td>
												<div class='productimgname'>
													<a href='javascript:void(0);' class='product-img stock-img'>
														<img src='uploads/default_product.jpg' alt='product image'>
													</a>
													<a href='javascript:void(0);'>Demo Expired Product</a> <!-- Demo product name -->
												</div>
											</td>
											<td>Demo Store</td>
											<td>Demo SKU</td>
											<td>" . date('Y-m-d', strtotime('-30 days')) . "</td> <!-- Demo manufactured date -->
											<td>" . date('Y-m-d') . "</td> <!-- Demo expiry date -->
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
	<!-- end main Wrapper-->
		

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/refresh.js"></script>
<script>
	$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable

	// FPDF export to pdf 
    const generatePdfBtn = document.getElementById('generatePdfBtn');

    generatePdfBtn.addEventListener('click', function() {
		// Open a new tab for the PDF
		window.open('expiry_product_pdf.php', '_blank');

        // Make an AJAX request to the PHP script to run the query and generate the PDF
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'expiry_product_pdf.php', true); // PHP file to handle query and PDF generation
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

		xhr.onload = function() {
     if (xhr.status === 200) {
        // Assuming the server returns the URL of the generated PDF or CSV
        const url = xhr.responseText; // Change this if the server response is different
        window.open(url, '_blank'); // Open the URL in a new tab
		} else {
			alert('Failed to generate file. Please try again.');
		}
	  };
    });


	// Export to Csv
    const csvExportButton = document.getElementById('csvExport');

    // Add a click event listener to open the CSV export in a new tab
    csvExportButton.addEventListener('click', function () {
        window.open('expiry_product_csv.php', '_blank'); // Replace with the actual path to your PHP script
    });


	// Clean up expired products passed 7 days
		document.addEventListener('DOMContentLoaded', function() {
			$('#cleanupExpired').on('click', function() {
				$.ajax({
					url: 'ajax_cleanup_expired_products.php', 
					type: 'POST', 
					dataType: 'json', // Expect JSON response
					success: function(response) {
						if (response.status) {
							swal.fire({
								toast: true,
								position: 'top-end', // Position at the top right
								title: '',
								text: response.message,
								icon: 'success',
								confirmButtonText: false,
								timer: 3000 // Auto-close after 3 seconds
							});
						  } else {
							swal.fire({
								toast: true,
								position: 'top-end', // Position at the top right
								title: '',
								text: response.message,
								icon: 'info',
								showConfirmButton: false,
								timer: 3000 // Auto-close after 3 seconds
							});
						}
					},
					error: function(xhr, status, error) {
						swal.fire({
							toast: true,
							position: 'top-end', // Position at the top right
							title: '',
							text: 'An error occurred: ' + error,
							icon: 'error',
							showConfirmButton: false,
							timer: 3000 // Auto-close after 3 seconds
						});
					}
				});
			});
		});
	</script>
</body>
</html>