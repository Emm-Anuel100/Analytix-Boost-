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

            <div class="page-wrapper cardhead">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Basic Tables</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Basic Tables</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-lg-6">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Basic Table</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table mb-0">
											<thead>
												<tr>
													<th>Firstname</th>
													<th>Lastname</th>
													<th>Email</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>John</td>
													<td>Doe</td>
													<td>john@example.com</td>
												</tr>
												<tr>
													<td>Mary</td>
													<td>Moe</td>
													<td>mary@example.com</td>
												</tr>
												<tr>
													<td>July</td>
													<td>Dooley</td>
													<td>july@example.com</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Striped Rows</h5>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped mb-0">
											<thead>
												<tr>
													<th>Firstname</th>
													<th>Lastname</th>
													<th>Email</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>John</td>
													<td>Doe</td>
													<td>john@example.com</td>
												</tr>
												<tr>
													<td>Mary</td>
													<td>Moe</td>
													<td>mary@example.com</td>
												</tr>
												<tr>
													<td>July</td>
													<td>Dooley</td>
													<td>july@example.com</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Bordered Table</h5>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered mb-0">
											<thead>
												<tr>
													<th>Firstname</th>
													<th>Lastname</th>
													<th>Email</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>John</td>
													<td>Doe</td>
													<td>john@example.com</td>
												</tr>
												<tr>
													<td>Mary</td>
													<td>Moe</td>
													<td>mary@example.com</td>
												</tr>
												<tr>
													<td>July</td>
													<td>Dooley</td>
													<td>july@example.com</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Borderless Table</h5>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-borderless mb-0">
											<thead>
												<tr>
													<th>Firstname</th>
													<th>Lastname</th>
													<th>Email</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>John</td>
													<td>Doe</td>
													<td>john@example.com</td>
												</tr>
												<tr>
													<td>Mary</td>
													<td>Moe</td>
													<td>mary@example.com</td>
												</tr>
												<tr>
													<td>July</td>
													<td>Dooley</td>
													<td>july@example.com</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Hover Rows</h5>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover mb-0">
											<thead>
												<tr>
													<th>Firstname</th>
													<th>Lastname</th>
													<th>Email</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>John</td>
													<td>Doe</td>
													<td>john@example.com</td>
												</tr>
												<tr>
													<td>Mary</td>
													<td>Moe</td>
													<td>mary@example.com</td>
												</tr>
												<tr>
													<td>July</td>
													<td>Dooley</td>
													<td>july@example.com</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Contextual Classes</h5>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table mb-0">
											<thead>
												<tr>
													<th>Firstname</th>
													<th>Lastname</th>
													<th>Email</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Default</td>
													<td>Defaultson</td>
													<td>def@somemail.com</td>
												</tr>
												<tr class="table-primary">
													<td>Primary</td>
													<td>Doe</td>
													<td>john@example.com</td>
												</tr>
												<tr class="table-secondary">
													<td>Secondary</td>
													<td>Moe</td>
													<td>mary@example.com</td>
												</tr>
												<tr class="table-success">
													<td>Success</td>
													<td>Dooley</td>
													<td>july@example.com</td>
												</tr>
												<tr class="table-danger">
													<td>Danger</td>
													<td>Refs</td>
													<td>bo@example.com</td>
												</tr>
												<tr class="table-warning">
													<td>Warning</td>
													<td>Activeson</td>
													<td>act@example.com</td>
												</tr>
												<tr class="table-info">
													<td>Info</td>
													<td>Activeson</td>
													<td>act@example.com</td>
												</tr>
												<tr class="table-light">
													<td>Light</td>
													<td>Activeson</td>
													<td>act@example.com</td>
												</tr>
												<tr class="table-dark">
													<td>Dark</td>
													<td>Activeson</td>
													<td>act@example.com</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Responsive Tables</h5>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-nowrap mb-0">
											<thead>
												<tr>
													<th>#</th>
													<th>Firstname</th>
													<th>Lastname</th>
													<th>Age</th>
													<th>City</th>
													<th>Country</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>Anna</td>
													<td>Pitt</td>
													<td>35</td>
													<td>New York</td>
													<td>USA</td>
												</tr>
												<tr>
													<td>1</td>
													<td>Anna</td>
													<td>Pitt</td>
													<td>35</td>
													<td>New York</td>
													<td>USA</td>
												</tr>
												<tr>
													<td>1</td>
													<td>Anna</td>
													<td>Pitt</td>
													<td>35</td>
													<td>New York</td>
													<td>USA</td>
												</tr>
												<tr>
													<td>1</td>
													<td>Anna</td>
													<td>Pitt</td>
													<td>35</td>
													<td>New York</td>
													<td>USA</td>
												</tr>
												<tr>
													<td>1</td>
													<td>Anna</td>
													<td>Pitt</td>
													<td>35</td>
													<td>New York</td>
													<td>USA</td>
												</tr>
												<tr>
													<td>1</td>
													<td>Anna</td>
													<td>Pitt</td>
													<td>35</td>
													<td>New York</td>
													<td>USA</td>
												</tr>
												<tr>
													<td>1</td>
													<td>Anna</td>
													<td>Pitt</td>
													<td>35</td>
													<td>New York</td>
													<td>USA</td>
												</tr>
												<tr>
													<td>1</td>
													<td>Anna</td>
													<td>Pitt</td>
													<td>35</td>
													<td>New York</td>
													<td>USA</td>
												</tr>
												<tr>
													<td>1</td>
													<td>Anna</td>
													<td>Pitt</td>
													<td>35</td>
													<td>New York</td>
													<td>USA</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-6">
							<div class="card">
								<div class="card-header justify-content-between">
									<div class="card-title">
										Table Without Borders
									</div>
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap table-borderless">
											<thead>
												<tr>
													<th scope="col">User Name</th>
													<th scope="col">Transaction Id</th>
													<th scope="col">Created</th>
													<th scope="col">Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">Harshrath</th>
													<td>#5182-3467</td>
													<td>24 May 2022</td>
													<td><span class="badge bg-primary">Fixed</span></td>
												</tr>
												<tr>
													<th scope="row">Zozo Hadid</th>
													<td>#5182-3412</td>
													<td>02 July 2022</td>
													<td><span class="badge bg-warning">In Progress</span></td>
												</tr>
												<tr>
													<th scope="row">Martiana</th>
													<td>#5182-3423</td>
													<td>15 April 2022</td>
													<td><span class="badge bg-success">Completed</span></td>
												</tr>
												<tr>
													<th scope="row">Alex Carey</th>
													<td>#5182-3456</td>
													<td>17 March 2022</td>
													<td><span class="badge bg-danger">Pending</span></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
						</div>
						<div class="col-xl-6">
							<div class="card">
								<div class="card-header justify-content-between">
									<div class="card-title">
										Striped rows
									</div>
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap table-striped">
											<thead>
												<tr>
													<th scope="col">ID</th>
													<th scope="col">Date</th>
													<th scope="col">Customer</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">2022R-01</th>
													<td>27-010-2022</td>
													<td>Moracco</td>
													<td>
														<button class="btn btn-sm btn-success btn-wave waves-effect waves-light">
															<i class="feather-download align-middle me-2 d-inline-block"></i>Download
														</button>
													</td>
												</tr>
												<tr>
													<th scope="row">2022R-02</th>
													<td>28-10-2022</td>
													<td>Thornton</td>
													<td>
														<button class="btn btn-sm btn-success btn-wave waves-effect waves-light">
															<i class="feather-download align-middle me-2 d-inline-block"></i>Download
														</button>
													</td>
												</tr>
												<tr>
													<th scope="row">2022R-03</th>
													<td>22-10-2022</td>
													<td>Larry Bird</td>
													<td>
														<button class="btn btn-sm btn-success btn-wave waves-effect waves-light">
															<i class="feather-download align-middle me-2 d-inline-block"></i>Download
														</button>
													</td>
												</tr>
												<tr>
													<th scope="row">2022R-04</th>
													<td>29-09-2022</td>
													<td>Erica Sean</td>
													<td>
														<button class="btn btn-sm btn-success btn-wave waves-effect waves-light">
															<i class="feather-download align-middle me-2 d-inline-block"></i>Download
														</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
						</div>

						<div class="col-xl-6">
							<div class="card">
								<div class="card-header justify-content-between">
									<div class="card-title">
										Striped columns
									</div>
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap table-striped-columns">
											<thead>
												<tr>
													<th scope="col">ID</th>
													<th scope="col">Date</th>
													<th scope="col">Customer</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">2022R-01</th>
													<td>27-010-2022</td>
													<td>Moracco</td>
													<td>
														<button class="btn btn-sm btn-danger btn-wave waves-effect waves-light">
															<i class="feather-trash align-middle me-2 d-inline-block"></i>Delete
														</button>
													</td>
												</tr>
												<tr>
													<th scope="row">2022R-02</th>
													<td>28-10-2022</td>
													<td>Thornton</td>
													<td>
														<button class="btn btn-sm btn-danger btn-wave waves-effect waves-light">
															<i class="feather-trash align-middle me-2 d-inline-block"></i>Delete
														</button>
													</td>
												</tr>
												<tr>
													<th scope="row">2022R-03</th>
													<td>22-10-2022</td>
													<td>Larry Bird</td>
													<td>
														<button class="btn btn-sm btn-danger btn-wave waves-effect waves-light">
															<i class="feather-trash align-middle me-2 d-inline-block"></i>Delete
														</button>
													</td>
												</tr>
												<tr>
													<th scope="row">2022R-04</th>
													<td>29-09-2022</td>
													<td>Erica Sean</td>
													<td>
														<button class="btn btn-sm btn-danger btn-wave waves-effect waves-light">
															<i class="feather-trash align-middle me-2 d-inline-block"></i>Delete
														</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
						</div>
						<div class="col-xl-6">
							<div class="card">
								<div class="card-header justify-content-between">
									<div class="card-title">
										Small Tables
									</div>
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap table-sm">
											<thead>
												<tr>
													<th scope="col">Invoice</th>
													<th scope="col">Created Date</th>
													<th scope="col">Status</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">
														<div class="form-check">
															<input class="form-check-input" type="checkbox" value="" id="checkebox-sm" checked="">
															<label class="form-check-label" for="checkebox-sm">
																Zelensky
															</label>
														</div>
													</th>
													<td>25-Apr-2021</td>
													<td><span class="badge bg-soft-success">Paid</span></td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"><i class="feather-edit"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<div class="form-check">
															<input class="form-check-input" type="checkbox" value="" id="checkebox-sm1">
															<label class="form-check-label" for="checkebox-sm1">
																Kim Jong
															</label>
														</div>
													</th>
													<td>29-April-2022</td>
													<td><span class="badge bg-soft-danger">Pending</span></td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"><i class="feather-edit"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<div class="form-check">
															<input class="form-check-input" type="checkbox" value="" id="checkebox-sm2">
															<label class="form-check-label" for="checkebox-sm2">
																Obana
															</label>
														</div>
													</th>
													<td>30-Nov-2022</td>
													<td><span class="badge bg-soft-success">Paid</span></td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"><i class="feather-edit"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<div class="form-check">
															<input class="form-check-input" type="checkbox" value="" id="checkebox-sm3">
															<label class="form-check-label" for="checkebox-sm3">
																Sean Paul
															</label>
														</div>
													</th>
													<td>01-Jan-2022</td>
													<td><span class="badge bg-soft-success">Paid</span></td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"><i class="feather-edit"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">
														<div class="form-check">
															<input class="form-check-input" type="checkbox" value="" id="checkebox-sm4">
															<label class="form-check-label" for="checkebox-sm4">
																Karizma
															</label>
														</div>
													</th>
													<td>14-Feb-2022</td>
													<td><span class="badge bg-soft-danger">Pending</span></td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"><i class="feather-edit"></i></a>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
						</div><div class="col-xl-6">
							<div class="card">
								<div class="card-header justify-content-between">
									<div class="card-title">
										Table Head Primary
									</div>
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap">
											<thead class="table-primary">
												<tr>
													<th scope="col">User Name</th>
													<th scope="col">Transaction Id</th>
													<th scope="col">Created</th>
													<th scope="col">Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">Harshrath</th>
													<td>#5182-3467</td>
													<td>24 May 2022</td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-success rounded-pill"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-info rounded-pill"><i class="feather-edit"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-danger rounded-pill"><i class="feather-trash"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">Zozo Hadid</th>
													<td>#5182-3412</td>
													<td>02 July 2022</td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-success rounded-pill"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-info rounded-pill"><i class="feather-edit"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-danger rounded-pill"><i class="feather-trash"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">Martiana</th>
													<td>#5182-3423</td>
													<td>15 April 2022</td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-success rounded-pill"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-info rounded-pill"><i class="feather-edit"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-danger rounded-pill"><i class="feather-trash"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													<th scope="row">Alex Carey</th>
													<td>#5182-3456</td>
													<td>17 March 2022</td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-success rounded-pill"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-info rounded-pill"><i class="feather-edit"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-soft-danger rounded-pill"><i class="feather-trash"></i></a>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="col-xl-12">
							<div class="card">
								<div class="card-header justify-content-between">
									<div class="card-title">Hoverable Rows</div>
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap table-hover">
											<thead>
												<tr>
													<th scope="col">Product Manager</th>
													<th scope="col">Category</th>
													<th scope="col">Team</th>
													<th scope="col">Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<div class="d-flex align-items-center">
															<div class="avatar avatar-sm me-2 avatar-rounded">
																<img src="assets/img/avatar/avatar-10.jpg" alt="img">
															</div>
															<div>
																<div class="lh-1">
																	<span>Joanna Smith</span>
																</div>
																<div class="lh-1">
																	<span class="fs-11 text-muted">joannasmith14@gmail.com</span>
																</div>
															</div>
														</div>
													</td>
													<td><span class="badge bg-soft-primary">Fashion</span></td>
													<td>
														<div class="avatar-list-stacked">
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-2.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-8.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-2.jpg" alt="img">
															</span>
															<a class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded" href="javascript:void(0);">
																+5
															</a>
														</div>
													</td>
													<td>
														<div class="progress progress-xs">
															<div class="progress-bar bg-primary" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100">
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="d-flex align-items-center">
															<div class="avatar avatar-sm me-2 avatar-rounded">
																<img src="assets/img/avatar/avatar-2.jpg" alt="img">
															</div>
															<div>
																<div class="lh-1">
																	<span>Kara Kova</span>
																</div>
																<div class="lh-1">
																	<span class="fs-11 text-muted">milesakara@gmail.com</span>
																</div>
															</div>
														</div>
													</td>
													<td><span class="badge bg-soft-warning">Clothing</span></td>
													<td>
														<div class="avatar-list-stacked">
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-4.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-6.jpg" alt="img">
															</span>
															<a class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded" href="javascript:void(0);">
																+6
															</a>
														</div>
													</td>
													<td>
														<div class="progress progress-xs">
															<div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="d-flex align-items-center">
															<div class="avatar avatar-sm me-2 avatar-rounded">
																<img src="assets/img/avatar/avatar-16.jpg" alt="img">
															</div>
															<div>
																<div class="lh-1">
																	<span>Donald Trimb</span>
																</div>
																<div class="lh-1">
																	<span class="fs-11 text-muted">donaldo21@gmail.com</span>
																</div>
															</div>
														</div>
													</td>
													<td><span class="badge bg-soft-dark">Electronics</span></td>
													<td>
														<div class="avatar-list-stacked">
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-1.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-11.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-15.jpg" alt="img">
															</span>
															<a class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded" href="javascript:void(0);">
																+2
															</a>
														</div>
													</td>
													<td>
														<div class="progress progress-xs">
															<div class="progress-bar bg-primary" role="progressbar" style="width: 17%" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100">
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<div class="d-flex align-items-center">
															<div class="avatar avatar-sm me-2 avatar-rounded">
																<img src="assets/img/avatar/avatar-13.jpg" alt="img">
															</div>
															<div>
																<div class="lh-1">
																	<span>Justin Gaethje</span>
																</div>
																<div class="lh-1">
																	<span class="fs-11 text-muted">justingae@gmail.com</span>
																</div>
															</div>
														</div>
													</td>
													<td><span class="badge bg-soft-danger">Sports</span></td>
													<td>
														<div class="avatar-list-stacked">
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-4.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-6.jpg" alt="img">
															</span>
															<a class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded" href="javascript:void(0);">
																+5
															</a>
														</div>
													</td>
													<td>
														<div class="progress progress-xs">
															<div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100">
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>								
							</div>
						</div>
						<div class="col-xl-6">
							<div class="card">
								<div class="card-header justify-content-between">
									<div class="card-title">
										Hoverable rows With striped rows
									</div>
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap table-striped table-hover">
											<thead>
												<tr>
													<th scope="col">Invoice</th>
													<th scope="col">Customer</th>
													<th scope="col">Status</th>
													<th scope="col">Date</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">IN-2032</th>
													<td>
														<div class="d-flex align-items-center">
															<div class="avatar avatar-sm me-2 avatar-rounded">
																<img src="assets/img/avatar/avatar-15.jpg" alt="img">
															</div>
															<div>
																<div class="lh-1">
																	<span>Mark Cruise</span>
																</div>
																<div class="lh-1">
																	<span class="fs-11 text-muted">markcruise24@gmail.com</span>
																</div>
															</div>
														</div>
													</td>
													<td><span class="badge bg-soft-success"><i class="ri-check-fill align-middle me-1"></i>Paid</span></td>
													<td>Jul 26,2022</td>
												</tr>
												<tr>
													<th scope="row">IN-2022</th>
													<td>
														<div class="d-flex align-items-center">
															<div class="avatar avatar-sm me-2 avatar-rounded">
																<img src="assets/img/avatar/avatar-12.jpg" alt="img">
															</div>
															<div>
																<div class="lh-1">
																	<span>Charanjeep</span>
																</div>
																<div class="lh-1">
																	<span class="fs-11 text-muted">charanjeep@gmail.in</span>
																</div>
															</div>
														</div>
													</td>
													<td><span class="badge bg-soft-success"><i class="ri-check-fill align-middle me-1"></i>Paid</span></td>
													<td>Mar 14,2022</td>
												</tr>
												<tr>
													<th scope="row">IN-2014</th>
													<td>
														<div class="d-flex align-items-center">
															<div class="avatar avatar-sm me-2 avatar-rounded">
																<img src="assets/img/avatar/avatar-5.jpg" alt="img">
															</div>
															<div>
																<div class="lh-1">
																	<span>Samantha Julie</span>
																</div>
																<div class="lh-1">
																	<span class="fs-11 text-muted">julie453@gmail.com</span>
																</div>
															</div>
														</div>
													</td>
													<td><span class="badge bg-soft-danger"><i class="ri-close-fill align-middle me-1"></i>Cancelled</span>
													</td>
													<td>Feb 1,2022</td>
												</tr>
												<tr>
													<th scope="row">IN-2036</th>
													<td>
														<div class="d-flex align-items-center">
															<div class="avatar avatar-sm me-2 avatar-rounded">
																<img src="assets/img/avatar/avatar-11.jpg" alt="img">
															</div>
															<div>
																<div class="lh-1">
																	<span>Simon Cohen</span>
																</div>
																<div class="lh-1">
																	<span class="fs-11 text-muted">simon@gmail.com</span>
																</div>
															</div>
														</div>
													</td>
													<td><span class="badge bg-light text-dark"><i class="ri-reply-line align-middle me-1"></i>Refunded</span>
													</td>
													<td>Apr 24,2022</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>								
							</div>
						</div>
					</div>
					
					<!-- Always responsive -->
					<div class="row">
						<div class="col-xl-12">
							<div class="card">
								<div class="card-header justify-content-between">
									<div class="card-title">
										Always responsive
									</div>									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap">
											<thead>
												<tr>
													
													<th scope="col">Team Head</th>
													<th scope="col">Category</th>
													<th scope="col">Role</th>
													<th scope="col">Gmail</th>
													<th scope="col">Team</th>
													<th scope="col">Work Progress</th>
													<th scope="col">Revenue</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													
													<td>
														<div class="d-flex align-items-center">
															<span class="avatar avatar-xs me-2 online avatar-rounded">
																<img src="assets/img/avatar/avatar-3.jpg" alt="img">
															</span>Mayor Kelly
														</div>
													</td>
													<td>Manufacturer</td>
													<td><span class="badge bg-soft-primary">Team Lead</span></td>
													<td>mayorkrlly@gmail.com</td>
													<td>
														<div class="avatar-list-stacked">
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-2.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-8.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-2.jpg" alt="img">
															</span>
															<a class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded" href="javascript:void(0);">
																+4
															</a>
														</div>
													</td>
													<td>
														<div class="progress progress-xs">
															<div class="progress-bar bg-primary" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100">
															</div>
														</div>
													</td>
													<td>$10,984.29</td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info"><i class="feather-edit"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													
													<td>
														<div class="d-flex align-items-center">
															<span class="avatar avatar-xs me-2 online avatar-rounded">
																<img src="assets/img/avatar/avatar-12.jpg" alt="img">
															</span>Andrew Garfield
														</div>
													</td>
													<td>Managing Director</td>
													<td><span class="badge bg-soft-warning">Director</span></td>
													<td>andrewgarfield@gmail.com</td>
													<td>
														<div class="avatar-list-stacked">
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-1.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-5.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-11.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-15.jpg" alt="img">
															</span>
															<a class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded" href="javascript:void(0);">
																+4
															</a>
														</div>
													</td>
													<td>
														<div class="progress progress-xs">
															<div class="progress-bar bg-primary" role="progressbar" style="width: 91%" aria-valuenow="91" aria-valuemin="0" aria-valuemax="100">
															</div>
														</div>
													</td>
													<td>$1.4billion</td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info"><i class="feather-edit"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													
													<td>
														<div class="d-flex align-items-center">
															<span class="avatar avatar-xs me-2 online avatar-rounded">
																<img src="assets/img/avatar/avatar-14.jpg" alt="img">
															</span>Simon Cowel
														</div>
													</td>
													<td>Service Manager</td>
													<td><span class="badge bg-soft-success">Manager</span></td>
													<td>simoncowel234@gmail.com</td>
													<td>
														<div class="avatar-list-stacked">
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-6.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-16.jpg" alt="img">
															</span>
															<a class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded" href="javascript:void(0);">
																+10
															</a>
														</div>
													</td>
													<td>
														<div class="progress progress-xs">
															<div class="progress-bar bg-primary" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
															</div>
														</div>
													</td>
													<td>$7,123.21</td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info"><i class="feather-edit"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													
													<td>
														<div class="d-flex align-items-center">
															<span class="avatar avatar-xs me-2 online avatar-rounded">
																<img src="assets/img/avatar/avatar-5.jpg" alt="img">
															</span>Mirinda Hers
														</div>
													</td>
													<td>Recruiter</td>
													<td><span class="badge bg-soft-danger">Employee</span></td>
													<td>mirindahers@gmail.com</td>
													<td>
														<div class="avatar-list-stacked">
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-3.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-10.jpg" alt="img">
															</span>
															<span class="avatar avatar-sm avatar-rounded">
																<img src="assets/img/avatar/avatar-14.jpg" alt="img">
															</span>
															<a class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded" href="javascript:void(0);">
																+6
															</a>
														</div>
													</td>
													<td>
														<div class="progress progress-xs">
															<div class="progress-bar bg-primary" role="progressbar" style="width: 21%" aria-valuenow="21" aria-valuemin="0" aria-valuemax="100">
															</div>
														</div>
													</td>
													<td>$2,325.45</td>
													<td>
														<div class="hstack gap-2 fs-15">
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success"><i class="feather-download"></i></a>
															<a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info"><i class="feather-edit"></i></a>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>								
							</div>
						</div>
					</div>
					<!-- /Always responsive -->
					
					<!-- Primary Table -->
					<div class="row">
						<div class="col-xl-12">
							<div class="card">
								<div class="card-header justify-content-between">
									<div class="card-title">
										Primary Table
									</div>
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table text-nowrap table-primary">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">First</th>
													<th scope="col">Last</th>
													<th scope="col">Handle</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">1</th>
													<td>Mark</td>
													<td>Otto</td>
													<td>@mdo</td>
												</tr>
												<tr>
													<th scope="row">2</th>
													<td>Jacob</td>
													<td>Thornton</td>
													<td>@fat</td>
												</tr>
												<tr>
													<th scope="row">3</th>
													<td>Larry the Bird</td>
													<td>Thornton</td>
													<td>@twitter</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
						</div>						
					</div>
					<!-- /Primary Table -->
					
					<!-- Table Head -->
					<div class="row">
						<div class="col-xl-12">
							<div class="card">
								<div class="card-header justify-content-between">
									<div class="card-title">
										Table head options
									</div>									
								</div>
								<div class="card-body">									
									<div class="table-responsive">
										<table class="table">
											<thead class="thead-primary">
												<tr>
													<th>#</th>
													<th class="w-25">thead-primary</th>
													<th>Last Name</th>
													<th>Username</th>
													<th>Role</th>
												</tr>
											</thead>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table">
											<thead class="thead-secondary">
												<tr>
													<th>#</th>
													<th class="w-25">thead-secondary</th>
													<th>Last Name</th>
													<th>Username</th>
													<th>Role</th>
												</tr>
											</thead>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table">
											<thead class="thead-success">
												<tr>
													<th>#</th>
													<th class="w-25">thead-success</th>
													<th>Last Name</th>
													<th>Username</th>
													<th>Role</th>
												</tr>
											</thead>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table">
											<thead class="thead-warning">
												<tr>
													<th>#</th>
													<th class="w-25">thead-warning</th>
													<th>Last Name</th>
													<th>Username</th>
													<th>Role</th>
												</tr>
											</thead>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table">
											<thead class="thead-info">
												<tr>
													<th>#</th>
													<th class="w-25">thead-info</th>
													<th>Last Name</th>
													<th>Username</th>
													<th>Role</th>
												</tr>
											</thead>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table">
											<thead class="thead-danger">
												<tr>
													<th>#</th>
													<th class="w-25">thead-danger</th>
													<th>Last Name</th>
													<th>Username</th>
													<th>Role</th>
												</tr>
											</thead>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table mb-0">
											<thead class="thead-dark">
												<tr>
													<th>#</th>
													<th class="w-25">thead-dark</th>
													<th>Last Name</th>
													<th>Username</th>
													<th>Role</th>
												</tr>
											</thead>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table mb-0">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th class="w-25">thead-light</th>
													<th>Last Name</th>
													<th>Username</th>
													<th>Role</th>
												</tr>
											</thead>
										</table>
									</div>								
								</div>
							</div>
						</div>
					</div>
					<!-- /Table Head -->					
				</div>			
            </div>
        </div>
        <!-- /Main Wrapper -->
        
		<?php include 'layouts/customizer.php'; ?>	
       
		<?php include 'layouts/vendor-scripts.php'; ?>
	
    </body>
</html>