<?php

// Fetch the username from the session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

?>

<!-- Header -->
<div class="header">

<!-- Logo -->
<div class="header-left active">
    <a href="index.php" class="logo logo-normal" style="position: relative; top: 14.5px">
        <img src="assets/img/My_Logo.png" alt="logo">
    </a>
    <a href="index.php" class="logo logo-white" style="position: relative; top: 14.5px">
        <img src="assets/img/My_Logo.png" alt="logo">
    </a>
    <a href="index.php" class="logo-small" style="position: relative; top: 14.5px">
        <img src="assets/img/My_Logo.png" alt="">
    </a>
    <a id="toggle_btn" href="javascript:void(0);">
        <i data-feather="chevrons-left" class="feather-16"></i>
    </a>
</div>
<!-- /Logo -->

<a id="mobile_btn" class="mobile_btn" href="#sidebar">
    <span class="bar-icon">
        <span></span>
        <span></span>
        <span></span>
    </span>
</a>

<!-- Header Menu -->
<ul class="nav user-menu">

    <!-- Search -->
    <li class="nav-item nav-searchinputs">
        <div class="top-nav-search">
            <a href="javascript:void(0);" class="responsive-search">
                <i class="fa fa-search"></i>
            </a>
            <form action="#" method="post" class="dropdown">
                <div class="searchinputs dropdown-toggle" id="dropdownMenuClickable" data-bs-toggle="dropdown" data-bs-auto-close="false">
                    <input type="text" placeholder="Search">
                    <div class="search-addon">
                        <span><i data-feather="x-circle" class="feather-14"></i></span>
                    </div>
                </div>
            </form>
        </div>
    </li>
    <!-- /Search -->

    <!-- Select Store -->
    <li class="nav-item dropdown has-arrow main-drop select-store-dropdown">
        <a href="javascript:void(0);" class="dropdown-toggle nav-link select-store"
            data-bs-toggle="dropdown">
            <span class="user-info">
                <span class="user-letter">
                    <img src="assets/img/store/store-03.png" alt="Store Logo" class="img-fluid">
                </span>
                <span class="user-detail">
                    <span class="user-name">My Stores</span>
                </span>
            </span>
        </a>

        <?php
        // Get user email
        $user_email = $_SESSION['email'];

        // Prepare the SQL statement
        $sql = "SELECT store_name FROM store WHERE user_email = ?";

        // Initialize the prepared statement
        $stmt = $conn->prepare($sql);

        // Bind the user email parameter
        $stmt->bind_param("s", $user_email);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        ?>

        <div class="dropdown-menu dropdown-menu-right">
            <?php
            // Define an array of store images
            $storeImages = [
                'assets/img/store/store-01.png',
                'assets/img/store/store-02.png',
                'assets/img/store/store-03.png',
                'assets/img/store/store-04.png'
            ];

            // Check if there are stores in the result set
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Shuffle the array to get random images
                    shuffle($storeImages);
                    
                    // Select the first image from the shuffled array
                    $randomImage = $storeImages[0];

                    // Output the store link and image
                    echo "<a href='javascript:void(0);' class='dropdown-item'>";
                    echo "<img src='" . $randomImage . "' alt='Store Logo' class='img-fluid'> "; // Random image
                    echo htmlspecialchars($row['store_name']); // Use htmlspecialchars for security
                    echo "</a>";
                }
               } else {
                // If no stores are found
                echo "<a href='javascript:void(0);' class='dropdown-item'>";
                echo "<img src='assets/img/users/user-30.jpg' alt='Store Logo' class='img-fluid'> ";
                echo htmlspecialchars('No store yet'); // Use htmlspecialchars for security
                echo "</a>";
                echo "<a href='javascript:void(0);' class='dropdown-item'>No stores available</a>";
            }

            // Close the statement
            $stmt->close();
            ?>
        </div>
      </li>
      <!-- /Select Store -->

    <!-- Flag -->
    <li class="nav-item dropdown has-arrow flag-nav nav-item-box">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);"
            role="button">
            <img src="assets/img/flags/us.png" alt="Language" class="img-fluid">
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a href="javascript:void(0);" class="dropdown-item active">
                <img src="assets/img/flags/us.png" alt="" height="16"> English
            </a>
            <a href="javascript:void(0);" class="dropdown-item">
                <img src="assets/img/flags/fr.png" alt="" height="16"> French
            </a>
            <a href="javascript:void(0);" class="dropdown-item">
                <img src="assets/img/flags/es.png" alt="" height="16"> Spanish
            </a>
            <a href="javascript:void(0);" class="dropdown-item">
                <img src="assets/img/flags/de.png" alt="" height="16"> German
            </a>
        </div>
    </li>
    <!-- /Flag -->

    <li class="nav-item nav-item-box">
        <a href="javascript:void(0);" id="btnFullscreen">
            <i data-feather="maximize"></i>
        </a>
    </li>
    <!-- <li class="nav-item nav-item-box">
        <a href="email.php">
            <i data-feather="mail"></i>
            <span class="badge rounded-pill">1</span>
        </a>
    </li> -->
    <!-- Notifications -->
    <li class="nav-item dropdown nav-item-box">
        <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
            <i data-feather="bell"></i><span class="badge rounded-pill">2</span>
        </a>
        <div class="dropdown-menu notifications">
            <div class="topnav-dropdown-header">
                <span class="notification-title">Notifications</span>
                <!-- <a href="javascript:void(0)" class="clear-noti"> Clear All </a> -->
            </div>
            <div class="noti-content">
                <ul class="notification-list">
                    <li class="notification-message">
                        <a href="activities.php">
                            <div class="media d-flex">
                                <span class="avatar flex-shrink-0">
                                    <img alt="" src="assets/img/profiles/avatar-02.jpg">
                                </span>
                                <div class="media-body flex-grow-1">
                                    <p class="noti-details"><span class="noti-title">John Doe</span> added
                                        new task <span class="noti-title">Patient appointment booking</span>
                                    </p>
                                    <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="notification-message">
                        <a href="activities.php">
                            <div class="media d-flex">
                                <span class="avatar flex-shrink-0">
                                    <img alt="" src="assets/img/profiles/avatar-03.jpg">
                                </span>
                                <div class="media-body flex-grow-1">
                                    <p class="noti-details"><span class="noti-title">Tarah Shropshire</span>
                                        changed the task name <span class="noti-title">Appointment booking
                                            with payment gateway</span></p>
                                    <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="notification-message">
                        <a href="activities.php">
                            <div class="media d-flex">
                                <span class="avatar flex-shrink-0">
                                    <img alt="" src="assets/img/profiles/avatar-06.jpg">
                                </span>
                                <div class="media-body flex-grow-1">
                                    <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                        added <span class="noti-title">Domenic Houston</span> and <span
                                            class="noti-title">Claire Mapes</span> to project <span
                                            class="noti-title">Doctor available module</span></p>
                                    <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="notification-message">
                        <a href="activities.php">
                            <div class="media d-flex">
                                <span class="avatar flex-shrink-0">
                                    <img alt="" src="assets/img/profiles/avatar-17.jpg">
                                </span>
                                <div class="media-body flex-grow-1">
                                    <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                        completed task <span class="noti-title">Patient and Doctor video
                                            conferencing</span></p>
                                    <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="notification-message">
                        <a href="activities.php">
                            <div class="media d-flex">
                                <span class="avatar flex-shrink-0">
                                    <img alt="" src="assets/img/profiles/avatar-13.jpg">
                                </span>
                                <div class="media-body flex-grow-1">
                                    <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span>
                                        added new task <span class="noti-title">Private chat module</span>
                                    </p>
                                    <p class="noti-time"><span class="notification-time">2 days ago</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="topnav-dropdown-footer">
                <a href="activities.php">View all Notifications</a>
            </div>
        </div>
    </li>
    <!-- /Notifications -->

    <li class="nav-item nav-item-box">
        <a href="general-settings.php"><i data-feather="settings"></i></a>
    </li>
    <li class="nav-item dropdown has-arrow main-drop">
        <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
            <span class="user-info">
                <span class="user-letter">
                    <img src="assets/img/profiles/avator1.jpg" alt="" class="img-fluid">
                </span>
                <span class="user-detail">
                    <span class="user-name"><?= htmlspecialchars($username); ?></span>
                    <!-- <span class="user-role">Super Admin</span> -->
                </span>
            </span>
        </a>
        <div class="dropdown-menu menu-drop-user">
            <div class="profilename">
                <hr class="m-0">
                <a class="dropdown-item" href="profile.php"> <i class="me-2" data-feather="user"></i> My
                    Profile</a>
                <a class="dropdown-item" href="general-settings.php"><i class="me-2"
                        data-feather="settings"></i>Settings</a>
                <hr class="m-0">
                <a class="dropdown-item logout pb-0" href="logout.php"><img
                        src="assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
            </div>
        </div>
    </li>
</ul>
<!-- /Header Menu -->

<!-- Mobile Menu -->
<div class="dropdown mobile-user-menu">
    <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="profile.php">My Profile</a>
        <a class="dropdown-item" href="general-settings.php">Settings</a>
        <a class="dropdown-item" href="logout.php">Logout</a>
    </div>
</div>
<!-- /Mobile Menu -->
</div>
<!-- /Header -->