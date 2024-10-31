<?php
$link = $_SERVER[ 'PHP_SELF' ];
$link_array = explode( '/', $link );
$page = end( $link_array );
?>
<!-- jQuery -->
<script src = 'assets/js/jquery-3.7.1.min.js'></script>

<!-- Feather Icon JS -->
<script src = 'assets/js/feather.min.js'></script>

<!-- Slimscroll JS -->
<script src = 'assets/js/jquery.slimscroll.min.js'></script>

<!-- Datatable JS -->
<script src = 'assets/js/jquery.dataTables.min.js'></script>
<script src = 'assets/js/dataTables.bootstrap5.min.js'></script>

<!-- Datetimepicker JS -->
<script src = 'assets/js/moment.min.js'></script>
<script src = 'assets/js/bootstrap-datetimepicker.min.js'></script>

<!-- Bootstrap Core JS -->
<script src = 'assets/js/bootstrap.bundle.min.js'></script>

<?php  if ( $page === 'appearance.php' || $page === 'attendance-admin.php' || $page === 'attendance-employee.php' || $page === 'ban-ip-address.php' || $page === 'bank-settings-grid.php' || $page === 'bank-settings-list.php' || $page === 'barcode.php' || $page === 'chat.php'
|| $page === 'company-settings.php' || $page === 'connected-apps.php' || $page === 'countries.php' || $page === 'currency-settings.php' || $page === 'custom-fields.php' || $page === 'customer-report.php' || $page === 'warehouse.php' || $page === 'units.php' || $page === 'users.php' || $page === 'warranty.php' || $page === 'varriant-attributes.php'|| $page === 'ui-text-editor.php' || $page === 'supplier-report.php' || $page === 'system-settings.php'|| $page === 'tax-rates.php' || $page === 'todo.php'||$page === 'sales-report.php'||$page==='security-settings.php'
||$page==='shift.php'||$page==='sms-gateway.php'||$page==='social-authentication.php'||$page==='states.php'||$page==='stock-transfer.php'||$page==='storage-settings.php'||$page==='delete-account.php'||$page==='department-grid.php'||$page==='department-list.php'||$page==='designation.php'||$page==='edit-employee.php'||$page==='email-settings.php'||$page==='employees-grid.php'||$page==='employees-list.php'||$page==='expense-category.php'||$page==='expired-products.php'||$page==='file-archived.php'||$page==='file-document.php'||$page==='file-favourites.php'||$page==='file-manager-deleted.php'
||$page==='file-manager.php'||$page==='file-recent.php'||$page==='file-shared.php'||$page==='gdpr-settings.php'||$page==='general-settings.php'||$page==='holidays.php'||$page==='inventory-report.php'||$page==='invoice-report.php'||$page==='invoice-settings.php'|| $page==='quotation-list.php'||$page==='language-settings-web.php'||$page==='language-settings.php'||$page==='leave-types.php'||$page==='leaves-admin.php'||$page==='leaves-employee.php'||$page==='manage-stocks.php'||$page==='notes.php'||$page==='notification.php'||$page==='payment-gateway-settings.php'|| $page==='quotation-list.php'||$page==='pos-settings.php'||$page==='preference.php'||$page==='printer-settings.php'||$page==='product-list.php'||$page==='profit-and-loss.php'||$page==='purchase-list.php'||$page==='purchase-report.php'||$page==='qrcode.php') {?>
    <!-- Summernote JS -->
    <script src = 'assets/plugins/summernote/summernote-bs4.min.js'></script>
<?php }?>

<?php  if ($page === 'chart-c3.php') {   ?>
 <!-- Chart JS -->
 <script src="assets/plugins/c3-chart/d3.v5.min.js"></script>
 <script src="assets/plugins/c3-chart/c3.min.js"></script>
 <script src="assets/plugins/c3-chart/chart-data.js"></script>
<?php } ?>

<?php  if ($page === 'form-fileupload.php') {   ?>
   <!-- Fileupload JS -->
   <script src="assets/plugins/fileupload/fileupload.min.js"></script>
<?php } ?>

<?php  if ($page === 'form-mask.php') {   ?>
   <!-- Mask JS -->
	<script src="assets/js/jquery.maskedinput.min.js"></script>
    <script src="assets/js/mask.js"></script>
<?php } ?>

<?php  if ($page === 'chart-flot.php') {   ?>
    <!-- Chart JS -->
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot/jquery.flot.fillbetween.js"></script>
    <script src="assets/plugins/flot/jquery.flot.pie.js"></script>
    <script src="assets/plugins/flot/chart-data.js"></script>
<?php } ?>

<?php  if ($page === 'chart-js.php') {   ?>
    <!-- Chart JS -->
    <script src="assets/plugins/chartjs/chart.min.js"></script>
    <script src="assets/plugins/chartjs/chart-data.js"></script>
<?php } ?>

<?php  if ($page === 'chart-morris.php') {   ?>
    <!-- Chart JS -->
    <script src="assets/plugins/morris/raphael-min.js"></script>
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="assets/plugins/morris/chart-data.js"></script>
<?php } ?>

<?php  if ($page === 'chart-peity.php') {   ?>
    <!-- Chart JS -->
    <script src="assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="assets/plugins/peity/chart-data.js"></script>
<?php } ?>

<?php  if ($page === 'calendar.php') {   ?>
    <!-- Full Calendar JS -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/plugins/fullcalendar/fullcalendar.min.js"></script>
    <script src="assets/plugins/fullcalendar/jquery.fullcalendar.js"></script>
<?php } ?>

<?php  if ($page === 'add-product.php'||$page==='edit-product.php'||$page==='product-list.php') {   ?>
    <!-- Bootstrap Tagsinput JS -->
    <script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<?php } ?>

<?php  if ($page === 'barcode.php'||$page==='calendar.php'||$page==='chart-apex.php'||$page==='email.php'||$page==='file-archived.php'||$page==='file-document.php'||$page==='file-favourites.php'||$page==='file-manager-deleted.php'||$page==='file-manager.php'||$page==='file-recent.php'||$page==='file-shared.php'||$page==='form-elements.php'||$page==='qrcode.php'||$page==='pos.php'||$page==='sales-dashboard.php'||$page==='theme-settings.php'||$page==='todo.php'||$page==='index.php') {   ?>
    <!-- Chart JS -->
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>
<?php } ?>

<?php  if ($page === 'expense-report.php' || $page === 'todo.php' || $page === 'sales-dashboard.php' || $page === 'profit-and-loss.php' || $page === 'income-report.php' || $page === 'invoice-report.php' || $page === 'pos.php' || $page === 'supplier-report.php' || $page === 'tax-reports.php') {   ?>
    <!-- Daterangepikcer JS -->
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<?php } ?>

<!-- Select2 JS -->
<script src = 'assets/plugins/select2/js/select2.min.js'></script>

<!-- Sticky-sidebar -->
<script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
<script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

<!-- Sweetalert 2 -->
<script src = 'assets/plugins/sweetalert/sweetalert2.all.min.js'></script>
<script src = 'assets/plugins/sweetalert/sweetalerts.min.js'></script>

<?php  if ( $page === 'todo.php'|| $page === 'pos.php'|| $page === 'product-details.php'||$page === 'qrcode.php'||$page==='notes.php') {?>
    <!-- Owl JS -->
    <script src = 'assets/plugins/owlcarousel/owl.carousel.min.js'></script>
<?php }?>

<!-- Custom JS -->
<script src = 'assets/js/theme-script.js'></script>
<script src = 'assets/js/script.js'></script>
