<?php
include 'conn.php'; // Include db connection
include 'layouts/session.php'; 

// Retrieve email parameter from URL
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';

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
			<div class="account-content">
				<div class="login-wrapper">
                    <div class="login-content">
                        <div class="login-userset">
                            <div class="login-userset">
                                <div class="login-logo logo-normal">
                                    <img src="assets/img/My_Logo.png" alt="img">
                                </div>
                            </div>    
							<a href="index.php" class="login-logo logo-white">
								<img src="assets/img/logo-white.png"  alt="">
							</a>
                            <div class="login-userheading text-center">
                                <h3>Verify Your Email</h3>
                                We have sent a verification link to <strong><?= htmlspecialchars($email) ?></strong>. Please follow the link 
                                in the email to continue. If you do not see it in your inbox, kindly check your spam folder.
                            </div>
                            <!-- <div class="signinform text-center">
                                <h4>Didn't receive an email?</h4>
                            </div>
                            <div class="form-login">
                                <a class="btn btn-login" href="#">Resend link</a>
                            </div> -->
                            <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                                   <p>Copyright &copy; <?= date('Y') ?> Analytix Boost. All rights reserved</p>
                            </div>
                        </div>
                    </div>
                    <div class="login-img">
                        <img src="assets/img/authentication/email02.png" alt="img">
                    </div>
                </div>
			</div>
        </div>
		<!-- /Main Wrapper -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>
