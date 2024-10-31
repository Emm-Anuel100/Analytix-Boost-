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
		 
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			
		<?php include 'layouts/menu.php'; ?>

			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Product Details</h4>
							<h6>Full details of a product</h6>
						</div>
					</div>
			<!-- Product Detail  -->
			<?php
	      // Get the product ID from the URL
			$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

			if ($product_id > 0) {
				 $query = "SELECT product_name, sku, image, category, store, warehouse, selling_type, price, unit, quantity, expiry_on, description, tax_value, discount_type, discount_value, manufactured_date, brand, barcode_symbology, product_barcode 
							  FROM products 
							  WHERE id = ?";
				 $stmt = $conn->prepare($query);
				 if ($stmt) {
					  $stmt->bind_param("i", $product_id);
					  $stmt->execute();
					  $result = $stmt->get_result();
	  
					  if ($result && $result->num_rows > 0) {
							$product = $result->fetch_assoc();
					  } else {
							echo "<h2>Product not found!</h2>";
							exit;
					  }
					  $stmt->close();
				 } else {
					  echo "Error in SQL: " . $conn->error;
					  exit;
				 }
			} else {
				 echo "<h2>Invalid Product ID.</h2>";
				 exit;
			}
	  ?>
     <div class="row">
        <div class="col-lg-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="productdetails">
                        <ul class="product-bar">
                            <li>
                                <h4>Product</h4>
                                <h6><?= htmlspecialchars($product['product_name']); ?></h6>
                            </li>
                            <li>
                                <h4>Category</h4>
                                <h6><?= htmlspecialchars($product['category']); ?></h6>
                            </li>
                            <li>
                                <h4>Store</h4>
                                <h6><?= htmlspecialchars($product['store']); ?></h6>
                            </li>
                            <li>
                                <h4>SKU</h4>
                                <h6><?= htmlspecialchars($product['sku']); ?></h6>
                            </li>
                            <li>
                                <h4>Selling Type</h4>
                                <h6><?= htmlspecialchars($product['selling_type']); ?></h6>
                            </li>
                            <li>
                                <h4>Warehouse</h4>
                                <h6><?= htmlspecialchars($product['warehouse']); ?></h6>
                            </li>
                            <li>
                                <h4>Brand</h4>
                                <h6><?= htmlspecialchars($product['brand']); ?></h6>
                            </li>
                            <li>
                                <h4>Unit</h4>
                                <h6><?= htmlspecialchars($product['unit']); ?></h6>
                            </li>
                            <li>
                                <h4>Barcode Symbology</h4>
                                <h6><?= htmlspecialchars($product['barcode_symbology']); ?></h6>
                            </li>
                            <li>
                                <h4>Product Barcode</h4>
                                <h6><?= htmlspecialchars($product['product_barcode']); ?></h6>
                            </li>
                            <li>
                                <h4>Quantity</h4>
                                <h6><?= htmlspecialchars($product['quantity']); ?></h6>
                            </li>
                            <li>
                                <h4>Price</h4>
                                <h6><?= htmlspecialchars($product['price']); ?></h6>
                            </li>
                            <li>
                                <h4>Tax Value</h4>
                                <h6><?= htmlspecialchars($product['tax_value']); ?></h6>
                            </li>
                            <li>
                                <h4>Discount Type</h4>
                                <h6><?= htmlspecialchars($product['discount_type']); ?></h6>
                            </li>
                            <li>
                                <h4>Discount Value</h4>
                                <h6><?= htmlspecialchars($product['discount_value']); ?></h6>
                            </li>
                            <li>
                                <h4>Manufactured Date</h4>
                                <h6><?= htmlspecialchars(date('d M Y', strtotime($product['manufactured_date']))); ?></h6>
                            </li>
                            <li>
                                <h4>Expiry Date</h4>
                                <h6><?= htmlspecialchars (date('d M Y', strtotime($product['expiry_on']))); ?></h6>
                            </li>
                            <li>
                                <h4>Description</h4>
                                <h6><?= htmlspecialchars($product['description']); ?></h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

		  <div class="col-lg-4 col-sm-12">
					<div class="card">
						<div class="card-body">
							<div class="slider-product-details">
								<div class="owl-carousel owl-theme product-slide">
									<div class="slider-product">
									<img src="uploads/<?= htmlspecialchars($product['image']); ?>" alt="Product Image">
										<!-- <h4>product image</h4> -->
									</div>
									<div class="slider-product">
									<img src="uploads/<?= htmlspecialchars($product['image']); ?>" alt="Product Image">
										<!-- <h4>product image</h4> -->
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

		<!-- /Main Wrapper -->
		<?php include 'layouts/customizer.php'; ?>		 
		<?php include 'layouts/vendor-scripts.php'; ?>
	    <!-- Owl JS -->
		<script src = 'assets/plugins/owlcarousel/owl.carousel.min.js'></script>
		<script>
		$.fn.dataTable.ext.errMode = 'none'; // Disable all error alerts globally in DataTable
	   </script>
    </body>
</html>