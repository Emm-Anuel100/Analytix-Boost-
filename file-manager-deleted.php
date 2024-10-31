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


    <div class="page-wrapper notes-page-wrapper file-manager">
				<div class="content">
					<div class="page-header page-add-notes d-flex align-items-center justify-content-between">
						<div class="add-item d-flex align-items-center">
							<div class="page-title">
								<h4>Deleted</h4>
								<h6>Manage your Deleted File</h6>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-3 col-md-12 sidebars-right theiaStickySidebar section-bulk-widget">
							<aside class="card file-manager-sidebar mb-0">
								<h5 class="d-flex align-items-center"><span class="me-2 d-flex align-items-center"><i data-feather="folder" class="feather-20"></i></span>Files</h5>
								<div class="dropdown">
	                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset btn btn-primary mb-3 btn-icon">
	                                    <span class="me-1 btn-icon"><i data-feather="plus-circle" class="feather-16"></i></span>New
	                                </a>
	                                <ul class="dropdown-menu">
	                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="upload-cloud" class="feather-16 me-2"></i>Upload File</a></li>
	                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="folder" class="feather-16 me-2"></i>Upload Folder</a></li>
	                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="folder-minus" class="feather-16 me-2"></i>Create folder</a></li>
	                                </ul>
	                            </div>

								<ul class="mb-5">
									<li><a  href="file-manager.php"><span class="me-2 btn-icon"><i data-feather="file-text" class="feather-16"></i></span>My Files</a></li>
									<li><a  href="javascript:void(0);"><span class="me-2 btn-icon"><i data-feather="star" class="feather-16"></i></span>Google Drive</a></li>
									<li><a  href="javascript:void(0);"><span class="me-2 btn-icon"><i data-feather="send" class="feather-16"></i></span>Dropbox</a></li>
									<li><a  href="file-shared.php"><span class="me-2 btn-icon"><i data-feather="file" class="feather-16"></i></span>Shared With Me</a></li>
									<li><a  href="file-document.php"><span class="me-2 btn-icon"><i data-feather="file" class="feather-16"></i></span>Document</a></li>
									<li><a  href="file-recent.php"><span class="me-2 btn-icon"><i data-feather="clock" class="feather-16"></i></span>Recent</a></li>
									<li><a  href="file-favourites.php"><span class="me-2 btn-icon"><i data-feather="star" class="feather-16"></i></span>Favourites</a></li>
									<li><a  href="file-archived.php"><span class="me-2 btn-icon"><i data-feather="target" class="feather-16"></i></span>Archived</a></li>
									<li><a  href="file-manager-deleted.php" class="active"><span class="me-2 btn-icon"><i data-feather="trash-2" class="feather-16"></i></span>Deleted</a></li>
									<li><a  href="javascript:void(0);"><span class="me-2 btn-icon"><i data-feather="settings" class="feather-16"></i></span>Settings</a></li>
								</ul>
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
										<span class="me-2 btn-icon"><i data-feather="hard-drive" class="feather-16"></i></span>
										<h6>Storage</h6>
									</div>
									<span>70%</span>
								</div>
								<div class="progress my-2">
								  	<div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<span>78.5 GB of 1 TB Free Used</span>
								<div class="space-manager p-4">
									<img src="assets/img/icons/half-circle.svg" alt="Folder">
									<h6><a href="javascript:void(0);">Need More Space?</a></h6>
									<p>Upgrade storage for 2TB for $60 per month</p>
									<a  href="javascript:void(0);" class="btn btn-outline-primary">Upgrade<span class="ms-1 btn-icon"><i data-feather="repeat" class="feather-16"></i></span></a>
								</div>
							</aside>
						</div>

						<div class="col-lg-9 budget-role-notes">

							<div class="alert alert-danger d-flex align-items-center justify-content-between delete-alert" role="alert">
							  <p class="mb-0 text-danger d-flex align-items-center"><i data-feather="info" class="feather-16 me-2"></i>Items in trash will be deleted forever after 30 days</p> <a  href="javascript:void(0);" class="btn btn-secondary" id="file-delete"><i data-feather="trash-2" class="feather-16 me-1"></i>Empty Trash</a>
							</div>
							<div class="card p-4 bg-white all-files mb-0">
								<div class="seprator-lg d-sm-flex align-items-center justify-content-between">
									<h4>All Files</h4>
									<div class="d-flex align-items-center btn-grp">
										<a href="javascript:void(0);" class="btn btn-primary me-2"><i data-feather="list" class="feather-20"></i></a>
										<a href="javascript:void(0);" class="btn btn-outline-secondary me-2"><i data-feather="layout" class="feather-20"></i></a>
										<a href="javascript:void(0);" class="btn btn-outline-secondary me-2"><i data-feather="grid" class="feather-20"></i></a>

										<div class="icon-select me-2">
											<span class="icon"><i data-feather="calendar" class="feather-16"></i></span>
											<select class="select">
												<option>Last Modified</option>
												<option>Last Modified by Me</option>
												<option>Last Opened by Me</option>
											</select>
										</div>

										<div class="icon-select">
											<span class="icon"><i data-feather="file-text" class="feather-16"></i></span>
											<select class="select">
												<option>All File types</option>
												<option>Folders</option>
												<option>PDF</option>
												<option>Images</option>
												<option>Videos</option>
												<option>Audios</option>
												<option>Excel</option>
											</select>
										</div>
									</div>
								</div>

								<div class="table-responsive deleted-table">
									<table class="table datanew">
										<thead>
											<tr>
												<th>
													<label class="checkboxs">
														<input type="checkbox" id="select-all">
														<span class="checkmarks"></span>
													</label>
												</th>
												<th>Name</th>
												<th>Last Modified</th>
												<th>Size</th>
												<th>Owned Memebr</th>
												<th>Action</th>
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
												<td class="productimgname">
													<a href="product-list.php" class="product-img d-flex align-items-center">
														<img src="assets/img/icons/folder.svg" alt="Product" class="me-2">
														<span>Digimed</span>
													</a>
												</td>
												<td>Today 08:30 AM <br>by Angel</td>
												<td>200 MB</td>
												<td>
													<a href="javascript:void(0);" class="product-img d-flex align-items-center">
														<img src="assets/img/avatar/avatar-6.jpg" alt="Product" class="me-2 rounded-circle">
														<span>Nolan Christopher</span>
													</a>
												</td>
												<td>
													<div class="d-flex align-items-center">
							                            <a href="javascript:void(0);" class=""><i data-feather="star" class="feather-16 me-2 color-primary"></i></a>
							                            <div class="dropdown">
							                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
							                                    <i class="fa fa-ellipsis-v"></i>
							                                </a>
							                                <ul class="dropdown-menu">
							                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="trash-2" class="feather-14 me-2"></i>Permanent Delete</a></li>
							                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="edit" class="feather-14 me-2"></i>Restore File</a></li>
							                                </ul>
							                            </div>
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
												<td class="productimgname">
													<a href="product-list.php" class="product-img d-flex align-items-center">
														<img src="assets/img/icons/xls.svg" alt="Product" class="me-2">
														<span>Estimation</span>
													</a>
												</td>
												<td>Today 09:20 AM</td>
												<td>140 MB</td>
												<td>
													<a href="javascript:void(0);" class="product-img d-flex align-items-center">
														<img src="assets/img/avatar/avatar-5.jpg" alt="Product" class="me-2 rounded-circle">
														<span>Nolan Harris</span>
													</a>
												</td>
												<td>
													<div class="d-flex align-items-center">
							                            <a href="javascript:void(0);" class=""><i data-feather="star" class="feather-16 me-2 color-primary"></i></a>
							                            <div class="dropdown">
							                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
							                                    <i class="fa fa-ellipsis-v"></i>
							                                </a>
							                                <ul class="dropdown-menu">
							                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="trash-2" class="feather-14 me-2"></i>Permanent Delete</a></li>
							                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="edit" class="feather-14 me-2"></i>Restore File</a></li>
							                                </ul>
							                            </div>
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
												<td class="productimgname">
													<a href="product-list.php" class="product-img d-flex align-items-center">
														<img src="assets/img/icons/pdf-02.svg" alt="Product" class="me-2">
														<span>Intro.pdf</span>
													</a>
												</td>
												<td>27 July 2023</td>
												<td>70 MB</td>
												<td>
													<a href="javascript:void(0);" class="product-img d-flex align-items-center">
														<img src="assets/img/avatar/avatar-10.jpg" alt="Product" class="me-2 rounded-circle">
														<span>Me</span>
													</a>
												</td>
												<td class="text-end">
													<div class="d-flex align-items-center">
							                            <a href="javascript:void(0);" class=""><i data-feather="star" class="feather-16 me-2 color-primary"></i></a>
							                            <div class="dropdown">
							                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
							                                    <i class="fa fa-ellipsis-v"></i>
							                                </a>
							                                <ul class="dropdown-menu">
							                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="trash-2" class="feather-14 me-2"></i>Permanent Delete</a></li>
							                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="edit" class="feather-14 me-2"></i>Restore File</a></li>
							                                </ul>
							                            </div>
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
												<td class="productimgname">
													<a href="product-list.php" class="product-img d-flex align-items-center">
														<img src="assets/img/icons/video.svg" alt="Product" class="me-2">
														<span>Demoworrking.mp4</span>
													</a>
												</td>
												<td>24 July 2023<br>08:25 AM</td>
												<td>180 MB</td>
												<td>
													<a href="javascript:void(0);" class="product-img d-flex align-items-center">
														<img src="assets/img/avatar/avatar-2.jpg" alt="Product" class="me-2 rounded-circle">
														<span>Daniel</span>
													</a>
												</td>
												<td>
													<div class="d-flex align-items-center">
							                            <a href="javascript:void(0);" class=""><i data-feather="star" class="feather-16 me-2 color-primary"></i></a>
							                            <div class="dropdown">
							                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
							                                    <i class="fa fa-ellipsis-v"></i>
							                                </a>
							                                <ul class="dropdown-menu">
							                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="trash-2" class="feather-14 me-2"></i>Permanent Delete</a></li>
							                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="edit" class="feather-14 me-2"></i>Restore File</a></li>
							                                </ul>
							                            </div>
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
												<td class="productimgname">
													<a href="product-list.php" class="product-img d-flex align-items-center">
														<img src="assets/img/icons/audio.svg" alt="Product" class="me-2">
														<span>voice.mp3</span>
													</a>
												</td>
												<td>27 July 2023</td>
												<td>80 MB</td>
												<td>
													<a href="javascript:void(0);" class="product-img d-flex align-items-center">
														<img src="assets/img/avatar/avatar-7.jpg" alt="Product" class="me-2 rounded-circle">
														<span>Henriques</span>
													</a>
												</td>
												<td class="text-end">
													<div class="d-flex align-items-center">
							                            <a href="javascript:void(0);" class=""><i data-feather="star" class="feather-16 me-2 color-primary"></i></a>
							                            <div class="dropdown">
							                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
							                                    <i class="fa fa-ellipsis-v"></i>
							                                </a>
							                                <ul class="dropdown-menu">
							                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="trash-2" class="feather-14 me-2"></i>Permanent Delete</a></li>
							                                    <li><a href="javascript:void(0);" class="dropdown-item"><i data-feather="edit" class="feather-14 me-2"></i>Restore File</a></li>
							                                </ul>
							                            </div>
							                        </div>
												</td>
											</tr>
											
										</tbody>
									</table>
								</div>

								<div class="deleted-info text-center p-4">
									<div class="bin-bg d-flex align-items-center justify-content-center">
										<img src="assets/img/icons/trash-bin.svg" class="me-2" alt="img">
									</div>
									<h6 class="mt-3">Trash is Empty</h6>
									<p>Items moved to the trash will be deleted forever after 30 days</p>
								</div>

							</div>

						</div>
					</div>
				</div>
				<!-- /Content -->
			</div>

    </div>
<!-- end main Wrapper-->
<?php include 'layouts/customizer.php'; ?>
<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>