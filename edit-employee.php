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
								<h4>Edit Employee</h4>
								<h6>Edit Employee</h6>
							</div>
						</div>
						<ul class="table-top-head">
							<li>
								<div class="page-btn">
									<a href="employees-list.php" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>Back to Employee List</a>
								</div>
							</li>
							<li>
								<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
							</li>
						</ul>
					</div>
					<!-- /product list -->
					<div class="card">
						<div class="card-body">
							<form action="edit-employee.php">
								<div class="new-employee-field">
									<div class="card-title-head">
										<h6><span><i data-feather="info" class="feather-edit"></i></span>Employee Information</h6>
									</div>
									<div class="profile-pic-upload edit-pic">
										<div class="profile-pic">
											<span><img src="assets/img/users/user-01.jpg" alt=""></span>
										</div>
										<div class="me-3 mb-0">
											<div class="image-upload mb-0">
												<input type="file">
												<div class="image-uploads">
													<h4>Change Image</h4>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">First Name</label>
												<input type="text" class="form-control" value="Mitchum">
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Last Name</label>
												<input type="text" class="form-control" value="Daniel">
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="email" class="form-control" value="mir34345@example.com">
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Contact Number</label>
												<input type="text" class="form-control" value="+1 54554 54788">
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Emp Code</label>
												<input type="text" class="form-control" value="POS001">
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="input-blocks">
												<label class="form-label">Date of Birth</label>
												
												<div class="input-groupicon calender-input">
													<i data-feather="calendar" class="info-img"></i>
													<input type="text" class="datetimepicker form-control" placeholder="Select Date" value="13 Aug 1992">
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Gender</label>
												<select class="select">
													<option>Male</option>
													<option>Female</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Nationality</label>
												<select class="select">
													<option>United Kingdom</option>
													<option>India</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="input-blocks">
												<label class="form-label">Joining Date</label>
												<div class="input-groupicon calender-input">
													<i data-feather="calendar" class="info-img"></i>
													<input type="text" class="datetimepicker form-control" placeholder="Select Date" >
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<div class="add-newplus">
													<label class="form-label">Shift</label>
													<a href="#"><span><i data-feather="plus-circle" class="plus-down-add"></i>Add new</span></a>
												</div>
												<select class="select">
													<option>Regular</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Department</label>
												<select class="select">
													<option>UI/UX</option>
													<option>Support</option>
													<option>HR</option>
													<option>Engineering</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Designation</label>
												<select class="select">
													<option>Designer</option>
													<option>Developer</option>
													<option>Tester</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="mb-3">
												<label class="form-label">Blood Group</label>
												<select class="select">
													<option>O positive</option>
													<option>A positive</option>
													<option>B negative</option>
												</select>
											</div>
										</div>
									</div>
									<div class="other-info">
										<div class="card-title-head">
											<h6><span><i data-feather="info" class="feather-edit"></i></span>Other Information</h6>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Emergency No 1</label>
													<input type="text" class="form-control" value="+1 72368 89153">
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Emergency No 2</label>
													<input type="text" class="form-control" value="+1 90563 60916">
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Address</label>
													<input type="text" class="form-control" value="9S Quay Street">
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Country</label>
													<select class="select">
														<option>United Kingdom</option>
														<option>USA</option>			
													</select>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">State</label>
													<input type="text" class="form-control" value="East London">
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">City</label>
													<input type="text" class="form-control" value="Leeds">
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="mb-3">
													<label class="form-label">Zipcode</label>
													<input type="text" class="form-control" value="LS1">
												</div>
											</div>
										</div>
									</div>
									<div class="pass-info">
										<div class="card-title-head">
											<h6><span><i data-feather="info" class="feather-edit"></i></span>Password</h6>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-6">
												<div class="input-blocks mb-md-0 mb-sm-3">
													<label class="form-label">Password</label>
													<div class="pass-group">
														<input type="password" class="pass-input" value="1234">
														<span class="fas toggle-password fa-eye-slash"></span>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-md-6">
												<div class="input-blocks mb-0">
													<label class="form-label">Confirm Password</label>
													<div class="pass-group">
														<input type="password" class="pass-inputa" value="1234">
														<span class="fas toggle-passworda fa-eye-slash"></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="text-end mb-3 mt-5">
									<button type="button" class="btn btn-cancel me-2">Cancel</button>
									<button type="submit" class="btn btn-submit">Save Changes</button>
								</div>
							</form>
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
</body>
</html>