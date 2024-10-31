<?php
    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
    $page = end($link_array);
?>
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page =='index.php'||$page == '/'||$page == 'sales-dashboard.php') ? 'active subdrop' : '' ;?>"><i
                                    data-feather="grid"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="index.php"
                                        class="<?php echo ($page =='index.php'||$page == '/') ? 'active' : '' ;?>">Administration</a></li>
                                <li><a href="sales-dashboard.php"
                                        class="<?php echo ($page =='sales-dashboard.php') ? 'active' : '' ;?>">Sales</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Inventory</h6>
                    <ul>
                        <li class="<?php echo ($page =='product-list.php'||$page =='product-details.php') ? 'active' : '' ;?>"><a
                                href="product-list.php"><i data-feather="box"></i><span>Products</span></a>
                        </li>
                        <li class="<?php echo ($page =='add-product.php'||$page =='edit-product.php') ? 'active' : '' ;?>"><a
                                href="add-product.php"><i data-feather="plus-square"></i><span>Create
                                    Product</span></a></li>
                        <li class="<?php echo ($page =='expired-products.php') ? 'active' : '' ;?>"><a
                                href="expired-products.php"><i data-feather="codesandbox"></i><span>Expired
                                    Products</span></a></li>
                        <li class="<?php echo ($page =='low-stocks.php') ? 'active' : '' ;?>"><a
                                href="low-stocks.php"><i data-feather="trending-down"></i><span>Low
                                    Stocks</span></a></li>
                        <li class="<?php echo ($page =='category-list.php') ? 'active' : '' ;?>"><a
                                href="category-list.php"><i
                                    data-feather="codepen"></i><span>Category</span></a></li>
                        <li class="<?php echo ($page =='brand-list.php') ? 'active' : '' ;?>"><a
                                href="brand-list.php"><i data-feather="tag"></i><span>Brands</span></a></li>
                        <li class="<?php echo ($page =='units.php') ? 'active' : '' ;?>"><a href="units.php"><i
                                    data-feather="speaker"></i><span>Units</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Stock</h6>
                    <ul>
                        <li class="<?php echo ($page =='manage-stocks.php') ? 'active' : '' ;?>"><a
                                href="manage-stocks.php"><i data-feather="package"></i><span>Manage
                                    Stock</span></a></li>
                        <li class="<?php echo ($page =='stock-adjustment.php') ? 'active' : '' ;?>"><a
                                href="stock-adjustment.php"><i data-feather="clipboard"></i><span>Stock
                                    Adjustment</span></a></li>
                        <li class="<?php echo ($page =='stock-transfer.php') ? 'active' : '' ;?>"><a
                                href="stock-transfer.php"><i data-feather="truck"></i><span>Stock
                                    Transfer</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Sales</h6>
                    <ul>
                        <li class="<?php echo ($page =='sales-list.php') ? 'active' : '' ;?>"><a
                                href="sales-list.php"><i
                                    data-feather="shopping-cart"></i><span>Sales</span></a></li>
                        <li class="<?php echo ($page =='invoice-report.php') ? 'active' : '' ;?>"><a
                                href="invoice-report.php"><i
                                    data-feather="file-text"></i><span>Invoices</span></a></li>
                        <li class="<?php echo ($page =='sales-returns.php') ? 'active' : '' ;?>"><a
                                href="sales-returns.php"><i data-feather="copy"></i><span>Sales
                                    Return</span></a></li>
                        <li class="<?php echo ($page =='quotation-list.php') ? 'active' : '' ;?>"><a
                                href="quotation-list.php"><i
                                    data-feather="save"></i><span>Quotation</span></a>
                        </li>
                        <li class="<?php echo ($page =='pos.php') ? 'active' : '' ;?>"><a href="pos.php"><i
                                    data-feather="hard-drive"></i><span>POS</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Promo</h6>
                    <ul>
                        <li class="<?php echo ($page =='coupons.php') ? 'active' : '' ;?>"><a href="coupons.php"><i
                                    data-feather="shopping-cart"></i><span>Coupons</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Purchases</h6>
                    <ul>
                        <li class="<?php echo ($page =='purchase-list.php') ? 'active' : '' ;?>"><a
                                href="purchase-list.php"><i
                                    data-feather="shopping-bag"></i><span>Purchases</span></a></li>
                        <li class="<?php echo ($page =='purchase-order-report.php') ? 'active' : '' ;?>"><a
                                href="purchase-order-report.php"><i
                                    data-feather="file-minus"></i><span>Purchase Order</span></a></li>
                        <li class="<?php echo ($page =='purchase-returns.php') ? 'active' : '' ;?>"><a
                                href="purchase-returns.php"><i data-feather="refresh-cw"></i><span>Purchase
                                    Return</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Finance & Accounts</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page =='expense-list.php'||$page == 'expense-category.php') ? 'active subdrop' : '' ;?>"><i
                                    data-feather="file-text"></i><span>Expenses</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="expense-list.php"
                                        class="<?php echo ($page =='expense-list.php') ? 'active' : '' ;?>">Expenses</a></li>
                                <li><a href="expense-category.php"
                                        class="<?php echo ($page =='expense-category.php') ? 'active' : '' ;?>">Expense
                                        Category</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Peoples</h6>
                    <ul>
                        <li class="<?php echo ($page =='customers.php') ? 'active' : '' ;?>"><a
                                href="customers.php"><i data-feather="user"></i><span>Customers</span></a>
                        </li>
                        <li class="<?php echo ($page =='suppliers.php') ? 'active' : '' ;?>"><a
                                href="suppliers.php"><i data-feather="users"></i><span>Suppliers</span></a>
                        </li>
                        <li class="<?php echo ($page =='store-list.php') ? 'active' : '' ;?>"><a
                                href="store-list.php"><i data-feather="home"></i><span>Stores</span></a>
                        </li>
                        <li class="<?php echo ($page =='warehouse.php') ? 'active' : '' ;?>"><a
                                href="warehouse.php"><i
                                    data-feather="archive"></i><span>Warehouses</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">HRM</h6>
                    <ul>
                        <li class="<?php echo ($page =='employees-grid.php'||$page =='employees-list.php'||$page =='edit-employee.php'||$page =='add-employee.php') ? 'active' : '' ;?>"><a
                                href="employees-grid.php"><i
                                    data-feather="user"></i><span>Employees</span></a></li>
                        <li class="<?php echo ($page =='department-grid.php'||$page =='department-list.php') ? 'active' : '' ;?>"><a
                                href="department-grid.php"><i
                                    data-feather="users"></i><span>Departments</span></a></li>
                        <li class="<?php echo ($page =='designation.php') ? 'active' : '' ;?>"><a
                                href="designation.php"><i
                                    data-feather="git-merge"></i><span>Designation</span></a></li>
                        <li class="<?php echo ($page =='shift.php') ? 'active' : '' ;?>"><a href="shift.php"><i
                                    data-feather="shuffle"></i><span>Shifts</span></a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page =='attendance-employee.php'||$page == 'attendance-admin.php') ? 'active subdrop' : '' ;?>"><i
                                    data-feather="book-open"></i><span>Attendence</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="attendance-employee.php"
                                        class="<?php echo ($page =='attendance-employee.php') ? 'active' : '' ;?>">Employee</a>
                                </li>
                                <li><a href="attendance-admin.php"
                                        class="<?php echo ($page =='attendance-admin.php') ? 'active' : '' ;?>">Admin</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page =='leaves-admin.php'||$page == 'leaves-employee.php'||$page == 'leave-types.php') ? 'active subdrop' : '' ;?>"><i
                                    data-feather="calendar"></i><span>Leaves</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="leaves-admin.php"
                                        class="<?php echo ($page =='leaves-admin.php') ? 'active' : '' ;?>">Admin Leaves</a>
                                </li>
                                <li><a href="leaves-employee.php"
                                        class="<?php echo ($page =='leaves-employee.php') ? 'active' : '' ;?>">Employee
                                        Leaves</a></li>
                                <li><a href="leave-types.php"
                                        class="<?php echo ($page =='leave-types.php') ? 'active' : '' ;?>">Leave Types</a></li>
                            </ul>
                        </li>
                        <li class="<?php echo ($page =='holidays.php') ? 'active' : '' ;?>"><a
                                href="holidays.php"><i
                                    data-feather="credit-card"></i><span>Holidays</span></a>
                        </li>
                        <li class="submenu">
                            <a href="payroll-list.php"
                                class="<?php echo ($page =='payroll-list.php'||$page == 'payslip.php') ? 'active subdrop' : '' ;?>"><i
                                    data-feather="dollar-sign"></i><span>Payroll</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="payroll-list.php"
                                        class="<?php echo ($page =='payroll-list.php') ? 'active' : '';?>">Employee Salary</a>
                                </li>
                                <li><a href="payslip.php"
                                        class="<?php echo ($page =='payslip.php') ? 'active' : '' ;?>">Payslip</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Reports</h6>
                    <ul>
                        <li class="<?php echo ($page =='sales-report.php') ? 'active' : '' ;?>"><a
                                href="sales-report.php"><i data-feather="bar-chart-2"></i><span>Sales
                                    Report</span></a></li>
                        <li class="<?php echo ($page =='purchase-report.php') ? 'active' : '' ;?>"><a
                                href="purchase-report.php"><i data-feather="pie-chart"></i><span>Purchase
                                    report</span></a></li>
                        <li class="<?php echo ($page =='inventory-report.php') ? 'active' : '' ;?>"><a
                                href="inventory-report.php"><i data-feather="inbox"></i><span>Inventory
                                    Report</span></a></li>
                        <li class="<?php echo ($page =='invoice-report.php') ? 'active' : '' ;?>"><a
                                href="invoice-report.php"><i data-feather="file"></i><span>Invoice
                                    Report</span></a></li>
                        <li class="<?php echo ($page =='supplier-report.php') ? 'active' : '' ;?>"><a
                                href="supplier-report.php"><i data-feather="user-check"></i><span>Supplier
                                    Report</span></a></li>
                        <li class="<?php echo ($page =='customer-report.php') ? 'active' : '' ;?>"><a
                                href="customer-report.php"><i data-feather="user"></i><span>Customer
                                    Report</span></a></li>
                        <li class="<?php echo ($page =='expense-report.php') ? 'active' : '' ;?>"><a
                                href="expense-report.php"><i data-feather="file"></i><span>Expense
                                    Report</span></a></li>
                        <li class="<?php echo ($page =='income-report.php') ? 'active' : '' ;?>"><a
                                href="income-report.php"><i data-feather="bar-chart"></i><span>Income
                                    Report</span></a></li>
                        <li class="<?php echo ($page =='tax-reports.php') ? 'active' : '' ;?>"><a
                                href="tax-reports.php"><i data-feather="database"></i><span>Tax
                                    Report</span></a></li>
                        <li class="<?php echo ($page =='profit-and-loss.php') ? 'active' : '' ;?>"><a
                                href="profit-and-loss.php"><i data-feather="pie-chart"></i><span>Profit &
                                    Loss</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">User Management</h6>
                    <ul>
                        <li class="<?php echo ($page =='users.php') ? 'active' : '' ;?>"><a href="users.php"><i
                                    data-feather="user-check"></i><span>Users</span></a>
                        </li>
                        <li class="<?php echo ($page =='roles-permissions.php'||$page =='permissions.php') ? 'active' : '' ;?>"><a
                                href="roles-permissions.php"><i data-feather="shield"></i><span>Roles &
                                    Permissions</span></a></li>
                        <li class="<?php echo ($page =='delete-account.php') ? 'active' : '' ;?>"><a
                                href="delete-account.php"><i data-feather="lock"></i><span>Delete Account
                                    Request</span></a></li>
                    </ul>
                </li>
        </div>
    </div>
</div>
<!-- /Sidebar -->