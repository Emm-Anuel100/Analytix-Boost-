<?php
session_start();
include 'conn.php';

// Establish the connection
$conn = connectMainDB();

if (isset($_GET['email']) && !empty($_GET['email'])) {
    $email = mysqli_real_escape_string($conn, $_GET['email']);

    // Retrieve the timestamp from the database
    $sql = "SELECT password_reset_timestamp FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $timestamp = $row['password_reset_timestamp'];

        // Calculate the difference in minutes
        $current_time = new DateTime();
        $reset_time = new DateTime($timestamp);
        $interval = $current_time->diff($reset_time);
        $minutes_elapsed = $interval->i + ($interval->h * 60);

        // if elapsed time is less than or equal to 4min
        if ($minutes_elapsed <= 4) {
            // Check if the form is submitted
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
                $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

                // Validate the new passwords
                if ($new_password === $confirm_password) {
                    // Password validation checks
                    if (strlen($new_password) < 8 || !preg_match('/[A-Z]/', $new_password) || !preg_match('/[^a-zA-Z0-9]/', $new_password)) {
                        echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Invalid Password',
                                        text: 'Password must be at least 8 characters long, contain an uppercase letter, and a special character.'
                                    });
                                });
                            </script>";
                    } else {
                        // Hash the new password
                        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                        // Update the password in the database
                        $update_sql = "UPDATE users SET password = '$hashed_password', password_reset_timestamp = NULL WHERE email = '$email'";
                        if (mysqli_query($conn, $update_sql)) {
                            echo "<script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Password Updated',
                                            text: 'Your password has been updated successfully.'
                                        }).then(function() {
                                            window.location.href = 'signin.php';
                                        });
                                    });
                                </script>";
                        } else {
                            echo "<script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Update Failed',
                                            text: 'There was an error updating your password. Please try again.'
                                        });
                                    });
                                </script>";
                        }
                    }
                } else {
                  echo "<script>
                           document.addEventListener('DOMContentLoaded', function() {
                              Swal.fire({
                                 icon: 'error',
                                 title: 'Passwords Do Not Match',
                                 text: 'The passwords you entered do not match. Please try again.'
                              });
                           });
                     </script>";
                }
            }
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Link Expired',
                            text: 'The password reset link has expired. Please request a new one.'
                        }).then(function() {
                            window.location.href = 'forgot-password.php';
                        });
                    });
                </script>";
        }
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Link',
                        text: 'The link you followed is invalid.'
                    }).then(function() {
                        window.location.href = 'forgot-password.php';
                    });
                });
            </script>";
    }
} else {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Request',
                    text: 'No email specified.'
                }).then(function() {
                    window.location.href = 'forgot-password.php';
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
    <body class="account-page">
        <div id="global-loader">
            <div class="whirly-loader"> </div>
        </div>
    
        <div class="main-wrapper">
            <div class="account-content">
                <div class="login-wrapper">
                    <div class="login-content">
                        <form action="update-password.php?email=<?= urlencode($email); ?>" method="post">
                            <div class="login-userset">
                                <div class="login-logo logo-normal">
                                    <img src="assets/img/My_Logo.png" alt="img">
                                </div>
                                <a href="index.php" class="login-logo logo-white">
                                    <img src="assets/img/logo-white.png" alt="">
                                </a>
                                <div class="login-userheading">
                                    <h3>Update password</h3>
                                    <h4>Update your Analytix Boost password and continue from where you stopped.</h4>
                                </div>
                                <div class="form-login">
                                    <label>New Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-input" name="new_password" required>
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <label>Confirm New Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-input" name="confirm_password" required>
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <button type="submit" class="btn btn-login">Update password</button>
                                </div>
                                <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                                    <p>Copyright &copy; <?= date('Y')?> Analytix Boost All rights reserved</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="login-img">
                        <img src="assets/img/authentication/reset02.png" alt="img">
                    </div>
                </div>
            </div>
        </div>

        <?php include 'layouts/customizer.php'; ?>
        <?php include 'layouts/vendor-scripts.php'; ?>
    </body>
</html>
