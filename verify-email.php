<?php
include 'conn.php'; // Include db connection
session_start();

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Connect to the main database
    $mainConn = connectMainDB();

    // Verify the token and retrieve the email and username 
    $sql = "SELECT email, username FROM users WHERE verification_token = ? AND is_verified = 0";
    $stmt = $mainConn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $username = $row['username'];

        // Update user's status to verified and nullify the token
        $sql = "UPDATE users SET is_verified = 1, verification_token = NULL WHERE verification_token = ?";
        $stmt = $mainConn->prepare($sql);
        $stmt->bind_param("s", $token);

        if ($stmt->execute()) {
            // Set session variables
            $_SESSION['authenticated'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;

            // Redirect to email-verified page
            header("Location: email-verified.php");
            exit();
        } else {
            // Error in updating verification status
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Verification Error',
                        text: 'An error occurred while verifying your account. Please try again.'
                    });
                });
            </script>";
        }
    } else {
        // Invalid or expired token
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Token',
                    text: 'The verification link is invalid or has already been used.'
                });
            });
        </script>";
    }

    // Close the connection
    $mainConn->close();
} else {
    // No token provided
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Token Missing',
                text: 'No verification token provided. Please register again.',
                willClose: () => {
                    window.location.href = 'register.php';
                }
            });
        });
    </script>";
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
                                <h3>Verify Email</h3>
                            </div>
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
