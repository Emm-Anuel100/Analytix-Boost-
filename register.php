<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'conn.php'; // Include db connection

$loginURL="";
$authUrl = $googleClient->createAuthUrl();
$loginURL = filter_var($authUrl, FILTER_SANITIZE_URL);

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Establish the connection
$conn = connectMainDB();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input values
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validation
    $passwordErrors = [];

    if (strlen($password) < 8) {
        $passwordErrors[] = "be at least 8 characters long";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $passwordErrors[] = "contain at least one uppercase letter";
    }
    if (!preg_match('/[\W]/', $password)) {
        $passwordErrors[] = "include at least one special character";
    }

    if (!empty($passwordErrors)) {
        $passwordErrorsText = "Password must " . implode(", and ", $passwordErrors) . ".";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Error',
                    text: '$passwordErrorsText'
                });
            });
        </script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Passwords do not match.'
                });
            });
        </script>";
      } else {
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        // Check if email already exists
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Email Exists',
                        text: 'This email address is already registered.'
                    });
                });
            </script>";
    } else {
        // Generate verification token
        $token = bin2hex(random_bytes(16));

        // Insert new user into the users table
        $sql = "INSERT INTO users (firstname, lastname, username, email, password, verification_token) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $firstname, $lastname, $username, $email, $password_hashed, $token);

        if ($stmt->execute()) {
            $_SESSION['email'] = $email;

            // Send verification email
            $verification_link = "https://hub.analytixboost.com/verify-email.php?token=$token";
            $subject = "Email Verification";
            $body = "Please click the link to verify your email: <a href=\"$verification_link\">Verify Email</a>";

            $mail = new PHPMailer(true);

            // Server settings
            $mail->SMTPDebug = 0;
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
            $mail->Subject = $subject;
            $mail->Body    = $body;

            if ($mail->send()) {
                header("Location: email-notify.php?email=$email");
                exit();
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Email Error',
                            text: 'There was a problem sending the verification email.'
                        });
                    });
                </script>";
            }
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration Error',
                        text: 'Error: " . $stmt->error . "'
                    });
                });
            </script>";
        }
    }

    // Close connection
    $conn->close();
  }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'layouts/title-meta.php'; ?>
    <?php include 'layouts/head-css.php'; ?>
    <!-- sweet alert link  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="account-page">
    <div id="global-loader">
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
                               <img src="assets/img/logo-white.png" alt="">
                           </a>
                           <div class="login-userheading">
                               <h3>Register</h3>
                               <h4>Create a new Analytix Boost account and start managing your inventory.</h4>
                           </div>
                           <div class="form-login">
                               <label>Firstname</label>
                               <div class="form-addons">
                                   <input type="text" name="firstname" class="form-control" required>
                                   <img src="assets/img/icons/user-icon.svg" alt="img">
                               </div>
                           </div>
                           <div class="form-login">
                               <label>Lastname</label>
                               <div class="form-addons">
                                   <input type="text" name="lastname" class="form-control" required>
                                   <img src="assets/img/icons/user-icon.svg" alt="img">
                               </div>
                           </div>
                           <div class="form-login">
                               <label>Username</label>
                               <div class="form-addons">
                                   <input type="text" name="username" class="form-control" required>
                                   <img src="assets/img/icons/user-icon.svg" alt="img">
                               </div>
                           </div>
                           <div class="form-login">
                               <label>Email Address</label>
                               <div class="form-addons">
                                   <input type="email" name="email" class="form-control" required>
                                   <img src="assets/img/icons/mail.svg" alt="img">
                               </div>
                           </div>
                           <div class="form-login">
                               <label>Password</label>
                               <div class="pass-group">
                                   <input type="password" name="password" class="pass-input" required>
                                   <span class="fas toggle-password fa-eye-slash"></span>
                               </div>
                           </div>
                           <div class="form-login">
                               <label>Confirm password</label>
                               <div class="pass-group">
                                   <input type="password" name="confirm_password" class="pass-input" required>
                                   <span class="fas toggle-password fa-eye-slash"></span>
                               </div>
                           </div>
                           <div class="form-login authentication-check">
                               <div class="row">
                                   <div class="col-6">
                                       <div class="custom-control custom-checkbox">
                                           <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                               <input type="checkbox" required>
                                               <span class="checkmarks"></span>I agree to the <a href="#">Terms of Service </a>
                                           </label>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="form-login">
                               <button type="submit" class="btn btn-login">Register</button>
                           </div>
                           <div class="signinform">
                               <h4>Already have an account?<a href="signin.php" class="hover-a"> Login</a></h4>
                           </div>
                           <div class="form-setlogin or-text">
                               <h4>OR</h4>
                           </div>
                           <div class="form-sociallink">
                               <ul class="d-flex">
                                   <li>
                                   <a href="<?= htmlspecialchars( $loginURL ); ?>">
                                           <img src="assets/img/icons/google.png" alt="Google">
                                       </a>
                                   </li>
                               </ul>
                               <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                                   <p>Copyright &copy; <?= date('Y')?> Analytix Boost All rights reserved</p>
                               </div>
                           </div>
                       </div>
                    </form>
                </div>
                <div class="login-img">
                    <img src="assets/img/authentication/register02.png" alt="img">
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->
    <?php include 'layouts/customizer.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>

</body>
</html>