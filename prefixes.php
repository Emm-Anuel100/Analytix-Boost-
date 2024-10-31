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
				<div class="content settings-content">
					<div class="page-header settings-pg-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Settings</h4>
								<h6>Manage your settings on portal</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-xl-12">
							 <div class="settings-wrapper d-flex">
							 <?php include 'layouts/settings-sidebar.php'; ?>
								<div class="settings-page-wrap">
									<form action="prefixes.php">
										<div class="setting-title">
											<h4>Prefixes</h4>
										</div>
										<div class="row">
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Product (SKU)</label>
													<input type="text" class="form-control" placeholder="SKU -">
												</div>
											</div>
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Supplier</label>
													<input type="text" class="form-control" placeholder="SUP -">
												</div>
											</div>									
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Purchase</label>
													<input type="text" class="form-control" placeholder="PU -">
												</div>
											</div>										
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Purchase Return</label>
													<input type="text" class="form-control" placeholder="PR -">
												</div>
											</div>
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Sales</label>
													<input type="text" class="form-control" placeholder="SA -">
												</div>
											</div>										
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Sales Return</label>
													<input type="text" class="form-control" placeholder="SR -">
												</div>
											</div>	
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Customer</label>
													<input type="text" class="form-control" placeholder="CT -">
												</div>
											</div>	
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Expense</label>
													<input type="text" class="form-control" placeholder="EX -">
												</div>
											</div>	
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Stock Transfer</label>
													<input type="text" class="form-control" placeholder="ST -">
												</div>
											</div>	
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Stock Adjustmentt</label>
													<input type="text" class="form-control" placeholder="SA -">
												</div>
											</div>	
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Sales Order</label>
													<input type="text" class="form-control" placeholder="SO -">
												</div>
											</div>	
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">POS Invoice</label>
													<input type="text" class="form-control" placeholder="PINV -">
												</div>
											</div>	
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Estimation</label>
													<input type="text" class="form-control" placeholder="EST -">
												</div>
											</div>	
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Transaction</label>
													<input type="text" class="form-control" placeholder="TRN -">
												</div>
											</div>	
											<div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
												<div class="mb-3">
													<label class="form-label">Employee</label>
													<input type="text" class="form-control" placeholder="EMP -">
												</div>
											</div>	
										</div>
										<div class="prefix-settings">
											<div class="modal-footer-btn">
												<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-submit">Save Changes</button>
											</div>
										</div>
									</form>
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
    </body>
</html>