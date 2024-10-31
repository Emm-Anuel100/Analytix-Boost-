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


    <div class="page-wrapper notes-page-wrapper">
				<div class="content">


					<div class="page-header">
						<div class="add-item d-flex">
							<div class="page-title">
								<h4>Print Barcode</h4>
								<h6>Manage your barcodes</h6>
							</div>
						</div>
						<div class="d-flex align-items-center">
							<ul class="table-top-head">
								<li>
									<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
								</li>
								<li>
									<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
								</li>
							</ul>
						</div>
					</div>
                    <div class="barcode-content-list">
                        <form>
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="row seacrh-barcode-item">
                                        <div class="col-sm-6 mb-3 seacrh-barcode-item-one">
                                            <label class="form-label">Warehouse</label>
                                            <select class="select">
                                                <option>Choose</option>
                                                <option>Manufacture</option>
                                                <option>Transport</option>
												<option>Customs</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mb-3 seacrh-barcode-item-one">
                                            <label class="form-label">Select Store</label>
                                            <select class="select">
                                                <option>Choose</option>
                                                <option>Online</option>
                                                <option>Offline</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                    <div class="input-blocks search-form seacrh-barcode-item">
                                        <div class="searchInput">
                                            <label class="form-label">Product</label>
                                            <input type="text" class="form-control" placeholder="Search Product by Codename">
                                            <div class="resultBox">
                                            </div>
                                            <div class="icon"><i class="fas fa-search"></i></div>
                                        </div>
                                    </div>                                                             
                                                                 
                                </div>
                            </div>
                        </form>  

                        <div class="col-lg-12">
                            <div class="modal-body-table search-modal-header">
                                <div class="table-responsive">
                                    <table class="table  datanew">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>SKU</th>
                                                <th>Code</th>
                                                <th>Qty</th>
                                                <th class="text-center no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="assets/img/products/stock-img-02.png" alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Nike Jordan</a>
                                                    </div>												
                                                </td>
                                                <td>PT002</td>
                                                <td>HG3FK</td>
                                                <td>
                                                    <div class="product-quantity">
														<span class="quantity-btn"><i data-feather="minus-circle" class="feather-search"></i></span>                                                        
                                                        <input type="text" class="quntity-input" value="4">
														<span class="quantity-btn">+<i data-feather="plus-circle" class="plus-circle"></i></span>
                                                       
                                                    </div>
                                                </td>
                                                <td class="action-table-data justify-content-center">
                                                    <div class="edit-delete-action">
                                                        <a class="confirm-text barcode-delete-icon" href="javascript:void(0);">
                                                            <i data-feather="trash-2" class="feather-trash-2"></i>
                                                        </a>
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="productimgname">
                                                        <a href="javascript:void(0);" class="product-img stock-img">
                                                            <img src="assets/img/products/stock-img-03.png" alt="product">
                                                        </a>
                                                        <a href="javascript:void(0);">Apple Series 5 Watch</a>
                                                    </div>												
                                                </td>
                                                <td>PT003</td>
                                                <td>TEUIU7</td>
                                                <td>
													<div class="product-quantity">
														<span class="quantity-btn"><i data-feather="minus-circle" class="feather-search"></i></span>                                                        
                                                        <input type="text" class="quntity-input" value="4">
														<span class="quantity-btn">+<i data-feather="plus-circle" class="plus-circle"></i></span>                                                       
                                                    </div>
                                                </td>
                                                <td class="action-table-data justify-content-center">
                                                    <div class="edit-delete-action">                                                        
                                                        <a class="barcode-delete-icon confirm-text" href="javascript:void(0);">
                                                            <i data-feather="trash-2" class="feather-trash-2"></i>
                                                        </a>
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>

                        <div class="paper-search-size">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <form class="mb-0">
                                        <label class="form-label">Paper Size</label>
                                        <select class="select">
                                            <option>Choose</option>
                                            <option>Recent1</option>
                                            <option>Recent2</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="col-lg-6 pt-3">
                                    <div class="row">
										<div class="col-sm-4">
											<div class="search-toggle-list">
												<p>Show Store Name</p>
												<div class="input-blocks m-0">
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="user7" class="check" checked>
														<label for="user7" class="checktoggle mb-0">	</label>
													</div>
												</div>
											</div> 
										</div>    
                                            
										<div class="col-sm-4">
											<div class="search-toggle-list">
												<p>Show Product Name</p>
												<div class="input-blocks m-0">
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="user8" class="check" checked>
														<label for="user8" class="checktoggle mb-0">	</label>
													</div>
												</div>
											</div> 
										</div>
    
    
										<div class="col-sm-4">
											<div class="search-toggle-list">
												<p>Show Price</p>
												<div class="input-blocks m-0">
													<div class="status-toggle modal-status d-flex justify-content-between align-items-center">
														<input type="checkbox" id="user9" class="check" checked>
														<label for="user9" class="checktoggle mb-0">	</label>
													</div>
												</div>
											</div> 
										</div> 
                                    </div>                                                               
                                </div>
                            </div>
                        </div> 

                        <div class="search-barcode-button">                            
							<a href="javascript:void(0);" class="btn btn-submit me-2" data-bs-toggle="modal" data-bs-target="#prints-barcode">
                                <span><i class="fas fa-eye me-2"></i></span>                                
                                Generate Barcode</a>
                            <a href="javascript:void(0);" class="btn btn-cancel me-2">
                                <span><i class="fas fa-power-off me-2"></i></span>                                  
                                Reset Barcode</a>
                            <a href="javascript:void(0);" class="btn btn-cancel close-btn">
                                <span><i class="fas fa-print me-2"></i></span>                                  
                                Print Barcode</a>
                        </div>
                    </div>                   								
				</div>
			</div>


    </div>
<!-- end main Wrapper-->
 <!-- Print Barcode -->
 <div class="modal fade" id="prints-barcode">
			<div class="modal-dialog modal-dialog-centered stock-adjust-modal">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Barcode</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
                                   <div class="d-flex justify-content-end">
                                       <a href="javascript:void(0);" class="btn btn-cancel close-btn">
                                        <span><i class="fas fa-print me-2"></i></span>                                  
                                        Print Barcode</a>
                                   </div>
                                    
                                        <div class="barcode-scan-header">
                                            <h5>Nike Jordan</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="barcode-scanner-link text-center">
                                                    <h6>Grocery Alpha</h6>
                                                    <p>
                                                        Nike Jordan
                                                    </p>
                                                    <p>Price: $400</p> 
                                                    <div class="barscaner-img">
                                                        <img src="./assets/img/barcode/barcode-01.png" alt="Barcode" class="img-fluid">
                                                    </div>                                           
                                                </div>                                                
                                            </div>
                                        </div>   
                                        
                                        <div class="barcode-scan-header">
                                            <h5>Apple Series 5 Watch</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="barcode-scanner-link text-center">
                                                    <h6>Grocery Alpha</h6>
                                                    <p>
                                                        Apple Series 5 Watch
                                                    </p>
                                                    <p>Price: $300</p> 
                                                    <div class="barscaner-img">
                                                        <img src="./assets/img/barcode/barcode-02.png" alt="Barcode" class="img-fluid">
                                                    </div>                                           
                                                </div>                                                
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="barcode-scanner-link text-center">
                                                    <h6>Grocery Alpha</h6>
                                                    <p>
                                                        Apple Series 5 Watch
                                                    </p>
                                                    <p>Price: $300</p> 
                                                    <div class="barscaner-img">
                                                        <img src="./assets/img/barcode/barcode-02.png" alt="Barcode" class="img-fluid">
                                                    </div>                                           
                                                </div>                                                
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="barcode-scanner-link text-center">
                                                    <h6>Grocery Alpha</h6>
                                                    <p>
                                                        Apple Series 5 Watch
                                                    </p>
                                                    <p>Price: $300</p> 
                                                    <div class="barscaner-img">
                                                        <img src="./assets/img/barcode/barcode-02.png" alt="Barcode" class="img-fluid">
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
		<!-- /Print Barcode -->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>