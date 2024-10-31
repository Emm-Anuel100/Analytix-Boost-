<?php
session_start();
include 'conn.php';

// Establish the connection
$conn = connectMainDB();

$loginURL="";
$authUrl = $googleClient->createAuthUrl();
$loginURL = filter_var($authUrl, FILTER_SANITIZE_URL);

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Generate the current timestamp
        $timestamp = date('Y-m-d H:i:s');
        
        // Store the timestamp in the database
        $update_sql = "UPDATE users SET password_reset_timestamp = '$timestamp' WHERE email = '$email'";
        mysqli_query($conn, $update_sql);

        // Send the email
        $mail = new PHPMailer;
        $mail->isSMTP();
		$mail->Host       = 'mail.analytixboost.com';
		$mail->SMTPAuth   = true;
		$mail->Username   = 'mail@analytixboost.com';
		$mail->Password   = 'Emmanuel2003@';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SMTPS (SSL/TLS) for port 465
		$mail->Port       = 465;  

        $mail->setFrom('mail@analytixboost.com', 'Analytix Boost');
        $mail->addAddress($email);

        $mail->isHTML(true);

        $mail->Subject = 'Password Reset';
        $mail->Body = "
            <p>Click the link below to reset your password. This link will expire in 4 minutes:</p>
            <p><a href='https://hub.analytixboost.com/update-password.php?email=$email'>Reset Password</a></p>
            <p>If you did not request this, please ignore this email.</p>
            <p>Regards,</p>
            <p>Analytix Boost</p>
            ";

        if ($mail->send()) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Email Sent',
                            text: 'An email has been sent to your email address with a link to reset your password. If you do not see it in your inbox, kindly check your spam folder.'
                        });
                    });
                </script>";
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Email Not Sent',
                            text: 'Mailer Error: " . $mail->ErrorInfo . "'
                        });
                    });
                </script>";
        }
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'No Account Found',
                        text: 'No account found with that email address.'
                    });
                });
            </script>";
    }
}
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
                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="login-userset">
                                <div class="login-logo logo-normal">
                                   <img src="assets/img/My_Logo.png" alt="img">
                               </div>
                               <a href="index.php" class="login-logo logo-white">
                                   <img src="assets/img/logo-white.png"  alt="">
                               </a>
                               <div class="login-userheading">
                                   <h3>Forgot password?</h3>
                                   <h4>If you forgot your password, well, then we’ll email you a link to reset your password.</h4>
                               </div>
                               <div class="form-login">
                                   <label>Email</label>
                                   <div class="form-addons">
                                       <input type="email" name="email" class="form-control" required>
                                       <img src="assets/img/icons/mail.svg" alt="img">
                                   </div>
                               </div>
                               <div class="form-login">
                                    <button type="submit" class="btn btn-login">Proceed</button>
                               </div>
                               <div class="signinform text-center">
                                   <h4>Return to<a href="signin.php" class="hover-a"> login </a></h4>
                               </div>
                               <div class="form-setlogin or-text">
                                   <h4>OR</h4>
                               </div>
                               <div class="form-sociallink">
                                   <ul class="d-flex justify-content-center">
                                       <li>
                                       <a href="<?= htmlspecialchars( $loginURL ); ?>">
                                               <img src="assets/img/icons/google.png" alt="Google">
                                           </a>
                                       </li>   
                                   </ul>
                               </div>
                               <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                                   <p>Copyright &copy; <?= date('Y') ?> Analytix Boost. All rights reserved</p>
                               </div>
                           </div>
                        </form>      
                    </div>
                    <div class="login-img">
                        <img src="assets/img/authentication/forgot-02.png" alt="img">
                    </div>
                </div>
			</div>
        </div>
		<!-- /Main Wrapper -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>