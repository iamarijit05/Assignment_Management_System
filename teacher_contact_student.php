<?php
// Start session
session_start();

// Determine the current page
$current_page = basename($_SERVER['PHP_SELF']);

// Your PHP code to determine the current mode
$currentMode = isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled' ? 'dark' : 'light';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Student</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="teacher_contact_student.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="favicon.ico">
</head>

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="logo.png" alt="Photo">
                </span>
                <div class="text header-text">
                    <span class="name">Assignment Management System</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search-alt-2 icon'></i>
                    <input type="search" placeholder="Search...">
                </li>
                <ul class="menu-links">
                    <li class="nav-link <?php echo $current_page == 'teacher_dashboard.php' ? 'active-link' : ''; ?>">
                        <a href="teacher_dashboard.php">
                            <i class='bx bx-home icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $current_page == 'teacher_profile.php' ? 'active-link' : ''; ?>">
                        <a href="teacher_profile.php">
                            <i class='bx bxs-user-account icon'></i>
                            <span class="text nav-text">View Profile</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $current_page == 'teacher_assn_download.php' ? 'active-link' : ''; ?>">
                        <a href="teacher_assn_download.php">
                            <i class='bx bxs-download icon'></i>
                            <span class="text nav-text">Download Assignment</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $current_page == 'teacher_marks_upload.php' ? 'active-link' : ''; ?>">
                        <a href="teacher_marks_upload.php">
                            <i class='bx bx-upload icon'></i>
                            <span class="text nav-text">Upload Marks</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $current_page == 'teacher_contact_student.php' ? 'active-link' : ''; ?>">
                        <a href="teacher_contact_student.php">
                            <i class='bx bxs-contact icon'></i>
                            <span class="text nav-text">Contact Student</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <li>
                    <a href="logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                <li class="mode">
                    <div class="moon-sun">
                        <i class="bx bx-moon icon moon"></i>
                        <i class="bx bx-sun icon sun"></i>
                    </div>
                    <span class="mode-text text">Dark Mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>

    <header>
        <div class="main-header sizeAdjust">
            <span class="text">Contact Student</span>
        </div>
    </header>

    <div class="maintainWidth">
        <section class="home">
        <div class="container">
        <h1>Contact Student</h1>
        <form method="post">
            <label for="enrollment_id">Enrolment ID:</label>
            <input type="text" id="enrollment_id" name="enrollment_id" placeholder="Enter Enrolment Id" required>
            <input type="submit" value="Fetch">
        </form>

        <div class="details">
            <?php
            if (isset($_POST['enrollment_id'])) {
                $enrollment_id = $_POST['enrollment_id'];
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "assn_mgn";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT full_name, email, mobile_no FROM student_details WHERE enrollment_id = '$enrollment_id'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $full_name = $row['full_name'];
                    $email = $row['email'];
                    $mobile_no = $row['mobile_no'];

                    echo "<h2>Details</h2>";
                    echo "<p><strong>Full Name:</strong> $full_name</p>";
                    echo "<p><strong>Email:</strong> $email</p>";
                    echo "<p><strong>Mobile Number:</strong> $mobile_no</p>";
                } else {
                    echo "<h2>No Details Found</h2>";
                    echo "<p>The provided Enrollment ID does not exist</p>";
                }

                // Close the database connection
                $conn->close();
            } else {
                echo "<h2>Enter Enrolment Please</h2>";
            }
            ?>
        </div>
    </div>
        </section>
    </div>

    <footer>
        <div class="main-footer sizeAdjust">
            <span class="text footer-disclaimer" style="color: white;">
                <p>&copy;Disclaimer:</p>
                <p>This website, developed by Bankim Chandra Das, Arijit Das, Nayanadhir Nandi, and Jagatbandhu Tudu,
                    serves as an assignment management system for educational purposes only. While every effort has been
                    made to ensure its functionality and reliability, users are advised to verify critical information
                    independently. We do not take responsibility for any inaccuracies or disruptions in service. Use at
                    your own discretion.
                </p>
            </span>
            <span class="img"> <img src="FooterLogo.png" alt="image" class="footerlogo">
                <img src="FooterLogo2.png" alt="image" class="footerlogo">
                <img src="FooterLogo3.png" alt="image" class="footerlogoEnd">
            </span>
        </div>
    </footer>
    <script src="script.js"></script>
    <script src="Student-dashboard.js"></script>
</body>

</html>