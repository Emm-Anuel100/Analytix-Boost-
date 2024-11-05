<?php 
include("./layouts/session.php"); // Include session

include 'conn.php'; // Include database connection

$conn = connectMainDB(); // Establish the connection to the database

$userEmail = htmlspecialchars($_SESSION['email']); // User's email

// Capture the selected start and end dates (if provided by the form)
$startDate = $_POST['startDate'] ?? null;
$endDate = $_POST['endDate'] ?? null;

// Prepare the base query to fetch sales data for the user with optional date range filtering
$salesQuery = "SELECT products FROM sales WHERE user_email = ?";
$params = [$userEmail];
$paramTypes = "s";

// Add date range condition to the query if dates are provided
if ($startDate && $endDate) {
    $salesQuery .= " AND timestamp BETWEEN ? AND ?";
    $params[] = $startDate;
    $params[] = $endDate;
    $paramTypes .= "ss";
}

$stmt = $conn->prepare($salesQuery);
$stmt->bind_param($paramTypes, ...$params);
$stmt->execute();
$salesResult = $stmt->get_result();

$productCounts = [];

// Parse each row's 'products' field
while ($row = $salesResult->fetch_assoc()) {
    $products = explode(";", $row['products']);
    foreach ($products as $productEntry) {
        if (preg_match('/^(\w+)\s+\(.*quantity:\s+(\d+)/', trim($productEntry), $matches)) {
            $productName = $matches[1];
            $quantity = (int)$matches[2];

            $productCounts[$productName] = ($productCounts[$productName] ?? 0) + $quantity;
        }
    }
}

$stmt->close();

// Sort and fetch product details as before
arsort($productCounts);

$productNames = array_keys($productCounts);
$productDetails = [];

// Fetch product prices and images for top-selling products
if (!empty($productNames)) {
    $placeholders = implode(',', array_fill(0, count($productNames), '?'));
    $priceQuery = "SELECT product_name, price, image FROM products WHERE product_name IN ($placeholders)";
    
    $stmt = $conn->prepare($priceQuery);
    $stmt->bind_param(str_repeat('s', count($productNames)), ...$productNames);
    $stmt->execute();
    $priceResult = $stmt->get_result();

    while ($row = $priceResult->fetch_assoc()) {
        $productDetails[$row['product_name']] = [
            'price' => $row['price'],
            'image' => $row['image']
        ];
    }

    $stmt->close();
}

// Display the top 4 selling products 
$topProducts = array_slice($productCounts, 0, 4, true);
?>


<!DOCTYPE html>
<html lang="en">

	<head>
	<?php include 'layouts/title-meta.php'; ?>
   <?php include 'layouts/head-css.php'; ?>
	<!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

	<!-- Include Flatpickr CSS -->
	<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

	<!-- Include Flatpickr JS -->
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
					<div class="welcome d-lg-flex align-items-center justify-content-between">
						<div class="d-flex align-items-center welcome-text">
							<h3 class="d-flex align-items-center"><img src="assets/img/icons/hi.svg" alt="img">&nbsp;Hi <?= htmlspecialchars($username); ?>,</h3>&nbsp;<h6>here's what's happening with your store today.</h6>
						</div>
						<div class="d-flex align-items-center">
							<div class="position-relative daterange-wraper me-2">
								<div class="input-groupicon calender-input">

								<!-- Date Range input field -->
								<form id="dateRangeForm" action="sales-dashboard.php" method="POST">
									<input type="text" id="dateRange-Picker" class="form-control" placeholder="Select Date Range">
									<input type="hidden" name="startDate" id="startDate">
									<input type="hidden" name="endDate" id="endDate">
								</form>
								<!-- /Date Range input field -->

								</div>
								<i data-feather="calendar" class="feather-14"></i>
							</div>
							<button type="button" data-toggle="tooltip" class="btn btn-white-outline d-none d-md-inline-block refresh" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-16"></i></button>
							<a href="javascript:void(0)" class="d-none d-lg-inline-block refresh" data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-16"></i></a>
						</div>
					</div>

					
					<div class="row sales-cards">
						<div class="col-xl-6 col-sm-12 col-12">
							<div class="card d-flex align-items-center justify-content-between default-cover mb-4">
								<div>
									<h6>Net Income</h6>
									<?php
									// Get the start and end date
									$startDate = $_POST['startDate'] ?? null;
									$endDate = $_POST['endDate'] ?? null;

									// Prepare default queries without date filters
									$salesQuery = "SELECT SUM(grand_total) AS totalSales FROM sales WHERE user_email = ?";
									$purchaseQuery = "SELECT SUM(grand_total) AS totalPurchases FROM purchases WHERE user_email = ?";

									// If date range is provided, add conditions to filter by timestamp
									if ($startDate && $endDate) {
										$salesQuery .= " AND timestamp BETWEEN ? AND ?";
										$purchaseQuery .= " AND timestamp BETWEEN ? AND ?";
									}

									// Prepare and execute the sales query
									$salesStmt = $conn->prepare($salesQuery);
									if ($startDate && $endDate) {
										$salesStmt->bind_param("sss", $userEmail, $startDate, $endDate);
									} else {
										$salesStmt->bind_param("s", $userEmail);
									}
									$salesStmt->execute();
									$salesResult = $salesStmt->get_result();
									$totalSales = $salesResult->fetch_assoc()['totalSales'] ?? 0;
									$salesStmt->close();

									// Prepare and execute the purchases query
									$purchaseStmt = $conn->prepare($purchaseQuery);
									if ($startDate && $endDate) {
										$purchaseStmt->bind_param("sss", $userEmail, $startDate, $endDate);
									} else {
										$purchaseStmt->bind_param("s", $userEmail);
									}
									$purchaseStmt->execute();
									$purchaseResult = $purchaseStmt->get_result();
									$totalPurchases = $purchaseResult->fetch_assoc()['totalPurchases'] ?? 0;
									$purchaseStmt->close();

									// Calculate the net income
									$totalEarnings = $totalSales - $totalPurchases;
									?>

									<h3>
										<span style="font-size: 19px">₦</span><span class="counters" data-count="<?= $totalEarnings; ?>"> </span>
									</h3>

									<?php
									// Get the start and end date
									$startDate = $_POST['startDate'] ?? null;
									$endDate = $_POST['endDate'] ?? null;

									// Default values for current and previous month
									$currentMonth = date('Y-m'); 
									$previousMonth = date('Y-m', strtotime('-1 month'));

									// Define the queries with and without a date range
									if ($startDate && $endDate) {
										// When date range is selected, calculate totals for the selected period
										$dateRangeQuery = "SELECT SUM(grand_total) AS total FROM sales WHERE user_email = ? AND timestamp BETWEEN ? AND ?";
										
										// Current period total
										$stmt = $conn->prepare($dateRangeQuery);
										$stmt->bind_param("sss", $userEmail, $startDate, $endDate);
										$stmt->execute();
										$result = $stmt->get_result();
										$currentPeriodTotal = $result->fetch_assoc()['total'] ?? 0;
										$stmt->close();
										
										// Set $previousPeriodTotal to zero if no comparison is defined
										$previousPeriodTotal = 0;

									} else {
										// Default calculation: current and previous month
										$currentMonthQuery = "
											SELECT SUM(grand_total) AS current_total 
											FROM sales 
											WHERE user_email = ? AND DATE_FORMAT(timestamp, '%Y-%m') = ?
										";
										$stmt = $conn->prepare($currentMonthQuery);
										$stmt->bind_param("ss", $userEmail, $currentMonth);
										$stmt->execute();
										$result = $stmt->get_result();
										$currentPeriodTotal = $result->fetch_assoc()['current_total'] ?? 0;
										$stmt->close();

										// Previous month calculation
										$previousMonthQuery = "
											SELECT SUM(grand_total) AS previous_total 
											FROM sales 
											WHERE user_email = ? AND DATE_FORMAT(timestamp, '%Y-%m') = ?
										";
										$stmt = $conn->prepare($previousMonthQuery);
										$stmt->bind_param("ss", $userEmail, $previousMonth);
										$stmt->execute();
										$result = $stmt->get_result();
										$previousPeriodTotal = $result->fetch_assoc()['previous_total'] ?? 0;
										$stmt->close();
									}

									// Calculate revenue increase percentage
									$revenueIncrease = 0;
									if ($previousPeriodTotal > 0) {
										$revenueIncrease = (($currentPeriodTotal - $previousPeriodTotal) / $previousPeriodTotal) * 100;
									}
									?>

									<p class="sales-range"><span class="text-success"><i data-feather="chevron-up" class="feather-16"></i><?php echo number_format($revenueIncrease, 2); ?>%&nbsp;</span>Revenue increase</p>
									</div>
								<img src="assets/img/icons/weekly-earning.svg" alt="img">
							</div>
						</div>

						<!-- Get the total number of sales for user -->
						<?php
						// Capture the selected start and end dates (if provided by the form)
						$startDate = $_POST['startDate'] ?? null;
						$endDate = $_POST['endDate'] ?? null;

						// Define the query with or without a date range
						if ($startDate && $endDate) {
							// Count total sales within the specified date range
							$totalSalesQuery = "
								SELECT COUNT(*) AS total_sales 
								FROM sales 
								WHERE user_email = ? AND timestamp BETWEEN ? AND ?
							";
							$stmt = $conn->prepare($totalSalesQuery);
							$stmt->bind_param("sss", $userEmail, $startDate, $endDate);
						} else {
							// Default: count all sales for the user
							$totalSalesQuery = "
								SELECT COUNT(*) AS total_sales 
								FROM sales 
								WHERE user_email = ?
							";
							$stmt = $conn->prepare($totalSalesQuery);
							$stmt->bind_param("s", $userEmail);
						}

						// Execute the query and fetch the result
						$stmt->execute();
						$result = $stmt->get_result();
						$totalSales = $result->fetch_assoc()['total_sales'] ?? 0; // Default to 0 if no sales

						$stmt->close(); // Close the statement
						?>

						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card color-info bg-primary mb-4">
								<img src="assets/img/icons/total-sales.svg" alt="img">
								<h3 class="counters" data-count="<?= $totalSales; ?>"> </h3>
								<p>No. of Total Sales</p>
								<i data-feather="rotate-ccw" class="feather-16" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"></i>
							</div>
						</div>
						<!--/ Get the total number of sales for user -->


						<!-- Get the total number of purchases for user -->
						<?php
						// Capture the selected start and end dates (if provided by the form)
						$startDate = $_POST['startDate'] ?? null;
						$endDate = $_POST['endDate'] ?? null;

						// Define the query with or without a date range
						if ($startDate && $endDate) {
							// Count total purchases within the specified date range
							$totalPurchasesQuery = "
								SELECT COUNT(*) AS total_purchases 
								FROM purchases 
								WHERE user_email = ? AND timestamp BETWEEN ? AND ?
							";
							$stmt = $conn->prepare($totalPurchasesQuery);
							$stmt->bind_param("sss", $userEmail, $startDate, $endDate);
						} else {
							// Default: count all purchases for the user
							$totalPurchasesQuery = "
								SELECT COUNT(*) AS total_purchases 
								FROM purchases 
								WHERE user_email = ?
							";
							$stmt = $conn->prepare($totalPurchasesQuery);
							$stmt->bind_param("s", $userEmail);
						}

						// Execute the query and fetch the result
						$stmt->execute();
						$result = $stmt->get_result();
						$totalPurchases = $result->fetch_assoc()['total_purchases'] ?? 0; // Default to 0 if no purchases

						$stmt->close(); // Close the statement
						?>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card color-info bg-secondary mb-4">
								<img src="assets/img/icons/purchased-earnings.svg" alt="img">
								<h3 class="counters" data-count="<?= $totalPurchases; ?>"> </h3>
								<p>No. of Total Purchaces</p>
								<i data-feather="rotate-ccw" class="feather-16" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"></i>
							</div>
						</div>
						<!--/ Get the total number of purchases for user -->
					</div>

					<div class="row">
					<div class="col-sm-12 col-md-12 col-xl-4 d-flex">
					<div class="card flex-fill default-cover w-100 mb-4">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h4 class="card-title mb-0">Top Selling Products</h4>
							<div class="dropdown">
								<a href="sales-list.php" class="view-all d-flex align-items-center">
									View All<span class="ps-2 d-flex align-items-center"><i data-feather="arrow-right" class="feather-16"></i></span>
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-borderless best-seller">
								<tbody>
										<?php if (!empty($topProducts)): ?>
											<?php foreach ($topProducts as $productName => $quantitySold): ?>
												<tr>
													<td>
														<div class="product-info">
															<a href="product-list.php" class="product-img">
																<img src="uploads/<?= htmlspecialchars($productDetails[$productName]['image'] ?? 'assets/img/img-1.jpg'); ?>" alt="product image">
															</a>
															<div class="info">
																<a href="product-list.php"><?= htmlspecialchars($productName); ?></a>
																<p class="dull-text">&#8358;<?= number_format($productDetails[$productName]['price'] ?? 0, 2); ?></p>
															</div>
														</div>
													</td>
													<td>
														<p class="head-text">Sales</p>
														<?= $quantitySold; ?>
													</td>
												</tr>
											<?php endforeach; ?>
											<?php else: ?>
											<!-- Demo Data Rows -->
											<tr>
												<td>
													<div class="product-info">
														<a href="product-list.php" class="product-img">
															<img src="assets/img/img-1.jpg" alt="product image">
														</a>
														<div class="info">
															<a href="product-list.php">Demo Product</a>
															<p class="dull-text">&#8358;5,000.00</p>
														</div>
													</div>
												</td>
												<td>
													<p class="head-text">Sales</p>
													10
												</td>
											</tr>
											<?php endif; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<!-- Recent Transactions section -->
						<div class="col-sm-12 col-md-12 col-xl-8 d-flex">
							<div class="card flex-fill default-cover w-100 mb-4">
								<div class="card-header d-flex justify-content-between align-items-center">
									<h4 class="card-title mb-0">Recent Transactions</h4>
									<div class="dropdown">
										<a href="sales-list.php" class="view-all d-flex align-items-center">
										View All<span class="ps-2 d-flex align-items-center"><i data-feather="arrow-right" class="feather-16"></i></span>
									</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<?php
									// Query to fetch recent transactions for the user
									$transactionsQuery = "
										SELECT id, products, payment_by, reference, status, grand_total, timestamp 
										FROM sales 
										WHERE user_email = ? 
										ORDER BY timestamp DESC 
										LIMIT 3
									";
									$stmt = $conn->prepare($transactionsQuery);
									$stmt->bind_param("s", $userEmail);
									$stmt->execute();
									$transactionsResult = $stmt->get_result();

									// Displaying recent transactions in the table
									?>
									<table class="table table-borderless recent-transactions">
										<thead>
											<tr>
												<th>#</th>
												<th>Order Details</th>
												<th>Payment</th>
												<th>Status</th>
												<th>Grand Total</th>
											</tr>
										</thead>
										<tbody>
											<?php if ($transactionsResult->num_rows > 0): ?>
												<?php 
												$serial = 1; // Initialize serial counter
												while ($row = $transactionsResult->fetch_assoc()): ?>
													<?php
													// Parse products and create a row for each product
													$products = explode(";", $row['products']);
													$isFirstProduct = true;
													foreach ($products as $productEntry) {
														if (preg_match('/^(.*?)\s+\(.*?quantity:\s+(\d+),.*?price:\s+([0-9.]+),.*?image:\s+([^\s,]+).*?\)/', trim($productEntry), $matches)) {
															$productName = $matches[1];
															$quantity = $matches[2];
															$price = $matches[3];
															$imagePath = $matches[4];
															?>
															<tr>
																<?php if ($isFirstProduct): ?>
																	<td rowspan="<?php echo count($products); ?>"><?php echo $serial; ?></td> <!-- Use serial number here -->
																<?php endif; ?>
																<td>
																	<div class="product-info">
																		<a href="product-list.php" class="product-img">
																			<img src="uploads/<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($productName); ?>">
																		</a>
																		<div class="info">
																			<a href="product-list.php"><?php echo htmlspecialchars($productName); ?></a>
																			<span class="dull-text d-flex align-items-center">
																				<i data-feather="clock" class="feather-14"></i>
																				<?php echo htmlspecialchars(timeAgo($row['timestamp'])); ?>
																			</span>
																		</div>
																	</div>
																</td>
																<?php if ($isFirstProduct): ?>
																	<td rowspan="<?php echo count($products); ?>">
																		<span class="d-block head-text"><?php echo htmlspecialchars($row['payment_by']); ?></span>
																		<span class="text-blue"><?php echo htmlspecialchars($row['reference']); ?></span>
																	</td>
																	<td rowspan="<?php echo count($products); ?>"><?php echo htmlspecialchars($row['status']); ?></td>
																	<td rowspan="<?php echo count($products); ?>">&#8358;<?php echo number_format($row['grand_total'], 2); ?></td>
																<?php endif; ?>
															</tr>
															<?php
															$isFirstProduct = false;
														}
													}
													$serial++; // Increment the serial number for the next transaction
												endwhile; ?>
											   <?php else: ?>
												<tr>
													<td>1</td>
													<td>
														<div class="product-info">
															<a href="product-list.php" class="product-img">
																<img src="assets/img/img-1.jpg" alt="product image">
															</a>
															<div class="info">
																<a href="product-list.php">Sample Product</a>
																<span class="dull-text d-flex align-items-center">
																	<i data-feather="clock" class="feather-14"></i>
																	Just Now
																</span>
															</div>
														</div>
													</td>
													<td>
														<span class="d-block head-text">Sample Payment</span>
														<span class="text-blue">Reference123</span>
													</td>
													<td>Completed</td>
													<td>&#8358;0.00</td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>

									<?php
									// Function to convert timestamp to "time ago" format
									function timeAgo($timestamp) {
										$timeDifference = time() - strtotime($timestamp);
										if ($timeDifference < 60) {
											return $timeDifference . ' seconds ago';
										} elseif ($timeDifference < 3600) {
											return floor($timeDifference / 60) . ' minutes ago';
										} elseif ($timeDifference < 86400) {
											return floor($timeDifference / 3600) . ' hours ago';
										} else {
											return floor($timeDifference / 86400) . ' days ago';
										}
									}
									?>
									</div>
								</div>
							</div>
						</div>
						<!--/ Recent Transactions section -->
					</div>
					<!-- Button trigger modal -->

					<div class="row sales-board">
						<div class="col-md-12 col-lg-7 col-sm-12 col-12">
							<div class="card flex-fill default-cover">
								<div class="card-header d-flex justify-content-between align-items-center">
									<h5 class="card-title mb-0">Sales Analytics</h5>
									<div class="graph-sets">
										<div class="dropdown dropdown-wraper">
										<button class="btn btn-white btn-sm dropdown-toggle d-flex align-items-center" type="button" id="dropdown-sales" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="calendar" class="feather-14"></i> </button>
											<!-- <button class="btn btn-white btn-sm dropdown-toggle d-flex align-items-center" type="button" id="dropdown-sales" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="calendar" class="feather-14"></i><?= date('Y'); ?></button> -->
										</div>
									</div>
								</div>
								<div class="card-body">
							      	<!-- Sales Analytics chart -->
									<div class="sales-analytics-chart"></div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-5 col-sm-12 col-12">
							<!-- World Map -->
							<div class="card default-cover">
								<div class="card-header d-flex justify-content-between align-items-center">
									<h5 class="card-title mb-0">Sales by Customers</h5>
									<div class="graph-sets">
										<div class="dropdown dropdown-wraper">
										<button class="btn btn-white btn-sm dropdown-toggle d-flex align-items-center" type="button" id="dropdown-sales" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="calendar" class="feather-14"></i> </button>
											<!-- <button class="btn btn-white btn-sm dropdown-toggle d-flex align-items-center" type="button" id="dropdown-country-sales" data-bs-toggle="dropdown" aria-expanded="false">This Year</button> -->
										</div>
									</div>
								</div>
								<div class="card-body">
									<!-- Customer's chart -->
									<div class="Customer-chart" style="height: 265px;"></div>
									<!-- <p class="sales-range"><span class="text-success"><i data-feather="chevron-up" class="feather-16"></i>48%&nbsp;</span>increase compare to last week</p> -->
								</div>
							</div>
							<!-- /World Map -->
						</div>
					</div>
				</div>
			</div>

			<?php include 'layouts/customizer.php'; ?>
			</div>
			<!-- /Main Wrapper -->
			
			<?php include 'layouts/vendor-scripts.php'; ?>


  <script src="assets/js/refresh.js"></script>
	<?php
	// Chart to display sales analytics
	$monthlySales = array_fill(0, 12, 0); // Initialize an array with zero sales for each month

	// Query to get monthly sales data
	$salesQuery = "SELECT MONTH(timestamp) AS sale_month, SUM(grand_total) AS total_sales
				FROM sales
				WHERE user_email = ?
				GROUP BY sale_month";
	$stmt = $conn->prepare($salesQuery);
	$stmt->bind_param("s", $userEmail);
	$stmt->execute();
	$salesResult = $stmt->get_result();

	// Populate monthly sales based on database results
	while ($row = $salesResult->fetch_assoc()) {
		$monthIndex = (int)$row['sale_month'] - 1; // Adjusting month index for array
		$monthlySales[$monthIndex] = (float)$row['total_sales'];
	}

	$stmt->close(); // Close statement


	// Chart to display sales by customers
	$customerQuery = "
		SELECT customer, COUNT(*) as order_count
		FROM sales
		WHERE user_email = ?
		GROUP BY customer
	"; // Query to count unique instances of each customer from the 'sales' table
	$stmt = $conn->prepare($customerQuery);
	$stmt->bind_param("s", $userEmail);
	$stmt->execute();
	$customerResult = $stmt->get_result();

	// Prepare data for chart
	$customerData = [];
	$customerLabels = [];

	while ($row = $customerResult->fetch_assoc()) {
		$customerLabels[] = $row['customer'];
		$customerData[] = (int)$row['order_count'];
	}

	$stmt->close(); // Close connection
	?>


	<script async>
	// Generate the line chart for sales analytics
    document.addEventListener("DOMContentLoaded", function () {
        // PHP data passed to JavaScript
        const monthlySalesData = <?php echo json_encode($monthlySales); ?>;

        var options = {
            chart: {
                type: 'line',
                height: 350,
                background: 'transparent' // Transparent to let CSS background show through
            },
            series: [{
                name: 'Monthly Sales',
                data: monthlySalesData
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yaxis: {
                title: {
                    text: 'Sales (₦)'
                }
            },
            stroke: {
                width: 3,
                curve: 'smooth',
                colors: ['#ff9800'] // Darker color for line visibility
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: "vertical",
                    shadeIntensity: 0.2,
                    gradientToColors: ['#ff9800'], // End color for the gradient under the line
                    inverseColors: false,
                    opacityFrom: 0.85, // Higher opacity for visibility
                    opacityTo: 0.4,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            title: {
                text: ' ',
                align: 'left'
            },
            colors: ['#ff5722'] // Main color for the line
        };

        var chart = new ApexCharts(document.querySelector(".sales-analytics-chart"), options);
        chart.render();
    });


	// Generate the area chart for sales by customers
    document.addEventListener("DOMContentLoaded", function () {
    // PHP data passed to JavaScript
    const customerLabels = <?php echo json_encode($customerLabels); ?>;
    const customerData = <?php echo json_encode($customerData); ?>;

    var options = {
        chart: {
            type: 'area',
            height: 370
        },
        series: [{
            name: 'Orders',
            data: customerData
        }],
        xaxis: {
            categories: customerLabels,
            title: {
                text: 'Customers'
            }
        },
        yaxis: {
            title: {
                text: 'Orders'
            }
        },
        colors: ['#00E396'],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: ['#008FFB'], // end color for the gradient
                inverseColors: true,
                opacityFrom: 0.7,
                opacityTo: 0.3,
                stops: [0, 100]
            }
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        dataLabels: {
            enabled: false
        },
        title: {
            text: '',
            align: 'left'
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Orders";
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector(".Customer-chart"), options);
    chart.render();
});


// Script for Flatpickr Date picker library functionality
document.addEventListener("DOMContentLoaded", function () {
        flatpickr("#dateRange-Picker", {
            mode: "range", // Enable range selection (start and end dates)
            onChange: function(selectedDates, dateStr, instance) {
                // Ensure both start and end dates are selected
                if (selectedDates.length === 2) {
                    const startDate = selectedDates[0];
                    const endDate = selectedDates[1];
                    
                    // Format the dates as YYYY-MM-DD without using toISOString()
                    const formattedStartDate = startDate.getFullYear() + "-" + 
                                               String(startDate.getMonth() + 1).padStart(2, '0') + "-" + 
                                               String(startDate.getDate()).padStart(2, '0');
                    const formattedEndDate = endDate.getFullYear() + "-" + 
                                             String(endDate.getMonth() + 1).padStart(2, '0') + "-" + 
                                             String(endDate.getDate()).padStart(2, '0');

                    // Set the values in the hidden input fields
                    document.getElementById('startDate').value = formattedStartDate;
                    document.getElementById('endDate').value = formattedEndDate;
                    
                    // Optionally, submit the form
                    document.getElementById('dateRangeForm').submit();
                }
            }
        });
    });
</script>
</body>
</body>
</html>
