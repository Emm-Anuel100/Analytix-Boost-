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

    <div class="page-wrapper cardhead">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Peity Chart</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Peity Charts</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
					
						<!-- Chart -->
						<div class="col-md-12">	
							<div class="card">
								<div class="card-header">
									<div class="card-title">Donut Chart</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="donut" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>1/5</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="donut" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>226/360</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="donut" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>0.52/1.561</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="donut" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>1,4</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="donut" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>226,134</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="donut" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>0.52,1.041</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Chart -->
						
						<!-- Chart -->
						<div class="col-md-12">	
							<div class="card">
								<div class="card-header">
									<div class="card-title">Pie Chart</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="pie" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>1/5</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="pie" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>226/360</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="pie" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>0.52/1.561</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="pie" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>1,4</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="pie" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>226,134</span>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<span class="pie" data-peity='{ "fill": ["#7638ff", "rgba(67, 87, 133, .09)"]}'>0.52,1.041</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Chart -->
						
						<!-- Chart -->
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Line Charts</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-lg-4">
											<div class="card-body ">
												<span class="peity-line" data-width="100%">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="card-body ">
												<span class="peity-line" data-width="100%">6,2,8,4,-3,8,1,-3,6,-5,9,2,-8,1,4,8,9,8,2,1</span>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="card-body ">
												<span class="peity-line" data-width="100%">6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
							
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Bar Charts</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-lg-4">
											<div class="card-body ">
												<span class="bar" data-peity='{ "fill": ["#5b73e8", "#38cb89"]}'>6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="card-body ">
												<span class="bar" data-peity='{ "fill": ["#38cb89", "#3e80eb"]}'>6,2,8,4,-3,8,1,-3,6,-5,9,2,-8,1,4,8,9,8,2,1</span>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="card-body ">
												<span class="bar" data-peity='{ "fill": ["#ef4b4b", "#ffab00"]}'>6,2,8,4,3,8,1,3,6,5,9,2,8,1,4,8,9,8,2,1</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Chart -->
						
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Data attributes</h3>
								</div>
								<div class="text-center">
									<div class="row">
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<p class="data-attributes">
													<span data-peity='{ "fill": ["#664dc9", "rgba(67, 87, 133, .09)"],    "innerRadius": 10, "radius": 40 }'>1/7</span>
												</p>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<p class="data-attributes">
													<span data-peity='{ "fill": ["#5b73e8", "rgba(67, 87, 133, .09)"], "innerRadius": 14, "radius": 36 }'>2/7</span>
												</p>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<p class="data-attributes">
													<span data-peity='{ "fill": ["#38cb89", "rgba(67, 87, 133, .09)"], "innerRadius": 16, "radius": 32 }'>3/7</span>
												</p>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<p class="data-attributes">
													<span data-peity='{ "fill": ["#ef4b4b", "rgba(67, 87, 133, .09)"],  "innerRadius": 18, "radius": 28 }'>4/7</span>
												</p>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<p class="data-attributes">
													<span data-peity='{ "fill": ["#ffab00", "rgba(67, 87, 133, .09)"],   "innerRadius": 20, "radius": 24 }'>5/7</span>
												</p>
											</div>
										</div>
										<div class="col-lg-2 col-md-4">
											<div class="card-body ">
												<p class="data-attributes">
													<span data-peity='{ "fill": ["#3e80eb", "rgba(67, 87, 133, .09)"], "innerRadius": 18, "radius": 20 }'>6/7</span>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
							
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Setting Colours Dynamically</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-lg-3">
											<div class="card-body ">
												<span class="bar-colours-1">5,3,9,6,5,9,7,3,5,2</span>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="card-body ">
												<span class="bar-colours-2">5,3,2,-1,-3,-2,2,3,5,2</span>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="card-body ">
												<span class="bar-colours-3">0,-3,-6,-4,-5,-4,-7,-3,-5,-2</span>
											</div>
										</div>
										<div class="col-lg-3">
											<div class="card-body ">
												<span class="pie-colours-2">5,3,9,6,5</span>
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
<!-- end main Wrapper-->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>