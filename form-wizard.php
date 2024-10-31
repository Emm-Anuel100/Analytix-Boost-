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
								<h3 class="page-title">Form Wizard</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Form Wizard</li>
								</ul>
							</div>
						</div>
					</div>	
					<!-- /Page Header -->					
					
					<div class="row">
					
						<!-- Lightbox -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Basic Wizard</h4>
                                </div>
                                <div class="card-body">
                                    <div id="basic-pills-wizard" class="twitter-bs-wizard">
                                        <ul class="twitter-bs-wizard-nav">
                                            <li class="nav-item">
                                                <a href="#seller-details" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Seller Details">
                                                        <i class="far fa-user"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#company-document" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Company Document">
                                                        <i class="fas fa-map-pin"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a href="#bank-detail" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Bank Details">
                                                        <i class="fas fa-credit-card"></i>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- wizard-nav -->

                                        <div class="tab-content twitter-bs-wizard-tab-content">
                                            <div class="tab-pane active" id="seller-details">
                                                <div class="mb-4">
                                                    <h5>Enter Your Personal Details</h5>
                                                </div>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-firstname-input" class="form-label">First name</label>
                                                                <input type="text" class="form-control" id="basicpill-firstname-input">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-lastname-input" class="form-label">Last name</label>
                                                                <input type="text" class="form-control" id="basicpill-lastname-input">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-phoneno-input" class="form-label">Phone</label>
                                                                <input type="text" class="form-control" id="basicpill-phoneno-input">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-email-input" class="form-label">Email</label>
                                                                <input type="email" class="form-control" id="basicpill-email-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i
                                                    class="bx bx-chevron-right ms-1"></i></a></li>
                                                </ul>
                                            </div>
                                            <!-- tab pane -->
                                            <div class="tab-pane" id="company-document">
                                              <div>
                                                <div class="mb-4">
                                                    <h5>Enter Your Address</h5>
                                                </div>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-pancard-input" class="form-label">Address 1</label>
                                                                <input type="text" class="form-control" id="basicpill-pancard-input">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-vatno-input" class="form-label">Address 2</label>
                                                                <input type="text" class="form-control" id="basicpill-vatno-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-cstno-input" class="form-label">Landmark</label>
                                                                <input type="text" class="form-control" id="basicpill-cstno-input">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="basicpill-servicetax-input" class="form-label">Town</label>
                                                                <input type="text" class="form-control" id="basicpill-servicetax-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i
													class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i
                                                    class="bx bx-chevron-right ms-1"></i></a></li>
                                                </ul>
												</div>
                                            </div>
                                            <!-- tab pane -->
                                            <div class="tab-pane" id="bank-detail">
                                                <div>
                                                    <div class="mb-4">
                                                        <h5>Payment Details</h5>
                                                    </div>
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="basicpill-namecard-input" class="form-label">Name on Card</label>
                                                                    <input type="text" class="form-control" id="basicpill-namecard-input">
                                                                </div>
                                                            </div>
    
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Credit Card Type</label>
                                                                    <select class="form-select">
                                                                            <option selected>Select Card Type</option>
                                                                            <option value="AE">American Express</option>
                                                                            <option value="VI">Visa</option>
                                                                            <option value="MC">MasterCard</option>
                                                                            <option value="DI">Discover</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="basicpill-cardno-input" class="form-label">Credit Card Number</label>
                                                                    <input type="text" class="form-control" id="basicpill-cardno-input">
                                                                </div>
                                                            </div>
    
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="basicpill-card-verification-input" class="form-label">Card Verification Number</label>
                                                                    <input type="text" class="form-control" id="basicpill-card-verification-input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="basicpill-expiration-input" class="form-label">Expiration Date</label>
                                                                    <input type="text" class="form-control" id="basicpill-expiration-input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                        <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i
                                                                    class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                                        <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target=".confirmModal">Save
                                                                Changes</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- tab pane -->
                                        </div>
                                        <!-- end tab content -->
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                        </div>
						<!-- /Wizard -->
						
						<!-- Wizard -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Wizard with Progressbar</h4>
                                </div>
                                <div class="card-body">

                                    <div id="progrss-wizard" class="twitter-bs-wizard">
                                        <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified">
                                            <li class="nav-item">
                                                <a href="#progress-seller-details" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="User Details">
                                                        <i class="far fa-user"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#progress-company-document" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Address Detail">
                                                        <i class="fas fa-map-pin"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            
                                            <li class="nav-item">
                                                <a href="#progress-bank-detail" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Payment Details">
                                                        <i class="fas fa-credit-card"></i>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- wizard-nav -->

                                        <div id="bar" class="progress mt-4">
                                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                                        </div>
                                        <div class="tab-content twitter-bs-wizard-tab-content">
                                            <div class="tab-pane active" id="progress-seller-details">
                                                <div class="mb-4">
                                                    <h5>User Details</h5>
                                                </div>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-firstname-input" class="form-label">First name</label>
                                                                <input type="text" class="form-control" id="progresspill-firstname-input">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-lastname-input" class="form-label">Last name</label>
                                                                <input type="text" class="form-control" id="progresspill-lastname-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-phoneno-input" class="form-label">Phone</label>
                                                                <input type="text" class="form-control" id="progresspill-phoneno-input">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-email-input" class="form-label">Email</label>
                                                                <input type="email" class="form-control" id="progresspill-email-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i
                                                        class="bx bx-chevron-right ms-1"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane" id="progress-company-document">
                                                <div>
                                                <div class="mb-4">
                                                    <h5>Location Details</h5>
                                                </div>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-pancard-input" class="form-label">Address Line 1</label>
                                                                <input type="text" class="form-control" id="progresspill-pancard-input">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-vatno-input" class="form-label">Address Line 2</label>
                                                                <input type="text" class="form-control" id="progresspill-vatno-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-cstno-input" class="form-label">Landmark</label>
                                                                <input type="text" class="form-control" id="progresspill-cstno-input">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-servicetax-input" class="form-label">City</label>
                                                                <input type="text" class="form-control" id="progresspill-servicetax-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-companyuin-input" class="form-label">State</label>
                                                                <input type="text" class="form-control" id="progresspill-companyuin-input">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-declaration-input" class="form-label">Country</label>
                                                                <input type="text" class="form-control" id="progresspill-declaration-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i
                                                        class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i
                                                    class="bx bx-chevron-right ms-1"></i></a></li>
                                                </ul>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="progress-bank-detail">
                                                <div>
                                                    <div class="mb-4">
                                                        <h5>Payment Details</h5>
                                                    </div>
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="progresspill-namecard-input" class="form-label">Name on Card</label>
                                                                    <input type="text" class="form-control" id="progresspill-namecard-input">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Credit Card Type</label>
                                                                    <select class="form-select">
                                                                        <option selected>Select Card Type</option>
                                                                        <option value="AE">American Express</option>
                                                                        <option value="VI">Visa</option>
                                                                        <option value="MC">MasterCard</option>
                                                                        <option value="DI">Discover</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="progresspill-cardno-input" class="form-label">Credit Card Number</label>
                                                                    <input type="text" class="form-control" id="progresspill-cardno-input">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="progresspill-card-verification-input" class="form-label">Card Verification Number</label>
                                                                    <input type="text" class="form-control" id="progresspill-card-verification-input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="progresspill-expiration-input" class="form-label">Expiration Date</label>
                                                                    <input type="text" class="form-control" id="progresspill-expiration-input">
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </form>
                                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                        <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i
                                                        class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                                        <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target=".confirmModal">Save Changes</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
						<!-- /Wizard -->
						
					</div>
				
				</div>	

            </div>



    </div>
<!-- end main Wrapper-->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
    <!-- Wizard JS -->
    <script src="assets/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="assets/plugins/twitter-bootstrap-wizard/prettify.js"></script>
    <script src="assets/plugins/twitter-bootstrap-wizard/form-wizard.js"></script>
</body>
</html>