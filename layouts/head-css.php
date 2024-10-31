<?php
$link = $_SERVER[ 'PHP_SELF' ];
$link_array = explode( '/', $link );
$page = end( $link_array );
?>

<!-- Bootstrap CSS -->
<link rel = 'stylesheet' href ='assets/css/bootstrap.min.css'>

<!-- Fontawesome CSS -->
<link rel = 'stylesheet' href = 'assets/plugins/fontawesome/css/fontawesome.min.css'>
<link rel = 'stylesheet' href = 'assets/plugins/fontawesome/css/all.min.css'>

<?php  if ( $page === 'appearance.php' || $page === 'attendance-admin.php' || $page === 'attendance-employee.php' || $page === 'ban-ip-address.php' || $page === 'bank-settings-grid.php' || $page === 'bank-settings-list.php' || $page === 'barcode.php' || $page === 'chat.php'
|| $page === 'company-settings.php' || $page === 'connected-apps.php' || $page === 'countries.php' || $page === 'currency-settings.php' || $page === 'custom-fields.php' || $page === 'customer-report.php' || $page === 'warehouse.php' || $page === 'units.php' || $page === 'users.php' || $page === 'warranty.php' || $page === 'varriant-attributes.php'|| $page === 'ui-text-editor.php' || $page === 'supplier-report.php' || $page === 'system-settings.php'|| $page === 'tax-rates.php' || $page === 'todo.php'||$page === 'sales-report.php'||$page==='security-settings.php'||$page==='shift.php'||$page==='sms-gateway.php'||$page==='social-authentication.php'||$page==='states.php'||$page==='stock-transfer.php'||$page==='storage-settings.php'||$page==='delete-account.php'||$page==='department-grid.php'||$page==='department-list.php'||$page==='designation.php'||$page==='edit-employee.php'||$page==='email-settings.php'||$page==='employees-grid.php'||$page==='employees-list.php'||$page==='expense-category.php'||$page==='expired-products.php'||$page==='file-archived.php'||$page==='file-document.php'||$page==='file-favourites.php'||$page==='file-manager-deleted.php'||$page==='file-manager.php'||$page==='file-recent.php'||$page==='file-shared.php'||$page==='gdpr-settings.php'||$page==='general-settings.php'||$page==='holidays.php'||$page==='inventory-report.php'||$page==='invoice-report.php'||$page==='invoice-settings.php'||$page==='delete-account.php'||$page==='department-grid.php'||$page==='department-list.php'||$page==='designation.php'||$page==='edit-employee.php'||$page==='email-settings.php'||$page==='employees-grid.php'||$page==='employees-list.php'||$page==='expense-category.php'||$page==='expired-products.php'||$page==='file-archived.php'||$page==='file-document.php'||$page==='file-favourites.php'||$page==='file-manager-deleted.php'||$page==='file-manager.php'||$page==='file-recent.php'||$page==='file-shared.php'||$page==='quotation-list.php'||$page==='language-settings-web.php'||$page==='language-settings.php'||$page==='leave-types.php'||$page==='leaves-admin.php'||$page==='leaves-employee.php'||$page==='manage-stocks.php'||$page==='notes.php'||$page==='notification.php'||$page==='payment-gateway-settings.php'||$page==='pos-settings.php'||$page==='preference.php'||$page==='printer-settings.php'||$page==='product-list.php'||$page==='profit-and-loss.php'||$page==='purchase-list.php'||$page==='purchase-report.php'||$page==='qrcode.php') {?>

    <!-- Summernote CSS -->
    <link rel = 'stylesheet' href = 'assets/plugins/summernote/summernote-bs4.min.css'>
<?php }?>

<?php  if ( $page === 'audio-call.php' || $page === 'video-call.php' || $page === 'todo.php' || $page==='barcode.php'||$page==='pos.php'||$page==='product-details.php'||$page==='qrcode.php'||$page==='notes.php') {?>
    <!-- Owl Carousel CSS -->
    <link rel = 'stylesheet' href = 'assets/plugins/owlcarousel/owl.carousel.min.css'>
    <link rel = 'stylesheet' href = 'assets/plugins/owlcarousel/owl.theme.default.min.css'>
<?php } ?>
 <!-- Feathericon CSS -->
 <link rel="stylesheet" href="assets/css/feather.css">
        
<!-- Datetimepicker CSS -->
<link rel = 'stylesheet' href = 'assets/css/bootstrap-datetimepicker.min.css'>
        
<?php  if ( $page === 'file-archived.php'||$page==='file-document.php' ||$page==='file-favourites.php'||$page==='file-manager.php'||$page==='file-recent.php'||$page==='file-shared.php') {?>
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="assets/css/plyr.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<?php }?>

<!-- animation CSS -->
<link rel = 'stylesheet' href='assets/css/animate.css'>

<!-- Select2 CSS -->
<link rel = 'stylesheet' href='assets/plugins/select2/css/select2.min.css'>

<!-- Datatable CSS -->
<link rel = 'stylesheet' href='assets/css/dataTables.bootstrap5.min.css'>

<?php  if ( $page === 'icon-feather.php' ) {?>
 <!-- Feather CSS -->
 <link rel="stylesheet" href="assets/plugins/icons/feather/feather.css">
 <?php }?>

<?php  if ( $page === 'icon-flag.php' ) {?>
<!-- Pe7 CSS -->
<link rel="stylesheet" href="assets/plugins/icons/flags/flags.css">
        
<?php }?>
<?php  if ( $page === 'icon-ionic.php' ) {?>
	<!-- Ionic CSS -->
<link rel="stylesheet" href="assets/plugins/icons/ionic/ionicons.css">
<?php }?>    
<?php  if ( $page === 'icon-material.php' ) {?>
<!-- Material CSS -->
<link rel="stylesheet" href="assets/plugins/material/materialdesignicons.css">
<?php }?> 
<?php  if ( $page === 'icon-pe7.php' ) {?>
<!-- Pe7 CSS -->
<link rel="stylesheet" href="assets/plugins/icons/pe7/pe-icon-7.css">
          
<?php }?> 
<?php  if ( $page === 'icon-simpleline.php' ) {?>
<!-- Material CSS -->
<link rel="stylesheet" href="assets/plugins/simpleline/simple-line-icons.css">
<?php }?>      
<?php  if ( $page === 'icon-themify.php' ) {?>
<!-- Pe7 CSS -->
<link rel="stylesheet" href="assets/plugins/icons/themify/themify.css">
<?php }?> 
<?php  if ( $page === 'icon-typicon.php' ) {?>
<!-- Pe7 CSS -->
<link rel="stylesheet" href="assets/plugins/icons/typicons/typicons.css">
<?php }?> 
<?php  if ( $page === 'icon-weather.php' ) {?>
<!-- Pe7 CSS -->
<link rel="stylesheet" href="assets/plugins/icons/weather/weathericons.css">
<?php }?>       
<?php  if ( $page === 'form-wizard.php' ) {?>
    <!-- Wizard CSS -->
    <link rel="stylesheet" href="assets/plugins/twitter-bootstrap-wizard/form-wizard.css">
 <?php }?>

<?php  if ( $page === 'video-call.php' || $page === 'chat.php') { ?>
    <!-- Swiper CSS -->
    <link rel = 'stylesheet' href='assets/plugins/swiper/swiper.min.css'>
<?php } ?>

<?php  if ( $page === 'video-call.php' || $page === 'chat.php'||$page === 'call-history.php' ||$page === 'audio-call.php') { ?>
    <!-- Boxicons CSS -->
    <link rel = 'stylesheet' href='assets/plugins/boxicons/css/boxicons.min.css'>
<?php } ?>

<?php  if ( $page === 'warehouse.php' || $page === 'chat.php'||$page==='customers.php') { ?>
	<!-- Mobile CSS-->
	<link rel="stylesheet" href="assets/plugins/intltelinput/css/intlTelInput.css">
    <link rel="stylesheet" href="assets/plugins/intltelinput/css/demo.css">
<?php }?>

<?php  if ($page === 'calendar.php') {   ?>
	<!-- Full Calander CSS -->
	<link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
<?php } ?>

<?php  if ($page === 'add-product.php'||$page==='edit-product.php'||$page==='product-list.php') {   ?>
	<!-- Bootstrap Tagsinput CSS -->
	<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<?php } ?>

<?php  if ($page === 'expense-report.php' || $page === 'todo.php' || $page === 'sales-dashboard.php' || $page === 'profit-and-loss.php' || $page === 'income-report.php' || $page === 'invoice-report.php' || $page === 'pos.php' || $page === 'supplier-report.php' || $page === 'tax-reports.php') {   ?>
    <!-- Daterangepikcer CSS -->
	<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
<?php } ?>

<?php  if ($page === 'chat.php') {   ?>
	<!-- Fancybox -->
	<link rel="stylesheet" href="assets/plugins/fancybox/jquery.fancybox.min.css">
<?php } ?>

<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">

<!-- Main CSS -->
<link rel="stylesheet" href="assets/css/style.css">
	
