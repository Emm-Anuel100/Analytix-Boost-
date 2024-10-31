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
								<h4>Customer List</h4>
								<h6>Manage your warehouse</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
						<div class="page-btn">
							<a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-units"><i data-feather="plus-circle" class="me-2"></i>Add New Customer</a>
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
								<div class="search-path">
									<div class="d-flex align-items-center">
										<a class="btn btn-filter" id="filter_search">
											<i data-feather="filter" class="filter-icon"></i>
											<span><img src="assets/img/icons/closes.svg" alt="img"></span>
										</a>
										
									</div>
								</div>
								<div class="form-sort">
									<i data-feather="sliders" class="info-img"></i>
									<select class="select">
										<option>Sort by Date</option>
										<option>Newest</option>
										<option>Oldest</option>
									</select>
								</div>
							</div>
							<!-- /Filter -->
							<div class="card" id="filter_inputs">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="user" class="info-img"></i>
												<select class="select">
													<option>Choose Customer Name</option>
													<option>Benjamin</option>
													<option>Ellen</option>
													<option>Freda</option>
													<option>Kaitlin</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="input-blocks">
												<i data-feather="globe" class="info-img"></i>
												<select class="select">
													<option>Choose Country</option>
													<option>India</option>
													<option>USA</option>
												</select>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12 ms-auto">
											<div class="input-blocks">
												<a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i> Search </a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Filter -->
							<div class="table-responsive">
								<table class="table  datanew">
									<thead>
										<tr>
											<th class="no-sort">
												<label class="checkboxs">
													<input type="checkbox" id="select-all">
													<span class="checkmarks"></span>
												</label>
											</th>
											<th>Customer  Name</th>
											<th>Code</th>
											<th>Customer</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Country</th>
											<th class="no-sort">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>											
											<td>
												<div class="userimgname cust-imgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-23.jpg" alt="product">
													</a>
													<a href="javascript:void(0);">Thomas</a>
												</div>
											</td>
											<td>
												201
											</td>
											<td>Thomas</td>
											<td>
												thomas@exmple.com
											</td>
											<td>+12163547758 </td>
											<td>Germany</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-text p-2" href="javascript:void(0);">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a>
												</div>
												
											</td>
										</tr>	
                                        <tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>											
											<td>
												<div class="userimgname cust-imgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-15.jpg" alt="product">
													</a>
													<a href="javascript:void(0);">Rose</a>
												</div>
											</td>
											<td>
												201
											</td>
											<td>Rose</td>
											<td>
												rose@exmple.com
											</td>
											<td>+11367529510  </td>
											<td>USA</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-text p-2" href="javascript:void(0);">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a>
												</div>
												
											</td>
										</tr>	

                                        <tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>											
											<td>
												<div class="userimgname cust-imgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-16.jpg" alt="product">
													</a>
													<a href="javascript:void(0);">Benjamin</a>
												</div>
											</td>
											<td>
												203
											</td>
											<td>Benjamin</td>
											<td>
												benjamin@exmple.com
											</td>
											<td>+15362789414 </td>
											<td>Japan</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-text p-2" href="javascript:void(0);">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a>
												</div>
												
											</td>
										</tr>	

                                        <tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>											
											<td>
												<div class="userimgname cust-imgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-17.jpg" alt="product">
													</a>
													<a href="javascript:void(0);">Kaitlin</a>
												</div>
											</td>
											<td>
												204
											</td>
											<td>Kaitlin</td>
											<td>
												kaitlin@exmple.com
											</td>
											<td>+18513094627 </td>
											<td>Austria</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-text p-2" href="javascript:void(0);">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a>
												</div>
												
											</td>
										</tr>	

                                        <tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>											
											<td>
												<div class="userimgname cust-imgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-18.jpg" alt="product">
													</a>
													<a href="javascript:void(0);">Lilly</a>
												</div>
											</td>
											<td>
												205
											</td>
											<td>Lilly</td>
											<td>
												lilly@exmple.com
											</td>
											<td>+14678219025 </td>
											<td>India</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-text p-2" href="javascript:void(0);">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a>
												</div>
												
											</td>
										</tr>	

                                        <tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>											
											<td>
												<div class="userimgname cust-imgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-19.jpg" alt="product">
													</a>
													<a href="javascript:void(0);">Freda</a>
												</div>
											</td>
											<td>
												206
											</td>
											<td>Freda</td>
											<td>
												freda@exmple.com
											</td>
											<td>+10913278319 </td>
											<td>France</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-text p-2" href="javascript:void(0);">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a>
												</div>
												
											</td>
										</tr>	

                                        <tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>											
											<td>
												<div class="userimgname cust-imgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/customer/people-customer-07.jpg" class="people-customer-walk" alt="product">
													</a>
													<a href="javascript:void(0);">Walk-in-Customer</a>
												</div>
											</td>
											<td>
												01
											</td>
											<td>Walk-in-Customer</td>
											<td>
												customer01@exmple.com
											</td>
											<td>+19125852947 </td>
											<td>Belgium</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-text p-2" href="javascript:void(0);">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a>
												</div>
												
											</td>
										</tr>	

                                        <tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>											
											<td>
												<div class="userimgname cust-imgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-06.jpg" alt="product">
													</a>
													<a href="javascript:void(0);">Maybelle</a>
												</div>
											</td>
											<td>
												207
											</td>
											<td>Maybelle</td>
											<td>
												maybelle@exmple.com
											</td>
											<td>+19125852947 </td>
											<td>Italy</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-text p-2" href="javascript:void(0);">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a>
												</div>
												
											</td>
										</tr>	

                                        <tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>											
											<td>
												<div class="userimgname cust-imgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/users/user-10.jpg" alt="product">
													</a>
													<a href="javascript:void(0);">Ellen</a>
												</div>
											</td>
											<td>
												208
											</td>
											<td>Ellen</td>
											<td>
												ellen@exmple.com
											</td>
											<td>+19756194733 </td>
											<td>Canada</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-text p-2" href="javascript:void(0);">
														<i data-feather="trash-2" class="feather-trash-2"></i>
													</a>
												</div>
												
											</td>
										</tr>	

                                        <tr>
											<td>
												<label class="checkboxs">
													<input type="checkbox">
													<span class="checkmarks"></span>
												</label>
											</td>											
											<td>
												<div class="userimgname cust-imgname">
													<a href="javascript:void(0);" class="product-img">
														<img src="assets/img/customer/people-customer-07.jpg" class="people-customer-walk" alt="product">
													</a>
													<a href="javascript:void(0);">Walk-in-Customer</a>
												</div>
											</td>
											<td>
												02
											</td>
											<td>Walk-in-Customer</td>
											<td>
                                                customer02@exmple.com
											</td>
											<td>+19167850925 </td>
											<td>Greece</td>
											<td class="action-table-data">
												<div class="edit-delete-action">
													<a class="me-2 p-2" href="#">
														<i data-feather="eye" class="feather-eye"></i>
													</a>
													<a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-units">
														<i data-feather="edit" class="feather-edit"></i>
													</a>
													<a class="confirm-text p-2" href="javascript:void(0);">
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
					<!-- /product list -->
				</div>
			</div>
  

    </div>
<!-- end main Wrapper-->
<!-- Add Customer -->
<div class="modal fade" id="add-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Add Customer</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="customers.php">
									<div class="modal-title-head people-cust-avatar">
										<h6>Avatar</h6>
									</div>
									<div class="new-employee-field">
										<div class="profile-pic-upload">
											<div class="profile-pic">
												<span><i data-feather="plus-circle" class="plus-down-add"></i> Add Image</span>
											</div>
											<div class="mb-3">
												<div class="image-upload mb-0">
													<input type="file">
													<div class="image-uploads">
														<h4>Change Image</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Customer Name</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="email" class="form-control">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="input-blocks">
												<label class="mb-2">Phone</label>
												<input class="form-control form-control-lg group_formcontrol" id="phone" name="phone" type="text">
											</div>
										</div>
										<div class="col-lg-12 pe-0">
											<div class="mb-3">
												<label class="form-label">Address</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 pe-0">
											<div class="mb-3">
												<label class="form-label">City</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 pe-0">
											<div class="mb-3">
												<label class="form-label">Country</label>
												<select class="select">
													<option>Choose</option>
													<option>United Kingdom</option>
													<option>United State</option>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3 input-blocks">
												<label class="form-label">Descriptions</label>
												<textarea class="form-control mb-1"></textarea>
												<p>Maximum 60 Characters</p>
											</div>											
										</div>									
									</div>								
									
									<div class="modal-footer-btn">
										<button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Customer -->

        <!-- Edit Customer -->
		<div class="modal fade" id="edit-units">
			<div class="modal-dialog modal-dialog-centered custom-modal-two">
				<div class="modal-content">
					<div class="page-wrapper-new p-0">
						<div class="content">
							<div class="modal-header border-0 custom-modal-header">
								<div class="page-title">
									<h4>Edit Customer</h4>
								</div>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body custom-modal-body">
								<form action="customers.php">
									<div class="modal-title-head people-cust-avatar">
										<h6>Avatar</h6>
									</div>
									<div class="new-employee-field">
										<div class="profile-pic-upload">
											<div class="profile-pic people-profile-pic">                                                
												<img src="assets/img/profiles/profile.png" alt="Img">
												<a href="#"><i data-feather="x-square" class="x-square-add"></i></a>                                          
											</div>
											<div class="mb-3">
												<div class="image-upload mb-0">
													<input type="file">
													<div class="image-uploads">
														<h4>Change Image</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Customer Name</label>
												<input type="text" class="form-control" value="Thomas">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="email" class="form-control" value="thomas@example.com">
											</div>
										</div>
										<div class="col-lg-4 pe-0">
											<div class="input-blocks">
												<label class="mb-2">Phone</label>
												<input class="form-control form-control-lg group_formcontrol" id="phone2" name="phone2" type="text">
											</div>
										</div>
										<div class="col-lg-12 pe-0">
											<div class="mb-3">
												<label class="form-label">Address</label>
												<input type="text" class="form-control" value="Budapester Strasse 2027259 ">
											</div>
										</div>
										<div class="col-lg-6 pe-0">
											<div class="mb-3">
												<label class="form-label">City</label>											
												<select class="select">
													<option>Varrel</option>
													<option>Varrel</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 pe-0">
											<div class="mb-3">
												<label class="form-label">Country</label>
												<select class="select">
													<option>Germany</option>
													<option>United State</option>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-0 input-blocks">
												<label class="form-label">Descriptions</label>
												<textarea class="form-control mb-1"></textarea>
												<p>Maximum 60 Characters</p>
											</div>											
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
		<!-- /Edit Customer -->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
    <!-- Mobile Input -->
    <script src="assets/plugins/intltelinput/js/intlTelInput.js"></script>
<?php include 'layouts/vendor-scripts.php'; ?>

</body>
</html>