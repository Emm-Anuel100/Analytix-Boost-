	<!-- Sidebar -->
        <div class="sidebar horizontal-sidebar">
				<div id="sidebar-menu-3" class="sidebar-menu">
					<ul class="nav">
						<li class="submenu">
							<a href="index.php" class="<?php echo ($page =='index.php'||$page =='sales-dashboard.php'||$page =='chat.php'||$page =='video-call.php'||$page =='audio-call.php'||$page =='call-history.php'||$page =='calendar.php'||$page =='email.php'||$page =='todo.php'||$page =='notes.php'||$page =='file-manager.php'||$page == 'file-archived.php'||$page =='file-document.php'||$page =='file-favourites.php'||$page =='file-manager-seleted.php'||$page =='file-recent.php'||$page =='file-shared.php'||$page =='file-manager-deleted.php') ? 'active subdrop' : '' ;?>"><i data-feather="grid"></i><span> Main Menu</span> <span class="menu-arrow"></span></a>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='index.php'||$page =='sales-dashboard.php') ? 'active subdrop' : '' ;?>"><span>Dashboard</span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="index.php"class="<?php echo ($page =='index.php') ? 'active' : '' ;?>">Administration</a></li>
										<li><a href="sales-dashboard.php"class="<?php echo ($page =='sales-dashboard.php') ? 'active' : '' ;?>">Sales</a></li>
									</ul>
								</li>  							
							</ul>
						</li>
						<li  class="submenu">
							<a href="javascript:void(0);"class="<?php echo ($page =='product-list.php'||$page =='product-details.php'||$page =='add-product.php'||$page =='edit-product.php'||$page =='expired-products.php'||$page =='low-stocks.php'||$page =='category-list.php'||$page =='sub-categories.php'||$page =='brand-list.php'||$page =='units.php'||$page =='varriant-attributes.php'||$page =='warranty.php'||$page =='barcode.php'||$page =='qrcode.php') ? 'active subdrop' : '' ;?>"><img src="assets/img/icons/product.svg" alt="img"><span> Inventory </span> <span class="menu-arrow"></span></a>
							<ul>
								<li><a href="product-list.php" class="<?php echo ($page =='product-list.php'||$page =='product-details.php') ? 'active' : '' ;?>"><span>Products</span></a></li>
								<li><a href="add-product.php"class="<?php echo ($page =='add-product.php'||$page =='edit-product.php') ? 'active' : '' ;?>"><span>Create Product</span></a></li>
								<li><a href="expired-products.php"class="<?php echo ($page =='expired-products.php') ? 'active' : '' ;?>"><span>Expired Products</span></a></li>
								<li><a href="low-stocks.php"class="<?php echo ($page =='low-stocks.php') ? 'active' : '' ;?>"><span>Low Stocks</span></a></li>
								<li><a href="category-list.php"class="<?php echo ($page =='category-list.php') ? 'active' : '' ;?>" ><span>Category</span></a></li>
								<li><a href="brand-list.php"class="<?php echo ($page =='brand-list.php') ? 'active' : '' ;?>"><span>Brands</span></a></li>
								<li><a href="units.php"class="<?php echo ($page =='units.php') ? 'active' : '' ;?>"><span>Units</span></a></li>								
							</ul>
						</li>
						<li class="submenu">
							<a href="javascript:void(0);"class="<?php echo ($page =='sales-list.php'||$page =='sales-returns.php'||$page =='quotation-list.php'||$page =='pos.php'||$page =='coupons.php'||$page =='purchase-list.php'||$page =='purchase-order-report.php'||$page =='purchase-returns.php'||$page =='manage-stocks.php'||$page =='stock-adjustment.php'||$page =='stock-transfer.php'||$page =='expense-list.php'||$page =='expense-category.php') ? 'active subdrop' : '' ;?>"><img src="assets/img/icons/purchase1.svg" alt="img"><span>Sales &amp; Purchase</span> <span class="menu-arrow"></span></a>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='sales-list.php'||$page =='invoice-report.php'||$page =='sales-returns.php'||$page =='quotation-list.php'||$page =='pos.php'||$page =='coupons.php') ? 'active subdrop ' : '' ;?>"><span>Sales</span><span class="menu-arrow"></span></a>
									<ul>	
										<li><a href="sales-list.php"class="<?php echo ($page =='sales-list.php') ? 'active' : '' ;?>"><span>Sales</span></a></li>
										<li><a href="invoice-report.php"class="<?php echo ($page =='invoice-report.php') ? 'active' : '' ;?>"><span>Invoices</span></a></li>
										<li><a href="sales-returns.php"class="<?php echo ($page =='sales-returns.php') ? 'active' : '' ;?>"><span>Sales Return</span></a></li>	
										<li><a href="quotation-list.php"class="<?php echo ($page =='quotation-list.php') ? 'active' : '' ;?>"><span>Quotation</span></a></li>								
										<li><a href="pos.php"class="<?php echo ($page =='pos.php') ? 'active' : '' ;?>"><span>POS</span></a></li>
										<li><a href="coupons.php"class="<?php echo ($page =='coupons.php') ? 'active' : '' ;?>"><span>Coupons</span></a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='purchase-list.php'||$page =='purchase-order-report.php'||$page =='purchase-returns.php'||$page =='manage-stocks.php'||$page =='stock-adjustment.php'||$page =='stock-transfer.php') ? 'active subdrop' : '' ;?>"><span>Purchase</span><span class="menu-arrow"></span></a>
									<ul>	
										<li><a href="purchase-list.php"class="<?php echo ($page =='purchase-list.php') ? 'active' : '' ;?>"><span>Purchases</span></a></li>
										<li><a href="purchase-order-report.php"class="<?php echo ($page =='purchase-order-report.php') ? 'active' : '' ;?>"><span>Purchase Order</span></a></li>
										<li><a href="purchase-returns.php"class="<?php echo ($page =='purchase-returns.php') ? 'active' : '' ;?>"><span>Purchase Return</span></a></li>	
										<li><a href="manage-stocks.php"class="<?php echo ($page =='manage-stocks.php') ? 'active' : '' ;?>"><span>Manage Stock</span></a></li>
										<li><a href="stock-adjustment.php"class="<?php echo ($page =='stock-adjustment.php') ? 'active' : '' ;?>"><span>Stock Adjustment</span></a></li>
										<li><a href="stock-transfer.php"class="<?php echo ($page =='stock-transfer.php') ? 'active' : '' ;?>"><span>Stock Transfer</span></a></li>	
									</ul>
								</li>						
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='expense-list.php'||$page =='expense-category.php') ? 'active subdrop' : '' ;?>"><span>Expenses</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="expense-list.php"class="<?php echo ($page =='expense-list.php') ? 'active' : '' ;?>">Expenses</a></li>
										<li><a href="expense-category.php"class="<?php echo ($page =='expense-category.php') ? 'active' : '' ;?>">Expense Category</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="submenu">
							<a href="javascript:void(0);" class="<?php echo ($page =='customers.php'||$page =='suppliers.php'||$page =='store-list.php'||$page =='warehouse.php'||$page =='roles-permissions.php'||$page =='permissions.php'||$page =='delete-account.php'||$page =='ui-alerts.php'||$page =='ui-accordion.php'||$page =='ui-avatar.php'||$page =='ui-badges.php'||$page =='ui-borders.php'||$page =='ui-buttons.php'||$page =='ui-buttons-group.php'||$page =='ui-breadcrumb.php'||$page =='ui-cards.php'||$page =='ui-carousel.php'||$page =='ui-colors.php'
                                                                       ||$page =='ui-dropdowns.php'||$page =='ui-grid.php'||$page =='ui-images.php'||$page =='ui-lightbox.php'||$page =='ui-media.php'||$page =='ui-modals.php'||$page =='ui-offcanvas.php'||$page =='ui-pagination.php'||$page =='ui-popovers.php'||$page =='ui-progress.php'||$page =='ui-placeholders.php'||$page =='ui-rangeslider.php'||$page =='ui-spinner.php'
                                                                       ||$page =='ui-sweetalerts.php'||$page =='ui-nav-tabs.php'||$page =='ui-toasts.php'||$page =='ui-tooltips.php'||$page =='ui-typography.php'||$page =='ui-video.php'||$page =='ui-counter.php'||$page =='ui-scrollbar.php'||$page =='ui-spinner.php'||$page =='ui-activities.php'||$page =='ui-lightbox.php'||$page =='ui-stickynote.php'||$page =='ui-timeline.php'||$page =='ui-form-wizard.php'||$page =='chart-apex.php'||$page =='chart-c3.php'||$page =='chart-js.php'||$page =='chart-morris.php'||$page =='chart-flot.php'||$page =='chart-peity.php'||$page =='icon-fontawesome.php'||$page =='icon-feather.php'||$page =='icon-ionic.php'||$page =='icon-material.php'||$page =='icon-pe7.php'
                                                                       ||$page =='icon-simpleline.php'||$page =='icon-themify.php'||$page =='icon-weather.php'||$page =='icon-typicon.php'||$page =='icon-flag.php'||$page =='form-basic-inputs.php'||$page =='form-checkbox-radios.php'||$page =='form-input-groups.php'||$page =='form-grid-gutters.php'||$page =='form-select.php'||$page =='form-mask.php'||$page =='form-fileupload.php'||$page =='form-horizontal.php'||$page =='form-vertical.php'||$page =='form-floating-labels.php'||$page =='form-validation.php'||$page =='form-select2.php'||$page =='form-wizard.php'||$page =='tables-basic.php'||$page =='data-tables.php'||$page=='activities.php') ? 'active subdrop' : '' ;?>"><img src="assets/img/icons/users1.svg" alt="img"><span>User Management</span> <span class="menu-arrow"></span></a>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='customers.php'||$page =='suppliers.php'||$page =='store-list.php'||$page =='warehouse.php') ? 'active subdrop' : '' ;?>"><span>People</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="customers.php"class="<?php echo ($page =='customers.php') ? 'active' : '' ;?>"><span>Customers</span></a></li>
										<li><a href="suppliers.php"class="<?php echo ($page =='suppliers.php') ? 'active' : '' ;?>"><span>Suppliers</span></a></li>
										<li><a href="store-list.php"class="<?php echo ($page =='store-list.php') ? 'active' : '' ;?>"><span>Stores</span></a></li>
										<li><a href="warehouse.php"class="<?php echo ($page =='warehouse.php') ? 'active' : '' ;?>"><span>Warehouses</span></a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='roles-permissions.php'||$page =='delete-account.php'||$page =='permissions.php') ? 'active' : '' ;?>"><span>Roles &amp; Permissions</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="roles-permissions.php"class="<?php echo ($page =='roles-permissions.php'||$page =='permissions.php') ? 'active' : '' ;?>"><span>Roles & Permissions</span></a></li>
								<li><a href="delete-account.php"class="<?php echo ($page =='delete-account.php') ? 'active' : '' ;?>"><span>Delete Account Request</span></a></li>
								
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='employees-grid.php'||$page=='add-employee.php'||$page=='edit-employee.php'||$page=='employees-list.php'||$page =='department-grid.php'||$page=='department-list.php'||$page =='designation.php'||$page =='shift.php') ? 'active' : '' ;?>"><span>Employees</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="employees-grid.php"class="<?php echo ($page =='employees-grid.php'||$page=='add-employee.php'||$page=='edit-employee.php'||$page=='employees-list.php') ? 'active' : '' ;?>"><span>Employees</span></a></li>
										<li><a href="department-grid.php"class="<?php echo ($page =='department-grid.php'||$page=='department-list.php') ? 'active' : '' ;?>"><span>Departments</span></a></li>
										<li><a href="designation.php"class="<?php echo ($page =='designation.php') ? 'active' : '' ;?>"><span>Designation</span></a></li>
										<li><a href="shift.php"class="<?php echo ($page =='shift.php') ? 'active' : '' ;?>"><span>Shifts</span></a></li>	
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='attendance-employee.php'||$page =='attendance-admin.php') ? 'active' : '' ;?>"><span>Attendence</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="attendance-employee.php"class="<?php echo ($page =='attendance-employee.php') ? 'active' : '' ;?>">Employee Attendence</a></li>
										<li><a href="attendance-admin.php"class="<?php echo ($page =='attendance-admin.php') ? 'active' : '' ;?>">Admin Attendence</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='leaves-admin.php'||$page =='leaves-employee.php'||$page =='leave-types.php'||$page =='holidays.php') ? 'active subdrop' : '' ;?>"><span>Leaves &amp; Holidays</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="leaves-admin.php"class="<?php echo ($page =='leaves-admin.php') ? 'active' : '' ;?>">Admin Leaves</a></li>
										<li><a href="leaves-employee.php"class="<?php echo ($page =='leaves-employee.php') ? 'active' : '' ;?>">Employee Leaves</a></li>
										<li><a href="leave-types.php"class="<?php echo ($page =='leave-types.php') ? 'active' : '' ;?>">Leave Types</a></li>
										<li><a href="holidays.php"class="<?php echo ($page =='holidays.php') ? 'active' : '' ;?>"><span>Holidays</span></a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="payroll-list.php"class="<?php echo ($page =='payroll-list.php'||$page =='payslip.php') ? 'active' : '' ;?>"><span>Payroll</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="payroll-list.php"class="<?php echo ($page =='payroll-list.php') ? 'active' : '' ;?>">Employee Salary</a></li>
										<li><a href="payslip.php"class="<?php echo ($page =='payslip.php') ? 'active' : '' ;?>">Payslip</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="submenu">
							<a href="javascript:void(0);"class="<?php echo ($page =='sales-report.php'||$page =='purchase-report.php'||$page =='inventory-report.php'||$page =='invoice-report.php'||$page =='supplier-report.php'||$page =='customer-report.php'||$page =='expense-report.php'||$page =='income-report.php'||$page =='tax-reports.php'||$page =='profit-and-loss.php') ? 'active subdrop' : '' ;?>"><img src="assets/img/icons/printer.svg" alt="img"><span>Reports</span> <span class="menu-arrow"></span></a>
							<ul>
								<li><a href="sales-report.php"class="<?php echo ($page =='sales-report.php') ? 'active' : '' ;?>"><span>Sales Report</span></a></li>
								<li><a href="purchase-report.php"class="<?php echo ($page =='purchase-report.php') ? 'active' : '' ;?>"><span>Purchase report</span></a></li>
								<li><a href="inventory-report.php"class="<?php echo ($page =='inventory-report.php') ? 'active' : '' ;?>"><span>Inventory Report</span></a></li>									
								<li><a href="invoice-report.php"class="<?php echo ($page =='invoice-report.php') ? 'active' : '' ;?>"><span>Invoice Report</span></a></li>
								<li><a href="supplier-report.php"class="<?php echo ($page =='supplier-report.php') ? 'active' : '' ;?>"><span>Supplier Report</span></a></li>
								<li><a href="customer-report.php"class="<?php echo ($page =='customer-report.php') ? 'active' : '' ;?>"><span>Customer Report</span></a></li>
								<li><a href="expense-report.php"class="<?php echo ($page =='expense-report.php') ? 'active' : '' ;?>"><span>Expense Report</span></a></li>
								<li><a href="income-report.php"class="<?php echo ($page =='income-report.php') ? 'active' : '' ;?>"><span>Income Report</span></a></li>
								<li><a href="tax-reports.php"class="<?php echo ($page =='tax-reports.php') ? 'active' : '' ;?>"><span>Tax Report</span></a></li>
								<li><a href="profit-and-loss.php"class="<?php echo ($page =='profit-and-loss.php') ? 'active' : '' ;?>"><span>Profit & Loss</span></a></li>
							</ul>
						</li>
						
						<li class="submenu">
							<a href="javascript:void(0);"class="<?php echo ($page =='general-settings.php'||$page =='security-settings.php'||$page =='notification.php'||$page =='connected-apps.php'||$page =='system-settings.php'||$page =='company-settings.php'||$page =='localization-settings.php'||$page =='prefixes.php'||$page =='preference.php'||$page =='appearance.php'||$page =='social-authentication.php'||$page =='language-settings.php'||$page=='language-settings-web.php'
							||$page =='invoice-settings.php'||$page =='printer-settings.php'||$page =='pos-settings.php'||$page =='custom-fields.php'||$page =='email-settings.php'||$page =='sms-gateway.php'||$page =='otp-settings.php'||$page =='gdpr-settings.php'||$page =='payment-gateway-settings.php'||$page =='bank-settings-grid.php'||$page=='bank-settings-list.php'||$page =='tax-rates.php'||$page =='currency-settings.php'||$page =='storage-settings.php'||$page =='ban-ip-address.php') ? 'active' : '' ;?>"><img src="assets/img/icons/settings.svg" alt="img"><span> Settings</span> <span class="menu-arrow"></span></a>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='general-settings.php'||$page =='security-settings.php'||$page =='notification.php'||$page =='connected-apps.php') ? 'active' : '' ;?>"><span>General Settings</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="general-settings.php" class="<?php echo ($page == 'general-settings.php')?'active':'';?>">Countdowns</a></li>
										<!-- <li><a href="security-settings.php" class="<?php echo ($page == 'security-settings.php')?'active':'';?>">Security</a></li>
										<li><a href="notification.php"class="<?php echo ($page == 'notification.php')?'active':'';?>">Notifications</a></li> -->
										<li><a href="connected-apps.php"class="<?php echo ($page == 'connected-apps.php')?'active':'';?>">Connected Apps</a></li>
									</ul>
								</li>
								<li class="submenu">
							   <a href="javascript:void(0);" class="<?php echo ($page == 'system-settings.php'||$page == 'company-settings.php'||$page == 'localization-settings.php'||$page == 'prefixes.php'||$page == 'preference.php'||$page == 'appearance.php'||$page == 'social-authentication.php'||$page == 'language-settings.php')?'active subdrop':'';?>"><i data-feather="airplay"></i><span>Website Settings</span><span class="menu-arrow"></span></a>
							   <ul>
									<!-- <li><a href="system-settings.php" class="<?php echo ($page == 'system-settings.php')?'active':'';?>">System Settings</a></li> -->
									<li><a href="company-settings.php"class="<?php echo ($page == 'company-settings.php')?'active':'';?>">Company Settings </a></li>
									<li><a href="localization-settings.php"class="<?php echo ($page == 'localization-settings.php')?'active':'';?>">Localization</a></li>
									<!-- <li><a href="prefixes.php"class="<?php echo ($page == 'prefixes.php')?'active':'';?>">Prefixes</a></li>
									<li><a href="preference.php"class="<?php echo ($page == 'preference.php')?'active':'';?>">Preference</a></li>
									<li><a href="appearance.php"class="<?php echo ($page == 'appearance.php')?'active':'';?>">Appearance</a></li>
									<li><a href="social-authentication.php"class="<?php echo ($page == 'social-authentication.php')?'active':'';?>">Social Authentication</a></li> -->
									<!-- <li><a href="language-settings.php"class="<?php echo ($page == 'language-settings.php')?'active':'';?>">Language</a></li> -->
						    	</ul>
						     </li>
							  
								<!-- <li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='email-settings.php'||$page =='sms-gateway.php'||$page =='otp-settings.php'||$page =='gdpr-settings.php') ? 'active subdrop' : '' ;?>"><span>System Settings</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="email-settings.php"class="<?php echo ($page =='email-settings.php') ? 'active' : '' ;?>">Email</a></li>
										<li><a href="sms-gateway.php"class="<?php echo ($page =='sms-gateway.php') ? 'active' : '' ;?>">SMS Gateways</a></li>
										<li><a href="otp-settings.php"class="<?php echo ($page =='otp-settings.php') ? 'active' : '' ;?>">OTP</a></li>
										<li><a href="gdpr-settings.php"class="<?php echo ($page =='gdpr-settings.php') ? 'active' : '' ;?>">GDPR Cookies</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='payment-gateway-settings.php'||$page =='bank-settings-grid.php'||$page =='tax-rates.php'||$page =='currency-settings.php'||$page=='bank-settings-list.php') ? 'active' : '' ;?>"><span>Financial Settings</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="payment-gateway-settings.php"class="<?php echo ($page =='payment-gateway-settings.php') ? 'active' : '' ;?>">Payment Gateway</a></li>
										<li><a href="bank-settings-grid.php"class="<?php echo ($page =='bank-settings-grid.php'||$page=='bank-settings-list.php') ? 'active' : '' ;?>">Bank Accounts</a></li>
										<li><a href="tax-rates.php"class="<?php echo ($page =='tax-rates.php') ? 'active' : '' ;?>">Tax Rates</a></li>
										<li><a href="currency-settings.php"class="<?php echo ($page =='currency-settings.php') ? 'active' : '' ;?>">Currencies</a></li>
									</ul>
								</li> -->
								<li class="submenu">
									<a href="javascript:void(0);"class="<?php echo ($page =='storage-settings.php'||$page =='ban-ip-address.php') ? 'active' : '' ;?>"><i data-feather="layout"></i><span>Other Settings</span><span class="menu-arrow"></span></a>
									<ul>
										<li><a href="storage-settings.php"class="<?php echo ($page =='storage-settings.php') ? 'active' : '' ;?>">Storage</a></li>
										<li><a href="ban-ip-address.php"class="<?php echo ($page =='ban-ip-address.php') ? 'active' : '' ;?>">Ban IP Address</a></li>
									</ul>
								</li>
								</li>
							</ul>
						</li> 
					</ul>
				</div>
		</div>
	<!-- /Sidebar -->
