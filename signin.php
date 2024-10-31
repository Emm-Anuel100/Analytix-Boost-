<?php
session_start();
include 'conn.php'; // Include the connection file

$loginURL="";
$authUrl = $googleClient->createAuthUrl();
$loginURL = filter_var($authUrl, FILTER_SANITIZE_URL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    // Connect to the main database
    $conn = connectMainDB();

    // Check if the email exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['authenticated'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $user['username'];

            // Handle 'Remember Me' functionality
            if ($remember) {
                setcookie('email', $email, time() + (86400 * 30), "/"); // 30 days
                setcookie('password', $password, time() + (86400 * 30), "/"); // 30 days
            } else {
                // Clear cookies if 'Remember Me' is not checked
                if (isset($_COOKIE['email'])) {
                    setcookie('email', '', time() - 3600, "/");
                }
                if (isset($_COOKIE['password'])) {
                    setcookie('password', '', time() - 3600, "/");
                }
            }

            // Redirect to dashboard
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Incorrect password.";
        }
      } else {
        $error_message = "No account found with this email.";
    }

    $stmt->close();
    $conn->close();
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
    <div class="whirly-loader"></div>
</div>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="assets/img/My_Logo.png" alt="logo">
                        </div>
                        <a href="index.php" class="login-logo logo-white">
                            <img src="assets/img/logo-white.png" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4>Access your Analytix Boost panel using your email and password.</h4>
                        </div>
                        <div class="form-login">
                            <label>Email Address</label>
                            <div class="form-addons">
                                <input type="text" name="email" class="form-control" required>
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
                        <?php if (!empty($error_message)) { ?>
                            <div class="alert alert-danger">
                                <?= $error_message; ?>
                            </div>
                        <?php } ?>
                        <div class="form-login authentication-check">
                            <div class="row">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                            <input type="checkbox" name="remember">
                                            <span class="checkmarks"></span>Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <a class="forgot-link" href="forgot-password.php">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-login">
                            <button type="submit" class="btn btn-login">Sign In</button>
                        </div>
                        <div class="signinform">
                            <h4>New on our platform?<a href="register.php" class="hover-a"> Create an account</a></h4>
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
                                <p>Copyright &copy; <?= date('Y') ?> Analytix Boost All rights reserved</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="login-img">
                <img src="assets/img/authentication/login02.png" alt="img">
            </div>
        </div>
    </div>
</div>
<!-- /Main Wrapper -->

<?php include 'layouts/customizer.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>
