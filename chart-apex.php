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
                <div class="content ">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Charts</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Charts</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
					
						<!-- Chart -->
						<div class="col-md-6">	
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Apex Simple</h5>
								</div>
								<div class="card-body">
									<div id="s-line" class="chart-set"></div>
								</div>
							</div>
						</div>
						<!-- /Chart -->
							
						<!-- Chart -->
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Area Chart</h5>
								</div>
								<div class="card-body">
									<div id="s-line-area" class="chart-set"></div>
								</div>
							</div>
						</div>
						<!-- /Chart -->
							
						<!-- Chart -->
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Column Chart</h5>
								</div>
								<div class="card-body">
									<div id="s-col" class="chart-set"></div>
								</div>
							</div>
						</div>
						<!-- /Chart -->
						
						<!-- Chart -->
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Column Stacked Chart</h5>
								</div>
								<div class="card-body">
									<div id="s-col-stacked" class="chart-set"></div>
								</div>
							</div>
						</div>
						<!-- /Chart -->
						
						
						<!-- Chart -->
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Bar Chart</h5>
								</div>
								<div class="card-body">
									<div id="s-bar" class="chart-set"></div>
								</div>
							</div>
						</div>
						<!-- /Chart -->
						
						<!-- Chart -->
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Mixed Chart</h5>
								</div>
								<div class="card-body">
									<div id="mixed-chart" class="chart-set"></div>
								</div>
							</div>
						</div>
						<!-- /Chart -->
						
						<!-- Chart -->
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Donut Chart</h5>
								</div>
								<div class="card-body">
									<div id="donut-chart" class="chart-set"></div>
								</div>
							</div>
						</div>
						<!-- /Chart -->
						
						<!-- Chart -->
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Radial Chart</h5>
								</div>
								<div class="card-body">
									<div id="radial-chart" class="chart-set"></div>
								</div>
							</div>
						</div>
						<!-- /Chart -->
						
					</div>
				</div>	
            </div>

    </div>
<!-- end main Wrapper-->
<div class="searchpart">
            <div class="searchcontent">
                <div class="searchhead">
                    <h3>Search </h3>
                    <a id="closesearch"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
                <div class="searchcontents">
                    <div class="searchparts">
                        <input type="text" placeholder="search here">
                        <a class="btn btn-searchs" >Search</a>
                    </div>
                    <div class="recentsearch">
                        <h2>Recent Search</h2>
                        <ul>
                            <li>
                                <h6><i class="fa fa-search me-2"></i> Settings</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-search me-2"></i> Report</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-search me-2"></i> Invoice</h6>
                            </li>
                            <li>
                                <h6><i class="fa fa-search me-2"></i> Sales</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>